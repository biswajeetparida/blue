<?php

namespace RMSArdra\Bundle\RMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RMSArdra\Bundle\RMSBundle\Entity\VendorProfileLimit;
use RMSArdra\Bundle\RMSBundle\Form\VendorProfileLimitType;

use RMSArdra\Bundle\RMSBundle\Entity\JobRequirement;


/**
 * VendorProfileLimit controller.
 *
 * @Route("/vendorprofilelimit")
 */
class VendorProfileLimitController extends Controller
{

    /**
     * Lists all VendorProfileLimit entities.
     *
     * @Route("/", name="vendorprofilelimit")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RMSArdraRMSBundle:VendorProfileLimit')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new VendorProfileLimit entity.
     *
     * @Route("/", name="vendorprofilelimit_create")
     * @Method("POST")
     * @Template("RMSArdraRMSBundle:VendorProfileLimit:new.html.twig")
     */
    public function createAction(Request $request)
    {
        
        $mappings= $request->request->get('datum');
        $em = $this->getDoctrine()->getManager();
        if(NULL===$mappings){
            return $this->redirect($this->generateUrl('jobrequirement'));
        }
        
        foreach($mappings as $mapping) {
            //if(empty($mapping['limit'])) continue;
            $entity = new VendorProfileLimit();
            $entity->setProfileLimit($mapping["limit"]);
            $entity->setJobRequire($this->getDoctrine()
                ->getRepository('RMSArdraRMSBundle:JobRequirement')
                ->find($mapping['requirement']));
            $entity->setVendorUser($this->getDoctrine()
                ->getRepository('ApplicationSonataUserBundle:user')
                ->find($mapping['vendor']));
            $em->persist($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('jobrequirement'));
    }

    /**
    * Creates a form to create a VendorProfileLimit entity.
    *
    * @param VendorProfileLimit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(VendorProfileLimit $entity)
    {
        $form = $this->createForm(new VendorProfileLimitType(), $entity, array(
            'action' => $this->generateUrl('vendorprofilelimit_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VendorProfileLimit entity.
     *
     * @Route("/new", name="vendorprofilelimit_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new VendorProfileLimit();
        $form   = $this->createCreateForm($entity);
        $em = $this->getDoctrine()->getManager();
        $company_entity=$this->container->get('security.context')->getToken()->getUser()->getCompany();
        //$entities = $em->getRepository('ApplicationSonataUserBundle:User')->findByRole('ROLE_ADMIN');
        $query = $this->getDoctrine()->getEntityManager()
                    ->createQuery(
                        'SELECT u FROM ApplicationSonataUserBundle:User u WHERE u.roles LIKE :role and u.company = :company')
                    ->setParameter('role', '%"ROLE_VENDOR_USER"%')
                    ->setParameter('company', $company_entity );
    
        
        $entities = $query->getResult();
        return array(
            'entity' => $entity,
            'users' => $entities
        );
    }
    

    /**
     * Finds and displays a VendorProfileLimit entity.
     *
     * @Route("/{id}", name="vendorprofilelimit_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //$jobid = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->find($id);
        //$jobid.= "'".$jobid."'";

        $entity = $em->getRepository('RMSArdraRMSBundle:VendorProfileLimit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VendorProfileLimit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing VendorProfileLimit entity.
     *
     * @Route("/{id}/edit", name="vendorprofilelimit_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:VendorProfileLimit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VendorProfileLimit entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a VendorProfileLimit entity.
    *
    * @param VendorProfileLimit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(VendorProfileLimit $entity)
    {
        $form = $this->createForm(new VendorProfileLimitType(), $entity, array(
            'action' => $this->generateUrl('vendorprofilelimit_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing VendorProfileLimit entity.
     *
     * @Route("/{id}", name="vendorprofilelimit_update")
     * @Method("PUT")
     * @Template("RMSArdraRMSBundle:VendorProfileLimit:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:VendorProfileLimit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VendorProfileLimit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vendorprofilelimit_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a VendorProfileLimit entity.
     *
     * @Route("/{id}", name="vendorprofilelimit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RMSArdraRMSBundle:VendorProfileLimit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VendorProfileLimit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vendorprofilelimit'));
    }

    /**
     * Creates a form to delete a VendorProfileLimit entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vendorprofilelimit_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
