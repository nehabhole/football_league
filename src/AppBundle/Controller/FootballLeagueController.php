<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FootballLeague;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Footballleague controller.
 *
 * @Route("footballleague")
 */
class FootballLeagueController extends Controller
{
    /**
     * Lists all footballLeague entities.
     *
     * @Route("/", name="footballleague_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $footballLeagues = $em->getRepository('AppBundle:FootballLeague')->findAll();

        return $this->render('footballleague/index.html.twig', array(
            'footballLeagues' => $footballLeagues,
        ));
    }

    /**
     * Creates a new footballLeague entity.
     *
     * @Route("/new", name="footballleague_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $footballLeague = new Footballleague();
        $form = $this->createForm('AppBundle\Form\FootballLeagueType', $footballLeague);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($footballLeague);
            $em->flush();

            return $this->redirectToRoute('footballleague_show', array('id' => $footballLeague->getId()));
        }

        return $this->render('footballleague/new.html.twig', array(
            'footballLeague' => $footballLeague,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a footballLeague entity.
     *
     * @Route("/{id}", name="footballleague_show")
     * @Method("GET")
     */
    public function showAction(FootballLeague $footballLeague)
    {
        $deleteForm = $this->createDeleteForm($footballLeague);

        return $this->render('footballleague/show.html.twig', array(
            'footballLeague' => $footballLeague,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing footballLeague entity.
     *
     * @Route("/{id}/edit", name="footballleague_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FootballLeague $footballLeague)
    {
        $deleteForm = $this->createDeleteForm($footballLeague);
        $editForm = $this->createForm('AppBundle\Form\FootballLeagueType', $footballLeague);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('footballleague_edit', array('id' => $footballLeague->getId()));
        }

        return $this->render('footballleague/edit.html.twig', array(
            'footballLeague' => $footballLeague,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a footballLeague entity.
     *
     * @Route("/{id}", name="footballleague_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FootballLeague $footballLeague)
    {
        $form = $this->createDeleteForm($footballLeague);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($footballLeague);
            $em->flush();
        }

        return $this->redirectToRoute('footballleague_index');
    }

    /**
     * Creates a form to delete a footballLeague entity.
     *
     * @param FootballLeague $footballLeague The footballLeague entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FootballLeague $footballLeague)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('footballleague_delete', array('id' => $footballLeague->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
