<?php

namespace Shift\ShiftBundle\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="admin_invoice")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\Admin\InvoiceRepository")
 */
class Invoice
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
     * @ORM\Column(name="invoice_id", type="integer")
     */
    private $invoiceId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="invoice_date", type="date")
     */
    private $invoiceDate;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_raised_to_name", type="string", length=255)
     */
    private $invoiceRaisedToName;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_raised_to_org", type="string", length=255)
     */
    private $invoiceRaisedToOrg;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_raised_to_Address", type="string", length=255)
     */
    private $invoiceRaisedToAddress;

    /**
     * @var array
     *
     * @ORM\Column(name="Invoice_shift_ids", type="array")
     */
    private $invoiceShiftIds;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_amount", type="decimal", precision=2, scale=1)
     */
    private $invoiceAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_status", type="string", length=255)
     */
    private $invoiceStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="invoice_closed_date", type="date", nullable=true)
     */
    private $invoiceClosedDate;


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
     * Set invoiceId
     *
     * @param integer $invoiceId
     *
     * @return Invoice
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * Get invoiceId
     *
     * @return int
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * Set invoiceDate
     *
     * @param \DateTime $invoiceDate
     *
     * @return Invoice
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    /**
     * Get invoiceDate
     *
     * @return \DateTime
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * Set invoiceRaisedToName
     *
     * @param string $invoiceRaisedToName
     *
     * @return Invoice
     */
    public function setInvoiceRaisedToName($invoiceRaisedToName)
    {
        $this->invoiceRaisedToName = $invoiceRaisedToName;

        return $this;
    }

    /**
     * Get invoiceRaisedToName
     *
     * @return string
     */
    public function getInvoiceRaisedToName()
    {
        return $this->invoiceRaisedToName;
    }

    /**
     * Set invoiceRaisedToOrg
     *
     * @param string $invoiceRaisedToOrg
     *
     * @return Invoice
     */
    public function setInvoiceRaisedToOrg($invoiceRaisedToOrg)
    {
        $this->invoiceRaisedToOrg = $invoiceRaisedToOrg;

        return $this;
    }

    /**
     * Get invoiceRaisedToOrg
     *
     * @return string
     */
    public function getInvoiceRaisedToOrg()
    {
        return $this->invoiceRaisedToOrg;
    }

    /**
     * Set invoiceRaisedToAddress
     *
     * @param string $invoiceRaisedToAddress
     *
     * @return Invoice
     */
    public function setInvoiceRaisedToAddress($invoiceRaisedToAddress)
    {
        $this->invoiceRaisedToAddress = $invoiceRaisedToAddress;

        return $this;
    }

    /**
     * Get invoiceRaisedToAddress
     *
     * @return string
     */
    public function getInvoiceRaisedToAddress()
    {
        return $this->invoiceRaisedToAddress;
    }

    /**
     * Set invoiceShiftIds
     *
     * @param array $invoiceShiftIds
     *
     * @return Invoice
     */
    public function setInvoiceShiftIds($invoiceShiftIds)
    {
        $this->invoiceShiftIds = $invoiceShiftIds;

        return $this;
    }

    /**
     * Get invoiceShiftIds
     *
     * @return array
     */
    public function getInvoiceShiftIds()
    {
        return $this->invoiceShiftIds;
    }

    /**
     * Set invoiceAmount
     *
     * @param string $invoiceAmount
     *
     * @return Invoice
     */
    public function setInvoiceAmount($invoiceAmount)
    {
        $this->invoiceAmount = $invoiceAmount;

        return $this;
    }

    /**
     * Get invoiceAmount
     *
     * @return string
     */
    public function getInvoiceAmount()
    {
        return $this->invoiceAmount;
    }

    /**
     * Set invoiceStatus
     *
     * @param string $invoiceStatus
     *
     * @return Invoice
     */
    public function setInvoiceStatus($invoiceStatus)
    {
        $this->invoiceStatus = $invoiceStatus;

        return $this;
    }

    /**
     * Get invoiceStatus
     *
     * @return string
     */
    public function getInvoiceStatus()
    {
        return $this->invoiceStatus;
    }

    /**
     * Set invoiceClosedDate
     *
     * @param \DateTime $invoiceClosedDate
     *
     * @return Invoice
     */
    public function setInvoiceClosedDate($invoiceClosedDate)
    {
        $this->invoiceClosedDate = $invoiceClosedDate;

        return $this;
    }

    /**
     * Get invoiceClosedDate
     *
     * @return \DateTime
     */
    public function getInvoiceClosedDate()
    {
        return $this->invoiceClosedDate;
    }
}

