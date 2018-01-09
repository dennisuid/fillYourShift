<?php

namespace Shift\ShiftBundle\Repository\Shift;

/**
 * FysShiftApplyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FysShiftApplyRepository extends \Doctrine\ORM\EntityRepository
{
    public function getByUserId($userid){
        $criteria = ['userId' => $userid];
        return $this->findBy($criteria);  
    }
}