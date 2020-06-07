<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Availability
 *
 * @ORM\Table(name="zourouna_availability")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvailabilityRepository")
 */
class Availability
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
     * @ORM\Column(name="closed_monday", type="string", length=255, nullable=true)
     */
    private $closedMonday;
    /**
     * @var string
     *
     * @ORM\Column(name="closed_tuesday", type="string", length=255, nullable=true)
     */
    private $closedTuesday;
    /**
     * @var string
     *
     * @ORM\Column(name="closed_wednesday", type="string", length=255, nullable=true)
     */
    private $closedWednesday;
    /**
     * @var string
     *
     * @ORM\Column(name="closed_thursday", type="string", length=255, nullable=true)
     */
    private $closedThursday;
    /**
     * @var string
     *
     * @ORM\Column(name="closed_friday", type="string", length=255, nullable=true)
     */
    private $closedFriday;
    /**
     * @var string
     *
     * @ORM\Column(name="closed_saturday", type="string", length=255, nullable=true)
     */
    private $closedSaturday;
    /**
     * @var string
     *
     * @ORM\Column(name="closed_sunday", type="string", length=255, nullable=true)
     */
    private $closedSunday;
    /**
     * @var string
     *
     * @ORM\Column(name="monday_opening", type="string", length=255, nullable=true)
     */
    private $mondayOpening;

    /**
     * @var string
     *
     * @ORM\Column(name="monday_closing", type="string", length=255, nullable=true)
     */
    private $mondayClosing;

    /**
     * @var string
     *
     * @ORM\Column(name="tuesday_opening", type="string", length=255, nullable=true)
     */
    private $tuesdayOpening;

    /**
     * @var string
     *
     * @ORM\Column(name="tuesday_closing", type="string", length=255, nullable=true)
     */
    private $tuesdayClosing;

    /**
     * @var string
     *
     * @ORM\Column(name="wednesday_opening", type="string", length=255, nullable=true)
     */
    private $wednesdayOpening;

    /**
     * @var string
     *
     * @ORM\Column(name="wednesday_closing", type="string", length=255, nullable=true)
     */
    private $wednesdayClosing;

    /**
     * @var string
     *
     * @ORM\Column(name="thursday_opening", type="string", length=255, nullable=true)
     */
    private $thursdayOpening;

    /**
     * @var string
     *
     * @ORM\Column(name="thursday_closing", type="string", length=255, nullable=true)
     */
    private $thursdayClosing;

    /**
     * @var string
     *
     * @ORM\Column(name="friday_opening", type="string", length=255, nullable=true)
     */
    private $fridayOpening;

    /**
     * @var string
     *
     * @ORM\Column(name="friday_closing", type="string", length=255, nullable=true)
     */
    private $fridayClosing;

    /**
     * @var string
     *
     * @ORM\Column(name="saturday_opening", type="string", length=255, nullable=true)
     */
    private $saturdayOpening;

    /**
     * @var string
     *
     * @ORM\Column(name="saturday_closing", type="string", length=255, nullable=true)
     */
    private $saturdayClosing;

    /**
     * @var string
     *
     * @ORM\Column(name="sunday_opening", type="string", length=255, nullable=true)
     */
    private $sundayOpening;

    /**
     * @var string
     *
     * @ORM\Column(name="sunday_closing", type="string", length=255, nullable=true)
     */
    private $sundayClosing;



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
     * Constructor
     */
    public function __construct()
    {
        $this->activities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set closedMonday
     *
     * @param string $closedMonday
     *
     * @return Availability
     */
    public function setClosedMonday($closedMonday)
    {
        $this->closedMonday = $closedMonday;

        return $this;
    }

    /**
     * Get closedMonday
     *
     * @return string
     */
    public function getClosedMonday()
    {
        return $this->closedMonday;
    }

    /**
     * Set closedTuesday
     *
     * @param string $closedTuesday
     *
     * @return Availability
     */
    public function setClosedTuesday($closedTuesday)
    {
        $this->closedTuesday = $closedTuesday;

        return $this;
    }

    /**
     * Get closedTuesday
     *
     * @return string
     */
    public function getClosedTuesday()
    {
        return $this->closedTuesday;
    }

    /**
     * Set closedWednesday
     *
     * @param string $closedWednesday
     *
     * @return Availability
     */
    public function setClosedWednesday($closedWednesday)
    {
        $this->closedWednesday = $closedWednesday;

        return $this;
    }

    /**
     * Get closedWednesday
     *
     * @return string
     */
    public function getClosedWednesday()
    {
        return $this->closedWednesday;
    }

    /**
     * Set closedThursday
     *
     * @param string $closedThursday
     *
     * @return Availability
     */
    public function setClosedThursday($closedThursday)
    {
        $this->closedThursday = $closedThursday;

        return $this;
    }

    /**
     * Get closedThursday
     *
     * @return string
     */
    public function getClosedThursday()
    {
        return $this->closedThursday;
    }

    /**
     * Set closedFriday
     *
     * @param string $closedFriday
     *
     * @return Availability
     */
    public function setClosedFriday($closedFriday)
    {
        $this->closedFriday = $closedFriday;

        return $this;
    }

    /**
     * Get closedFriday
     *
     * @return string
     */
    public function getClosedFriday()
    {
        return $this->closedFriday;
    }

    /**
     * Set closedSaturday
     *
     * @param string $closedSaturday
     *
     * @return Availability
     */
    public function setClosedSaturday($closedSaturday)
    {
        $this->closedSaturday = $closedSaturday;

        return $this;
    }

    /**
     * Get closedSaturday
     *
     * @return string
     */
    public function getClosedSaturday()
    {
        return $this->closedSaturday;
    }

    /**
     * Set closedSunday
     *
     * @param string $closedSunday
     *
     * @return Availability
     */
    public function setClosedSunday($closedSunday)
    {
        $this->closedSunday = $closedSunday;

        return $this;
    }

    /**
     * Get closedSunday
     *
     * @return string
     */
    public function getClosedSunday()
    {
        return $this->closedSunday;
    }

    /**
     * Set mondayOpening
     *
     * @param string $mondayOpening
     *
     * @return Availability
     */
    public function setMondayOpening($mondayOpening)
    {
        $this->mondayOpening = $mondayOpening;

        return $this;
    }

    /**
     * Get mondayOpening
     *
     * @return string
     */
    public function getMondayOpening()
    {
        return $this->mondayOpening;
    }

    /**
     * Set mondayClosing
     *
     * @param string $mondayClosing
     *
     * @return Availability
     */
    public function setMondayClosing($mondayClosing)
    {
        $this->mondayClosing = $mondayClosing;

        return $this;
    }

    /**
     * Get mondayClosing
     *
     * @return string
     */
    public function getMondayClosing()
    {
        return $this->mondayClosing;
    }

    /**
     * Set tuesdayOpening
     *
     * @param string $tuesdayOpening
     *
     * @return Availability
     */
    public function setTuesdayOpening($tuesdayOpening)
    {
        $this->tuesdayOpening = $tuesdayOpening;

        return $this;
    }

    /**
     * Get tuesdayOpening
     *
     * @return string
     */
    public function getTuesdayOpening()
    {
        return $this->tuesdayOpening;
    }

    /**
     * Set tuesdayClosing
     *
     * @param string $tuesdayClosing
     *
     * @return Availability
     */
    public function setTuesdayClosing($tuesdayClosing)
    {
        $this->tuesdayClosing = $tuesdayClosing;

        return $this;
    }

    /**
     * Get tuesdayClosing
     *
     * @return string
     */
    public function getTuesdayClosing()
    {
        return $this->tuesdayClosing;
    }

    /**
     * Set wednesdayOpening
     *
     * @param string $wednesdayOpening
     *
     * @return Availability
     */
    public function setWednesdayOpening($wednesdayOpening)
    {
        $this->wednesdayOpening = $wednesdayOpening;

        return $this;
    }

    /**
     * Get wednesdayOpening
     *
     * @return string
     */
    public function getWednesdayOpening()
    {
        return $this->wednesdayOpening;
    }

    /**
     * Set wednesdayClosing
     *
     * @param string $wednesdayClosing
     *
     * @return Availability
     */
    public function setWednesdayClosing($wednesdayClosing)
    {
        $this->wednesdayClosing = $wednesdayClosing;

        return $this;
    }

    /**
     * Get wednesdayClosing
     *
     * @return string
     */
    public function getWednesdayClosing()
    {
        return $this->wednesdayClosing;
    }

    /**
     * Set thursdayOpening
     *
     * @param string $thursdayOpening
     *
     * @return Availability
     */
    public function setThursdayOpening($thursdayOpening)
    {
        $this->thursdayOpening = $thursdayOpening;

        return $this;
    }

    /**
     * Get thursdayOpening
     *
     * @return string
     */
    public function getThursdayOpening()
    {
        return $this->thursdayOpening;
    }

    /**
     * Set thursdayClosing
     *
     * @param string $thursdayClosing
     *
     * @return Availability
     */
    public function setThursdayClosing($thursdayClosing)
    {
        $this->thursdayClosing = $thursdayClosing;

        return $this;
    }

    /**
     * Get thursdayClosing
     *
     * @return string
     */
    public function getThursdayClosing()
    {
        return $this->thursdayClosing;
    }

    /**
     * Set fridayOpening
     *
     * @param string $fridayOpening
     *
     * @return Availability
     */
    public function setFridayOpening($fridayOpening)
    {
        $this->fridayOpening = $fridayOpening;

        return $this;
    }

    /**
     * Get fridayOpening
     *
     * @return string
     */
    public function getFridayOpening()
    {
        return $this->fridayOpening;
    }

    /**
     * Set fridayClosing
     *
     * @param string $fridayClosing
     *
     * @return Availability
     */
    public function setFridayClosing($fridayClosing)
    {
        $this->fridayClosing = $fridayClosing;

        return $this;
    }

    /**
     * Get fridayClosing
     *
     * @return string
     */
    public function getFridayClosing()
    {
        return $this->fridayClosing;
    }

    /**
     * Set saturdayOpening
     *
     * @param string $saturdayOpening
     *
     * @return Availability
     */
    public function setSaturdayOpening($saturdayOpening)
    {
        $this->saturdayOpening = $saturdayOpening;

        return $this;
    }

    /**
     * Get saturdayOpening
     *
     * @return string
     */
    public function getSaturdayOpening()
    {
        return $this->saturdayOpening;
    }

    /**
     * Set saturdayClosing
     *
     * @param string $saturdayClosing
     *
     * @return Availability
     */
    public function setSaturdayClosing($saturdayClosing)
    {
        $this->saturdayClosing = $saturdayClosing;

        return $this;
    }

    /**
     * Get saturdayClosing
     *
     * @return string
     */
    public function getSaturdayClosing()
    {
        return $this->saturdayClosing;
    }

    /**
     * Set sundayOpening
     *
     * @param string $sundayOpening
     *
     * @return Availability
     */
    public function setSundayOpening($sundayOpening)
    {
        $this->sundayOpening = $sundayOpening;

        return $this;
    }

    /**
     * Get sundayOpening
     *
     * @return string
     */
    public function getSundayOpening()
    {
        return $this->sundayOpening;
    }

    /**
     * Set sundayClosing
     *
     * @param string $sundayClosing
     *
     * @return Availability
     */
    public function setSundayClosing($sundayClosing)
    {
        $this->sundayClosing = $sundayClosing;

        return $this;
    }

    /**
     * Get sundayClosing
     *
     * @return string
     */
    public function getSundayClosing()
    {
        return $this->sundayClosing;
    }

    /**
     * Add activity
     *
     * @param \AppBundle\Entity\Activity $activity
     *
     * @return Availability
     */
    public function addActivity(\AppBundle\Entity\Activity $activity)
    {
        $this->activities[] = $activity;

        return $this;
    }

    /**
     * Remove activity
     *
     * @param \AppBundle\Entity\Activity $activity
     */
    public function removeActivity(\AppBundle\Entity\Activity $activity)
    {
        $this->activities->removeElement($activity);
    }

    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivities()
    {
        return $this->activities;
    }

    public function __toString() {
        return $this->getName();
    }
}
