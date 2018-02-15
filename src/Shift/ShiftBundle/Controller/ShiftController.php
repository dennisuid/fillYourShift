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

    public function createNewShiftAction(Request $request) {
        $shift = new Shift();
//        $shift->setPayLeadtime($this->container->getParameter('shift.pay_leadtime'));
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
            var_dump($shift->getStartDateHours());
            var_dump($shift->getShiftRate());
            
            $startTime = $request->request->get('start_date_hours');
            var_dump($startTime);
            //var_dump($request);
            
            $startDateHours = date_create_from_format('Y-m-d H:i:s', $shift->getStartDateHours());
            $shift->setStartDateHours($startDateHours);
            
            //$shift->setStartDateHours($startTime);
            var_dump($shift->getStartDateHours());
            var_dump($shift);
            
            $endDateHours = date_create_from_format('Y-m-d H:i:s', $shift->getEndDateHours());
            $shift->setEndDateHours($endDateHours);
            $shift->setShiftJobRate(5.7);
//            print_r($shift); die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($shift);
            $em->flush();
        }
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

    public function deleteShiftAction(Request $request) {


        $shiftId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
        $em->remove($shift);
        $em->flush();
        //building form with SHIFT returned from DB
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
            $this->getDoctrine()->getManager()->flush();
        }

        $shifts = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->findBy(['shiftCreatedById' => $this->getUser()->getId()]);

        return $this->render('@Shift/Shift/listShifts.html.twig', ['shifts' => $shifts]);
    }

    public function listShiftsAction() {
        $em = $this->getDoctrine()->getManager();
        $shifts = $em->getRepository(Shift::class)->findBy(['shiftCreatedById' => $this->getUser()->getId()]);
        ;

        foreach ($shifts as $shift) {
            $results[] = [
                'id' => htmlspecialchars($shift->getId()),
                'org_name' => $shift->getOrgName(),
            ];
        }
        return $this->render('@Shift/Shift/listShifts.html.twig', [
                    'shifts' => $results
        ]);
    }

    public function publishShiftAction(Request $request) {

        $shiftId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
        $status = 'PUBLISHED';
        $shift->setShiftStatus($status);
        $em->persist($shift);
        $em->flush();

        return $this->redirectToRoute('viewShift', array('id' => $shiftId));
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
        echo $shift->getShiftStatus();
        $em->persist($shift);
        $em->flush();    
        echo "done the saving";
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
        
        // Send the list of all Shifts created by this user
        
        $shiftsForThisUser = $this->getDoctrine()
                ->getRepository(Shift::class)
                ->findBy(['shiftCreatedById' => $this->getUser()->getId()]);

        return $this->render('@Shift/Shift/listShifts.html.twig', ['shifts' => $shiftsForThisUser]);
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
        
        $interval = date_diff($datetime1,$datetime2,FALSE);
        
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
        }
        
        
        
        
        //email should go to shift created by
        
        return $this->redirectToRoute('employeeViewShift', array('id' => $shiftId));
    }
    
}
