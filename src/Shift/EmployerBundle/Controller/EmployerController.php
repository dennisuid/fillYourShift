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

    public function updateAction(Request $request)
    {
        try {
            $user = new fysUser();
            $user->setFirstName($request->get('first_name'));
            $user->setFirstName($request->get('last_name'));
            $user->setEmail($request->get('email'));
            $user->setMobileNumber($request->get('mobile_number'));
            $user->setUserId($request->get('userid'));
            $user->setFirstName($request->get('user_type'));
            $user->setPassword($request->get('password'));
            $user->setUserType($request->get('house_number'));
            $user->setFirstName($request->get('address_line1'));
            $user->setFirstName($request->get('address_line2'));
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

    public function getAction(Request $request)
    {
         $user = $this->getDoctrine()
                 ->getRepository('EmployerBundle:User\fysUser')
                 ->find($request->get('id'));
         
         return new Response($user->getFirstName());
    }
    
    public function deleteAction(Request $request)
    {
        $user = new fysUser();
        $user->setFirstName($request->get('user_id'));
        // how to write delete code into DB
    }

    public function loginAction(Request $request)
    {
        $user = new fysUser();
        $user->setFirstName($request->get('email'));
        $user->setFirstName($request->get('password'));
        // how to write delete code into DB
    }

}
