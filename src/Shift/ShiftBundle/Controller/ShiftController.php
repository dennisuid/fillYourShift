<?php

namespace Shift\ShiftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShiftController extends Controller
{

    public function indexAction()
    {
        return $this->render('@Shift/Shift/index.html.twig');
    }

    public function dashboardAction()
    {
        return $this->render('@Shift/Shift/dashboard.html.twig');
    }

}
