<?php

namespace Shift\ShiftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shift\ShiftBundle\Entity\Shift\Shift;
use Shift\ShiftBundle\Form\User\ShiftType;
use Symfony\Component\HttpFoundation\Request;
use \Shift\ShiftBundle\Entity\Shift\FysShiftApply;
use \Shift\ShiftBundle\Entity\User\FysUser;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Date;

class EmployeeController extends Controller
{
    
    public function dashboardAction() {
        
    }
    
    public function listShiftsAction() {
      // current implementation refer to the Employer Controller function for 'employee' as well  
    }
    
    public function viewShiftAction(Request $request) {

        //getting ID from the request
        $shiftId = $request->get('id');
        $subscriberData = [];
        $shift = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->find($shiftId);
        if (empty($shift)) {
            $this->addFlash(
                    'failure', 'Shift you tried to access dont exist'
            );
        }
        
        
        
        /**
         * @var $shift Shift
         */
        $data = [
            'id' => $shiftId,
            'shift_org_name' => $shift->getOrgName(),
            'pay_lead_time' => $shift->getPayLeadtime(),
            'role_name' => $shift->getRoleName(),
            'start_date_hours' => date_format($shift->getStartDateHours(), "Y/m/d H:i:s"),
            'end_date_hours' => date_format($shift->getEndDateHours(), "Y/m/d H:i:s"),
            'shift_rate' => $shift->getShiftRate(),
            'shift_status' => $shift->getShiftStatus(),
            'shift_created_by' => $shift->getShiftCreatedBy()
        ];
        if ($shift->getShiftStatus() != 'CREATED') {
            $appliedShifts = $this->getDoctrine()
                    ->getRepository(FysShiftApply::class)
                    ->findBy(['shiftId' => $shiftId]);
            if (!empty($appliedShifts)) {
                foreach ($appliedShifts as $appliedShift) {
                    $subscriberData[] = [
                        'applyId' => $appliedShift->getId(),
                        'shiftId' => $appliedShift->getShiftId(),
                        'subscriberId' => $appliedShift->getUserId(),
                        'subscriber_first_name' => $appliedShift->getEmployeeFirstName(),
                        'subscriber_last_name' => $appliedShift->getEmployeeLastName(),
                        'subscriber_resume_id' => $appliedShift->getEmployeeResumeId(),
                        'applied_time' => date_format($appliedShift->getShiftApplyTime(), "Y/m/d H:i:s"),
                        'apply_status' => $appliedShift->getApplyStatus()
                    ];
                }
            }
        }
        
        return $this->render('@Shift/Shift/viewShift.html.twig', ['shift' => $data, 'subscribers' => $subscriberData]);
    }
    
    
    public function subscribeShiftAction(Request $request) {

        $shiftId = $request->get('id');
        $this->updated = new \DateTime();

        $em = $this->getDoctrine()->getManager();

        $fysShiftApply = new FysShiftApply();
        $fysShiftApply->setUserId($this->getUser()->getId());
        $fysShiftApply->setShiftId($shiftId);

        $fysShiftApply->setEmployeeFirstName($this->getUser()->getFirstName());
        $fysShiftApply->setEmployeeLastName($this->getUser()->getLastName());
        $fysShiftApply->setEmployeeResumeId(200);
        $fysShiftApply->setShiftApplyTime();
        $fysShiftApply->setApplyStatus('SUBSCRIBED');
        $em->persist($fysShiftApply);
        $em->flush();
        
        $shift = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->find($shiftId);
        
        $this->get('fys.genericEvent')->genericEvent('SHIFT_SUBSCRIBED', 'SHIFT', $this->getUser(), $shift); //generating an event for CREATE
        
        return $this->redirectToRoute('dashboard');
    }

