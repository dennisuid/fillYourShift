<?php

namespace Shift\ShiftBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Table(name="fys_employee_sector")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\User\FysEmployeeSectorRepository")
 */
class FysEmployeeSector
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="sector_id", type="integer")
     */
    private $sectorId;

    /**
     * @var int
     *
     * @ORM\Column(name="employee_id", type="integer")
     */
    private $employeeId;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sectorId
     *
     * @param integer $sectorId
     *
     * @return FysEmployeeSector
     */
    public function setSectorId($sectorId)
    {
        $this->sectorId = $sectorId;

        return $this;
    }

    /**
     * Get sectorId
     *
     * @return int
     */
    public function getSectorId()
    {
        return $this->sectorId;
    }

    /**
     * Set employeeId
     *
     * @param integer $employeeId
     *
     * @return FysEmployeeSector
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;

        return $this;
    }

    /**
     * Get employeeId
     *
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }
}

