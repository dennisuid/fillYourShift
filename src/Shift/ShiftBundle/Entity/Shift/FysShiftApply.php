<?php

namespace Shift\ShiftBundle\Entity\Shift;

use Doctrine\ORM\Mapping as ORM;

/**
 * FysShiftApply
 *
 * @ORM\Table(name="fys_shift_apply")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\Shift\FysShiftApplyRepository")
 */
class FysShiftApply
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
     * @ORM\Column(name="shift_id", type="integer")
     */
    private $shiftId;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="employee_first_name", type="string", length=255)
     */
    private $employeeFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="employee_last_name", type="string", length=255)
     */
    private $employeeLastName;

    /**
     * @var int
     *
     * @ORM\Column(name="employee_resume_id", type="integer")
     */
    private $employeeResumeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="shift_apply_time", type="date")
     */
    private $shiftApplyTime;

    /**
     * @var string
     *
     * @ORM\Column(name="apply_status", type="string", length=20)
     */
    private $applyStatus;
    
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
     * Set shiftId
     *
     * @param integer $shiftId
     *
     * @return FysShiftApply
     */
    public function setShiftId($shiftId)
    {
        $this->shiftId = $shiftId;

        return $this;
    }

    /**
     * Get shiftId
     *
     * @return int
     */
    public function getShiftId()
    {
        return $this->shiftId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return FysShiftApply
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set employeeFirstName
     *
     * @param string $employeeFirstName
     *
     * @return FysShiftApply
     */
    public function setEmployeeFirstName($employeeFirstName)
    {
        $this->employeeFirstName = $employeeFirstName;

        return $this;
    }

    /**
     * Get employeeFirstName
     *
     * @return string
     */
    public function getEmployeeFirstName()
    {
        return $this->employeeFirstName;
    }

    /**
     * Set employeeLastName
     *
     * @param string $employeeLastName
     *
     * @return FysShiftApply
     */
    public function setEmployeeLastName($employeeLastName)
    {
        $this->employeeLastName = $employeeLastName;

        return $this;
    }

    /**
     * Get employeeLastName
     *
     * @return string
     */
    public function getEmployeeLastName()
    {
        return $this->employeeLastName;
    }

    /**
     * Set employeeResumeId
     *
     * @param integer $employeeResumeId
     *
     * @return FysShiftApply
     */
    public function setEmployeeResumeId($employeeResumeId)
    {
        $this->employeeResumeId = $employeeResumeId;

        return $this;
    }

    /**
     * Get employeeResumeId
     *
     * @return int
     */
    public function getEmployeeResumeId()
    {
        return $this->employeeResumeId;
    }

    /**
     * Set shiftApplyTime
     *
     * @param \DateTime $shiftApplyTime
     *
     * @return FysShiftApply
     */
    public function setShiftApplyTime()
    {
        $this->shiftApplyTime  = new \DateTime();

        return $this;
    }

    /**
     * Get shiftApplyTime
     *
     * @return \DateTime
     */
    public function getShiftApplyTime()
    {
        return $this->shiftApplyTime;
    }
    
    /**
     * Set applyStatus
     *
     * @param string $applyStatus
     *
     * @return FysShiftApply
     */
    public function setApplyStatus($applyStatus)
    {
        $this->applyStatus = $applyStatus;

        return $this;
    }

    /**
     * Get applyStatus
     *
     * @return string
     */
    public function getApplyStatus()
    {
        return $this->applyStatus;
    }

}
