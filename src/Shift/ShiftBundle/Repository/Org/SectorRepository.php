<?php

namespace Shift\ShiftBundle\Repository\Org;
use Doctrine\ORM\EntityRepository;
use Shift\ShiftBundle\Entity\Org\Sector;

class SectorRepository extends EntityRepository
{
    public function getAllSectors()
    {
        $sectors = [];
        /* @var $sector Sector */
        foreach ($this->findAll() as $sector) {
            $sectors[$sector->getId()] = ucwords($sector->getSectorName());
        }
        return $sectors;
    }
}
