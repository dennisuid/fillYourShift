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
use \Shift\ShiftBundle\Entity\Event\FysEvents;

class EmployerController extends Controller
{
    
    public function dashboardAction() {
        
    }
    
    public function employerShiftFlowAction(Request $request)
    {
        $selectedSubscriber = [];
        $shiftId = $request->get('id');
        $subscribers = [];
        $shift = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->find($shiftId);
        if (empty($shift)) {
            $this->addFlash(
                    'failure', 'Shift you tried to access dont exist'
            );
        }
        

        if ($shift->getShiftStatus() != 'CREATED') {
            $subscribers = $this->getDoctrine()
                    ->getRepository(FysShiftApply::class)
                    ->findBy(['shiftId' => $shiftId]);
            if (!empty($subscribers)) {
                foreach ($subscribers as $subscriber) {
                    
                    if ($shift->getShiftStatus() == "APPROVED" || "ACCEPTED" || "CHECKEDIN" || 'COMPLETED'){
                        
                        if($subscriber->getApplyStatus() == "SELECTED"){
                           
                          $selectedSubscriber = $this->getDoctrine()
                                ->getRepository(FysUser::class)
                                ->findOneBy(['id' => $subscriber->getUserId()]);
                           
                        }
                            
                    }
                }
            }
        }
        
        $eventTrails = $this->getDoctrine()
                    ->getRepository(FysEvents::class)
                    ->findBy(['eventModifiedObjectId' => $shiftId]);
        
         $form = $this->createForm(ShiftType::class, $shift, array(
            'action' => $this->generateUrl('submitShift'),
            'method' => 'POST',
            'mode' => 'create',
            'payleadtime' => $this->container->getParameter('shift.pay_leadtime'),
            'shiftCreatedBy' => $this->getUser()->getEmail(),
            'shiftCreatedById' => $this->getUser()->getID()
           
        ));
        

        
        $form->handleRequest($request);

        
        return $this->render('@Shift/Shift/employerShiftFlow.html.twig', ['form' => $form->createView(), 'shift' => $shift, 'subscribers' => $subscribers, 'selectedSubscriber' => $selectedSubscriber, 'eventTrails' => $eventTrails]);
    }
    
