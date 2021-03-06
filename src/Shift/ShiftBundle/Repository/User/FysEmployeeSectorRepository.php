<?php

namespace Shift\ShiftBundle\Repository\User;

use Doctrine\ORM\OptimisticLockException;
use Shift\ShiftBundle\Entity\User\FysEmployeeSector;

/**
 * FysEmployeeSectorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FysEmployeeSectorRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByEmployeeId($employeeID)
    {
        $sids = [];
        $sectorDetails = $this->createQueryBuilder('e')
            ->where('e.employeeId = :employeeID')
            ->setParameter('employeeID', $employeeID)
            ->getQuery()->getResult();
        if (empty($sectorDetails)) {
            return [];
        }
        /**
         * @var $sid FysEmployeeSector
         */
        foreach ($sectorDetails as $sid) {
            $sids[$sid->getId()] = $sid->getSectorId();
        }
        return $sids;
    }

    public function deleteSectorsForEmployee($employeeID)
    {
        $existing = $this->findByEmployeeId($employeeID);
        foreach ($existing as $id => $value){
            $sector = $this->find($id);
            $this->getEntityManager()->remove($sector);
            try {
                $this->getEntityManager()->flush();
            } catch (OptimisticLockException $e) {
                //need to do logging
            }
        }
        return true;
    }
}
