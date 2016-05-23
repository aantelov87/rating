<?php

namespace RatingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reviews
 *
 * @ORM\Table(name="reviews", indexes={@ORM\Index(name="fk_reviews_user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Reviews
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=36)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="None")
     */
    private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rated_at", type="datetime", nullable=false)
     */
    private $ratedAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \RatingBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="RatingBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}

