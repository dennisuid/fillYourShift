<?php

namespace Shift\ShiftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Shift\ShiftBundle\Entity\User\fysUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Shift\ShiftBundle\Exception\UserNotFoundException;

class ShiftUserController extends Controller
{

    public function getAction(Request $request)
    {
        $user = $this->getDoctrine()
                ->getRepository('ShiftBundle:User\fysUser')
                ->find($request->get('id'));
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        if (!$user) {
            throw new UserNotFoundException("Invalid user id " . $request->get('id'),
            JsonResponse::HTTP_NOT_FOUND
            );
        }
        $serializer = new Serializer($normalizers, $encoders);
        $response = $serializer->serialize($user, 'json');
        $status = JsonResponse::HTTP_OK;

        return new Response($response, $status, ['Content-type' => 'json']);
    }

    public function deleteAction()
    {
        return $this->render('ShiftBundle:ShiftUser:delete.html.twig', array(
                        // ...
        ));
    }

    public function updateAction()
    {
        return $this->render('ShiftBundle:ShiftUser:update.html.twig', array(
                        // ...
        ));
    }

    public function addAction(Request $request)
    {
        $error = "";
        try {
            $user = new fysUser();
            $user->setFirstName($request->get('first_name'));
            $user->setEmail($request->get('email'));
            $user->setMobileNumber($request->get('mobile_number'));
            $user->setUserId($request->get('userid'));
            $user->setPassword($request->get('password'));
            $user->setUserType($request->get('user_type'));
            $user->setPostcode($request->get('postcode'));
            $user->setCountry($request->get('country'));
            $user->setRegistrationNumber($request->get('registration_number'));
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();
            $success = " User added successfully";
        } catch (Exception $ex) {
            $error = $ex->getMessage();
        }

        return $this->render('ShiftBundle:ShiftUser:add.html.twig', array(
                    'error' => $error,
                    'success' => $success
        ));
    }

    public function loginAction()
    {
        return $this->render('ShiftBundle:ShiftUser:login.html.twig', array(
                        // ...
        ));
    }

}
