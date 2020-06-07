<?php

namespace NavigationBundle\Controller;

use AppBundle\Entity\Review;
use AppBundle\Entity\Bookmark;
use AppBundle\Form\ReviewType;
use AppBundle\Entity\Reservation;
use AppBundle\Form\ReservationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Mail;
use AppBundle\Form\MailType;

class DefaultController extends Controller
{
    
    public function showCatAction(Request $request) {

        $q = $request->query->get('q','all');
        $c = $request->query->get('c','all');
        $t = $request->query->get('t','all');
        $categories=$this->getDoctrine()->getRepository('AppBundle:Category')
        ->findAll();
        $cities=$this->getDoctrine()->getRepository('AppBundle:City')->findAll();
        $activities=$this->get('service')
        ->getActivities(array('order'=>'visitsnumber','keyword' => $q,'categories'=>$c,'cities'=>$t));  
            return $this->render('NavigationBundle:Default:index.html.twig',array(
                'categories'=>$categories,
                'activities' =>$activities,
                'cities'=>$cities,
                'q'=>$q,
                'c'=>$c,
                't'=>$t));  
        }
    
    
    public function EmptyPageAction() {

        $categories=$this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
            
        return $this->rende('NavigationBundle:Default:PageVide.html.twig',array(
                'categories'=>$categories));

    }
    
    
    public function AboutPageAction() {

        return $this->render('NavigationBundle:Default:about.html.twig');
    }
    
    
    public function HelpPageAction() {

        return $this->render('NavigationBundle:Default:help.html.twig');
    }
    
   
    public function ContactFormAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $mail=new Mail();
        $formMail=$this->createForm(MailType::class,$mail);
        $formMail->handleRequest($request);

        if ($formMail->isSubmitted()&& $formMail->isValid()){
            
            $mail->setCreatedAt(new \DateTime());
            $Sender_name=$formMail->get('name')->getData();
            $Sender_last_name=$formMail->get('last_name')->getData();
            $Sender_telephone=$formMail->get('telephone')->getData();

            $Sender_email=$mail->getAddressMail();
            $receiver='zourounatunisia@gmail.com';
            $subject=$mail->getSubject();
           
            $object=$formMail->get('object')->getData();
            $object="Sent from: ".$Sender_name." ".$Sender_last_name."\n Email address : ".$Sender_email."\n Phone number : ".$Sender_telephone." \n\n\n".$object;
            

            $message= \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($Sender_email)
                ->setTo($receiver)
                ->setBody($object);

            $this->get('mailer')->send($message);
            $em->persist($mail);
            $em->flush(); 
            
            $this->addFlash(
                'success',
                'Email sent');
        }
        return $this->render('NavigationBundle:Default:contact.html.twig',array(
            'formMail'=>$formMail->createView()));
    }

  
    public function categoriesAllAction() {

        $activities=$this->getDoctrine()->getRepository('AppBundle:Activity')
        ->findAll();
        $categories=$this->getDoctrine()->getRepository('AppBundle:Category')
        ->findAll();
        
        return $this->render('NavigationBundle:Default:categories.html.twig',array(
            'categories'=>$categories,
            'activities'=>$activities));
    }
  
    // User dashboard

    public function HeaderAction() {    

        $activities=$this->getDoctrine()->getRepository('AppBundle:Activity')
        ->findAll();
        $categories=$this->getDoctrine()->getRepository('AppBundle:Category')
        ->findAll();
    
        return $this->render('NavigationBundle:Default:header.html.twig',array(
            'activities'=>$activities,
            'categories'=>$categories));
    }
    
    public function SuggestionsAction (Request $request){

            $category=$this->getDoctrine()->getRepository('AppBundle:Category')
            ->findAll();
            $review=$this->getDoctrine()->getRepository('AppBundle:Review')
            ->findAll();
            $city=$this->getDoctrine()->getRepository('AppBundle:City')
            ->findAll();
                
                $q = $request->query->get('q','all');
                $c = $request->query->get('c','all');
                $t = $request->query->get('t','all');
                $pU = $request->query->get('pU','all');
                $pL = $request->query->get('pL','all');
                
            $paginator=$this->get('knp_paginator');    
            $popularActivities=$this->get('service')->getActivities(array(
                'order'=>'visitsnumber',
                'keyword' => $q,
                'category'=>$c,
                'priceUpper'=>$pU,
                'priceLower'=>$pL,
                'city'=>$t));

            $result=$paginator->paginate(
                $popularActivities,
                $request->query->get('page',1),4);
                
     return $this->render('NavigationBundle:Default:Suggestions.html.twig',array(
            'activities'=>$result,
            'category'=>$category,
            'review'=>$review,
            'city'=>$city,
            'q'=>$q,
            'c'=>$c,
            't'=>$t,
            'pU'=>$pL,
            'pL'=>$pL
        
         ));
    }
 