    public function unsubscribeShiftAction(Request $request) {

//        $shiftId = $request->get('id');
//        $em = $this->getDoctrine()->getManager();
//     
//        $fysShiftApply = new FysShiftApply();
//        $fysShiftApply->setuserId($this->getUser()->getId());
//        $fysShiftApply->setShiftId($shiftId);
//        $fysShiftApply->setShiftApplyId(100); // need to decide if we need this field
//        $fysShiftApply->setEmployeeFirstName($this->getUser()->getFirstName());
//        $fysShiftApply->setEmployeeLastName($this->getUser()->getLastName());
//        $fysShiftApply->setEmployeeResumeId(200);
//        $fysShiftApply->setShiftApplyTime(date(now));
//        
//        $em->persist($fysShiftApply);
//        $em->flush();
//        
//        return $this->redirectToRoute('dashboard');
        
    }


   
    public function employeeViewShiftAction (Request $request) {

        //getting ID from the request
        $shiftId = $request->get('id');
        
        $shift = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->find($shiftId);
        if (empty($shift)) {
            $this->addFlash(
                    'failure', 'Shift you tried to access dont exist'
            );
        }
        
        return $this->render('@Shift/Shift/eViewShift.html.twig', ['shift' => $shift]);
    }
    
    public function acceptShiftAction (Request $request) {

        $shiftId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
        $status = 'ACCEPTED';
        $shift->setShiftStatus($status);
        $em->persist($shift);
        $em->flush();
        
        $this->addFlash(
                    'success', 'Thanks for Accepting the Shift'
            );
        
        $this->get('fys.genericEvent')->genericEvent('SHIFT_ACCEPTED', 'SHIFT', $this->getUser(), $shift); //generating an event for CREATE

        return $this->redirectToRoute('employeeViewShift', array('id' => $shiftId));
    }
    
    public function checkInShiftAction (Request $request) {
        
        $shiftId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
       

        
        date_default_timezone_set('Europe/London');
        
        $datetime1 = $shift->getStartDateHours();
        $datetime2 = date_create('now');
        //$interval = $datetime1->diff($datetime2);
        
        $interval = date_diff($datetime1,$datetime2,FALSE);
        
        if ($interval->format('%d') >= 1) {
         
            $this->addFlash(
                    'failure', 'You can not check IN earlier than one hour to start of shift'
            );
            
        }
        else{
         
            $status = 'CHECKEDIN';
            $shift->setShiftStatus($status);
            $em->persist($shift);
            $em->flush();
        
        $this->get('fys.genericEvent')->genericEvent('SHIFT_CHECKEDIN', 'SHIFT', $this->getUser(), $shift); //generating an event for CREATE

        }
        
        
        $this->addFlash(
                    'success', 'You have Checked IN. Good luck'
            );
        
        //email should go to shift created by
        return $this->redirectToRoute('employeeViewShift', array('id' => $shiftId));
    }
    
    public function completeShiftAction (Request $request) {

        $shiftId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
       
        date_default_timezone_set('Europe/London');
        
        $datetime1 = $shift->getEndDateHours();
        $datetime2 = date_create('now');
        
        $interval = date_diff($datetime2,$datetime1,FALSE);
        
        var_dump('I am in complete');
        var_dump($datetime1);
        var_dump($datetime2);
        
        var_dump($interval->format('%d'));
        
        if ($interval->format('%d') <= 0) {
            
            $endTimeString = $datetime1->format('Y-M-d H');
            $this->addFlash(
                    'failure', "You can mark complete only after shift ends at:  $endTimeString" 
            );
            
        }
        else{
         
            $status = 'COMPLETE';
            $shift->setShiftStatus($status);
            $em->persist($shift);
            $em->flush();
            
            $this->addFlash(
                    'success', 'Well done on completing shift. We will progress with payment approvals'
            );
            
            $this->get('fys.genericEvent')->genericEvent('SHIFT_COMPLETE', 'SHIFT', $this->getUser(), $shift);
        }
        
        
        
        
        //email should go to shift created by
        
        return $this->redirectToRoute('employeeViewShift', array('id' => $shiftId));
    }
    
}
