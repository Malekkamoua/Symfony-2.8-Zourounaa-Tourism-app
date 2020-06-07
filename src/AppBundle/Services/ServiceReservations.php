<?php
namespace AppBundle\Services;
use AppBundle\Entity\Reservation;
use AppBundle\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;

class ServiceReservations {
    private $em;
public function __construct(\Doctrine\ORM\EntityManager $em)  {
    $this->em = $em;
}
public function getReservations(array $criterias){
    $order="none";
    if(array_key_exists('order',$criterias)){
        $order=$criterias['order'];
    }
    $user="all";
    if(array_key_exists('user',$criterias)){
        $user=$criterias['user'];}
    $status="all";
    if(array_key_exists('status',$criterias)){
        $status=$criterias['status'];
    }
    if($status == 'Any status') {
        $status="all";
    }
        $reservations=$this->em->getRepository('AppBundle:Reservation')->getReservations($order,$user,$status);
        return $reservations;
   
} 
}