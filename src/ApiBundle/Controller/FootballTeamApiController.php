<?php

namespace ApiBundle\Controller;

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

class FootballTeamApiController  extends FOSRestController
{
    /**
     * List all Football teams in a League
     *
     *  @SWG\Response(
     *     response=200,
     *     description="Football Leagues",
     * )
     *
     * @SWG\Parameter(
     *     name="Authorization",
     *      in="header",
     *      required=true,
     *      type="string",
     *      default="Bearer TOKEN",
     *      description="Authorization"
     * )
     * @param $id
     * @return array
     *
     */
    public function getTeamAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballTeam')->findBy(['strip' => $id]);
    }

    /**
     *
     * Create new Football Team
     *
     * @param Request $request
     * @return View|\Symfony\Component\Form\Form
     *
     * @SWG\Response(
     *     response=201,
     *     description="New Football Team added",
     *     @Model(type=FootballTeam::class)
     * )
     *
     * @SWG\Parameter(
     *          name="userCredentials",
     *          in="body",
     *          description="User data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="strip", type="integer")
     *          )
     * )
     *
     *
     * @SWG\Parameter(
     *     name="Authorization",
     *      in="header",
     *      required=true,
     *      type="string",
     *      default="Bearer TOKEN",
     *      description="Authorization"
     * )
     *
     */
    public function postTeamAction(Request $request)
    {

        $footballTeam = new Footballteam();
        $form = $this->createForm('AppBundle\Form\FootballTeamType', $footballTeam,[
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $footballTeam  = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($footballTeam);
        $em->flush();

        return new View($footballTeam, Response::HTTP_CREATED);

    }

    /**
     * Modify Football Team
     *
     * @param Request $request
     * @param int     $id
     * @return View|\Symfony\Component\Form\Form
     *
     * @SWG\Response(
     *     response=200,
     *     description="Create a new football team",
     *     @Model(type=FootballTeam::class)
     * )
     *
     * @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Team name",
     *     required=true,
     *     type="string",
     *     @SWG\Schema(type="string")
     * )
     *
     *  @SWG\Parameter(
     *     name="Authorization",
     *     in="header",
     *     required=true,
     *     type="string",
     *     default="Bearer TOKEN",
     *     description="Authorization"
     * )
     *
     */
    public function patchTeamAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $footballTeam = $em->getRepository('AppBundle:FootballTeam')->find($id);

        if ($footballTeam === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm('AppBundle\Form\FootballTeamType', $footballTeam,[
            'csrf_protection' => false,
        ]);

        $form->submit($request->request->all(), false);

        if (!$form->isValid()) {
            return $form;
        }
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new View($footballTeam, Response::HTTP_RESET_CONTENT);

    }


}
