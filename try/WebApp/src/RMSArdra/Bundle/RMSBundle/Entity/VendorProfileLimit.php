<?php

namespace RMSArdra\Bundle\RMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VendorProfileLimit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class VendorProfileLimit
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
     * @ORM\ManyToOne(targetEntity="JobRequirement")
     * @ORM\JoinColumn(name="jobRequirement_id", referencedColumnName="id")
     **/
    private $jobRequire;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="vendor_user_id", referencedColumnName="id")
     **/
    private $vendorUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="profile_limit", type="integer")
     */
    private $profileLimit;


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
     * Set profileLimit
     *
     * @param integer $profileLimit
     * @return VendorProfileLimit
     */
    public function setProfileLimit($profileLimit)
    {
        $this->profileLimit = $profileLimit;
    
        return $this;
    }

    /**
     * Get profileLimit
     *
     * @return integer 
     */
    public function getProfileLimit()
    {
        return $this->profileLimit;
    }

    /**
     * Set jobRequire
     *
     * @param \RMSArdra\Bundle\RMSBundle\Entity\JobRequirement $jobRequire
     * @return VendorProfileLimit
     */
    public function setJobRequire(\RMSArdra\Bundle\RMSBundle\Entity\JobRequirement $jobRequire = null)
    {
        $this->jobRequire = $jobRequire;
    
        return $this;
    }

    /**
     * Get jobRequire
     *
     * @return \RMSArdra\Bundle\RMSBundle\Entity\JobRequirement 
     */
    public function getJobRequire()
    {
        return $this->jobRequire;
    }

    /**
     * Set vendorUser
     *
     * @param \Application\Sonata\UserBundle\Entity\User $vendorUser
     * @return VendorProfileLimit
     */
    public function setVendorUser(\Application\Sonata\UserBundle\Entity\User $vendorUser = null)
    {
        $this->vendorUser = $vendorUser;
    
        return $this;
    }

    /**
     * Get vendorUser
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getVendorUser()
    {
        return $this->vendorUser;
    }
    
    public function __toString()
    {
        return $this->jobRequire;
    }
}