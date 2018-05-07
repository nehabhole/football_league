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
 * @RouteResource("api")
 */
class FootballApiController extends FOSRestController implements ClassResourceInterface
{

    /**
     * Lists all football Leagues.
     *
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     */
    public function getLeagueAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballLeague')->findAll();
    }


    public function deleteLeagueAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $footballLeague = $em->getRepository('AppBundle:FootballLeague')->find($id);

        if ($footballLeague === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        //delete all footteam in the league

        $em->remove($footballLeague);
        $em->flush();

        return new View(null, Response::HTTP_NO_CONTENT);
    }




}
