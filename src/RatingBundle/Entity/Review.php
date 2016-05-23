<?php

namespace RatingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reviews
 *
 * @ORM\Table(name="reviews", indexes={@ORM\Index(name="fk_reviews_user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Review
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
     * @ORM\ManyToOne(targetEntity="RatingBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Review
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set ratedAt
     *
     * @param \DateTime $ratedAt
     *
     * @return Review
     */
    public function setRatedAt($ratedAt)
    {
        $this->ratedAt = $ratedAt;

        return $this;
    }

    /**
     * Get ratedAt
     *
     * @return \DateTime
     */
    public function getRatedAt()
    {
        return $this->ratedAt;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \RatingBundle\Entity\Users $user
     *
     * @return Review
     */
    public function setUser(\RatingBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \RatingBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }
}
