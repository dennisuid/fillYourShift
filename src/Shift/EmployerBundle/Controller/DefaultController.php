<?php

namespace Shift\EmployerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shift\EmployerBundle\Entity\User\fysUser;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Requ)
    {
        
        $user = new fysUser();
        $user->setFirstName("Riya");
        $user->setEmail("riyacv@gmail.com");
        $user->setMobileNumber("078954278");
        $user->setUserId(1223);
        $user->setPassword("hello");
        $user->setUserType("admin");
        $user->setPostcode("E18 3QE");
        $user->setCountry("UK");
        $user->setRegistrationNumber("12242343");
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($user);
        if($em->flush()) {
            $message = "Data Saved Successfully";
        }
        
        return $this->render('EmployerBundle:Default:index.html.twig', ['message' => $message]);
    }
}
