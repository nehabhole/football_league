<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FootballTeam;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Footballteam controller.
 *
 * @Route("footballteam")
 */
class FootballTeamController extends Controller
{
    /**
     * Lists all footballTeam entities.
     *
     * @Route("/", name="footballteam_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $footballTeams = $em->getRepository('AppBundle:FootballTeam')->findAll();

        return $this->render('footballteam/index.html.twig', array(
            'footballTeams' => $footballTeams,
        ));
    }

    /**
     * Creates a new footballTeam entity.
     *
     * @Route("/new", name="footballteam_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $footballTeam = new Footballteam();
        $form = $this->createForm('AppBundle\Form\FootballTeamType', $footballTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($footballTeam);
            $em->flush();

            return $this->redirectToRoute('footballteam_show', array('id' => $footballTeam->getId()));
        }

        return $this->render('footballteam/new.html.twig', array(
            'footballTeam' => $footballTeam,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a footballTeam entity.
     *
     * @Route("/{id}", name="footballteam_show")
     * @Method("GET")
     */
    public function showAction(FootballTeam $footballTeam)
    {
        $deleteForm = $this->createDeleteForm($footballTeam);

        return $this->render('footballteam/show.html.twig', array(
            'footballTeam' => $footballTeam,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing footballTeam entity.
     *
     * @Route("/{id}/edit", name="footballteam_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FootballTeam $footballTeam)
    {
        $deleteForm = $this->createDeleteForm($footballTeam);
        $editForm = $this->createForm('AppBundle\Form\FootballTeamType', $footballTeam);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('footballteam_edit', array('id' => $footballTeam->getId()));
        }

        return $this->render('footballteam/edit.html.twig', array(
            'footballTeam' => $footballTeam,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a footballTeam entity.
     *
     * @Route("/{id}", name="footballteam_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FootballTeam $footballTeam)
    {
        $form = $this->createDeleteForm($footballTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($footballTeam);
            $em->flush();
        }

        return $this->redirectToRoute('footballteam_index');
    }

    /**
     * Creates a form to delete a footballTeam entity.
     *
     * @param FootballTeam $footballTeam The footballTeam entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FootballTeam $footballTeam)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('footballteam_delete', array('id' => $footballTeam->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
