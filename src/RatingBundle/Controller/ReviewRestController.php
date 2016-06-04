<?php
/**
 * Created by PhpStorm.
 * User: aantelov
 * Date: 6/3/16
 * Time: 8:54 AM
 */

namespace RatingBundle\Controller;


use RatingBundle\Entity\Review;
use RatingBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use RatingBundle\Form\ReviewType;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReviewRestController extends Controller
{
    /**
     * Delete a review for an user.
     *
     * @Secure(roles="ROLE_API")
     * @ApiDoc(
     *   resource = true,
     *   description = "Delete a review for an user",
     *   statusCodes = {
     *     204 = "Returned when successful"
     *   }
     * )
     *
     * @Post("/user/{userId}/reviews/{reviewId}")
     *
     * @return View
     */
    public function deleteAction(Request $request){
        return new Response();
    }

    /**
     * @Rest\View()
     *
     * Create a new user review
     *
     * @Post("/user/{userId}/reviews/")
     *
     * @ParamConverter("user", class="RatingBundle:User", options={"id" = "user_id"})
     *
     */
    public function newUserReviewAction(User $user){
        //Logic to check if it is a valid user
        $review = new Review();
        $review->setUser($user);

        return $this->processForm($review);
    }

    /**
     * @Rest\View()
     *
     * Edit a user review
     *
     * @Put("/user/{id}/reviews/{review_id}")
     *
     * @ParamConverter("review", class="RatingBundle:Review", options={"mapping": {"id" = "id", "user_id" = "user.id"}})
     *
     */
    public function editAction(Review $review){
        return $this->processForm($review);
    }

    /**
     * @Rest\View()
     *
     * Get a user review
     *
     * @Put("/user/{id}/reviews/{review_id}")
     * @ParamConverter("review", class="RatingBundle:Review", options={"mapping": {"id" = "id", "user_id" = "user.id"}})
     *
     */
    public function getUserReviewAction(Review $review){
        return $review;
    }

    /**
     * @Rest\View()
     *
     * List all user reviews
     *
     * @Get("/user/{user_id}/reviews/")
     *
     * @ParamConverter("user", class="RatingBundle:User", options={"id" = "user_id"})
     *
     */
    public function allUserReviewAction(User $user){
        return $this->get('reviews_repository')->findBy([
            'user_id' => $user->getId()
        ]);
    }

    /**
     * @Rest\View()
     *
     * Get the average of rating review from a user
     *
     * @Get("/user/{user_id}/reviews_info")
     *
     * @ParamConverter("user", class="RatingBundle:User", options={"id" = "user_id"})
     */
    public function ratingAvgAction(User $user){
        $result = $this->get('user_repository')->calculateUserAverageRating();
        return [
            'user' => $user->getUsername(),
            'reviews' => [
                'total' => $result['total'],
                'rating_data' => [
                    'avg' => $result['avg'],
                    'min' => $result['min'],
                    'max' => $result['max']
                ]  
            ]
        ];
    }


}