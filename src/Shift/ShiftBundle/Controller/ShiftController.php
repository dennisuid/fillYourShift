<?php

/**
 * Controller that will manage edit, 
 * delete, approve and publish the shifts.
 * 
 */

namespace Shift\ShiftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shift\ShiftBundle\Entity\Shift\Shift;
use Shift\ShiftBundle\Form\User\ShiftType;
use Symfony\Component\HttpFoundation\Request;

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

    public function createNewShiftAction(Request $request)
    {
        $shift = new Shift();
        $form = $this->createForm(ShiftType::class, $shift);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $shift = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($shift);
            $em->flush();
        }
        return $this->render('@Shift/Shift/createShift.html.twig',
                [
                    'form' => $form->createView()
                ]);
    }

}
