<?php

namespace RatingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/widget/{user_id}.js", requirements={"id" = "[a-zA-Z0-9]+"}
     */
    public function indexAction()
    {
        return $this->render('RatingBundle:Default:index.html.twig');
    }

    /**
     * @Route("/user/{user_id}/view_rating", requirements={"id" = "[a-zA-Z0-9\-]+"}
     */
    public function viewRatingAction(Request $request, $user_id)
    {
        $avg = $this->get('user_repository')->calculateAverageRating($user_id);
        
        
        return $this->render('RatingBundle:Default:rating.html.twig', [
            'rating'=>$avg
        ]);
    }
}
