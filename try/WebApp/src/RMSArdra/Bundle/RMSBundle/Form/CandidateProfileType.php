<?php

namespace RMSArdra\Bundle\RMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityRepository;

class CandidateProfileType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('candidateName')
            ->add('phoneNumber')
            ->add('email')
            ->add('currentCompany')
            ->add('currentDesignation')
            ->add('yearsOfExperience')
            ->add('relevantYearsOfExperience')
            ->add('currentCtc')
            ->add('expectedCtc')
            ->add('noticePeriod')
            ->add('currentLocation')
            ->add('preferredLocation')
            //->add('screeningResult')
            //->add('telephonicInterviewResult')
            //->add('personalInterviewResult')
            //->add('hrRoundResult')
            //->add('offerLetterDeliveryDate')
            //->add('documentation')
            //->add('joiningDate')
            //->add('createdAt')
            //->add('updatedAt')
            //->add('createdBy')
            //->add('updatedBy')
            ->add('resume')
            ->add('jobRequirement', 'hidden_entity', array(
                "class" => "RMSArdraRMSBundle:JobRequirement",
                'label' => 'job code',
                'read_only' => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RMSArdra\Bundle\RMSBundle\Entity\CandidateProfile',
            'required' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rmsardra_bundle_rmsbundle_candidateprofile';
    }
}
