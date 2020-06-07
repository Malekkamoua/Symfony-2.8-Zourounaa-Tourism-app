<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Activity
 *
 * @ORM\Table(name="zourouna_activity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
     /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true,nullable=false)
     */
    private $slug;
    

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
     /**
     * @var array
     *
     * @ORM\Column(name="usefulInformation", type="array",nullable=true)
     */
    private $usefulInformation;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="facebookLink", type="string", length=255, nullable=true)
     */
    private $facebookLink;

    /**
     * @var string
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="activityDuration", type="string", length=255, nullable=true)
     */
    private $activityDuration;
    /**
     * @var int
     *
     * @ORM\Column(name="max", type="integer",nullable=true)
     */
    private $max;
    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer",nullable=true)
     */
    private $price;
    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;
    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;
    /**
     * @var integer
     *
     * @ORM\Column(name="zoom", type="integer")
     */
    private $zoom;
    /**
     * @var int
     *
     * @ORM\Column(name="visitsnumber", type="integer", nullable=true)
     */
    private $visitsnumber ;

    /**
     * @var datetime
     *
     * @ORM\Column(name="createdat", type="datetime", nullable=true)
     */
    private $createdAt;
    /**
     * @var int
     *
     * @ORM\Column(name="totalRating", type="integer", nullable=true)
     */
    private $totalRating ;

    /**
     * @var int
     *
     * @ORM\Column(name="Score", type="integer", nullable=true)
     */
    private $Score ;

    /**
     *
     * @ORM\Column(name="note", type="float", nullable=true)
     */
    private $note=0;

     /**
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="activity" ,cascade={"persist", "remove"}))
     */
    private $reservations;
 
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Language", inversedBy="activities", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="zourouna_language_activity",
     *   joinColumns={@ORM\JoinColumn(name="Zourouna_activity_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="Language_id", referencedColumnName="id")}
     * )
     */
    private $languages;

    /**
    * @ORM\ManyToOne(targetEntity="Category", inversedBy="activities")
    * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
    */
   private $category;

    /**
    * @ORM\ManyToOne(targetEntity="City", inversedBy="activities")
    * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
    */
   private $city;
    /**
     * @ORM\OneToOne(targetEntity="Availability",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="availability_id", referencedColumnName="id")
     */
    private $availability;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="activity",orphanRemoval=true)
     */
    private $reviews;
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="Activity",cascade={"persist","merge","remove"})
     */
    private $Image;
     /**
     * @ORM\OneToMany(targetEntity="Bookmark",mappedBy="Activity" ,cascade={"persist", "remove"}))
     */
    private $bookmarks;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Activity
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Activity
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set usefulInformation
     *
     * @param array $usefulInformation
     *
     * @return Activity
     */
    public function setUsefulInformation($usefulInformation)
    {
        $this->usefulInformation = $usefulInformation;

        return $this;
    }

    /**
     * Get usefulInformation
     *
     * @return array
     */
    public function getUsefulInformation()
    {
        return $this->usefulInformation;
    }
    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Activity
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
     * Set website
     *
     * @param string $website
     *
     * @return Activity
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Activity
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set facebookLink
     *
     * @param string $facebookLink
     *
     * @return Activity
     */
    public function setFacebookLink($facebookLink)
    {
        $this->facebookLink = $facebookLink;

        return $this;
    }

    /**
     * Get facebookLink
     *
     * @return string
     */
    public function getFacebookLink()
    {
        return $this->facebookLink;
    }



    /**
     * Set video
     *
     * @param string $video
     *
     * @return Activity
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Activity
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set activityDuration
     *
     * @param string $activityDuration
     *
     * @return Activity
     */
    public function setActivityDuration($activityDuration)
    {
        $this->activityDuration = $activityDuration;

        return $this;
    }

    /**
     * Get activityDuration
     *
     * @return string
     */
    public function getActivityDuration()
    {
        return $this->activityDuration;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     *
     * @return Activity
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return integer
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
    /**
     * Set longitude
     *
     * @param integer $longitude
     *
     * @return Activity
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
     /**
     * Set zoom
     *
     * @param integer $zoom
     *
     * @return Activity
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Get zoom
     *
     * @return integer
     */
    public function getZoom()
    {
        return $this->zoom;
    }
    public function getCategory() 
    {
        return $this->category;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }
    public function getAvailability()
    {
        return $this->availability;
    }

    public function setAvailability(Availability $availability)
    {
        $this->availability = $availability;

        return $this;
    }
    public function getLanguage()
    {
        return $this->languages;
    }

    public function setLanguage(Language $language)
    {
        $this->languages = $language;

        return $this;
    }
    public function getCity()
    {
        return $this->city;
    }

    public function setCity(City $city)
    {
        $this->city = $city;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add language
     *
     * @param \AppBundle\Entity\Language $language
     *
     * @return Activity
     */
    public function addLanguage(Language $language)
    {
        $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \AppBundle\Entity\Language $language
     */
    public function removeLanguage(Language $language)
    {
        $this->languages->removeElement($language);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set visitsnumber
     *
     * @param integer $visitsnumber
     *
     * @return Activity
     */
    public function setVisitsnumber($visitsnumber)
    {
        $this->visitsnumber = $visitsnumber;

        return $this;
    }

    /**
     * Get visitsnumber
     *
     * @return integer
     */
    public function getVisitsnumber()
    {
        return $this->visitsnumber;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Activity
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Activity
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set max
     *
     * @param integer $max
     *
     * @return Activity
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return integer
     */
    public function getMax()
    {
        return $this->max;
    }



    /**
     * Add review
     *
     * @param \AppBundle\Entity\Review $review
     *
     * @return Activity
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

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Activity
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->Image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->Image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Activity
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    

    /**
     * Add reservation
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return Activity
     */
    public function addReservation(\AppBundle\Entity\Reservation $reservation)
    {
        $this->Reservation[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \AppBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\AppBundle\Entity\Reservation $reservation)
    {
        $this->Reservation->removeElement($reservation);
    }

    
    /**
     * Add bookmark
     *
     * @param \AppBundle\Entity\Bookmark $bookmark
     *
     * @return Activity
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
    public function isBookmarkedByUser(User $user){
        foreach ($this->bookmarks as $bookmarks) {
            if ($bookmarks->getUser() === $user) {
                return true;
            }
        }
        return false;
    }

    public function __toString() {
        return $this->getTitle();
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

    /**
     * Set totalRating
     *
     * @param integer $totalRating
     *
     * @return Activity
     */
    public function setTotalRating($totalRating)
    {
        $this->totalRating = $totalRating;

        return $this;
    }

    /**
     * Get totalRating
     *
     * @return integer
     */
    public function getTotalRating()
    {
        return $this->totalRating;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Activity
     */
    public function setScore($score)
    {
        $this->Score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->Score;
    }

    /**
     * Set note
     *
     * @param float $note
     *
     * @return Activity
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }
}
