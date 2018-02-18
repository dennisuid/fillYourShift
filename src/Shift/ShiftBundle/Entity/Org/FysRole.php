<?php

namespace Shift\ShiftBundle\Entity\Org;

use Doctrine\ORM\Mapping as ORM;

/**
 * FysRole
 *
 * @ORM\Table(name="fys_role")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\FysRoleRepository")
 */
class FysRole
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
     * @ORM\Column(name="role_id", type="integer", unique=true)
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
     * @ORM\Column(name="role_description", type="string", length=255 , nullable=true)
     */
    private $roleDescription;
    
    /**
     * @var int
     *
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    private $orgId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="org_name", type="string", length=255, nullable=true)
     */
    private $orgName;
    
    /**
     * @var int
     *
     * @ORM\Column(name="sector_id", type="integer")
     */
    private $sectorId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sector_name", type="string", length=255, nullable=true)
     */
    private $sectorName;
    

    
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
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return FysRole
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
     * @return FysRole
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
     * Set roleDescription
     *
     * @param string $roleDescription
     *
     * @return FysRole
     */
    public function setRoleDescription($roleDescription)
    {
        $this->roleDescription = $roleDescription;

        return $this;
    }

    /**
     * Get roleDescription
     *
     * @return string
     */
    public function getRoleDescription()
    {
        return $this->roleDescription;
    }
    
    /**
     * Set orgId
     *
     * @param integer $orgId
     *
     * @return FysRole
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
     * @return FysRole
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
     * Set sectorId
     *
     * @param integer $sectorId
     *
     * @return FysRole
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
     * Set sectorName
     *
     * @param string $sectorName
     *
     * @return FysRole
     */
    public function setSectorName($sectorName)
    {
        $this->sectorName = $sectorName;

        return $this;
    }

    /**
     * Get sectorName
     *
     * @return string
     */
    public function getSectorName()
    {
        return $this->sectorName;
    }
}
