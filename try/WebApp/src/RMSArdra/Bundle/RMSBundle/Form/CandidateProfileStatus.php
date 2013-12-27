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
            ->add('screeningResult')
            ->add('telephonicInterviewResult')
            ->add('personalInterviewResult')
            ->add('hrRoundResult')
            ->add('offerLetterDeliveryDate')
            ->add('documentation')
            ->add('joiningDate')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RMSArdra\Bundle\RMSBundle\Entity\CandidateProfile'
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
