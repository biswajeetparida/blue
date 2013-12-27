<?php
namespace Application\Sonata\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Application\Sonata\UserBundle\Form\Type\RemoveFormFieldType;

class RemoveFormFieldController extends Controller
{
    public function firstWayAction()
    {
        $form = $this->createForm(new RemoveFormFieldType());

        $form->remove('firstname');
    
        // form processing...
    
        return $this->render('QADayBundle:RemoveFormField:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function secondWayAction()
    {
        $form = $this->createForm(new RemoveFormFieldType(), null, array(
            'use_second' => false
        ));
    
        return $this->render('QADayBundle:RemoveFormField:form.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first', 'text');
    
        if ($options['use_second']) {
            $builder->add('firstname', 'text');
        }
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'use_second' => true
        ));
    }
}