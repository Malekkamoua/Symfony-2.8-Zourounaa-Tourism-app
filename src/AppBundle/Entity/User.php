<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use FOS\MessageBundle\Model\ParticipantInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="zourouna_fos_user")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(name="name", type="string", length=255, nullable=true)
    */
    protected $name;

    /**
    * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
    */
    protected $last_name;

    /**
    * @ORM\Column(name="phone", type="string", length=255, nullable=true)
    */
    protected $phone;

    /**
     * @ORM\OneToMany(targetEntity="Bookmark", mappedBy="user" ,cascade={"persist", "remove"}))
       * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $bookmarks;

     /**
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="user" ,cascade={"persist", "remove"}))
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="user",orphanRemoval=true)
      * @ORM\OrderBy({"createdat" = "DESC"})
     */
    private $reviews;

        /**
    * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
    */
    protected $facebook_id;

    /** 
    * @ORM\Column(name="googleplus_id", type="string", length=255, nullable=true)
    */
    protected $googleplus_id;
 
    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_CLIENT');
    }

    public function setFacebookId($facebookID) {
        $this->facebook_id = $facebookID;
    
        return $this;
    }
    
    public function getFacebookId() {
        return $this->facebook_id;
    }

    public function setGoogleplusId($googlePlusId) {
        $this->googleplus_id = $googlePlusId;
    
        return $this;
    }
    
    public function getGoogleplusId() {
        return $this->googleplus_id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add review
     *
     * @param \AppBundle\Entity\Review $review
     *
     * @return User
     */
    public function addReview(\AppBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \AppBundle\Entity\Review $review
     */
    public function removeReview(\AppBundle\Entity\Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    public function __toString() {
        return $this->getUsername();
    }

    /**
     * Add bookmark
     *
     * @param \AppBundle\Entity\Bookmark $bookmark
     *
     * @return User
     */
    public function addBookmark(\AppBundle\Entity\Bookmark $bookmark)
    {
        $this->bookmarks[] = $bookmark;

        return $this;
    }

    /**
     * Remove bookmark
     *
     * @param \AppBundle\Entity\Bookmark $bookmark
     */
    public function removeBookmark(\AppBundle\Entity\Bookmark $bookmark)
    {
        $this->bookmarks->removeElement($bookmark);
    }

    /**
     * Get bookmarks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookmarks()
    {
        return $this->bookmarks;
    }

    /**
     * Add reservation
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return User
     */
    public function addReservation(\AppBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \AppBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\AppBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
