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

class ShiftController extends Controller {

    public function indexAction() {
        return $this->render('@Shift/Shift/index.html.twig');
    }

    public function dashboardAction() {
        $usertype = $this->getUser()->getUserType();
        $forSubscriptionShiftIds = [];
        $subscribedShiftIds = [];
        $assignedShiftIds = [];
        $notAssignedShiftIds = []; //how to declare an array of Shift Class
        
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
                            $forSubscriptionShiftIds[] = $shift->getId();
                        } 
                        else {
                            $subscribedShiftIds[] = $shift->getId();
                        }
                    } 
                    else {
                        
                        if($shiftApplied->getApplyStatus() == 'SELECTED'){
                            $assignedShiftIds[] = $shift->getId();
                        } 
                        else {
                            $notAssignedShiftIds[] = $shift->getId();
                        }
                    }
                    
                }
            }
            echo "just before render";
            return $this->render('@Shift/Shift/employee.html.twig', [
                'forSubscriptionShiftIds' => $forSubscriptionShiftIds, 
                'subscribedShiftIds' => $subscribedShiftIds,
                'assignedShiftIds' => $assignedShiftIds,
                'notAssignedShiftIds' => $notAssignedShiftIds
                ]);
        }

        if ($usertype == "employer") {
            return $this->render('@Shift/Shift/employer.html.twig');
        }
        return $this->render('@Shift/Shift/dashboard.html.twig');
    }

    public function createNewShiftAction(Request $request) {
        $shift = new Shift();
        $form = $this->createForm(ShiftType::class, $shift, array(
            'action' => $this->generateUrl('submitShift'),
            'method' => 'POST',
            'mode' => 'create',
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
}
