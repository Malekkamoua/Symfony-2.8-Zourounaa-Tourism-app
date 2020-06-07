<?php

namespace AdminBundle\Controller;


use AppBundle\Entity\Activity;
use AppBundle\Entity\Image;
use AppBundle\Form\ActivityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    
    public function dashboardAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
        'SELECT SUM(r.totalPrice) As total
           FROM AppBundle:Reservation r
           WHERE  r.createdAt <= :datenowmonthago ');
$query->setParameter('datenowmonthago', new \DateTime('-1 month'));
$revenu=$query->getResult();
        $query = $em->createQuery(
        'SELECT COUNT(r) AS nb,Date(r.createdAt) AS datecreation
         FROM AppBundle:Reservation r
         GROUP BY datecreation ');
          $res=$query->getResult();
        $users=$this->getDoctrine()->getRepository('AppBundle:User')
            ->findAll();
        $reviews=$this->getDoctrine()->getRepository('AppBundle:Review')
            ->findAll();  
        $reservations=$this->getDoctrine()->getRepository('AppBundle:Reservation')
            ->findAll();
        $activities=$this->getDoctrine()->getRepository('AppBundle:Activity')
            ->findAll();              
        return $this->render('AdminBundle:Default:dashboard.html.twig',array(
            'users'=>$users,
            'reviews'=>$reviews,
            'reservations'=>$reservations,
            'activities'=>$activities,
            'res'=>$res,
            'revenu'=>$revenu,
            
        ));
    }


    public function formAction($id=null,Request $request,$slug=null)
    {
        $em=$this->getDoctrine()->getManager();
        
        $DeleteImages=$this->getDoctrine()->getRepository('AppBundle:Image')->findAll();
        foreach ($DeleteImages as $deleteIt) {
            if ($deleteIt->getPath()==null || $deleteIt->getActivity()==null  ) {
                $em->remove($deleteIt);
                $em->flush();
            }
        }

        if ($slug==null){
            $activity=new Activity();
            }
        else {
            $activity=$em->getRepository('AppBundle:Activity')->findOneBySlug($slug);
        }

        $form= $this->createForm(ActivityType::class,$activity);
        $form->handleRequest($request);
 
        if ($form->isSubmitted()&& $form->isValid()){
            if($id==null){
                $activity->setCreatedAt(new \DateTime());
            }

            $files = $form->get('Image')->getData();
            
            foreach ($files as $file) {
                $filename =md5(uniqid()) . '.' . $file->getFilename()->guessExtension();

                $image=new Image();
                $image->setFilename($filename);
                $image->setPath(
                    '/uploads/' . $filename
                );
                $file->getFilename()->move(
                    $this->getParameter('uploads_directory'),
                    $filename
                );
 
                $image->setActivity($activity);
                $activity->addImage($image);
                $em->persist($image);

            }
            
            $video = $form->get('video')->getData();

            if ($activity->getVideo() == null || strpos($video, 'embed/') == false ) {
                $pos=strpos($video,"v=")+2;
                $video= "https://www.youtube.com/embed/".substr($video,$pos,strlen($video));

                $activity->setVideo($video);

            }elseif (strpos($video, 'embed/') == true) {
                $valid= strpos($video, "embed/")+6;
                $video="https://www.youtube.com/embed/".substr($video,$valid,strlen($video));
                $activity->setVideo($video);
            }
            
            $em->persist($activity);
            $em->flush();
            $this->addFlash(
                'success',
                'Activity Saved');
            return $this->redirectToRoute('activities');

        }
       return $this->render('AdminBundle:Default:add_activity.html.twig',array(
           'form'=> $form->createView(),
           'activity'=>$activity,
           'editMode'=>$activity->getSlug()!==null,

       ));
    }
      public function deleteImageAction($id){
        
        $em= $this->getDoctrine()->getManager();
       
        $image=$em->getRepository('AppBundle:Image')->findOneById($id);
       
        $em->remove($image);
        $em->flush();

        return new JsonResponse(array('message' => 'Image deleted from controller'), 200);
    }

    public function activitiesAction(Request $request){ 
        $q = $request->query->get('q','all');

        $images=$this->getDoctrine()->getRepository('AppBundle:Image')
            ->findAll();
        $activities=$this->get('service')
            ->getActivities(array('order'=>'createdAt','keyword' => $q));

        $paginator=$this->get('knp_paginator');
        $result=$paginator->paginate(
            $activities,
            $request->query->get('page',1),3);

        return $this->render('AdminBundle:Default:activities.html.twig',array(
            'activities'=>$result,
            'images'=>$images,
            'q'=>$q));
    }
    public function deleteActivityAction($slug){
        $em= $this->getDoctrine()->getManager();

        $activity=$em->getRepository('AppBundle:Activity')->findOneBySlug($slug);
        $reservations=$em->getRepository('AppBundle:Reservation')->findBy([
            'activity' => $activity
        ]);

        if ($reservations== null ) {
            $em->remove($activity);
            $em->flush();
        $this->addFlash(
        'error',
        'Activity Removed');
        }else{
            $this->addFlash(
                'error',
                'Activity is already reserved by users');
        }
            
       return $this->redirectToRoute('activities');
    } 

    public function detailsAction($slug){  

        $activity=$this->getDoctrine()->getRepository('AppBundle:Activity')
             ->findOneBySlug($slug);

        return $this->render('AdminBundle:Default:details.html.twig',array(
            'activity'=>$activity,
       ));
    }

    public function reviewsAction(Request $request){

        $reviews=$this->getDoctrine()->getRepository('AppBundle:Review')
            ->findByDates();

        $paginator=$this->get('knp_paginator');
        $result=$paginator->paginate(
            $reviews,
            $request->query->get('page',1),3);

        return $this->render('AdminBundle:Default:reviews.html.twig',array(
            'reviews'=>$result ));
    }

    public function deleteReviewAction($id){
        $em= $this->getDoctrine()->getManager();

        $review=$em->getRepository('AppBundle:Review')->find($id);

        $em->remove($review);
        $em->flush();
        $this->addFlash(
            'error',
            'Review Removed');

        return $this->redirectToRoute('reviews');
    }

    public function bookmarksAction(Request $request){
        $bookmarks=$this->getDoctrine()->getRepository('AppBundle:Bookmark')
        ->findByDates();

        $paginator=$this->get('knp_paginator');
        $result=$paginator->paginate(
            $bookmarks,
            $request->query->get('page',1),3);

        return $this->render('AdminBundle:Default:bookmarks.html.twig',array(
            'bookmarks'=>$result,
        ));
    }
    public function deleteBookmarkAction($id){

        $em= $this->getDoctrine()->getManager();

        $bookmark=$em->getRepository('AppBundle:Bookmark')->find($id);

        $em->remove($bookmark);
        $em->flush();
        $this->addFlash(
            'error',
            'Bookmark Removed');

        return $this->redirectToRoute('admin_bookmarks');
    }
 
    public function bookingsAction(Request $request){
        $q = $request->query->get('q','all');
        $res=$this->getDoctrine()->getRepository('AppBundle:Reservation')
        ->findAll();  
        foreach($res as $res) {
            if($res->getStatus()=='unchecked'){
                $tab[]=array($res);
            }
        }
        $bookings=$this->get('serviceReservation')
        ->getReservations(array('order'=>'createdAt','status'=>$q));
        $paginator=$this->get('knp_paginator');
        $result=$paginator->paginate(
            $bookings,
            $request->query->get('page',1),3);
    return $this->render('AdminBundle:Default:bookings.html.twig',array(
        'bookings'=>$result,
        'tab'=>$tab,
        'q'=>$q));
    }

    public function ApprouveBookingAction($id){

        $em= $this->getDoctrine()->getManager();

        $booking=$em->getRepository('AppBundle:reservation')->findOneById($id);
       
        $userEmail = $booking->getUser()->getEmail();
        $activity=$booking->getActivity()->getTitle();
        $booking->setStatus("checked");
        $em->persist($booking);
        $em->flush();
        $this->addFlash(
            'success',
            'Booking approuved');
        $object= "Your reservation for ".$activity." has been approuved. Please check your bookings and proceed to pay."."\n\n\n"."Zourouna Tunisia";
        $message= \Swift_Message::newInstance()
                ->setSubject("Reservation approuved")
                ->setFrom("zourounatunisia@gmail.com")
                ->setTo($userEmail)
                ->setBody($object);
                $this->get('mailer')->send($message);

        return $this->redirectToRoute('admin_bookings');
    }
    public function deleteBookingAction($id){

        $em= $this->getDoctrine()->getManager();

        $booking=$em->getRepository('AppBundle:reservation')->findOneById($id);
        $userEmail = $booking->getUser()->getEmail();
        $activity=$booking->getActivity()->getTitle();

        $em->remove($booking);
        $em->flush();
        $this->addFlash(
            'error',
            'Booking Removed');

        $object= "With the greatest regrets, we announce that your reservation for ".$activity." has been denied. Please contact us for more informations."."\n\n\n"."Zourouna Tunisia";
        $message= \Swift_Message::newInstance()
                    ->setSubject("Reservation denied")
                    ->setFrom("zourounatunisia@gmail.com")
                    ->setTo($userEmail)
                    ->setBody($object);
                    $this->get('mailer')->send($message);

        return $this->redirectToRoute('admin_bookings');
    }



    public function usersAction(){

        $users=$this->getDoctrine()->getRepository('AppBundle:User')
            ->findAll();

        return $this->render('AdminBundle:Default:users.html.twig',array(
            'users'=>$users ));
    }

    public function blockUserAction($id){

        $em= $this->getDoctrine()->getManager();

        $user=$em->getRepository('AppBundle:User')->find($id);
        $user->setEnabled(false);
            $em->flush();
            $this->addFlash(
                'error',
                'User Blocked');

        return $this->redirectToRoute('users');
    }
    public function CallbackUserAction($id){

        $em= $this->getDoctrine()->getManager();
        
        $user=$em->getRepository('AppBundle:User')->find($id);

        $user->setEnabled(true );
            $em->flush();
            $this->addFlash(
                'success',
                'User called back');
        return $this->redirectToRoute('users');
    }

    public function testAction (Request $request){

        $q = $request->query->get('q', 'all');

        $popularActivities=$this->get('service')
            ->getActivities(array('order'=>'visitsnumber', 'keyword' => $q));

        return $this->render('AdminBundle:Default:test.html.twig',array(
            'activities'=>$popularActivities ));
    }


    public function blankAction(){
        
        return $this->render('AdminBundle:Default:page_vide.html.twig');
    }
}