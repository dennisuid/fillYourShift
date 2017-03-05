<?php

namespace Shift\ShiftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShiftController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShiftBundle:Shift:index.html.twig');
    }
}
