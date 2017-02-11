<?php

namespace Shift\EmployerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmployerBundle:Default:index.html.twig');
    }
}
