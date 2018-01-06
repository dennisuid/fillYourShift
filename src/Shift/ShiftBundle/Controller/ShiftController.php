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
        return $this->render('@Shift/Shift/viewShift.html.twig', [
                    'form' => $form->createView(), 'id' => $shiftId
        ]);
    }

    public function viewShiftAction(Request $request) {

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
            'action' => $this->generateUrl('viewShift', array('id' => $shiftId)), // how to dynamically add the id? 
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        return $this->render('@Shift/Shift/viewShift.html.twig', [
                    'form' => $form->createView(), 'id' => $shiftId
        ]);
    }

    public function deleteShiftAction(Request $request) {
        $shiftId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $shift = $em->getRepository(Shift::class)->findOneBy(['id' => $shiftId]);
        $em->remove($shift);
        $em->flush();
        //building form with SHIFT returned from DB
        //TODO I would like to display a list of all the shifts created by this employer once a shift is deleted
        $shifts = $em->getRepository(Shift::class)->findBy(['shift_created_by_id' => $this->getUser()->getUserId()]);
        return $this->render('@Shift/Shift/listShifts.html.twig', [
                    array('shifts', $shifts)
        ]);
    }

    public function updateShiftAction(Request $request) {

        // not sure if we need this - the 'save functionality is working from create form itself?

        $shift = new Shift();
        $shiftId = $request->get('id');
        var_dump($shiftId);
        die;
        $form = $this->createForm(ShiftType::class, $shift);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $shift = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($shift);
            $em->flush();
        }
        return $this->render('@Shift/Shift/viewShift.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    public function listShiftsAction() {
        $em = $this->getDoctrine()->getManager();
        $shifts = $em->getRepository(Shift::class)->findAll();
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

}
