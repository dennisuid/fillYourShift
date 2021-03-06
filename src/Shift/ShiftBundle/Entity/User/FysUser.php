<?php

namespace Shift\ShiftBundle\Entity\User;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use function PHPSTORM_META\type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FysUser
 *
 * @ORM\Table(name="fys_user")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\User\FysUserRepository")
 * @ORM\AttributeOverrides({
 *              @ORM\AttributeOverride(name="email", column=@ORM\Column(nullable=true, unique=true)),
 *              @ORM\AttributeOverride(name="emailCanonical", column=@ORM\Column(nullable=true, unique=true))
 * })
 */
class FysUser extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255,  nullable=true)
     */
    private $firstName;
    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;
    /**
     * @var string
     *
     * @ORM\Column(name="mobile_number", type="string", length=255,  nullable=true)
     */
    private $mobileNumber;

    /**
     * @var string
     *
     * @Assert\NotNull(message="Please select a User type.")
     * @ORM\Column(name="user_type", type="string", length=255, nullable=true)
     */
    private $userType;

    /**
     * @var string
     *
     * @ORM\Column(name="house_number", type="string", length=255, nullable=true)
     */
    private $houseNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line1", type="string", length=255, nullable=true)
     */
    private $addressLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line2", type="string", length=255, nullable=true)
     */
    private $addressLine2;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=255,  nullable=true)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255,  nullable=true)
     */
    private $country;
    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=15,  nullable=true)
     */
    private $gender;
    /**
     * @var string
     *
     * @ORM\Column(name="dob", type="date", length=150,  nullable=true)
     */
    private $dob;
    /**
     * @var string
     *
     * @ORM\Column(name="registration_number", type="string", length=255,  nullable=true)
     */
    private $registrationNumber;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /** @ORM\Column(name="googleplus_id", type="string", length=255, nullable=true) */
    protected $googleplus_id;

    /** @ORM\Column(name="googleplus_access_token", type="string", length=255, nullable=true) */
    protected $googleplus_access_token;

    public function __construct()
    {
        parent::__construct();
    }

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return FysUser
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return FysUser
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return FysUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set mobileNumber
     *
     * @param string $mobileNumber
     *
     * @return FysUser
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;

        return $this;
    }

    /**
     * Get mobileNumber
     *
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return FysUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set userType
     *
     * @param string $userType
     *
     * @return FysUser
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }
    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     *
     * @return FysUser
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return string
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set addressLine1
     *
     * @param string $addressLine1
     *
     * @return FysUser
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * Get addressLine1
     *
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * Set addressLine2
     *
     * @param string $addressLine2
     *
     * @return FysUser
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * Get addressLine2
     *
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return FysUser
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return FysUser
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set registrationNumber
     *
     * @param string $registrationNumber
     *
     * @return FysUser
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * Get registrationNumber
     *
     * @return string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * @param mixed $facebook_id
     */
    public function setFacebookId($facebook_id)
    {
        $this->facebook_id = $facebook_id;
    }

    /**
     * @return mixed
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * @param mixed $facebook_access_token
     */
    public function setFacebookAccessToken($facebook_access_token)
    {
        $this->facebook_access_token = $facebook_access_token;
    }

    /**
     * @return mixed
     */
    public function getGoogleplusId()
    {
        return $this->googleplus_id;
    }

    /**
     * @param mixed $googleplus_id
     */
    public function setGoogleplusId($googleplus_id)
    {
        $this->googleplus_id = $googleplus_id;
    }

    /**
     * @return mixed
     */
    public function getGoogleplusAccessToken()
    {
        return $this->googleplus_access_token;
    }

    /**
     * @param mixed $googleplus_access_token
     */
    public function setGoogleplusAccessToken($googleplus_access_token)
    {
        $this->googleplus_access_token = $googleplus_access_token;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        if (empty($this->gender)){
            return "";
        }
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }


    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param DateTime $dob
     */
    public function setDob(DateTime $dob)
    {
        $this->dob = $dob;
    }
}
