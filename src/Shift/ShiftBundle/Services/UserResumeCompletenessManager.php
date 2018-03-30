<?php

namespace Shift\ShiftBundle\Services;

use Doctrine\ORM\EntityManager;
use Shift\ShiftBundle\Entity\User\FysEmployeeResume;
use Shift\ShiftBundle\Entity\User\FysUser;

class UserResumeCompletenessManager
{
    public function manageResumeCompleteness(EntityManager $entityManager, $employeeId, $step)
    {
        /**
         * @var $employeeResume FysEmployeeResume
         */
        $employeeResume = $this->getDoctrine()
            ->getRepository(FysEmployeeResume::class)
            ->findByEmployeeId($employeeId);

        $currentResumeCompleteness = $employeeResume->getUserResumeCompleteness();
        $newResumeCompleteness = $currentResumeCompleteness + $step;
        $employeeResume->setUserResumeCompleteness($newResumeCompleteness);
        $entityManager->merge($employeeResume);
        $entityManager->flush();
    }
}