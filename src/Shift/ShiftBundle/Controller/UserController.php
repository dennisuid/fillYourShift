<?php

namespace Shift\ShiftBundle\Controller;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookResponse;
use Facebook\GraphNodes\GraphUser;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Google_Client;
use Google_Service_Oauth2_Userinfoplus;
use Shift\ShiftBundle\Entity\User\FysUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

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
        $scope = ['email', 'public_profile', 'user_location'];
        return $helper->getLoginUrl($this->container->getParameter('facebook_redirect_url'), $scope);
    }

    public function redirectWithGoogleAction(Request $request)
    {
        $client = $this->createGoogleClient();
        $service = new \Google_Service_Oauth2($client);
        $code = $client->authenticate($request->query->get('code'));// to get code
        $client->setAccessToken($code);// to get access token by setting of $code
        $userDetails = $service->userinfo->get();// to get user detail by using access token
        if ($userDetails) {
            $googleId = $userDetails->getId();
            $couldLogIn = $this->loginAlreadyExistingUserFromGoogleWithId($googleId, $request);
            if ($couldLogIn) {
                $url = $this->generateUrl('dashboard');
                return new RedirectResponse($url);
            }
            $roles = $this->getDoctrine()
                ->getRepository('ShiftBundle:Org\FysRole')
                ->getAllRoles();
            return $this->createUserFromGoogleAndAskForExtraDetails($userDetails, $roles);
        }
        $url = $this->generateUrl('login');
        return new RedirectResponse($url);
    }

    private function createUserFromGoogleAndAskForExtraDetails(Google_Service_Oauth2_Userinfoplus $googleUserDetail, array $roles)
    {
        if ($this->validateGoogleUserDetails($googleUserDetail)) {
            $created = $this->createUserFromGoogleAccountData($googleUserDetail);
            if ($created) {
                $data = ['email' => $googleUserDetail->getEmail(), 'roles' => $roles, 'googleplus_id' => $googleUserDetail->getId()];
                return $this->render('@Shift/ShiftUser/getExtraUserDetails.html.twig', $data);
            }
        }
        $message = 'Cant login using google details';
        $this->addFlash('error', $message);
        $url = $this->generateUrl('login');
        return new RedirectResponse($url);
    }

    private function loginAlreadyExistingUserFromGoogleWithId($googleId, $request)
    {
        $loggedIn = false;
        /** @var $user FysUser * */
        $user = $this->checkFieldExistsAndReturnUser('googleplus_id', $googleId);
        if ($user) {
            $email = $user->getEmail();
            //TODO need to figure out whether we need to check this
            $userTypeExists = $this->checkUserTypeExistsForAField('email', $email);
            if ($user && $userTypeExists) {
                $loggedIn = $this->get('login.valid.user')->loginAsValidUser($user, $request);
            }
        }
        return $loggedIn;
    }

    private function loginAlreadyExistingUserFromFaceBookWithId($facebookId, $request)
    {
        $loggedIn = false;
        /** @var $user FysUser * */
        $user = $this->checkFieldExistsAndReturnUser('facebook_id', $facebookId);
        if ($user) {
            //TODO need to figure out whether we need to check this
            $facebookId = $user->getFacebookId();
            $userTypeExists = $this->checkUserTypeExistsForAField('facebook_id', $facebookId);
            if ($user && $userTypeExists) {
                $loggedIn = $this->get('login.valid.user')->loginAsValidUser($user, $request);
            }
        }
        return $loggedIn;
    }

    public function redirectWithFaceBookAction(Request $request)
    {
        try {
            $client = $this->createFaceBookClient();
            $helper = $client->getRedirectLoginHelper();
            $accessToken = $helper->getAccessToken();
            $client->setDefaultAccessToken($accessToken);
            /** @var $response FacebookResponse * */
            $response = $client->get('/me', $accessToken);
            /** @var $userDetails GraphUser * */
            $userDetails = $response->getGraphUser();
            if ($userDetails->getId()) {
                $userId = (int)$userDetails->getId();
                $couldLogin = $this->loginAlreadyExistingUserFromFaceBookWithId($userId, $request);
                if ($couldLogin) {
                    $url = $this->generateUrl('dashboard');
                    return new RedirectResponse($url);
                }
                $roles = $this->getDoctrine()
                    ->getRepository('ShiftBundle:Org\FysRole')
                    ->getAllRoles();
                return $this->createUserFromFaceBookAndAskForExtraDetails($userDetails, $roles);
            }
            $url = $this->generateUrl('login');
            return new RedirectResponse($url);

        } catch (FacebookSDKException $e) {
            $message = 'Facebook SDK returned an error: ' . $e->getMessage();
            $this->addFlash('error', $message);
            $url = $this->generateUrl('login');
            return new RedirectResponse($url);
        }
    }

    private function createUserFromFaceBookAndAskForExtraDetails(GraphUser $facebookUserDetails, $roles)
    {
        $email = null;
        $facebookId = null;
        $created = false;
        if ($this->validateFaceBookUserDetails($facebookUserDetails)) {
            $facebookId = $facebookUserDetails->getId();
            $created = $this->createUserFromFacebookAccountData($facebookUserDetails);
        }
        if ($created) {
            $data = ['email' => $email, 'roles' => $roles, 'facebook_id' => $facebookId];
            return $this->render('@Shift/ShiftUser/getExtraUserDetails.html.twig', $data);
        }
        $message = 'Cant login using facebook details';
        $this->addFlash('error', $message);
        $url = $this->generateUrl('login');
        return new RedirectResponse($url);
    }

    public function saveExtraDetailsAction(Request $request)
    {
        $email = $request->request->get('email');
        $facebookId = $request->request->get('facebook_id');
        $userType = $request->request->get('usertype');
        $mobile = $request->request->get('mobile');
        $postcode = $request->request->get('postcode');
        if (!empty($email) && empty($facebookId)) {
            /**
             * @var $user FysUser
             */
            $user = $this->checkFieldExistsAndReturnUser('email', $email);
        }
        //this is the facebook login scenario
        if (!empty($facebookId) && !empty($email)) {
            $firstName = $request->request->get('first_name');
            $lastName = $request->request->get('last_name');
            /**
             * @var $user FysUser
             */
            $user = $this->checkFieldExistsAndReturnUser('facebook_id', $facebookId);
            $user->setEmail($email);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
        }
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

    private function createUserFromFacebookAccountData(GraphUser $facebookUserDetails)
    {
        if (
            !$this->checkFieldExistsAndReturnUser('facebook_id', $facebookUserDetails->getId()) &&
            !$this->checkFieldExistsAndReturnUser('username', $facebookUserDetails->getName())
        ) {
            $user = new FysUser();
            $user->setUsername($facebookUserDetails->getName());
            $user->setPassword($facebookUserDetails->getId());
            $user->setFacebookId($facebookUserDetails->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return true;
        }
        return false;
    }

    private function createUserFromGoogleAccountData(Google_Service_Oauth2_Userinfoplus $googleUserDetails)
    {
        $userName = $googleUserDetails->getGivenName() . " " . $googleUserDetails->getFamilyName();
        if (
            !$this->checkFieldExistsAndReturnUser('email', $googleUserDetails->getEmail()) &&
            !$this->checkFieldExistsAndReturnUser('username', $userName)
        ) {
            $user = new FysUser();
            $user->setEmail($googleUserDetails->getEmail());
            $user->setPassword($googleUserDetails->getId());
            $user->setGoogleplusId($googleUserDetails->getId());
            $user->setUsername($userName);
            $user->setFirstName($googleUserDetails->getGivenName());
            $user->setLastName($googleUserDetails->getFamilyName());
            $user->setEnabled(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return true;
        }
        return false;
    }

    /**
     * @param $field
     * @param $value
     * @return bool|object
     */
    private function checkFieldExistsAndReturnUser($field, $value)
    {
        $user = $this->getDoctrine()
            ->getRepository(FysUser::class)
            ->findOneBy([$field => $value]);
        if (!$user) {
            return false;
        }
        return $user;
    }

    private function checkUserTypeExistsForAField($field, $value)
    {
        /**
         * @var $user FysUser
         */
        $user = $this->checkFieldExistsAndReturnUser($field, $value);
        if (!empty($user) && $user->getUserType() != "") {
            return true;
        }
        return false;
    }

    private function validateFaceBookUserDetails(GraphUser $facebookUser)
    {
        if (empty($facebookUser)) {
            return false;
        }
        if ($facebookUser->getId() == null) {
            return false;
        }
        if ($facebookUser->getName() == null) {
            return false;
        }
        return true;
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