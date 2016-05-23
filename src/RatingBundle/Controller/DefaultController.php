<?php

namespace RatingBundle\Controller;

use RatingBundle\Repositories\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/widget/{userId}.js", requirements={"userId" = "[a-fA-F0-9\-]+"}, name="rating_widget")
     */
    public function widgetAction($userId)
    {
        $user = $userId;//$this->get("user_repository")->find($userId);
        if (!$user){
            throw new NotFoundHttpException("Resource not found");
        }

        return $this->render('RatingBundle:Default:rating.js.twig', [
            'user'=>$user
        ]);
    }

    /**
     * @Route("/user/{userId}/rating_average", requirements={"userId" = "[a-fA-F0-9\-]+"}, name="rating_average")
     */
    public function viewRatingAction($userId)
    {
        $user = $userId;//$this->get("user_repository")->find($userId);
        if (!$user){
            throw new NotFoundHttpException("Resource not found");
        }

        $avg = $this->get("user_repository")->calculateUserAverageRating($userId);
        
        
        return $this->render('RatingBundle:Default:rating.html.twig', [
            'rating'=>85
        ]);
    }
}
