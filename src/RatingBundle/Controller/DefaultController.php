<?php
namespace RatingBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class DefaultController
 * @package RatingBundle\Controller
 *
 * @author Antonio Antelo Vazquez (aantelov87[at]gmail.com)
 */
class DefaultController extends Controller
{
    /**
     * @Route("/widget/{userId}.js", requirements={"userId" = "[a-fA-F0-9\-]+"}, name="rating_widget")
     */
    public function widgetAction($userId)
    {
        $userRepository = $this->getDoctrine()->getRepository("RatingBundle:User");
        $user = $userRepository->find($userId);
        if (!$user){
            throw new NotFoundHttpException("Resource not found");
        }

        $response = new Response(
            $this->renderView('RatingBundle:Default:rating.js.twig', [
                'user'=>$user
            ])
        );
        $response->headers->set('Content-Type', 'application/javascript; charset=UTF-8');
        return $response;
    }

    /**
     * @Route("/user/{userId}/rating_average", requirements={"userId" = "[a-fA-F0-9\-]+"}, name="rating_average")
     */
    public function viewRatingAction($userId)
    {
        $userRepository = $this->getDoctrine()->getRepository("RatingBundle:User");
        $user = $userRepository->find($userId);
        if (!$user){
            throw new NotFoundHttpException("Resource not found");
        }

        $avg = $userRepository->calculateUserAverageRating($user->getId());
        
        
        return $this->render('RatingBundle:Default:rating.html.twig', [
            'rating'=>$avg
        ]);
    }
}
