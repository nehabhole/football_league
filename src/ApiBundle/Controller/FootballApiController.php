<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class FootballApiController extends FOSRestController
{

    /**
     *
     *  @SWG\Response(
     *     response=200,
     *     description="Token created",
     * )
     *
     * @SWG\Parameter(
     *          name="userCredentials",
     *          in="body",
     *          description="User data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="_username", type="string"),
     *              @SWG\Property(property="_password", type="string")
     *          )
     * )
     *
     *
     */
    public function postLogin_checkAction(){

    }

    /**
     * List all football Leagues.
     *
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     *  @SWG\Response(
     *     response=200,
     *     description="All records fetched",
     * )
     *
     *  @SWG\Parameter(
     *     name="Authorization",
     *      in="header",
     *      required=true,
     *      type="string",
     *      default="Bearer TOKEN",
     *      description="Authorization"
     * )
     *
     */
    public function getLeagueAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:FootballLeague')->findAll();
    }


    /**
     *
     * Delete Football League
     *
     * @param $id
     * @return View
     *
     *  @SWG\Response(
     *     response=204,
     *     description="Record deleted",
     * )
     *
     *   @SWG\Response(
     *     response=404,
     *     description="No Record found",
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
    public function deleteLeagueAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $footballLeague = $em->getRepository('AppBundle:FootballLeague')->find($id);

        if ($footballLeague === null) {
            return new View(null, Response::HTTP_NOT_FOUND);
        }

        //delete all footteam in the league

        $teams = $footballLeague->getTeams();

        foreach($teams as $team){
            $em->remove($team);
        }

        $em->remove($footballLeague);
        $em->flush();

        return new View(null, Response::HTTP_NO_CONTENT);
    }




}