/******** Reservation Methods ***********/

    public function PlanAction() {

        return $this->render('NavigationBundle:Default:myPlan.html.twig');

    }
 
    public function detailsAction(Request $request,$slug=null) {

        $em=$this->getDoctrine()->getManager();
        $activity=$this->getDoctrine()->getRepository('AppBundle:Activity')
        ->findOneBySlug($slug);

        $visitors = $activity->getVisitsnumber()+1;

        $activity->setVisitsnumber($visitors);
        $em->persist($activity);
        $em->flush();

        $review=new Review();
        $user = $this->getUser();

        $reviewform= $this->createForm(ReviewType::class,$review);
        $reviewform->handleRequest($request);

        if ($reviewform->isSubmitted()&& $reviewform->isValid()){

                $review->setCreatedAt(new \DateTime())
                    ->setActivity($activity)
                    ->setUser($user);

                $Rating = $reviewform->get('rating')->getData();
                $Score= $activity->getScore();
                $Score+=$Rating;
                $activity->setScore($Score);
                $VotingNumber=$activity->getTotalRating();
                $VotingNumber+=1;
                $activity->setTotalRating($VotingNumber);

                $note=$Score/$VotingNumber;
                $note=round($note,1);
                $activity->setNote($note);

            $em->persist($review);
            $em->flush();

        }

        $mail=new Mail();
        $formMail=$this->createForm(MailType::class,$mail);
        $formMail->handleRequest($request);

        if ($formMail->isSubmitted()&& $formMail->isValid()){
            
            $mail->setCreatedAt(new \DateTime());

            
            $sender="zourounatunisia@gmail.com";
            $receiver=$activity->getEmail();
            $UserEmail=$formMail->get('addressMail')->getData();
            $object=$formMail->get('object')->getData();
            $object="Sent from: ".$UserEmail."\n".$object."\n\n\n"."Zourouna Tunisia";
            $subject=$mail->getSubject();
            
            $message= \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($sender)
                ->setTo($receiver)
                ->setBody($object);

            $this->get('mailer')->send($message);
            $em->persist($mail);
            $em->flush();
            
            $this->addFlash(
                'success',
                'Email sent');
        }

        $reservation=new Reservation();
        $reservation->setCreatedAt(new \DateTime());
       
        $form= $this->createForm(ReservationType::class,$reservation);
        $form->handleRequest($request);

       
        if ($form->isSubmitted()&& $form->isValid()){

            $activityID = $form->get('activity')->getData();
            $participants = $form->get('nbParticipants')->getData();

            $dateReservation = $form->get('date')->getData();
            $date = trim($dateReservation);
            $time = substr($date,11,5);
   
            $reservations=$em->getRepository('AppBundle:Reservation')->findBy([
                'user' => $user,
                'date'=>$dateReservation
            ]);

            $date = substr($date,0,10);
            $date=explode('/',$date);
            $date=implode('-',$date);

            if (strtotime($dateReservation) < time()) {
                return new JsonResponse(array('message' => 'The date you have chosen has already passed. Please pick another day. '), 200);
            }
            elseif($reservations == null) {
        
                $reservation->setUser($user);
                $reservation->setActivity($activity);
                $total = $activity->getPrice()*$participants;
                $reservation->setTotalPrice($total);

                $reservation->setDate($dateReservation);
                $reservation->setTime($time);

                $em->persist($reservation);
                $em->flush();

            return new JsonResponse(array('message' => 'Congratulations, your reservation is successfully achieved. '), 200);
        }
            else{
                return new JsonResponse(array('message' => 'You already have reserved another activity for this given time. Please choose another time '), 200);
        }
    }
        return $this->render('NavigationBundle:Default:activityDetail.html.twig',array(
            'activity'=>$activity,
            'form'=>$form->createView(),
            'formMail'=>$formMail->createView(),
            'reviewform'=>$reviewform->createView()));
    
}

    public function BookingsAction(Request $request) {
        $em=$this->getDoctrine()->getManager();
        $q = $request->query->get('q','all');
        $user = $this->getUser();
        $tab[]=array();
        $res=$this->getDoctrine()->getRepository('AppBundle:Reservation')
      ->findBy([
                'user' => $user
            ]);
        foreach($res as $res) {
            if($res->getStatus()=='unchecked' ){
                $tab[]=array($res);
            }
        }
            $reservation=$this->get('serviceReservation')
        ->getReservations(array('order'=>'createdAt','user'=>$user,'status'=>$q));
        $paginator=$this->get('knp_paginator');
        $result=$paginator->paginate(
            $reservation,
            $request->query->get('page',1),3);

        return $this->render('NavigationBundle:Default:booking.html.twig',array(
            'reservation' => $result,
            'tab'=>$tab,
        'q'=>$q));
    }

    public function CheckoutAction($id) {

        $em= $this->getDoctrine()->getManager();
        $reservation=$em->getRepository('AppBundle:reservation')->findOneById($id);

        return $this->render('NavigationBundle:Default:checkout.html.twig',array(
            'reservation'=> $reservation));
    }

    public function PayBookingAction($id){

        $em= $this->getDoctrine()->getManager();
        $reservation=$em->getRepository('AppBundle:reservation')->findOneById($id);

        $reservation->setStatus("payed");

        $em->persist($reservation);
        $em->flush();
   
        return $this->redirectToRoute('navigation_plan');
    }

