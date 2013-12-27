<?php

namespace RMSArdra\Bundle\CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('registrationNo')
            ->add('location')
            ->add('contactNumber')
            ->add('organizationType')
            ->add('website')
            //->add('createdAt')
            //->add('updatedAt')
            //->add('createdBy')
            //->add('updatedBy')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RMSArdra\Bundle\CompanyBundle\Entity\Company'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rmsardra_bundle_companybundle_company';
    }
}
