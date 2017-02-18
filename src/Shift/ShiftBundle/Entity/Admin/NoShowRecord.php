<?php

namespace Shift\ShiftBundle\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * NoShowRecord
 *
 * @ORM\Table(name="admin_no_show_record")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\Admin\NoShowRecordRepository")
 */
class NoShowRecord
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
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="shift_id", type="integer")
     */
    private $shiftId;

    /**
     * @var string
     *
     * @ORM\Column(name="no_show_reason", type="string", length=255, nullable=true)
     */
    private $noShowReason;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_start_date", type="string", length=255)
     */
    private $shiftStartDate;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_org_name", type="string", length=255)
     */
    private $shiftOrgName;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_role_name", type="string", length=255)
     */
    private $shiftRoleName;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return NoShowRecord
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
     * Set shiftId
     *
     * @param integer $shiftId
     *
     * @return NoShowRecord
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
     * Set noShowReason
     *
     * @param string $noShowReason
     *
     * @return NoShowRecord
     */
    public function setNoShowReason($noShowReason)
    {
        $this->noShowReason = $noShowReason;

        return $this;
    }

    /**
     * Get noShowReason
     *
     * @return string
     */
    public function getNoShowReason()
    {
        return $this->noShowReason;
    }

    /**
     * Set shiftStartDate
     *
     * @param string $shiftStartDate
     *
     * @return NoShowRecord
     */
    public function setShiftStartDate($shiftStartDate)
    {
        $this->shiftStartDate = $shiftStartDate;

        return $this;
    }

    /**
     * Get shiftStartDate
     *
     * @return string
     */
    public function getShiftStartDate()
    {
        return $this->shiftStartDate;
    }

    /**
     * Set shiftOrgName
     *
     * @param string $shiftOrgName
     *
     * @return NoShowRecord
     */
    public function setShiftOrgName($shiftOrgName)
    {
        $this->shiftOrgName = $shiftOrgName;

        return $this;
    }

    /**
     * Get shiftOrgName
     *
     * @return string
     */
    public function getShiftOrgName()
    {
        return $this->shiftOrgName;
    }

    /**
     * Set shiftRoleName
     *
     * @param string $shiftRoleName
     *
     * @return NoShowRecord
     */
    public function setShiftRoleName($shiftRoleName)
    {
        $this->shiftRoleName = $shiftRoleName;

        return $this;
    }

    /**
     * Get shiftRoleName
     *
     * @return string
     */
    public function getShiftRoleName()
    {
        return $this->shiftRoleName;
    }
}

