<?php

namespace Shift\ShiftBundle\Entity\Shift;

use Doctrine\ORM\Mapping as ORM;

/**
 * fysShiftAlert
 *
 * @ORM\Table(name="fys_shift_alert")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\Shift\fysShiftAlertRepository")
 */
class fysShiftAlert
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
     * @ORM\Column(name="employee_id", type="integer")
     */
    private $employeeId;

    /**
     * @var int
     *
     * @ORM\Column(name="org_id", type="integer")
     */
    private $orgId;

    /**
     * @var string
     *
     * @ORM\Column(name="org_name", type="string", length=255)
     */
    private $orgName;

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
     * @var string
     *
     * @ORM\Column(name="employee_mobile", type="string", length=255)
     */
    private $employeeMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="employee_email", type="string", length=255)
     */
    private $employeeEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="alert_status", type="string", length=255)
     */
    private $alertStatus;


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
     * Set employeeId
     *
     * @param integer $employeeId
     *
     * @return fysShiftAlert
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

    /**
     * Set orgId
     *
     * @param integer $orgId
     *
     * @return fysShiftAlert
     */
    public function setOrgId($orgId)
    {
        $this->orgId = $orgId;

        return $this;
    }

    /**
     * Get orgId
     *
     * @return int
     */
    public function getOrgId()
    {
        return $this->orgId;
    }

    /**
     * Set orgName
     *
     * @param string $orgName
     *
     * @return fysShiftAlert
     */
    public function setOrgName($orgName)
    {
        $this->orgName = $orgName;

        return $this;
    }

    /**
     * Get orgName
     *
     * @return string
     */
    public function getOrgName()
    {
        return $this->orgName;
    }

    /**
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return fysShiftAlert
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set roleName
     *
     * @param string $roleName
     *
     * @return fysShiftAlert
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Set employeeMobile
     *
     * @param string $employeeMobile
     *
     * @return fysShiftAlert
     */
    public function setEmployeeMobile($employeeMobile)
    {
        $this->employeeMobile = $employeeMobile;

        return $this;
    }

    /**
     * Get employeeMobile
     *
     * @return string
     */
    public function getEmployeeMobile()
    {
        return $this->employeeMobile;
    }

    /**
     * Set employeeEmail
     *
     * @param string $employeeEmail
     *
     * @return fysShiftAlert
     */
    public function setEmployeeEmail($employeeEmail)
    {
        $this->employeeEmail = $employeeEmail;

        return $this;
    }

    /**
     * Get employeeEmail
     *
     * @return string
     */
    public function getEmployeeEmail()
    {
        return $this->employeeEmail;
    }

    /**
     * Set alertStatus
     *
     * @param string $alertStatus
     *
     * @return fysShiftAlert
     */
    public function setAlertStatus($alertStatus)
    {
        $this->alertStatus = $alertStatus;

        return $this;
    }

    /**
     * Get alertStatus
     *
     * @return string
     */
    public function getAlertStatus()
    {
        return $this->alertStatus;
    }
}

