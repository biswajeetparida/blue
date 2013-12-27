<?php

namespace Application\Sonata\UserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;


/**
 * User
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="fos_user_user")
 * @ORM\Entity
 */

class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *@var string
     *
     *
     *  @ORM\ManyToOne(targetEntity="RMSArdra\Bundle\CompanyBundle\Entity\Company")
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(referencedColumnName="id")}
        )
     **/

    protected $company;
    
    
    /**
     * Set name
     *
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get name
     *
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    //public function __toString()
    //{
    //    return $this->;
    //}
    
    //public function prePersist($object) {
    //    print_r('hello');exit;
    //    $uniqid = $this->getRequest()->query->get('uniqid');
    //    $formData = $this->getRequest()->request->get($uniqid);
    //    if(array_key_exists('company', $formData) && $formData['company'] !== null ) {
    //        $object->setCompany($this->container->get('security.context')->getToken()->getUser()->getCompany());
    //    }
    //}
}