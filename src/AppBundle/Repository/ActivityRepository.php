<?php

namespace AppBundle\Repository;



/**
 * ActivityRepository
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActivityRepository extends \Doctrine\ORM\EntityRepository
{

    public function getActivities($order, $keyword,$category,$city,$priceUpper,$priceLower) {

        $qb = $this->createQueryBuilder("a");

        $qb->select("a");

        if($order != "none") {
            $qb->orderBy("a." . $order, "DESC");
        }

        if($keyword != "all") {
            $qb->andWhere("a.description LIKE :keyword OR a.title LIKE :keyword")->setParameter("keyword", "%".$keyword."%");
        }
        if($category != "all") {
            $qb->leftJoin("a.category","category");
            $qb->andWhere("category.slug = :category")->setParameter("category", $category);
        }
        if($priceUpper != "all" ) {            
            $qb->andWhere("a.price <= :priceUpper")
            ->setParameter("priceUpper", $priceUpper);
        }

        if ( $priceLower!="all"){
            $qb->andWhere("a.price >= :priceLower")
            ->setParameter("priceLower", $priceLower);
        }
     
        if($city!= "all") {
            $qb->leftJoin("a.city","city");
            $qb->andWhere("city.slug = :city")->setParameter("city", $city);
        }
        return $qb->getQuery()->getResult();

    }

}
