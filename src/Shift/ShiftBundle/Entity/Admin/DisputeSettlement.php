<?php

namespace Shift\ShiftBundle\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * DisputeSettlement
 *
 * @ORM\Table(name="admin_dispute_settlement")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\Admin\DisputeSettlementRepository")
 */
class DisputeSettlement
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
     * @ORM\Column(name="dispute_id", type="integer", unique=true)
     */
    private $disputeId;

    /**
     * @var string
     *
     * @ORM\Column(name="dispute_reason", type="string", length=255)
     */
    private $disputeReason;

    /**
     * @var string
     *
     * @ORM\Column(name="dispute_description", type="string", length=255)
     */
    private $disputeDescription;

    /**
     * @var int
     *
     * @ORM\Column(name="shift_id", type="integer")
     */
    private $shiftId;

    /**
     * @var int
     *
     * @ORM\Column(name="dispute_raised_by_id", type="integer")
     */
    private $disputeRaisedById;

    /**
     * @var string
     *
     * @ORM\Column(name="dispute_raised_by_name", type="string", length=255)
     */
    private $disputeRaisedByName;

    /**
     * @var string
     *
     * @ORM\Column(name="dispute_raised_date", type="string", length=255)
     */
    private $disputeRaisedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="dispute_status", type="string", length=255)
     */
    private $disputeStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="dispute_closed_date", type="string", length=255)
     */
    private $disputeClosedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="dispute_closure_desc", type="string", length=255, nullable=true)
     */
    private $disputeClosureDesc;

    /**
     * @var int
     *
     * @ORM\Column(name="dispute_closed_by_id", type="integer")
     */
    private $disputeClosedById;

    /**
     * @var string
     *
     * @ORM\Column(name="dispute_closed_by_name", type="string", length=255)
     */
    private $disputeClosedByName;


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
     * Set disputeId
     *
     * @param integer $disputeId
     *
     * @return DisputeSettlement
     */
    public function setDisputeId($disputeId)
    {
        $this->disputeId = $disputeId;

        return $this;
    }

    /**
     * Get disputeId
     *
     * @return int
     */
    public function getDisputeId()
    {
        return $this->disputeId;
    }

    /**
     * Set disputeReason
     *
     * @param string $disputeReason
     *
     * @return DisputeSettlement
     */
    public function setDisputeReason($disputeReason)
    {
        $this->disputeReason = $disputeReason;

        return $this;
    }

    /**
     * Get disputeReason
     *
     * @return string
     */
    public function getDisputeReason()
    {
        return $this->disputeReason;
    }

    /**
     * Set disputeDescription
     *
     * @param string $disputeDescription
     *
     * @return DisputeSettlement
     */
    public function setDisputeDescription($disputeDescription)
    {
        $this->disputeDescription = $disputeDescription;

        return $this;
    }

    /**
     * Get disputeDescription
     *
     * @return string
     */
    public function getDisputeDescription()
    {
        return $this->disputeDescription;
    }

    /**
     * Set shiftId
     *
     * @param integer $shiftId
     *
     * @return DisputeSettlement
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
     * Set disputeRaisedById
     *
     * @param integer $disputeRaisedById
     *
     * @return DisputeSettlement
     */
    public function setDisputeRaisedById($disputeRaisedById)
    {
        $this->disputeRaisedById = $disputeRaisedById;

        return $this;
    }

    /**
     * Get disputeRaisedById
     *
     * @return int
     */
    public function getDisputeRaisedById()
    {
        return $this->disputeRaisedById;
    }

    /**
     * Set disputeRaisedByName
     *
     * @param string $disputeRaisedByName
     *
     * @return DisputeSettlement
     */
    public function setDisputeRaisedByName($disputeRaisedByName)
    {
        $this->disputeRaisedByName = $disputeRaisedByName;

        return $this;
    }

    /**
     * Get disputeRaisedByName
     *
     * @return string
     */
    public function getDisputeRaisedByName()
    {
        return $this->disputeRaisedByName;
    }

    /**
     * Set disputeRaisedDate
     *
     * @param string $disputeRaisedDate
     *
     * @return DisputeSettlement
     */
    public function setDisputeRaisedDate($disputeRaisedDate)
    {
        $this->disputeRaisedDate = $disputeRaisedDate;

        return $this;
    }

    /**
     * Get disputeRaisedDate
     *
     * @return string
     */
    public function getDisputeRaisedDate()
    {
        return $this->disputeRaisedDate;
    }

    /**
     * Set disputeStatus
     *
     * @param string $disputeStatus
     *
     * @return DisputeSettlement
     */
    public function setDisputeStatus($disputeStatus)
    {
        $this->disputeStatus = $disputeStatus;

        return $this;
    }

    /**
     * Get disputeStatus
     *
     * @return string
     */
    public function getDisputeStatus()
    {
        return $this->disputeStatus;
    }

    /**
     * Set disputeClosedDate
     *
     * @param string $disputeClosedDate
     *
     * @return DisputeSettlement
     */
    public function setDisputeClosedDate($disputeClosedDate)
    {
        $this->disputeClosedDate = $disputeClosedDate;

        return $this;
    }

    /**
     * Get disputeClosedDate
     *
     * @return string
     */
    public function getDisputeClosedDate()
    {
        return $this->disputeClosedDate;
    }

    /**
     * Set disputeClosureDesc
     *
     * @param string $disputeClosureDesc
     *
     * @return DisputeSettlement
     */
    public function setDisputeClosureDesc($disputeClosureDesc)
    {
        $this->disputeClosureDesc = $disputeClosureDesc;

        return $this;
    }

    /**
     * Get disputeClosureDesc
     *
     * @return string
     */
    public function getDisputeClosureDesc()
    {
        return $this->disputeClosureDesc;
    }

    /**
     * Set disputeClosedById
     *
     * @param integer $disputeClosedById
     *
     * @return DisputeSettlement
     */
    public function setDisputeClosedById($disputeClosedById)
    {
        $this->disputeClosedById = $disputeClosedById;

        return $this;
    }

    /**
     * Get disputeClosedById
     *
     * @return int
     */
    public function getDisputeClosedById()
    {
        return $this->disputeClosedById;
    }

    /**
     * Set disputeClosedByName
     *
     * @param string $disputeClosedByName
     *
     * @return DisputeSettlement
     */
    public function setDisputeClosedByName($disputeClosedByName)
    {
        $this->disputeClosedByName = $disputeClosedByName;

        return $this;
    }

    /**
     * Get disputeClosedByName
     *
     * @return string
     */
    public function getDisputeClosedByName()
    {
        return $this->disputeClosedByName;
    }
}