// sends information to ajax in calendar


    public function LoadBookingsAction() {

        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $reservation=$em->getRepository('AppBundle:Reservation')->findBy([
                'user' => $user,
                'status'=>"payed"
        ]);
        $events=null;
        foreach ($reservation as $reservation) {
                $events[] = array(
                    'id' => $reservation->getId(),
                    "title" => $reservation->getActivity()->getTitle(),
                    "slug" => $reservation->getActivity()->getSlug(),
                    'start' => $reservation->getDate(),
                    'end'=>$reservation->getDate()
                );
        }

        $response = new Response(json_encode($events));

        return $response;
    } 

    public function deleteBookingAction($id) {

        $em= $this->getDoctrine()->getManager();
        $reservation=$em->getRepository('AppBundle:Reservation')->findOneById($id);
            $em->remove($reservation);
            $em->flush();
            $this->addFlash(
                'error',
                'Booking deleted');
        
            return $this->redirectToRoute('navigation_bookings');
    }

    /***Bookmarks methods */

    public function BookmarkAction($slug) {

        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();

        $activity=$this->getDoctrine()->getRepository('AppBundle:Activity')
        ->findOneBySlug($slug);

        if ($activity->isBookmarkedByUser($user) == false) {
            $bookmark= new Bookmark();
            $bookmark->setCreatedAt(new \DateTime());
        
            $bookmark->setUser($user);
            $bookmark->setActivity($activity);
            $em->persist($bookmark);
            $em->flush();

            return new JsonResponse(array('message' => 'bookmarked'), 200);
    }
    return new JsonResponse(array('message' => 'bookmarked'), 200);
}

    public function DeleteBookmarkAction($id){

        $em= $this->getDoctrine()->getManager();
        $bookmark=$em->getRepository('AppBundle:Bookmark')->findOneById($id);
            $em->remove($bookmark);
            $em->flush();
            $this->addFlash(
                'error',
                'Bookmark deleted');
        
            return $this->redirectToRoute('navigation_bookmarks');
    }


    public function ShowBookmarksAction() {


    return $this->render('NavigationBundle:Default:bookmarks.html.twig');
    }

    public function ShowReviewsAction(Request $request)
    {
        
        return $this->render('NavigationBundle:Default:reviews.html.twig');
    }
    public function deleteReviewAction($id){
        $em= $this->getDoctrine()->getManager();
        $review=$em->getRepository('AppBundle:Review')->find($id);
            $em->remove($review);
            $em->flush();
            $this->addFlash(
                'error',
                'Review Removed');
        return $this->redirectToRoute('navigation_reviews');
    }
    public function FooterAction(Request $request) { 
        $em = $this->getDoctrine()->getManager();
        $categories=$this->getDoctrine()->getRepository('AppBundle:Category')
        ->findAll();
        return $this->render('NavigationBundle:Default:footer.html.twig',array(
        'categories'=>$categories));
    }
}
