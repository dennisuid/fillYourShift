<?php

/**
 * Controller that will manage edit, 
 * delete, approve and publish the shifts.
 * 
 */

namespace Shift\ShiftBundle\Controller;

use Shift\ShiftBundle\Entity\Shift\Shift;
use Shift\ShiftBundle\Form\User\ShiftType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Shift\ShiftBundle\Entity\Shift\FysShiftApply;
use \Shift\ShiftBundle\Entity\User\FysUser;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Date;

class ShiftController extends Controller {

    public function indexAction() {
        return $this->render('@Shift/Shift/index.html.twig');
    }

    public function dashboardAction() {
        $usertype = $this->getUser()->getUserType();
        $forSubscriptionShifts = []; 
        $subscribedShifts = [];
        $assignedShifts = [];
        $notAssignedShifts = [];

        if ($usertype == "employee") {
            $shifts = $this->getDoctrine()
                    ->getRepository(Shift::class) 
                    ->getNot('CREATED');
            if (!empty($shifts)) {
                foreach ($shifts as $shift) {
                    $shiftApplied = $this->getDoctrine()
                            ->getRepository(FysShiftApply::class)
                            ->findOneBy(['userId' => $this->getUser()->getId(),'shiftId' => $shift->getId()]);
                    
                    if ($shift->getShiftStatus() == "PUBLISHED") {
       
                        if (empty($shiftApplied)){
                            $forSubscriptionShifts[] = $shift;
                        } 
                        else {
                            $subscribedShifts[] = $shift;
                        }
                    } 
                    else {
                        
                        if(!empty($shiftApplied) && $shiftApplied->getApplyStatus() == 'SELECTED'){
                            $assignedShifts[] = $shift;
                        } 
                        else {
                            $notAssignedShifts[] = $shift;
                        }
                    }
                    
                }
            }
            
            return $this->render('@Shift/Shift/employee.html.twig', [
                'forSubscriptionShifts' => $forSubscriptionShifts, 
                'subscribedShifts' => $subscribedShifts,
                'assignedShifts' => $assignedShifts,
                'notAssignedShifts' => $notAssignedShifts
                ]);
        }

        if ($usertype == "employer") {
            return $this->render('@Shift/Shift/employer.html.twig');
        }
        return $this->render('@Shift/Shift/dashboard.html.twig');
    }


    
    

    

}
