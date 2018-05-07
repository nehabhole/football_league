<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FootballTeam;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
 *
 * @RouteResource("api")
 */
class FootballTeamApiController  extends FOSRestController
{
    /**
     * List teams in a League
     *
     * @param $id
     * @return array
     */
    public function getTeamAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballTeam')->findBy(['strip' => $id]);
    }

    /**
     *
     * Create a new Team
     *
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @SWG\Response(
     *     response=200,
     *     description="Create a new football team",
     *     @Model(type=FootballTeam::class)
     * )
     *
     * @SWG\Parameter(
     *     name="team",
     *     in="body",
     *     @Model(type=FootballTeam::class)
     * )
     *
     */
    public function postTeamAction(Request $request)
    {

        $footballTeam = new Footballteam();
        $form = $this->createForm('AppBundle\Form\FootballTeamType', $footballTeam,[
            'csrf_protection' => false,
        ]);
//        $form->handleRequest($request);


//        $form = $this->createForm(FootballTeam::class, null, [
//            'csrf_protection' => false,
//        ]);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $footballTeam  = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($footballTeam);
        $em->flush();

        $routeOptions = [
            'id' => $footballTeam->getId(),
            '_format' => $request->get('_format'),
        ];

        return $this->routeRedirectView('get_api_team', $routeOptions, Response::HTTP_CREATED);
    }

    /**
     *
     * @param Request $request
     * @return array
     */
    public function putTeamAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballTeam')->findBy(['strip' => $id]);
    }

}
