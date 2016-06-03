<?php
/**
 * Created by PhpStorm.
 * User: aantelov
 * Date: 6/3/16
 * Time: 8:54 AM
 */

namespace RatingBundle\Controller;


use RatingBundle\Entity\Review;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use RatingBundle\Form\ReviewType;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;

class ReviewController extends Controller
{
    /**
     * @Rest\View()
     *
     * @Route("/reviews/", name="rating_review_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request){
        return $this->processForm(new Review(), $request);
    }

    /**
     * @Rest\View()
     * @Route("/reviews/{id}", name="rating_review_edit")
     * @Method({"PUT"})
     *
     * @ParamConverter("review", class="RatingBundle:Review")
     */
    public function editAction(Review $review, Request $request){
        return $this->processForm($review, $request);
    }

    /**
     * @Rest\View()
     * @Route("/reviews/{id}", requirements={"userId" = "[a-fA-F0-9\-]+"}, name="rating_review_get")
     * @Method({"GET"})
     *
     * @ParamConverter("review", class="RatingBundle:Review")
     */
    public function getAction(Review $review){
        return $review;
    }

    /**
     * @Rest\View()
     *
     * @Route("/reviews/", name="rating_review_all")
     * @Method({"GET"})
     */
    public function allAction()
    {
        $reviewRepo = $this->getDoctrine()->getRepository("RatingBundle:Review");

        return $reviewRepo->findAll();
    }

    private function processForm(Review $r, Request $request)
    {
        $statusCode = empty($r->getId()) ? 201 : 204;

        $form = $this->createForm(ReviewType::class, $r);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $r->save();

            $response = new Response();
            $response->setStatusCode($statusCode);

            if (201 === $statusCode) {
                $response->headers->set('Location',
                    $this->generateUrl(
                        'rating_review_get', array('id' => $r->getId()),
                        true
                    )
                );
            }

            return $response;
        }

        return View::create($form, 400);
    }
}