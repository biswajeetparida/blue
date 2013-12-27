<?php

namespace RMSArdra\Bundle\RMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * JobRequirement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RMSArdra\Bundle\RMSBundle\Entity\JobRequirementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class JobRequirement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="job_code", type="string", length=100, nullable=true)
     */
    private $jobCode;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=100, nullable=true)
     */
    private $position;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Year_of_experience", type="string", length=100, nullable=true)
     */
    private $yearOfExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="relevant_experience", type="string", length=100, nullable=true)
     */
    private $relevantExperience;
    
    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100, nullable=true)
     */
    private $location;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ctc", type="string", length=100, nullable=true)
     */
    private $ctc;
    
    /**
     * @var string
     *
     * @ORM\Column(name="notice_period", type="string", length=100, nullable=true)
     */
    private $noticePeriod;
    
    /**
     * @var string
     *
     * @ORM\Column(name="qualification", type="string", length=100, nullable=true)
     */
    private $qualification;
    
    

    /**
     * @var string
     *
     * @ORM\Column(name="relevant_skills", type="string", length=200, nullable=true)
     */
    private $relevantSkills;
    
    /**
     * @var string
     *
     * @ORM\Column(name="job_description", type="text", nullable=true)
     */
    private $jobDescription;
    
    /**
     * @var date
     *
     * @ORM\Column(name="start_date", type="date", nullable=true)
     */
    private $startDate;
    
    
    /**
     * @var date
     *
     * @ORM\Column(name="close_date", type="date", nullable=true)
     */
    private $closeDate;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="created_by", type="string", length=50, nullable=true)
     */
    private $createdBy;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(name="updated_by", type="string", length=50, nullable=true)
     */
    private $updatedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="vendors", type="string", length=255, nullable=true)
     */
    private $vendors;

    /**
     * @ORM\ManyToOne(targetEntity="RMSArdra\Bundle\CompanyBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     **/
    private $company;
    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set jobCode
     *
     * @param string $jobCode
     * @return JobRequirement
     */
    public function setJobCode($jobCode)
    {
        $this->jobCode = $jobCode;
    
        return $this;
    }

    /**
     * Get jobCode
     *
     * @return string 
     */
    public function getJobCode()
    {
        return $this->jobCode;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return JobRequirement
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }
    
    /**
     * Set relevantExperience
     *
     * @param string $yearOfExperience
     * @return JobRequirement
     */
    public function setYearOfExperience($yearOfExperience)
    {
        $this->yearOfExperience = $yearOfExperience;
    
        return $this;
    }

    /**
     * Get yearOfExperience
     *
     * @return string 
     */
    public function getYearOfExperience()
    {
        return $this->yearOfExperience;
    }
    
    /**
     * Set relevantExperience
     *
     * @param string $relevantExperience
     * @return JobRequirement
     */
    public function setRelevantExperience($relevantExperience)
    {
        $this->relevantExperience = $relevantExperience;
    
        return $this;
    }

    /**
     * Get relevantExperience
     *
     * @return string 
     */
    public function getRelevantExperience()
    {
        return $this->relevantExperience;
    }
    
    /**
     * Set location
     *
     * @param string $location
     * @return JobRequirement
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }
    
    /**
     * Set ctc
     *
     * @param string $ctc
     * @return JobRequirement
     */
    public function setCtc($ctc)
    {
        $this->ctc = $ctc;
    
        return $this;
    }

    /**
     * Get ctc
     *
     * @return string 
     */
    public function getCtc()
    {
        return $this->ctc;
    }
    
    /**
     * Set noticePeriod
     *
     * @param string $noticePeriod
     * @return JobRequirement
     */
    public function setNoticePeriod($noticePeriod)
    {
        $this->noticePeriod = $noticePeriod;
    
        return $this;
    }

    /**
     * Get noticePeriod
     *
     * @return string 
     */
    public function getNoticePeriod()
    {
        return $this->noticePeriod;
    }
    
    /**
     * Set qualification
     *
     * @param string $qualification
     * @return JobRequirement
     */
    public function setQualification($qualification)
    {
        $this->qualification = $qualification;
    
        return $this;
    }

    /**
     * Get noticePeriod
     *
     * @return string 
     */
    public function getQualification()
    {
        return $this->qualification;
    }
    
   

    /**
     * Set relevantSkills
     *
     * @param string $relevantSkills
     * @return JobRequirement
     */
    public function setRelevantSkills($relevantSkills)
    {
        $this->relevantSkills = $relevantSkills;
    
        return $this;
    }

    /**
     * Get relevantSkills
     *
     * @return string 
     */
    public function getRelevantSkills()
    {
        return $this->relevantSkills;
    }

    /**
     * Set jobDescription
     *
     * @param string $jobDescription
     * @return JobRequirement
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    
        return $this;
    }

    /**
     * Get jobDescription
     *
     * @return string 
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

   
    /**
     * Set startDate
     *
     * @param date $startDate
     * @return JobRequirement
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get noticePeriod
     *
     * @return date 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }
   
     /**
     * Set closeDate
     *
     * @param date $closeDate
     * @return JobRequirement
     */
    public function setCloseDate($closeDate)
    {
        $this->startDate = $closeDate;
    
        return $this;
    }

    /**
     * Get closeDate
     *
     * @return date 
     */
    public function getCloseDate()
    {
        return $this->startDate;
    }
    
    
   /**
     * Set createdAt
     * @ORM\PrePersist
     * @return JobRequirement
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     * @ORM\PrePersist
     * @return JobRequirement
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return JobRequirement
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param string $updatedBy
     * @return JobRequirement
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    
        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return string 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set vendors
     *
     * @param string $vendors
     * @return JobRequirement
     */
    public function setVendors($vendors)
    {
        $this->vendors = $vendors;
    
        return $this;
    }

    /**
     * Get vendors
     *
     * @return string 
     */
    public function getVendors()
    {
        return $this->vendors;
    }

    /**
     * Set company
     *
     * @param \RMSArdra\Bundle\CompanyBundle\Entity\Company $company
     * @return JobRequirement
     */
    public function setCompany(\RMSArdra\Bundle\CompanyBundle\Entity\Company $company = null)
    {   
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return \RMSArdra\Bundle\CompanyBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    
    public function __toString()
    {
        return $this->id;
    }
}