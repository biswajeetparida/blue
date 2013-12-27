<?php

namespace RMSArdra\Bundle\RMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RMSArdra\Bundle\RMSBundle\Entity\JobRequirement;
use RMSArdra\Bundle\RMSBundle\Form\JobRequirementType;

use Symfony\Component\Security\Core\SecurityContext;

/**
 * JobRequirement controller.
 *
 * @Route("/jobrequirement")
 */
class JobRequirementController extends Controller
{

    /**
     * Lists all JobRequirement entities.
     *
     * @Route("/", name="jobrequirement")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->container->get('security.context')->getToken()->getUser();
        if (true === $this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
        {
            $entities = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->findAll();
        }
        else //if(true === $this->get('security.context')->isGranted('ROLE_COMPANY_USER'))
        {
            $entities = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->findBy(array('company' => $user->getCompany()->getId()));
        }
        //else
        //{
        //    $permited = $em->getRepository('RMSArdraRMSBundle:VendorProfileLimit')->findBy(array('vendorUser' => $user->getId()));
        //    $entities = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->findBy(array('company' => $user->getCompany()->getId(), 'id' => $permited));
        //}
        //$company_entity_id=$this->container->get('security.context')->getToken()->getUser()->getCompany()->getId();
        //$entities = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->findBy(array('company' => $company_entity_id));

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new JobRequirement entity.
     *
     * @Route("/", name="jobrequirement_create")
     * @Method("POST")
     * @Template("RMSArdraRMSBundle:JobRequirement:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new JobRequirement();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $company_entity=$this->container->get('security.context')->getToken()->getUser()->getCompany();
        $entity->setCompany($company_entity);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vendorprofilelimit_new', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a JobRequirement entity.
    *
    * @param JobRequirement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(JobRequirement $entity)
    {
        $form = $this->createForm(new JobRequirementType(), $entity, array(
            'action' => $this->generateUrl('jobrequirement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new JobRequirement entity.
     *
     * @Route("/new", name="jobrequirement_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new JobRequirement();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a JobRequirement entity.
     *
     * @Route("/{id}", name="jobrequirement_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->find($id);
        $candidate = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->findBy(array('jobRequirement' => $id));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find JobRequirement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'candidates' => $candidate,
        );
    }

    /**
     * Displays a form to edit an existing JobRequirement entity.
     *
     * @Route("/{id}/edit", name="jobrequirement_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find JobRequirement entity.');
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
    * Creates a form to edit a JobRequirement entity.
    *
    * @param JobRequirement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(JobRequirement $entity)
    {
        $form = $this->createForm(new JobRequirementType(), $entity, array(
            'action' => $this->generateUrl('jobrequirement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing JobRequirement entity.
     *
     * @Route("/{id}/edit", name="jobrequirement_update")
     * @Method("PUT")
     * @Template("RMSArdraRMSBundle:JobRequirement:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find JobRequirement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('jobrequirement_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a JobRequirement entity.
     *
     * @Route("/{id}", name="jobrequirement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RMSArdraRMSBundle:JobRequirement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find JobRequirement entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('jobrequirement'));
    }

    /**
     * Creates a form to delete a JobRequirement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jobrequirement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
