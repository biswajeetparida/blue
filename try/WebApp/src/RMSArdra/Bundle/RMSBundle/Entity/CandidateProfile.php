<?php

namespace RMSArdra\Bundle\RMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CandidateProfile
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class CandidateProfile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    private $temp;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="integer", nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=100, nullable=true)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="candidate_name", type="string", length=200, nullable=true)
     */
    private $candidateName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=20, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="current_company", type="string", length=200, nullable=true)
     */
    private $currentCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="current_designation", type="string", length=200, nullable=true)
     */
    private $currentDesignation;

    /**
     * @var string
     *
     * @ORM\Column(name="years_of_experience", type="string", length=30, nullable=true)
     */
    private $yearsOfExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="relevant_years_of_experience", type="string", length=30, nullable=true)
     */
    private $relevantYearsOfExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="current_ctc", type="string", length=15, nullable=true)
     */
    private $currentCtc;

    /**
     * @var string
     *
     * @ORM\Column(name="expected_ctc", type="string", length=25, nullable=true)
     */
    private $expectedCtc;

    /**
     * @var string
     *
     * @ORM\Column(name="notice_period", type="string", length=30, nullable=true)
     */
    private $noticePeriod;

    /**
     * @var string
     *
     * @ORM\Column(name="current_location", type="string", length=200, nullable=true)
     */
    private $currentLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="preferred_location", type="string", length=200, nullable=true)
     */
    private $preferredLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="screening_result", type="string", length=200, nullable=true)
     */
    private $screeningResult;

    /**
     * @var string
     *
     * @ORM\Column(name="telephonic_interview_result", type="string", length=200, nullable=true)
     */
    private $telephonicInterviewResult;

    /**
     * @var string
     *
     * @ORM\Column(name="personal_interview_result", type="string", length=200, nullable=true)
     */
    private $personalInterviewResult;

    /**
     * @var string
     *
     * @ORM\Column(name="hr_round_result", type="string", length=200, nullable=true)
     */
    private $hrRoundResult;

    /**
     * @var string
     *
     * @ORM\Column(name="offer_letter_delivery_date", type="string", length=2100, nullable=true)
     */
    private $offerLetterDeliveryDate;

    /**
     * @var string
     *
     * @ORM\Column(name="documentation", type="string", length=255, nullable=true)
     */
    private $documentation;

    /**
     * @var date
     *
     * @ORM\Column(name="joining_date", type="date", nullable=true)
     */
    private $joiningDate;
    
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
     * @ORM\Column(name="created_by", type="string", length=255, nullable=true)
     */
    private $createdBy;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(name="updated_by", type="string", length=255, nullable=true)
     */
    private $updatedBy;

    /**
     * @var string
     * @Assert\File(maxSize="6000000")
     * @ORM\Column(name="resume", type="string", length=255, nullable=true)
     */
    private $resume;
    
    /**
     * @ORM\ManyToOne(targetEntity="JobRequirement")
     * @ORM\JoinColumn(name="jobRequirement_id", referencedColumnName="id")
     **/
    private $jobRequirement;
    
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
     * Set source
     *
     * @param string $source
     * @return CandidateProfile
     */
    public function setSource($source)
    {
        $this->source = $source;
    
        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set designation
     *
     * @param string $designation
     * @return CandidateProfile
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    
        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set candidateName
     *
     * @param string $candidateName
     * @return CandidateProfile
     */
    public function setCandidateName($candidateName)
    {
        $this->candidateName = $candidateName;
    
        return $this;
    }

    /**
     * Get candidateName
     *
     * @return string 
     */
    public function getCandidateName()
    {
        return $this->candidateName;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return CandidateProfile
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return CandidateProfile
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
     * Set currentCompany
     *
     * @param string $currentCompany
     * @return CandidateProfile
     */
    public function setCurrentCompany($currentCompany)
    {
        $this->currentCompany = $currentCompany;
    
        return $this;
    }

    /**
     * Get currentCompany
     *
     * @return string 
     */
    public function getCurrentCompany()
    {
        return $this->currentCompany;
    }

    /**
     * Set currentDesignation
     *
     * @param string $currentDesignation
     * @return CandidateProfile
     */
    public function setCurrentDesignation($currentDesignation)
    {
        $this->currentDesignation = $currentDesignation;
    
        return $this;
    }

    /**
     * Get currentDesignation
     *
     * @return string 
     */
    public function getCurrentDesignation()
    {
        return $this->currentDesignation;
    }

    /**
     * Set yearsOfExperience
     *
     * @param string $yearsOfExperience
     * @return CandidateProfile
     */
    public function setYearsOfExperience($yearsOfExperience)
    {
        $this->yearsOfExperience = $yearsOfExperience;
    
        return $this;
    }

    /**
     * Get yearsOfExperience
     *
     * @return string 
     */
    public function getYearsOfExperience()
    {
        return $this->yearsOfExperience;
    }

    /**
     * Set relevantYearsOfExperience
     *
     * @param string $relevantYearsOfExperience
     * @return CandidateProfile
     */
    public function setRelevantYearsOfExperience($relevantYearsOfExperience)
    {
        $this->relevantYearsOfExperience = $relevantYearsOfExperience;
    
        return $this;
    }

    /**
     * Get relevantYearsOfExperience
     *
     * @return string 
     */
    public function getRelevantYearsOfExperience()
    {
        return $this->relevantYearsOfExperience;
    }

    /**
     * Set currentCtc
     *
     * @param string $currentCtc
     * @return CandidateProfile
     */
    public function setCurrentCtc($currentCtc)
    {
        $this->currentCtc = $currentCtc;
    
        return $this;
    }

    /**
     * Get currentCtc
     *
     * @return string 
     */
    public function getCurrentCtc()
    {
        return $this->currentCtc;
    }

    /**
     * Set expectedCtc
     *
     * @param string $expectedCtc
     * @return CandidateProfile
     */
    public function setExpectedCtc($expectedCtc)
    {
        $this->expectedCtc = $expectedCtc;
    
        return $this;
    }

    /**
     * Get expectedCtc
     *
     * @return string 
     */
    public function getExpectedCtc()
    {
        return $this->expectedCtc;
    }

    /**
     * Set noticePeriod
     *
     * @param string $noticePeriod
     * @return CandidateProfile
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
     * Set currentLocation
     *
     * @param string $currentLocation
     * @return CandidateProfile
     */
    public function setCurrentLocation($currentLocation)
    {
        $this->currentLocation = $currentLocation;
    
        return $this;
    }

    /**
     * Get currentLocation
     *
     * @return string 
     */
    public function getCurrentLocation()
    {
        return $this->currentLocation;
    }

    /**
     * Set preferredLocation
     *
     * @param string $preferredLocation
     * @return CandidateProfile
     */
    public function setPreferredLocation($preferredLocation)
    {
        $this->preferredLocation = $preferredLocation;
    
        return $this;
    }

    /**
     * Get preferredLocation
     *
     * @return string 
     */
    public function getPreferredLocation()
    {
        return $this->preferredLocation;
    }

    /**
     * Set screeningResult
     *
     * @param string $screeningResult
     * @return CandidateProfile
     */
    public function setScreeningResult($screeningResult)
    {
        $this->screeningResult = $screeningResult;
    
        return $this;
    }

    /**
     * Get screeningResult
     *
     * @return string 
     */
    public function getScreeningResult()
    {
        return $this->screeningResult;
    }

    /**
     * Set telephonicInterviewResult
     *
     * @param string $telephonicInterviewResult
     * @return CandidateProfile
     */
    public function setTelephonicInterviewResult($telephonicInterviewResult)
    {
        $this->telephonicInterviewResult = $telephonicInterviewResult;
    
        return $this;
    }

    /**
     * Get telephonicInterviewResult
     *
     * @return string 
     */
    public function getTelephonicInterviewResult()
    {
        return $this->telephonicInterviewResult;
    }

    /**
     * Set personalInterviewResult
     *
     * @param string $personalInterviewResult
     * @return CandidateProfile
     */
    public function setPersonalInterviewResult($personalInterviewResult)
    {
        $this->personalInterviewResult = $personalInterviewResult;
    
        return $this;
    }

    /**
     * Get personalInterviewResult
     *
     * @return string 
     */
    public function getPersonalInterviewResult()
    {
        return $this->personalInterviewResult;
    }

    /**
     * Set hrRoundResult
     *
     * @param string $hrRoundResult
     * @return CandidateProfile
     */
    public function setHrRoundResult($hrRoundResult)
    {
        $this->hrRoundResult = $hrRoundResult;
    
        return $this;
    }

    /**
     * Get hrRoundResult
     *
     * @return string 
     */
    public function getHrRoundResult()
    {
        return $this->hrRoundResult;
    }

    /**
     * Set offerLetterDeliveryDate
     *
     * @param string $offerLetterDeliveryDate
     * @return CandidateProfile
     */
    public function setOfferLetterDeliveryDate($offerLetterDeliveryDate)
    {
        $this->offerLetterDeliveryDate = $offerLetterDeliveryDate;
    
        return $this;
    }

    /**
     * Get offerLetterDeliveryDate
     *
     * @return string 
     */
    public function getOfferLetterDeliveryDate()
    {
        return $this->offerLetterDeliveryDate;
    }

    /**
     * Set documentation
     *
     * @param string $documentation
     * @return CandidateProfile
     */
    public function setDocumentation($documentation)
    {
        $this->documentation = $documentation;
    
        return $this;
    }

    /**
     * Get documentation
     *
     * @return string 
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Set joiningDate
     *
     * @param date $joiningDate
     * @return CandidateProfile
     */
    public function setJoiningDate($joiningDate)
    {
        $this->joiningDate = $joiningDate;
    
        return $this;
    }

    /**
     * Get joiningDate
     *
     * @return date 
     */
    public function getJoiningDate()
    {
        return $this->joiningDate;
    }
    
    /**
     * Set createdAt
     * @ORM\PrePersist
     * @return CandidateProfile
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
     * @return CandidateProfile
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
     * @return CandidateProfile
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
     * @return CandidateProfile
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
     * Get resume
     *
     * @return string 
     */
    public function getResume()
    {
        return $this->resume;
    }
    
     /**
     * Set resume
     *
     * @param UploadedFile $resume
     * @return CandidateProfile
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }
    
     /**
     * Get resume
     *
     * @return string 
     */
    public function getTemp()
    {
        return $this->temp;
    }
    
     /**
     * Set temp
     *
     * @param UploadedFile $temp
     * @return CandidateProfile
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }


    /**
     * Set jobRequirement
     *
     * @param \RMSArdra\Bundle\RMSBundle\Entity\JobRequirement $jobRequirement
     * @return CandidateProfile
     */
    public function setJobRequirement(\RMSArdra\Bundle\RMSBundle\Entity\JobRequirement $jobRequirement = null)
    {
        $this->jobRequirement = $jobRequirement;
    
        return $this;
    }

    /**
     * Get jobRequirement
     *
     * @return \RMSArdra\Bundle\RMSBundle\Entity\JobRequirement 
     */
    public function getJobRequirement()
    {
        return $this->jobRequirement;
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
}