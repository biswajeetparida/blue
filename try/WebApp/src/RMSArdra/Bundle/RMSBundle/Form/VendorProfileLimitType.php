<?php

namespace RMSArdra\Bundle\RMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VendorProfileLimitType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('profileLimit')
            //->add('jobRequire')
            ->add('vendorUser')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RMSArdra\Bundle\RMSBundle\Entity\VendorProfileLimit'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rmsardra_bundle_rmsbundle_vendorprofilelimit';
    }
}
