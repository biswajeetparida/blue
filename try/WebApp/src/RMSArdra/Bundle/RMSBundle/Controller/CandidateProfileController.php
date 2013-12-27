<?php

namespace RMSArdra\Bundle\RMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RMSArdra\Bundle\RMSBundle\Entity\CandidateProfile;
use RMSArdra\Bundle\RMSBundle\Form\CandidateProfileType;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityRepository;


/**
 * CandidateProfile controller.
 *
 * @Route("/candidateprofile")
 */
class CandidateProfileController extends Controller
{

    /**
     * Lists all CandidateProfile entities.
     *
     * @Route("/", name="candidateprofile")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->container->get('security.context')->getToken()->getUser();
        if (true === $this->get('security.context')->isGranted('ROLE_SUPER_ADMIN'))
        {
            $entities = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->findall();
        }
        else if (true === $this->get('security.context')->isGranted('ROLE_COMPANY_USER'))
        {
            $entities = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->findBy(array('company' => $user->getCompany()->getId()));
        }
        else if (true === $this->get('security.context')->isGranted('ROLE_VENDOR_USER'))
        {
            $entities = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->findBy(array('source' => $user->getId()));
        }
        else{
            print_r('sorry your role is not sufficient for this action');exit;
        }
        


        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CandidateProfile entity.
     *
     * @Route("/", name="candidateprofile_create")
     * @Method("POST")
     * @Template("RMSArdraRMSBundle:CandidateProfile:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new CandidateProfile();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $user=$this->container->get('security.context')->getToken()->getUser();
        $entity->setSource($user->getId());
        $entity->setCompany($user->getCompany());
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('candidateprofile_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a CandidateProfile entity.
    *
    * @param CandidateProfile $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(CandidateProfile $entity)
    {
        $form = $this->createForm(new CandidateProfileType(), $entity, array(
            'action' => $this->generateUrl('candidateprofile_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CandidateProfile entity.
     *
     * @Route("/new", name="candidateprofile_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $request = Request::createFromGlobals();
        $jobReqId = $request->query->get('jobId');
        $user=$this->container->get('security.context')->getToken()->getUser()->getId();
        $uploadedno = $em->createQueryBuilder();
        $uploadedno->select('count(cp.id)')
        ->from('RMSArdraRMSBundle:CandidateProfile','cp')
        ->where('cp.source = :user')
        ->andwhere('cp.jobRequirement = :jobrequirement')
        ->setParameter('user', $user)
        ->setParameter('jobrequirement', $jobReqId);
        $count = $uploadedno->getQuery()->getSingleScalarResult();
        
        $uploadlimit = $em->createQueryBuilder();
        $uploadlimit->select('count(vpl.id),vpl.profileLimit')
        ->from('RMSArdraRMSBundle:VendorProfileLimit','vpl')
        ->where('vpl.vendorUser = :vendoruser')
        ->andwhere('vpl.jobRequire = :jobrequirement')
        ->setParameter('vendoruser', $user)
        ->setParameter('jobrequirement', $jobReqId);
        $limit = $uploadlimit->getQuery()->getResult();
        
        
        if($limit[0][1]==0)
        {
            print_r('<h2>sorry you are not allowed to upload profile for this job requirement</h2>');exit;
        }
        if(!(($limit[0]['profileLimit']-$count)>0))
        {
            print_r('<h2>sorry you are exceeding your profile upload limit</h2>');exit;
        }
        $entity = new CandidateProfile();
        $entity->setJobRequirement($this->getDoctrine()
                ->getRepository('RMSArdraRMSBundle:JobRequirement')
                ->find($jobReqId));
        $form   = $this->createCreateForm($entity);
        
        
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CandidateProfile entity.
     *
     * @Route("/{id}", name="candidateprofile_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CandidateProfile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CandidateProfile entity.
     *
     * @Route("/{id}/edit", name="candidateprofile_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CandidateProfile entity.');
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
     * Displays a form to edit an existing CandidateProfile entity.
     *
     * @Route("/{id}/status", name="candidateprofile_edit_status")
     * @Method("GET")
     * @Template()
     */
    public function statusAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CandidateProfile entity.');
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
    * Creates a form to edit a CandidateProfile entity.
    *
    * @param CandidateProfile $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CandidateProfile $entity)
    {
        $form = $this->createForm(new CandidateProfileType(), $entity, array(
            'action' => $this->generateUrl('candidateprofile_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CandidateProfile entity.
     *
     * @Route("/{id}", name="candidateprofile_update")
     * @Method("PUT")
     * @Template("RMSArdraRMSBundle:CandidateProfile:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CandidateProfile entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('candidateprofile_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CandidateProfile entity.
     *
     * @Route("/{id}", name="candidateprofile_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RMSArdraRMSBundle:CandidateProfile')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CandidateProfile entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('candidateprofile'));
    }

    /**
     * Creates a form to delete a CandidateProfile entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('candidateprofile_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
