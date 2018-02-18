<?php

namespace Shift\ShiftBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * FysEmployeeResume
 *
 * @ORM\Table(name="fys_employee_resume")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\User\FysEmployeeResumeRepository")
 */
class FysEmployeeResume
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
     * @ORM\Column(name="user_resume_id", type="integer")
     */
    private $userResumeId;

    /**
     * @var string
     *
     * @ORM\Column(name="employee_resume_desc", type="string", length=255)
     */
    private $employeeResumeDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="user_experience_1", type="string", length=255, nullable=true)
     */
    private $userExperience1;

    /**
     * @var string
     *
     * @ORM\Column(name="user_experience_2", type="string", length=255, nullable=true)
     */
    private $userExperience2;

    /**
     * @var string
     *
     * @ORM\Column(name="user_experience_3", type="string", length=255, nullable=true)
     */
    private $userExperience3;

    /**
     * @var string
     *
     * @ORM\Column(name="user_certificate_1", type="string", length=255, nullable=true)
     */
    private $userCertificate1;

    /**
     * @var string
     *
     * @ORM\Column(name="user_certificate_2", type="string", length=255), nullable=true
     */
    private $userCertificate2;

    /**
     * @var string
     *
     * @ORM\Column(name="user_certificate_3", type="string", length=255, nullable=true)
     */
    private $userCertificate3;

    /**
     * @var int
     *
     * @ORM\Column(name="user_experience_year", type="integer" , nullable=true)
     */
    private $userExperienceYear;

    /**
     * @var string
     *
     * @ORM\Column(name="employee_resume_doc", type="blob", nullable=true)
     */
    private $employeeResumeDoc;

    /**
     * @var string
     *
     * @ORM\Column(name="employee_profile_photo", type="blob", nullable=true)
     */
    private $employeeProfilePhoto;
    
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
     * @return FysEmployeeResume
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
     * Set userResumeId
     *
     * @param integer $userResumeId
     *
     * @return FysEmployeeResume
     */
    public function setUserResumeId($userResumeId)
    {
        $this->userResumeId = $userResumeId;

        return $this;
    }

    /**
     * Get userResumeId
     *
     * @return int
     */
    public function getUserResumeId()
    {
        return $this->userResumeId;
    }

    /**
     * Set employeeResumeDesc
     *
     * @param string $employeeResumeDesc
     *
     * @return FysEmployeeResume
     */
    public function setEmployeeResumeDesc($employeeResumeDesc)
    {
        $this->employeeResumeDesc = $employeeResumeDesc;

        return $this;
    }

    /**
     * Get employeeResumeDesc
     *
     * @return string
     */
    public function getEmployeeResumeDesc()
    {
        return $this->employeeResumeDesc;
    }

    /**
     * Set userExperience1
     *
     * @param string $userExperience1
     *
     * @return FysEmployeeResume
     */
    public function setUserExperience1($userExperience1)
    {
        $this->userExperience1 = $userExperience1;

        return $this;
    }

    /**
     * Get userExperience1
     *
     * @return string
     */
    public function getUserExperience1()
    {
        return $this->userExperience1;
    }

    /**
     * Set userExperience2
     *
     * @param string $userExperience2
     *
     * @return FysEmployeeResume
     */
    public function setUserExperience2($userExperience2)
    {
        $this->userExperience2 = $userExperience2;

        return $this;
    }

    /**
     * Get userExperience2
     *
     * @return string
     */
    public function getUserExperience2()
    {
        return $this->userExperience2;
    }

    /**
     * Set userExperience3
     *
     * @param string $userExperience3
     *
     * @return FysEmployeeResume
     */
    public function setUserExperience3($userExperience3)
    {
        $this->userExperience3 = $userExperience3;

        return $this;
    }

    /**
     * Get userExperience3
     *
     * @return string
     */
    public function getUserExperience3()
    {
        return $this->userExperience3;
    }

    /**
     * Set userCertificate1
     *
     * @param string $userCertificate1
     *
     * @return FysEmployeeResume
     */
    public function setUserCertificate1($userCertificate1)
    {
        $this->userCertificate1 = $userCertificate1;

        return $this;
    }

    /**
     * Get userCertificate1
     *
     * @return string
     */
    public function getUserCertificate1()
    {
        return $this->userCertificate1;
    }

    /**
     * Set userCertificate2
     *
     * @param string $userCertificate2
     *
     * @return FysEmployeeResume
     */
    public function setUserCertificate2($userCertificate2)
    {
        $this->userCertificate2 = $userCertificate2;

        return $this;
    }

    /**
     * Get userCertificate2
     *
     * @return string
     */
    public function getUserCertificate2()
    {
        return $this->userCertificate2;
    }

    /**
     * Set userCertificate3
     *
     * @param string $userCertificate3
     *
     * @return FysEmployeeResume
     */
    public function setUserCertificate3($userCertificate3)
    {
        $this->userCertificate3 = $userCertificate3;

        return $this;
    }

    /**
     * Get userCertificate3
     *
     * @return string
     */
    public function getUserCertificate3()
    {
        return $this->userCertificate3;
    }

    /**
     * Set userExperienceYear
     *
     * @param integer $userExperienceYear
     *
     * @return FysEmployeeResume
     */
    public function setUserExperienceYear($userExperienceYear)
    {
        $this->userExperienceYear = $userExperienceYear;

        return $this;
    }

    /**
     * Get userExperienceYear
     *
     * @return int
     */
    public function getUserExperienceYear()
    {
        return $this->userExperienceYear;
    }

    /**
     * Set employeeResumeDoc
     *
     * @param string $employeeResumeDoc
     *
     * @return FysEmployeeResume
     */
    public function setEmployeeResumeDoc($employeeResumeDoc)
    {
        $this->employeeResumeDoc = $employeeResumeDoc;

        return $this;
    }

    /**
     * Get employeeResumeDoc
     *
     * @return string
     */
    public function getEmployeeResumeDoc()
    {
        return $this->employeeResumeDoc;
    }
    
    /**
     * Set employeeProfilePhoto
     *
     * @param string $employeeProfilePhoto
     *
     * @return FysEmployeeProfilePhoto
     */
    public function setEmployeeProfilePhoto($employeeProfilePhoto)
    {
        $this->employeeProfilePhoto = $employeeProfilePhoto;

        return $this;
    }

    /**
     * Get employeeProfilePhoto
     *
     * @return string
     */
    public function getEmployeeProfilePhoto()
    {
        return $this->employeeProfilePhoto;
    }
}
