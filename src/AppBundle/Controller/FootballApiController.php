<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 *
 * @RouteResource("v1/api")
 */
class FootballApiController extends FOSRestController implements ClassResourceInterface
{

    /**
     * Lists all footballTeam entities.
     *
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     */
    public function cgetAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballLeague')->findAll();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     */
    public function getAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballTeam')->findBy(['strip' => $id]);
    }

    public function postAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballTeam')->findBy(['strip' => $id]);
    }

    public function putAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballTeam')->findBy(['strip' => $id]);
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballTeam')->findBy(['strip' => $id]);
    }




}