    public function createNewShiftAction(Request $request) {
        $shift = new Shift();
//      $shift->setPayLeadtime($this->container->getParameter('shift.pay_leadtime'));
        $form = $this->createForm(ShiftType::class, $shift, array(
            'action' => $this->generateUrl('submitShift'),
            'method' => 'POST',
            'mode' => 'create',
            'payleadtime' => $this->container->getParameter('shift.pay_leadtime'),
            'shiftCreatedBy' => $this->getUser()->getEmail(),
            'shiftCreatedById' => $this->getUser()->getID()
           
        ));
        

        
        $form->handleRequest($request);

        return $this->render('@Shift/Shift/createShift.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    public function submitShiftAction(Request $request) {

        $shift = new Shift();
        $shiftId = null;
        $form = $this->createForm(ShiftType::class, $shift);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $shift = $form->getData();
            
            //everything to do with date picker here
            
//            var_dump($shift->getStartDateHours());
//            var_dump($shift->getShiftRate());
//            
//            $startTime = $request->request->get('start_date_hours');
//            var_dump($startTime);
//            //var_dump($request);
//            
//            $startDateHours = date_create_from_format('Y-m-d H:i:s', $shift->getStartDateHours());
//            $shift->setStartDateHours($startDateHours);
//            
//            //$shift->setStartDateHours($startTime);
//            var_dump($shift->getStartDateHours());
//            var_dump($shift);
//            
//            $endDateHours = date_create_from_format('Y-m-d H:i:s', $shift->getEndDateHours());
//            $shift->setEndDateHours($endDateHours);
            
            // Everything to do with date picker ends 
            
            $shift->setShiftJobRate(5.7);
     
//            print_r($shift); die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($shift);
            $em->flush();
        }
        
        $this->get('fys.genericEvent')->genericEvent('SHIFT_CREATED', 'SHIFT', $this->getUser(), $shift); //generating an event for CREATE
        
        if (!empty($shift->getId())) {
            $shiftId = $shift->getId();
        }

        return $this->redirectToRoute('viewShift', array('id' => $shiftId));
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
            'start_date_hours' => $shift->getStartDateHours(),
            'end_date_hours' => $shift->getEndDateHours(),
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

    public function deleteShiftAction(Request $request) {


        $shiftId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
        $em->remove($shift);
        $em->flush();
        //building form with SHIFT returned from DB
        
        $this->get('fys.genericEvent')->genericEvent('SHIFT_DELETED', 'SHIFT', $this->getUser(), $shift); //generating an event for DELETE
        
        $shifts = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->findBy(['shiftCreatedById' => $this->getUser()->getId()]);

        return $this->render('@Shift/Shift/listShifts.html.twig', ['shifts' => $shifts]);
    }

    public function updateShiftAction(Request $request) {

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
        $form = $this->createForm(ShiftType::class, $shift, array(
            'action' => $this->generateUrl('saveShift', array('id' => $shiftId)), // how to dynamically add the id? 
            'method' => 'POST',
            'mode' => 'create'
        ));

        return $this->render('@Shift/Shift/createShift.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    public function saveShiftAction(Request $request, Shift $shift) {

        $form = $this->createForm(ShiftType::class, $shift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $shiftId = $request->get('id');
            $shift = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->find($shiftId);
            $shift = $form->getData();
            
            var_dump($shift->getStartDateHours());
            var_dump($request->get('shift_start_date_hours'));
            
            var_dump($shift->getEndDateHours());
            var_dump($request->get('shift_end_date_hours'));
            
            $shift->setShiftCreatedBy($this->getUser()->getEmail());
            $shift->setShiftCreatedById($this->getUser()->getId());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($shift);
            $em->flush();
            
        }
        
        $this->get('fys.genericEvent')->genericEvent('SHIFT_MODIFIED', 'SHIFT', $this->getUser(), $shift); //generating an event for CREATE
        
        $shifts = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->findBy(['shiftCreatedById' => $this->getUser()->getId()]);

        return $this->render('@Shift/Shift/listShifts.html.twig', ['shifts' => $shifts]);
    }

    public function listShiftsAction() {
        $em = $this->getDoctrine()->getManager();
        $shifts = $em->getRepository(Shift::class)->findBy(['shiftCreatedById' => $this->getUser()->getId()]);
        

//        foreach ($shifts as $shift) {
//            $results[] = [
//                'id' => htmlspecialchars($shift->getId()),
//                'org_name' => $shift->getOrgName(),
//            ];
//        }
        return $this->render('@Shift/Shift/listShifts.html.twig', ['shifts' => $shifts]);
    }

    public function publishShiftAction(Request $request) {

        $shiftId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
        $status = 'PUBLISHED';
        $shift->setShiftStatus($status);
        $em->persist($shift);
        $em->flush();
        
        $this->get('fys.genericEvent')->genericEvent('SHIFT_PUBLISHED', 'SHIFT', $this->getUser(), $shift); //generating an event for CREATE
        
        return $this->redirectToRoute('viewShift', array('id' => $shiftId));
    }



    public function approveShiftAction(Request $request) {

        $shiftId = $request->get('id');
        $subscriberId = $request->get('subscriberId');
        $em = $this->getDoctrine()->getManager();
        
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
        $subscriber = $em->getRepository(FysUser::class)
                ->findOneBy(['id' => $subscriberId]);
        $appliedShifts = $em->getRepository(FysShiftApply::class)
                    ->findBy(['shiftId' => $shiftId]);
        
        // Add employee details to the Shift and Change status to APPROVED
        
        if (!empty($subscriber)) {
        
        $status = 'APPROVED';
        $shift->setShiftStatus($status);
        $shift->setShiftAssignedEmployee($subscriber->getFirstName());
        $shift->setShiftAssignedEmployeeId($subscriber->getId());
        $shift->setShiftAssignedResumeId(200);
        $shift->setShiftAssignedPhone($subscriber->getMobileNumber());
        $shift->setShiftAssignedEmail($subscriber->getEmail());
        $em->persist($shift);
        $em->flush(); 
        }
        
        // Update all the applicants about the status of the Shift in SHiftApply table
        
        if (!empty($appliedShifts)) {
                foreach ($appliedShifts as $appliedShift) {
                    
                    if($appliedShift->getUserId() == $subscriberId){
                       $appliedShift->setApplyStatus('SELECTED'); 
                    }
                    else{
                        $appliedShift->setApplyStatus('NOTSELECTED');
                    }
                    
                    $em->persist($appliedShift);
                    $em->flush();
                }
        
        }
        
        $this->get('fys.genericEvent')->genericEvent('SHIFT_APPROVED', 'SHIFT', $this->getUser(), $shift); //generating an event for CREATE
        //
        // Send the list of all Shifts created by this user
        
        $shiftsForThisUser = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->findBy(['shiftCreatedById' => $this->getUser()->getId()]);

        return $this->render('@Shift/Shift/listShifts.html.twig', ['shifts' => $shiftsForThisUser]);
    }
    

    
}
