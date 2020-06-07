<?php

namespace AppBundle\Form;

use AppBundle\Form\AvailabilityType;
use AppBundle\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ActivityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    $information=array('Elevator'=>'Elevator','Terrace'=>'Terrace','No-smoking'=>'No-smoking',
        'Pets-allowed'=>'Pets-allowed','Meeting-room'=>'Meeting-room',
        'Laundry-service'=>'Laundry-service','Free-wifi'=>'Free-wifi',
        'Free-parking'=>'Free-parking','Babysitting'=>'Babysitting',
        'Beauty-salon'=>'Beauty-salon','Spa'=>'Spa','Sport'=>'Sport',
        'Airport-pickup-service'=>'Airport-pickup-service','Handicapped-friendly-room'=>'Handicapped-friendly-room','Bar'=>'Bar');
        $builder
        ->add('title',TextType::class,array(
                'label'=>'Title','attr'=>array('class'=>'form-control ','placeholder'=>"Add a title")))
        ->add('category',EntityType::class,array(
                'label'=>'Category',
                'class'=>'AppBundle:Category',
                'attr'=>array('class'=>"form-control")
        ))
        ->add('language',EntityType::class,array(
                'label'=>'Language',
                'class'=>'AppBundle:Language',
                'multiple'=> true,
                'attr'=>array('class'=>"selectpicker form-control",'data-live-search'=>"true")
                 ))
        ->add('description',TextareaType::class,array(
                'label'=>'Description',
                'attr'=>array('class'=>'editor')))
        ->add('phone',TextType::class,array(
               'label'=>'Phone(Optional)',
               'required'=>false,
               'attr'=>array('class'=>'form-control','placeholder'=>"Add a phone number")))
        ->add('website',TextType::class,array(
               'label'=>'Website(Optional)',
               'required'=>false,
               'attr'=>array('class'=>'form-control','placeholder'=>"Add a website link")))
        ->add('email',EmailType::class,array(
              'label'=>'Email',
              'attr'=>array('class'=>'form-control','placeholder'=>"Add an email")))
        ->add('facebookLink',TextType::class,array(
              'label'=>'Facebook link(Optional)',
              'required'=>false,
              'attr'=>array('class'=>'form-control','placeholder'=>"Add a facebook link")))
        ->add('Image', 'collection', array('type' => new
            ImageType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false))
        ->add('video',TextType::class,array(
              'label'=>'Add youtube video link (optional)',
              'required'=>false,
              'attr'=>array('class'=>'form-control','placeholder'=>"Add a video link")))
        ->add('address',TextType::class,array(
              'label'=>'Address',
              'required'=>true ,
              'attr'=>array('class'=>'form-control','placeholder'=>"Add an address")))
        ->add('activityDuration',TextType::class,array(
              'label'=>'Activity duration',
              'required'=>true,
              'attr'=>array('class'=>'form-control','placeholder'=>"The activity duration must be per hour")))
        ->add('max',IntegerType::class,array(
                'attr'=>array('class'=>'form-control',
                'required'=>false,
                'placeholder'=>"Add the maximum of people for this activity")
            ))
        ->add('price',IntegerType::class,array(
                'attr'=>array('class'=>'form-control ','placeholder'=>'Add a price (TND)')
            ))
        ->add('latitude',HiddenType::class,array(
            'attr'=>array('class'=>"gllpLatitude",'empty_data'=>'36.82')))
        ->add('longitude',HiddenType::class,array(
            'attr'=>array('class'=>"gllpLongitude",'empty_data'=>'10.17')))
        ->add('zoom',HiddenType::class,array(
            'attr'=>array('class'=>"gllpZoom",'empty_data'=>'10')))
        ->add('usefulinformation',ChoiceType::class, array(
            'label'=>'Useful information',
            'multiple'=>true,
            'expanded'=>true,
            'choices'=>$information,
            'choices_as_values'=>true))
        ->add('city',EntityType::class,array(
            'label'=>'City',
            'required'=>true,
            'attr'=>array('class'=>"styled-select"),
            'class'=>'AppBundle:City'))
        ->add('availability', new AvailabilityType(),array(
            'label'=>'Availability : ',
            'required'=>true,
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Activity'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_activity';
    }


}
