<?php

namespace Shift\ShiftBundle\Controller;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookResponse;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Google_Client;
use Google_Service_Oauth2_Userinfoplus;
use Shift\ShiftBundle\Entity\User\FysUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class UserController extends BaseController
{
    public function loginAction(Request $request)
    {
        /** @var $session Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;
        $googleUrl = $this->getGoogleUrl();
        $faceBookUrl = $this->getFaceBookUrl();
        $data = array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
            'google_url' => $googleUrl,
            'facebook_url' => $faceBookUrl,
        );
        return $this->render('@FOSUser/Security/login.html.twig', $data);
    }

    private function getGoogleUrl()
    {
        $client = $this->createGoogleClient();
        return $client->createAuthUrl();// to get login url
    }
    private function getFaceBookUrl()
    {
        $client = $this->createFaceBookClient();
        $helper = $client->getRedirectLoginHelper();
        $scope = ['email'];
        return $helper->getLoginUrl( $this->container->getParameter('facebook_redirect_url'), $scope);
    }
    public function redirectWithGoogleAction(Request $request)
    {
        $client = $this->createGoogleClient();
        $service = new \Google_Service_Oauth2($client);
        $code = $client->authenticate($request->query->get('code'));// to get code
        $client->setAccessToken($code);// to get access token by setting of $code
        $userDetails = $service->userinfo->get();// to get user detail by using access token
        $roles = $this->getDoctrine()
            ->getRepository('ShiftBundle:Org\FysRole')
            ->getAllRoles();
        if ($userDetails) {
            $email = $userDetails->getEmail();
            $user = $this->checkEmailExistsAndReturnUser($email);
            $userTypeExists = $this->checkUserTypeExistsForAnEmail($email);
            if ($user && $userTypeExists) {
                //@TODO we may need to check the password here
                return $this->loginAsValidUser($user, $request);
            }
            if ($this->validateGoogleUserDetails($userDetails)) {
                $this->createUserFromGoogleAccountData($userDetails);
                return $this->render('@Shift/ShiftUser/getExtraUserDetails.html.twig', ['email' => $email, 'roles' => $roles]);
            }
        }
        //@TODO if the google login details are not valid then we should redirect to login
        return $this->render('@Shift/ShiftUser/getExtraUserDetails.html.twig', ['email' => null, 'roles' => $roles]);
    }

    public function saveExtraDetailsAction(Request $request)
    {
        $email = $request->request->get('email');
        $userType = $request->request->get('usertype');
        $mobile = $request->request->get('mobile');
        $postcode = $request->request->get('postcode');
        /**
         * @var $user FysUser
         */
        $user = $this->checkEmailExistsAndReturnUser($email);
        if ($user) {
            $user->setUserType($userType);
            $user->setMobileNumber($mobile);
            $user->setPostcode($postcode);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        $this->get('login.valid.user')->loginAsValidUser($user, $request);

        $url = $this->generateUrl('dashboard');
        return new RedirectResponse($url);
    }

    private function createUserFromGoogleAccountData(Google_Service_Oauth2_Userinfoplus $googleUserDetails)
    {
        if (!$this->checkEmailExistsAndReturnUser($googleUserDetails->getEmail())) {
            $user = new FysUser();
            $user->setEmail($googleUserDetails->getEmail());
            $user->setPassword($googleUserDetails->getId());
            $user->setUsername($googleUserDetails->getEmail());
            $user->setFirstName($googleUserDetails->getGivenName());
            $user->setLastName($googleUserDetails->getFamilyName());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
    }
    /**
     * @param $email
     * @return bool|object
     */
    private function checkEmailExistsAndReturnUser($email)
    {
        $user = $this->getDoctrine()
            ->getRepository(FysUser::class)
            ->findOneBy(['email' => $email]);
        if (!$user) {
            return false;
        }
        if ($user->getEmail() != "") {
            return $user;
        }
        return false;
    }

    private function checkUserTypeExistsForAnEmail($email)
    {
        /**
         * @var $user FysUser
         */
        $user = $this->getDoctrine()
            ->getRepository(FysUser::class)
            ->findOneBy(['email' => $email]);
        if (!$user) {
            return false;
        }
        if ($user->getUserType() != "") {
            return true;
        }
        return false;
    }

    private function validateGoogleUserDetails(Google_Service_Oauth2_Userinfoplus $googleUserDetails)
    {
        if (is_null($googleUserDetails)) {
            return false;
        }
        if ($googleUserDetails->getEmail() == null) {
            return false;
        }
        if (!$googleUserDetails->getVerifiedEmail()) {
            return false;
        }
        return true;
    }

    private function createGoogleClient()
    {
        $client = new Google_Client();
        $client->setApplicationName($this->container->getParameter('googleplus_application_name'));// to set app name
        $client->setClientId($this->container->getParameter('googleplus_client_id'));// to set app id or client id
        $client->setClientSecret($this->container->getParameter('googleplus_secret'));// to set app secret or client secret
        $client->setRedirectUri($this->container->getParameter('googleplus_redirect_url'));// to set redirect uri
        $client->setScopes(['email profile']);
        return $client;
    }
    public function loginWithFacebookAction()
    {
        $this->createFaceBookClient();
    }
    private function createFaceBookClient()
    {
        $client = new Facebook([
            'app_id' => $this->container->getParameter('facebook_client_id'),
            'app_secret' => $this->container->getParameter('facebook_secret'),
            'default_graph_version' => $this->container->getParameter('facebook_graph_version'),
        ]);
        return $client;
    }

}