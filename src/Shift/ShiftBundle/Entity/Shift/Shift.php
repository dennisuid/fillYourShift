<?php

namespace Shift\ShiftBundle\Entity\Shift;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shift
 *
 * @ORM\Table(name="fys_shift")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\Shift\ShiftRepository")
 */
class Shift {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="org_name", type="string", length=255)
     */
    private $orgName;

    /**
     * @var int
     *
     * @ORM\Column(name="pay_leadtime", type="integer")
     */
    private $payLeadtime;

    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="integer")
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=255)
     */
    private $roleName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date_hours", type="date")
     */
    private $startDateHours;
    //protected $startDateHours = ['start_date_hours'];
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date_hours", type="date")
     */
    private $endDateHours;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_duration", type="decimal", precision=2, scale=1)
     */
    private $shiftDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_rate", type="decimal", precision=2, scale=1)
     */
    private $shiftRate;

    /**
     * @var string
     *
     * @ORM\Column(name="Shift_job_rate", type="decimal", precision=2, scale=1)
     */
    private $shiftJobRate;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_status", type="string", length=255)
     */
    private $shiftStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_created_by", type="string", length=255)
     */
    private $shiftCreatedBy;

    /**
     * @var int
     *
     * @ORM\Column(name="shift_created_by_id", type="integer")
     */
    private $shiftCreatedById;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_assigned_employee", type="string", length=255, nullable=true)
     */
    private $shiftAssignedEmployee;

    /**
     * @var int
     *
     * @ORM\Column(name="shift_assigned_employee_id", type="integer", nullable=true)
     */
    private $shiftAssignedEmployeeId;

    /**
     * @var int
     *
     * @ORM\Column(name="shift_assigned_resume_id", type="integer", nullable=true)
     */
    private $shiftAssignedResumeId;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_assigned_phone", type="string", length=255 , nullable=true)
     */
    private $shiftAssignedPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_assigned_email", type="string", length=255, nullable=true)
     */
    private $shiftAssignedEmail;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set shiftId
     *
     * @param integer $shiftId
     *
     * @return Shift
     */
    public function setShiftId($shiftId) {
        $this->shiftId = $shiftId;

        return $this;
    }

    /**
     * Get shiftId
     *
     * @return int
     */
    public function getShiftId() {
        return $this->shiftId;
    }

    /**
     * Set orgName
     *
     * @param string $orgName
     *
     * @return Shift
     */
    public function setOrgName($orgName) {
        $this->orgName = $orgName;

        return $this;
    }

    /**
     * Get orgName
     *
     * @return string
     */
    public function getOrgName() {
        return $this->orgName;
    }

    /**
     * Set payLeadtime
     *
     * @param integer $payLeadtime
     *
     * @return Shift
     */
    public function setPayLeadtime($payLeadtime) {
        $this->payLeadtime = $payLeadtime;

        return $this;
    }

    /**
     * Get payLeadtime
     *
     * @return int
     */
    public function getPayLeadtime() {
        return $this->payLeadtime;
    }

    /**
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return Shift
     */
    public function setRoleId($roleId) {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return int
     */
    public function getRoleId() {
        return $this->roleId;
    }

    /**
     * Set roleName
     *
     * @param string $roleName
     *
     * @return Shift
     */
    public function setRoleName($roleName) {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string
     */
    public function getRoleName() {
        return $this->roleName;
    }

    /**
     * Set startDateHours
     *
     * @param \DateTime $startDateHours
     *
     * @return Shift
     */
    public function setStartDateHours($startDateHours) {
        $this->startDateHours = $startDateHours;

        return $this;
    }

    /**
     * Get startDateHours
     *
     * @return \DateTime
     */
    public function getStartDateHours() {
        return $this->startDateHours;
    }

    /**
     * Set endDateHours
     *
     * @param \DateTime $endDateHours
     *
     * @return Shift
     */
    public function setEndDateHours($endDateHours) {
        $this->endDateHours = $endDateHours;

        return $this;
    }

    /**
     * Get endDateHours
     *
     * @return \DateTime
     */
    public function getEndDateHours() {
        return $this->endDateHours;
    }

    /**
     * Set shiftDuration
     *
     * @param string $shiftDuration
     *
     * @return Shift
     */
    public function setShiftDuration($shiftDuration) {
        $this->shiftDuration = $shiftDuration;

        return $this;
    }

    /**
     * Get shiftDuration
     *
     * @return string
     */
    public function getShiftDuration() {
        return $this->shiftDuration;
    }

    /**
     * Set shiftRate
     *
     * @param string $shiftRate
     *
     * @return Shift
     */
    public function setShiftRate($shiftRate) {
        $this->shiftRate = $shiftRate;

        return $this;
    }

    /**
     * Get shiftRate
     *
     * @return string
     */
    public function getShiftRate() {
        return $this->shiftRate;
    }

    /**
     * Set shiftJobRate
     *
     * @param string $shiftJobRate
     *
     * @return Shift
     */
    public function setShiftJobRate($shiftJobRate) {
        $this->shiftJobRate = $shiftJobRate;

        return $this;
    }

    /**
     * Get shiftJobRate
     *
     * @return string
     */
    public function getShiftJobRate() {
        return $this->shiftJobRate;
    }

    /**
     * Set shiftStatus
     *
     * @param string $shiftStatus
     *
     * @return Shift
     */
    public function setShiftStatus($shiftStatus) {
        $this->shiftStatus = $shiftStatus;

        return $this;
    }

    /**
     * Get shiftStatus
     *
     * @return string
     */
    public function getShiftStatus() {
        return $this->shiftStatus;
    }

    /**
     * Set shiftCreatedBy
     *
     * @param string $shiftCreatedBy
     *
     * @return Shift
     */
    public function setShiftCreatedBy($shiftCreatedBy) {
        $this->shiftCreatedBy = $shiftCreatedBy;

        return $this;
    }

    /**
     * Get shiftCreatedBy
     *
     * @return string
     */
    public function getShiftCreatedBy() {
        return $this->shiftCreatedBy;
    }

    /**
     * Set shiftCreatedById
     *
     * @param integer $shiftCreatedById
     *
     * @return Shift
     */
    public function setShiftCreatedById($shiftCreatedById) {
        $this->shiftCreatedById = $shiftCreatedById;

        return $this;
    }

    /**
     * Get shiftCreatedById
     *
     * @return int
     */
    public function getShiftCreatedById() {
        return $this->shiftCreatedById;
    }

    /**
     * Set shiftAssignedEmployee
     *
     * @param string $shiftAssignedEmployee
     *
     * @return Shift
     */
    public function setShiftAssignedEmployee($shiftAssignedEmployee) {
        $this->shiftAssignedEmployee = $shiftAssignedEmployee;

        return $this;
    }

    /**
     * Get shiftAssignedEmployee
     *
     * @return string
     */
    public function getShiftAssignedEmployee() {
        return $this->shiftAssignedEmployee;
    }

    /**
     * Set shiftAssignedEmployeeId
     *
     * @param integer $shiftAssignedEmployeeId
     *
     * @return Shift
     */
    public function setShiftAssignedEmployeeId($shiftAssignedEmployeeId) {
        $this->shiftAssignedEmployeeId = $shiftAssignedEmployeeId;

        return $this;
    }

    /**
     * Get shiftAssignedEmployeeId
     *
     * @return int
     */
    public function getShiftAssignedEmployeeId() {
        return $this->shiftAssignedEmployeeId;
    }

    /**
     * Set shiftAssignedResumeId
     *
     * @param integer $shiftAssignedResumeId
     *
     * @return Shift
     */
    public function setShiftAssignedResumeId($shiftAssignedResumeId) {
        $this->shiftAssignedResumeId = $shiftAssignedResumeId;

        return $this;
    }

    /**
     * Get shiftAssignedResumeId
     *
     * @return int
     */
    public function getShiftAssignedResumeId() {
        return $this->shiftAssignedResumeId;
    }

    /**
     * Set shiftAssignedPhone
     *
     * @param string $shiftAssignedPhone
     *
     * @return Shift
     */
    public function setShiftAssignedPhone($shiftAssignedPhone) {
        $this->shiftAssignedPhone = $shiftAssignedPhone;

        return $this;
    }

    /**
     * Get shiftAssignedPhone
     *
     * @return string
     */
    public function getShiftAssignedPhone() {
        return $this->shiftAssignedPhone;
    }

    /**
     * Set shiftAssignedEmail
     *
     * @param string $shiftAssignedEmail
     *
     * @return Shift
     */
    public function setShiftAssignedEmail($shiftAssignedEmail) {
        $this->shiftAssignedEmail = $shiftAssignedEmail;

        return $this;
    }

    /**
     * Get shiftAssignedEmail
     *
     * @return string
     */
    public function getShiftAssignedEmail() {
        return $this->shiftAssignedEmail;
    }

}
