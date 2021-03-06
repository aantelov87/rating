<?php

namespace RatingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Review.
 *
 * @ORM\Table(name="reviews", indexes={@ORM\Index(name="fk_reviews_user_id", columns={"user_id"})})
 * @ORM\Entity
 *
 *
 * @ExclusionPolicy("all")
 */
class Review
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=36)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @Expose
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     *
     * @Assert\NotBlank()
     *
     * @Expose
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="string", nullable=false, length=100)
     *
     * @Assert\Length(
     *      min = 10
     * )
     * @Expose
     */
    private $comments;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rated_at", type="datetime", nullable=false)
     *
     * @Expose
     */
    private $ratedAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \RatingBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="RatingBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     *
     * @Assert\NotBlank()
     */
    private $user;

    /**
     * Set rating.
     *
     * @param int $rating
     *
     * @return Review
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating.
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set ratedAt.
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
     * Get ratedAt.
     *
     * @return \DateTime
     */
    public function getRatedAt()
    {
        return $this->ratedAt;
    }

    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user.
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
     * Get user.
     *
     * @return \RatingBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @VirtualProperty
     *
     */
    public function getUsername()
    {
        return $this->user->getUsername();
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments(){
        return $this->comments;
    }


    /**
     * @param string $c
     *
     * @return Review
     */
    public function setComments($c){
        $this->comments = $c;
        return $this;
    }
}
