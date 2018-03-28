<?php

namespace Shift\ShiftBundle\Controller;

use Shift\ShiftBundle\Entity\User\FysEmployeeResume;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends Controller
{
    private $entityManager;
    public function saveEmployeeResumeAction(Request $request)
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        /**
         * @var $employeeResume FysEmployeeResume
         */
        $employeeResume = $this->getLoggedInUserResume();
        /** @var $resumeFile UploadedFile */
        $resumeFile = $request->files->get('resume');
        if ($resumeFile) {
            $resumeFilePath = $employeeResume->UploadResumeDoc($resumeFile);
            $employeeResume->setEmployeeResumeDoc($resumeFilePath);
        }
        $this->entityManager->merge($employeeResume);
        $this->entityManager->flush();
        $url = $this->generateUrl('profile');
        return new RedirectResponse($url);
    }
    public function getProfilePicturePathAction(Request $request){
        $path = "";
        $this->entityManager = $this->getDoctrine()->getManager();
        /**
         * @var $employeeResume FysEmployeeResume
         */
        $employeeResume = $this->getLoggedInUserResume();

        /** @var $profilePhoto UploadedFile */
        $profilePhoto = $request->files->get('photo');
        if ($profilePhoto) {
            $profileFilePath = $employeeResume->UploadProfilePhoto($profilePhoto);
            $employeeResume->setEmployeeProfilePhoto($profileFilePath);
            $path = $employeeResume->getWebProfilePath();
        }
        $this->entityManager->merge($employeeResume);
        $this->entityManager->flush();
        return new Response($path);
    }

    public function savePreviousExperiencesOrganisationAction(Request $request)
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        /**
         * @var $employeeResume FysEmployeeResume
         */
        $employeeResume = $this->getLoggedInUserResume();
        $previousExperienceOrgFirst = $request->get('previous-exp1-org');
        if ($previousExperienceOrgFirst) {
            $employeeResume->setUserOrganisation1($previousExperienceOrgFirst);
        }
        $previousExperienceOrgSecond = $request->get('previous-exp2-org');
        if ($previousExperienceOrgSecond) {
            $employeeResume->setUserOrganisation2($previousExperienceOrgSecond);
        }
        $previousExperienceOrgThird = $request->get('previous-exp3-org');
        if ($previousExperienceOrgThird) {
            $employeeResume->setUserOrganisation3($previousExperienceOrgThird);
        }
        $this->entityManager->merge($employeeResume);
        $this->entityManager->flush();
        return new Response("success");
    }

    public function savePreviousExperiencesRoleAction(Request $request)
    {
        $this->entityManager = $this->getDoctrine()->getManager();
        /**
         * @var $employeeResume FysEmployeeResume
         */
        $employeeResume = $this->getLoggedInUserResume();
        $previousExperienceFirst = $request->get('previous-exp1-role');
        if ($previousExperienceFirst) {
            $employeeResume->setUserExperience1($previousExperienceFirst);
        }
        $previousExperienceSecond = $request->get('previous-exp2-role');
        if ($previousExperienceSecond) {
            $employeeResume->setUserExperience2($previousExperienceSecond);
        }
        $previousExperienceThird = $request->get('previous-exp3-role');
        if ($previousExperienceThird) {
            $employeeResume->setUserExperience3($previousExperienceThird);
        }
        $this->entityManager->merge($employeeResume);
        $this->entityManager->flush();
        return new Response("success");
    }

    private function getLoggedInUserResume()
    {
        $employeeId = $this->getUser()->getId();

        return $this->getDoctrine()
            ->getRepository(FysEmployeeResume::class)
            ->findByEmployeeId($employeeId);
    }

}