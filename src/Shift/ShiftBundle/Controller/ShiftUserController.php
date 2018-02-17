<?php

namespace Shift\ShiftBundle\Controller;

use Behat\Mink\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Shift\ShiftBundle\Entity\User\FysUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Shift\ShiftBundle\Exception\UserNotFoundException;
use Shift\ShiftBundle\Form\User\FysUserType;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Event\FilterUserResponseEvent;

class ShiftUserController extends Controller
{

    public function getAction(Request $request)
    {
        $user = $this->getDoctrine()
                ->getRepository('ShiftBundle:User\FysUser')
                ->find($request->get('id'));
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        if (!$user) {
            throw new UserNotFoundException(
            "Invalid user id " . $request->get('id'), JsonResponse::HTTP_NOT_FOUND
            );
        }
        $serializer = new Serializer($normalizers, $encoders);
        $response = $serializer->serialize($user, 'json');
        $status = JsonResponse::HTTP_OK;

        return new Response($response, $status, ['Content-type' => 'json']);
    }
    public function profileAction(Request $request)
    {
        return $this->render('@Shift/ShiftUser/profile.html.twig');
    }
    public function registerAction(Request $request)
    {
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        $user = new FysUser();
        $event = new GetResponseUserEvent($user, $request);
        $roles = $this->getDoctrine()
                ->getRepository('ShiftBundle:Org\FysRole')
                ->getAllRoles();
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
        $form = $this->createForm(
                FysUserType::class, 
                $user,
                ['user_types' => $roles,'attr'=> array('class'=>'form-label-left input_mask')]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                try{
                    $user = $form->getData();
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                    $dispatcher->dispatch(
                        FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response)
                    );
                    $this->get('login.valid.user')->loginAsValidUser($user, $request);
                    $url = $this->generateUrl('dashboard');
                    return new RedirectResponse($url);
                }catch (\Exception $e){
                    $this->addFlash('error', "Unable to add the user");
                }

            }
        }
        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

        if (null !== $response = $event->getResponse()) {
            return $response;
        }

        return $this->render('@FOSUser/Registration/register.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
}
