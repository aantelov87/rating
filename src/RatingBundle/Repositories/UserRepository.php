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
    public function calculateUserAverageRating($userID)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT AVG(r.rating) as avg_rate FROM RatingBundle:Review r WHERE r.user = :user_id'
            )
            ->setParameter('user_id', $userID)
            ->getSingleScalarResult();
    }
}
