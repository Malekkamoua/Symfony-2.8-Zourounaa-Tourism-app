<?php
namespace AppBundle\Services;
use AppBundle\Entity\Activity;
use AppBundle\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;

class ServiceActivities {
    private $em;
public function __construct(\Doctrine\ORM\EntityManager $em)  {
    $this->em = $em;
}
public function getActivities(array $criterias){
    $order="none";
 
    if(array_key_exists('order',$criterias)){
        $order=$criterias['order'];
    }

    $keyword="all";
    if(array_key_exists('keyword',$criterias)){
        $keyword=$criterias['keyword'];
    }

    $category="all";
    if(array_key_exists('category',$criterias)){
        $category=$criterias['category'];
    }
    if($category == 'All categories') {
        $category="all";
    }
    $city="all";
    if(array_key_exists('city',$criterias)){
        $city=$criterias['city'];
    }
    if($city == 'All cities') {
        $city="all";
    }
    $priceLower="all";
    if(array_key_exists('priceLower',$criterias)){
        $priceLower=$criterias['priceLower'];
    }
    if($priceLower == '0.00') {
        $priceLower="all";
    }
   
    $priceUpper="all";
    if(array_key_exists('priceUpper',$criterias)){
        $priceUpper=$criterias['priceUpper'];
    }

    if($priceUpper == '1000.00') {
        $priceUpper="all";
    }
   

        $activities=$this->em->getRepository('AppBundle:Activity')->getActivities($order,$keyword,$category,$city,$priceUpper,$priceLower);
    return $activities;

}
}