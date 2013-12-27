<?php

namespace RMSArdra\Bundle\RMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JobRequirementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('jobCode')
            ->add('position','text',array('required' => true))
            ->add('yearOfExperience','text',array('required' => true))
            ->add('relevantExperience','text',array('required' => false))
            ->add('location','textarea',array('required' => false))
            ->add('ctc','text',array('required' => false))
            ->add('noticePeriod','textarea',array('required' => true))
            ->add('qualification','textarea',array('required' => true))
            ->add('relevantSkills','textarea',array('required' => true))
            ->add('jobDescription','textarea',array('required' => true))
            ->add('startDate','date',array('required' => true))
            ->add('closeDate','date',array('required' => true))
            //->add('createdAt')
            //->add('updatedAt')
            //->add('createdBy')
            //->add('updatedBy')
            //->add('vendors')
            //->add('company')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RMSArdra\Bundle\RMSBundle\Entity\JobRequirement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rmsardra_bundle_rmsbundle_jobrequirement';
    }
}
