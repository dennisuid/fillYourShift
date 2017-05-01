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
}
