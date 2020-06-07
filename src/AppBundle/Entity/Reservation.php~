<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="zourouna_reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */ 
class Reservation
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
    * @ORM\ManyToOne(targetEntity="User", inversedBy="reservations")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
   private $user;
  
   /**
    * @ORM\ManyToOne(targetEntity="Activity", inversedBy="reservations")
     * @ORM\JoinColumn(name="activity_id", referencedColumnName="id")
    */
    private $activity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="string", unique=false)
     */
    private $date;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="string", unique=false)
     */
    private $time;
   

    /**
     * @var int
     *
     * @ORM\Column(name="nb_participants", type="integer",unique=false)
     */
    private $nbParticipants;

   
    /**
     * @var float
     *
     * @ORM\Column(name="totalPrice", type="float", nullable=true)
     */
    private $totalPrice = 25;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(name="status", type="string", )
     */
    private $status = "unchecked";


  

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

   
 
    /**
     * Set nbParticipants
     *
     * @param integer $nbParticipants
     *
     * @return Reservation
     */
    public function setNbParticipants($nbParticipants)
    {
        $this->nbParticipants = $nbParticipants;

        return $this;
    }

    /**
     * Get nbParticipants
     *
     * @return integer
     */
    public function getNbParticipants()
    {
        return $this->nbParticipants;
    }

  

    /**
     * Set totalPrice
     *
     * @param float $totalPrice
     *
     * @return Reservation
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Reservation
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
     * Set status
     *
     * @param string $status
     *
     * @return Reservation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Set date
     *
     * @param string $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Reservation
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    public function __toString() {
        return $this->getName();
    }

   

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Reservation
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


   

    /**
     * Set activity
     *
     * @param \AppBundle\Entity\Activity $activity
     *
     * @return Reservation
     */
    public function setActivity(\AppBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \AppBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }
}
