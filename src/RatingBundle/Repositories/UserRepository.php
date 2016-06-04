<?php

namespace RatingBundle\Repositories;

/**
 * Class UserRepository.
 *
 * @author Antonio Antelo Vazquez (aantelov87[at]gmail.com)
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $userID
     *
     * @return array
     */
    public function calculateUserAverageRating($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COALESCE(AVG(r.rating), 0) as avg, COUNT(r.id) as total, COALESCE(MAX(r.rating), 0) as max, 
                 COALESCE(MIN(r.rating), 0) as min FROM RatingBundle:Review r WHERE r.user = :user_id'
            )
            ->setParameter('user_id', $userId)
            ->getArrayResult();
    }
}
