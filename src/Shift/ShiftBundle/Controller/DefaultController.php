<?php

namespace Shift\ShiftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShiftBundle:Default:index.html.twig');
    }
}
