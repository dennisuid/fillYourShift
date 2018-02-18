<?php

namespace Shift\ShiftBundle\Entity\Org;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organisation
 *
 * @ORM\Table(name="fys_organisation")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\OrganisationRepository")
 */
class Organisation
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
     * @var string
     *
     * @ORM\Column(name="org_profile_description", type="string", length=255)
     */
    private $orgProfileDescription;
    
    /**
     * @var string
     *
     * @ORM\Column(name="org_address", type="string", length=255)
     */
    private $orgAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="org_postcode", type="string", length=255)
     */
    private $orgPostcode;

    /**
     * @var string
     *
     * @ORM\Column(name="org_contact1", type="string", length=255)
     */
    private $orgContact1;

    /**
     * @var string
     *
     * @ORM\Column(name="org_contact1_phone", type="string", length=255)
     */
    private $orgContact1Phone;

    /**
     * @var string
     *
     * @ORM\Column(name="org_contact1_email", type="string", length=255)
     */
    private $orgContact1Email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="org_contact1_photo", type="blob", length=255, nullable=true)
     */
    private $orgContact1Photo;
    
    /**
     * @var int
     *
     * @ORM\Column(name="sector_id", type="integer")
     */
    private $sectorId;

    /**
     * @var string
     *
     * @ORM\Column(name="sector_name", type="string", length=100)
     */
    private $sectorName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="org_profile_photo1", type="blob", nullable=true)
     */
    private $orgProfilePhoto1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="org_profile_photo2", type="blob", nullable=true)
     */
    private $orgProfilePhoto2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="org_profile_photo3", type="blob", nullable=true)
     */
    private $orgProfilePhoto3;
    
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
     * Set orgId
     *
     * @param integer $orgId
     *
     * @return Organisation
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
     * @return Organisation
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
     * Set orgProfileDescription
     *
     * @param string $orgProfileDescription
     *
     * @return orgProfileDescription
     */
    public function setOrgProfileDescription($orgProfileDescription)
    {
        $this->orgProfileDescription = $orgProfileDescription;

        return $this;
    }

    /**
     * Get orgProfileDescription
     *
     * @return string
     */
    public function getOrgProfileDescription()
    {
        return $this->orgProfileDescription;
    }
    
    /**
     * Set orgAddress
     *
     * @param string $orgAddress
     *
     * @return Organisation
     */
    public function setOrgAddress($orgAddress)
    {
        $this->orgAddress = $orgAddress;

        return $this;
    }

    /**
     * Get orgAddress
     *
     * @return string
     */
    public function getOrgAddress()
    {
        return $this->orgAddress;
    }

    /**
     * Set orgPostcode
     *
     * @param string $orgPostcode
     *
     * @return Organisation
     */
    public function setOrgPostcode($orgPostcode)
    {
        $this->orgPostcode = $orgPostcode;

        return $this;
    }

    /**
     * Get orgPostcode
     *
     * @return string
     */
    public function getOrgPostcode()
    {
        return $this->orgPostcode;
    }

    /**
     * Set orgContact1
     *
     * @param string $orgContact1
     *
     * @return Organisation
     */
    public function setOrgContact1($orgContact1)
    {
        $this->orgContact1 = $orgContact1;

        return $this;
    }

    /**
     * Get orgContact1
     *
     * @return string
     */
    public function getOrgContact1()
    {
        return $this->orgContact1;
    }

    /**
     * Set orgContact1Phone
     *
     * @param string $orgContact1Phone
     *
     * @return Organisation
     */
    public function setOrgContact1Phone($orgContact1Phone)
    {
        $this->orgContact1Phone = $orgContact1Phone;

        return $this;
    }

    /**
     * Get orgContact1Phone
     *
     * @return string
     */
    public function getOrgContact1Phone()
    {
        return $this->orgContact1Phone;
    }

    /**
     * Set orgContact1Email
     *
     * @param string $orgContact1Email
     *
     * @return Organisation
     */
    public function setOrgContact1Email($orgContact1Email)
    {
        $this->orgContact1Email = $orgContact1Email;

        return $this;
    }

    /**
     * Get orgContact1Email
     *
     * @return string
     */
    public function getOrgContact1Email()
    {
        return $this->orgContact1Email;
    }
    
    /**
     * Set sectorId
     *
     * @param integer $sectorId
     *
     * @return Organisation
     */
    public function setSectorId($sectorId)
    {
        $this->sectorId = $sectorId;

        return $this;
    }

    /**
     * Get orgId
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
     * @return Organisation
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
    
    
    /**
     * Set orgContact1Photo
     *
     * @param string $orgContact1Photo
     *
     * @return FysOrgContact1Photo
     */
    public function setOrgContact1Photo($orgContact1Photo)
    {
        $this->orgContact1Photo = $orgContact1Photo;

        return $this;
    }

    /**
     * Get orgContact1Photo
     *
     * @return string
     */
    public function getOrgContact1Photo()
    {
        return $this->orgContact1Photo;
    }
    
    /**
     * Set orgProfilePhoto1
     *
     * @param string $orgProfilePhoto1
     *
     * @return FysOrgProfilePhoto1
     */
    
    public function setOrgProfilePhoto1($orgProfilePhoto1)
    {
        $this->orgProfilePhoto1 = $orgProfilePhoto1;

        return $this;
    }

    /**
     * Get orgProfilePhoto1
     *
     * @return string
     */
    public function getOrgProfilePhoto1()
    {
        return $this->orgProfilePhoto1;
    }
    
    /**
     * Set orgProfilePhoto2
     *
     * @param string $orgProfilePhoto2
     *
     * @return FysOrgProfilePhoto2
     */
    
    public function setOrgProfilePhoto2($orgProfilePhoto2)
    {
        $this->orgProfilePhoto2 = $orgProfilePhoto2;

        return $this;
    }

    /**
     * Get orgProfilePhoto2
     *
     * @return string
     */
    public function getOrgProfilePhoto2()
    {
        return $this->orgProfilePhoto2;
    }
    
    /**
     * Set orgProfilePhoto3
     *
     * @param string $orgProfilePhoto3
     *
     * @return FysOrgProfilePhoto3
     */
    
    public function setOrgProfilePhoto3($orgProfilePhoto3)
    {
        $this->orgProfilePhoto3 = $orgProfilePhoto3;

        return $this;
    }

    /**
     * Get orgProfilePhoto3
     *
     * @return string
     */
    public function getOrgProfilePhoto3()
    {
        return $this->orgProfilePhoto3;
    }
    
}
