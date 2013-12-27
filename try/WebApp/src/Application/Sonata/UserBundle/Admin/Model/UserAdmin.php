<?php
namespace Application\Sonata\UserBundle\Admin\model;

use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;
////////
//use Sonata\AdminBundle\Admin\AdminInterface;
//use Symfony\Component\Form\Form;
//use Symfony\Component\Form\FormBuilder;
//use Symfony\Component\PropertyAccess\PropertyPath;
//use Symfony\Component\PropertyAccess\PropertyAccess;
//use Symfony\Component\Validator\ValidatorInterface;
//use Symfony\Component\Translation\TranslatorInterface;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Security\Acl\Model\DomainObjectInterface;
//
//use Sonata\AdminBundle\Show\ShowMapper;
//
//use Sonata\AdminBundle\Admin\Pool;
//use Sonata\AdminBundle\Validator\ErrorElement;
//use Sonata\AdminBundle\Validator\Constraints\InlineConstraint;
//
//use Sonata\AdminBundle\Translator\LabelTranslatorStrategyInterface;
//use Sonata\AdminBundle\Builder\FormContractorInterface;
//use Sonata\AdminBundle\Builder\ListBuilderInterface;
//use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
//use Sonata\AdminBundle\Builder\ShowBuilderInterface;
//use Sonata\AdminBundle\Builder\RouteBuilderInterface;
//use Sonata\AdminBundle\Route\RouteGeneratorInterface;
//
//use Sonata\AdminBundle\Security\Handler\SecurityHandlerInterface;
//use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
//use Sonata\AdminBundle\Route\RouteCollection;
//use Sonata\AdminBundle\Model\ModelManagerInterface;
//
//use Knp\Menu\FactoryInterface as MenuFactoryInterface;
//use Knp\Menu\ItemInterface as MenuItemInterface;
//
//use Doctrine\Common\Util\ClassUtils;

///////
class UserAdmin extends SonataUserAdmin //implements AdminInterface, DomainObjectInterface
{
    
    
    /**
    * {@inheritdoc}
    */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
        $formMapper
            ->with('General')
                ->add('username')
                ->add('email')
                ->add('plainPassword', 'text', array(
                    'required' => is_null($this->getSubject()->getId())
                ))
            ->end();
        }
        $formMapper
            ->with('Groups')
                ->add('groups', 'sonata_type_model', array(
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true
                ))
            ->end()
            ->with('Profile')
                ->add('dateOfBirth', 'birthday', array('required' => false))
                ->add('firstname', null, array('required' => false))
                ->add('lastname', null, array('required' => false))
                ->add('website', 'url', array('required' => false))
                ->add('biography', 'text', array('required' => false))
                ->add('gender', 'sonata_user_gender', array(
                    'required' => true,
                    'translation_domain' => $this->getTranslationDomain()
                ))
                ->add('locale', 'locale', array('required' => false))
                ->add('timezone', 'timezone', array('required' => false))
                ->add('phone', null, array('required' => false))
            ->end()
            ->with('Social')
                ->add('facebookUid', null, array('required' => false))
                ->add('facebookName', null, array('required' => false))
                ->add('twitterUid', null, array('required' => false))
                ->add('twitterName', null, array('required' => false))
                ->add('gplusUid', null, array('required' => false))
                ->add('gplusName', null, array('required' => false))
            ->end()
        ;

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                    ->add('realRoles', 'sonata_security_roles', array(
                        'label'    => 'form.label_roles',
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false
                    ))
                    ->add('locked', null, array('required' => false))
                    ->add('expired', null, array('required' => false))
                    ->add('enabled', null, array('required' => false))
                    ->add('credentialsExpired', null, array('required' => false))
                ->end()
            ;
        }

        $formMapper
            ->with('Security')
                ->add('token', null, array('required' => false))
                ->add('twoStepVerificationCode', null, array('required' => false))
            ->end()
        ;
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
        
            if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
                $formMapper
                    ->with('General')
                        ->add('company', 'entity', array(
                            'class' => 'RMSArdraCompanyBundle:Company',
                            'label' => 'Company',
                            'property' => 'name',
                            
                        ))
                    ->end()
                ;
            }
        }
        
    }
    
    
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        if (!$this->isGranted('ROLE_SUPER_ADMIN')) {
            $query->andWhere(
            $query->expr()->eq($query->getRootAlias() . '.company', ':COMPANY')
            );
            $company=$this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser()->getCompany();
            $query->setParameter('COMPANY', $company);
        }
        return $query;
    }
    
    ///**
    // * Build the side menu related to the current action
    // *
    // * @param string                                   $action
    // * @param \Sonata\AdminBundle\Admin\AdminInterface $childAdmin
    // *
    // * @return \Knp\Menu\ItemInterface|boolean
    // */
    //public function buildSideMenu($action, AdminInterface $childAdmin = null)
    //{
    //    if ($this->loaded['side_menu']) {
    //        return;
    //    }
    //
    //    $this->loaded['side_menu'] = true;
    //    print_r('hello');exit;
    //
    //    $menu = $this->menuFactory->createItem('root');
    //    $menu->setChildrenAttribute('class', 'nav nav-list');
    //    $menu->setUri($this->getRequest()->getBaseUrl().$this->getRequest()->getPathInfo());
    //
    //    $this->configureSideMenu($menu, $action, $childAdmin);
    //
    //    foreach ($this->getExtensions() as $extension) {
    //        $extension->configureSideMenu($this, $menu, $action, $childAdmin);
    //    }
    //
    //    $this->menu = $menu;
    //}




}