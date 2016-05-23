<?php

namespace RatingBundle\Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Created by PhpStorm.
 * User: aantelov
 * Date: 5/23/16
 * Time: 9:32 PM
 */
class UserRepository extends EntityRepository
{
    /**
     * @param $userID
     * @return array
     */
    public function calculateUserAverageRating($userID){

        return $this->getEntityManager()
            ->createQuery(
                'SELECT round(AVG(r.rating),0) as avg_rate FROM RatingBundle:Review r WHERE r.user > :user_id'
            )
            ->setParameter('user_id', $userID)
            ->getSingleScalarResult();
    }
}