<?php

namespace Shift\ShiftBundle\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Shift\ShiftBundle\Entity\User\FysEmployeeResume;

class UserResumeCompletenessManager
{
    public function manageResumeCompleteness(EntityManager $entityManager, $employeeId, $step)
    {
        /**
         * @var $employeeResume FysEmployeeResume
         */
        $employeeResume = $entityManager->getRepository(FysEmployeeResume::class)
            ->findByEmployeeId($employeeId);

        if (empty($employeeResume)) {
            $employeeResume = new FysEmployeeResume();
            $employeeResume->setEmployeeId($employeeId);
        }
        $currentResumeCompleteness = $employeeResume->getUserResumeCompleteness();
        $newResumeCompleteness = $this->calculateResumeCompleteness($currentResumeCompleteness, $step);
        if ($newResumeCompleteness != $currentResumeCompleteness) {
            $employeeResume->setUserResumeCompleteness($newResumeCompleteness);
            $entityManager->merge($employeeResume);
            $entityManager->flush();
        }
        return true;
    }

    public function calculateResumeCompleteness($currentValue, $stepNumber)
    {
        if ($stepNumber == 1 && $currentValue == 0) {
            $currentValue = 10;
        }
        if ($stepNumber == 2 && $currentValue < 20) {
            return 20;
        }
        if ($stepNumber == 3 && $currentValue < 60) {
            return 60;
        }
        if ($stepNumber == 4 && $currentValue != 100) {
            return 100;
        }
        return $currentValue;
    }
}