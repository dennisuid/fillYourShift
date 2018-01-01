<?php

/**
 * Controller that will manage edit, 
 * delete, approve and publish the shifts.
 * 
 */

namespace Shift\ShiftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shift\ShiftBundle\Entity\Shift\FysShiftApply;
use Shift\ShiftBundle\Form\User\ShiftType;
use Symfony\Component\HttpFoundation\Request;
use Shift\ShiftBundle\Entity\Shift\Shift;

class ShiftController extends Controller {

    public function indexAction() {
        return $this->render('@Shift/Shift/index.html.twig');
    }

    public function dashboardAction() {
        $usertype = $this->getUser()->getUserType();
        $shiftIds = [];
    
        if ($usertype == "employee") {
            $shiftDetails = $this->getDoctrine()
                    ->getRepository('Shift\ShiftBundle\Entity\Shift\FysShiftApply')
                    ->getByUserId($this->getUser()->getUserId());
            if (!empty($shiftDetails)) {
                foreach ($shiftDetails as $shift) {
                    $shiftIds[] = $shift->getShiftId();
//                    $shiftDetails = $this->getDoctrine()
//                            ->getRepository('Shift\ShiftBundle\Entity\Shift\Shift')
//                            ->findOneBy(['shift_id', $shiftId]);
  
                }
            }
            return $this->render('@Shift/Shift/employee.html.twig', ['shiftIds' => $shiftIds]);
        }

        if ($usertype == "employer") {
            return $this->render('@Shift/Shift/employer.html.twig');
        }
//        
        return $this->render('@Shift/Shift/dashboard.html.twig');
    }

    public function createNewShiftAction(Request $request) {
        $shift = new Shift();
        $form = $this->createForm(ShiftType::class, $shift);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $shift = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($shift);
            $em->flush();
        }
        return $this->render('@Shift/Shift/createShift.html.twig', [
                    'form' => $form->createView()
        ]);
    }

}
