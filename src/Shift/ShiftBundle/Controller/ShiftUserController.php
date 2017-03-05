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
use Shift\ShiftBundle\Form\User\fysUserType;

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
            throw new UserNotFoundException("Invalid user id " . $request->get('id'), JsonResponse::HTTP_NOT_FOUND
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
        try {
            $user = new fysUser();
            $form = $this->createForm(fysUserType::class, $user);
            $form->handleRequest($request);
            $message = "";
            if ($form->isSubmitted()) {
                $user = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $message = 'User added successfully';
                return new JsonResponse(['description' => $message],
                        Response::HTTP_CREATED, 
                        ['Content-type' => 'json']
                );
            }
        } catch (Exception $ex) {
            $message = $ex->getMessage() . " " . $ex->getCode();
        }
        return $this->render("ShiftBundle:ShiftUser:add.html.twig", [
                    'form' => $form->createView()
        ]);
    }
    
    public function loginAction()
    {
        return $this->render('ShiftBundle:ShiftUser:login.html.twig', array(
                        // ...
        ));
    }

}