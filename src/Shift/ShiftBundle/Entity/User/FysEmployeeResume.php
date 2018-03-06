<?php

namespace Shift\ShiftBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * FysEmployeeResume
 *
 * @ORM\Table(name="fys_employee_resume")
 * @ORM\Entity(repositoryClass="Shift\ShiftBundle\Repository\User\FysEmployeeResumeRepository")
 */
class FysEmployeeResume
{
    const DEFAULT_PROFILE_TYPE = "jpeg";
    const DEFAULT_RESUME_TYPE = "doc";
    const DEFAULT_RESUME_NAME = "resume";
    const DEFAULT_PROFILE_PIC_NAME = "profile";
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
     * @ORM\Column(name="user_organisation_1", type="string", length=255, nullable=true)
     */
    private $userOrganisation1;

    /**
     * @var string
     *
     * @ORM\Column(name="user_organisation_2", type="string", length=255, nullable=true)
     */
    private $userOrganisation2;

    /**
     * @var string
     *
     * @ORM\Column(name="user_organisation_3", type="string", length=255, nullable=true)
     */
    private $userOrganisation3;

    /**
     * @var int
     *
     * @ORM\Column(name="user_experience_year", type="integer" , nullable=true)
     */
    private $userExperienceYear;

    /**
     * @ORM\Column(name="employee_resume_doc", type="string",length=500, nullable=true)
     */
    private $employeeResumeDoc;

    /**
     * @ORM\Column(name="employee_profile_photo", type="string",length=500, nullable=true)
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
     * @return File
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
     * @return FysEmployeeResume
     */
    public function setEmployeeProfilePhoto($employeeProfilePhoto)
    {
        $this->employeeProfilePhoto = $employeeProfilePhoto;

        return $this;
    }

    /**
     * Get employeeProfilePhoto
     *
     * @return File
     */
    public function getEmployeeProfilePhoto()
    {
        return $this->employeeProfilePhoto;
    }

    public function getAbsoluteProfilePath()
    {
        return null === $this->employeeProfilePhoto
            ? null
            : $this->getUploadProfileRootDir() . '/' . $this->employeeProfilePhoto;
    }

    public function getWebProfilePath()
    {
        return null === $this->employeeProfilePhoto
            ? null
            :  $this->employeeProfilePhoto;
    }

    public function UploadResumeDoc(File $resume)
    {
        // the file property can be empty if the field is not required
        if (null === $resume) {
            return;
        }
        $extension = $this->getFileType($resume, self::DEFAULT_RESUME_TYPE);
        $resumeName = self::DEFAULT_RESUME_NAME . "_" . $this->getEmployeeId() . "." . $extension;
        //delete existing file
        //delete existing file
        $this->deleteExistingFilesForUSer(self::DEFAULT_RESUME_NAME);

        $resume->move($this->getUploadRootDir(), $resumeName);
        return $this->getUploadDir() . $resumeName;
    }

    public function UploadProfilePhoto(File $profile)
    {
        // the file property can be empty if the field is not required
        if (null === $profile) {
            return;
        }
        $extension = $this->getFileType($profile, self::DEFAULT_PROFILE_TYPE);
        // move takes the target directory and then the
        // target filename to move to
        $profilePicName = self::DEFAULT_PROFILE_PIC_NAME . "_" . $this->getEmployeeId() . "." . $extension;
        //delete existing file
        $this->deleteExistingFilesForUSer(self::DEFAULT_PROFILE_PIC_NAME);

        $profile->move($this->getUploadRootDir(), $profilePicName);
        // set the path property to the filename where you've saved the file
        return $this->getUploadDir() . $profilePicName;
    }

    protected function deleteExistingFilesForUSer($type)
    {
        if (!is_dir($this->getUploadRootDir())) {
            return;
        }
        $fileName = $type . "_" . $this->getEmployeeId();
        foreach (scandir($this->getUploadRootDir()) as $file) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;
            $fileNameSplit = explode(".", $file);
            if ($fileNameSplit[0] && $fileNameSplit[0] == $fileName) {
                unlink($this->getUploadRootDir().$file);
            }
        }
    }

    protected function getFileType(File $file, $type)
    {
        if (empty($file->guessExtension())) {
            return $type;
        }
        return $file->guessExtension();
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../../web/uploads/documents/';
    }

    protected function getUploadDir()
    {
        return '/uploads/documents/';
    }

    /**
     * @return string
     */
    public function getUserOrganisation1(): string
    {
        return $this->userOrganisation1;
    }

    /**
     * @param string $userOrganisation1
     */
    public function setUserOrganisation1(string $userOrganisation1)
    {
        $this->userOrganisation1 = $userOrganisation1;
    }

    /**
     * @return string
     */
    public function getUserOrganisation2(): string
    {
        return $this->userOrganisation2;
    }

    /**
     * @param string $userOrganisation2
     */
    public function setUserOrganisation2(string $userOrganisation2)
    {
        $this->userOrganisation2 = $userOrganisation2;
    }

    /**
     * @return string
     */
    public function getUserOrganisation3(): string
    {
        return $this->userOrganisation3;
    }

    /**
     * @param string $userOrganisation3
     */
    public function setUserOrganisation3(string $userOrganisation3)
    {
        $this->userOrganisation3 = $userOrganisation3;
    }
}
