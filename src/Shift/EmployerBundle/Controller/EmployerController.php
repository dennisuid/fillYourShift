<?php

namespace Shift\EmployerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Response;
use Shift\EmployerBundle\Entity\User\fysUser;
use Symfony\Component\HttpFoundation\Request;

class EmployerController extends Controller
{

    public function addAction(Request $request)
    {
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
            return new Response("Data Saved Successfully");
        } catch(\Exception $ex){
            return new Response($ex->getMessage());
        }
    }

    public function updateAction()
    {
        return $this->render('EmployerBundle:Employer:update.html.twig', array(
                        // ...
        ));
    }

    public function deleteAction()
    {
        return $this->render('EmployerBundle:Employer:delete.html.twig', array(
                        // ...
        ));
    }

    public function loginAction()
    {
        return $this->render('EmployerBundle:Employer:login.html.twig', array(
                        // ...
        ));
    }

}
