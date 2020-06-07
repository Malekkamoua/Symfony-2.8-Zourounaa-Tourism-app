<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AvailabilityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $times= array('01 AM'=>'01 AM ','02 AM'=>'02 AM','03 AM'=>'03 AM','04 AM'=>'04 AM','05 AM'=>'05 AM','06 AM'=>'06 AM',
            '07 AM'=>'07 AM','08 AM'=>'08 AM','09 AM'=>'09 AM','10 AM'=>'10 AM','11 AM'=>'11 AM','12 AM'=>'12 AM',
            '01 PM'=>'01 PM ','02 PM'=>'02 PM','03 PM'=>'03 PM','04 PM'=>'04 PM','05 PM'=>'05 PM','06 PM'=>'06 PM',
            '07 PM'=>'07 PM','08 PM'=>'08 PM','09 PM'=>'09 PM','10 PM'=>'10 PM','11 PM'=>'11 PM','12 PM'=>'12 PM');

        $builder
            ->add('closedMonday',ChoiceType::class, array(
                'mapped'=>false,
                'multiple'=>true,
                'expanded'=>true,
                'choices'=>array('Closed'=>'Closed'),
                'attr'=>array( 'class'=>"closed")
    ))
            ->add('closedTuesday',ChoiceType::class,array(
                'mapped'=>false,
                'multiple'=>true,
                'expanded'=>true,
                'choices'=>array('Closed'=>'Closed'),
                'attr'=>array( 'class'=>"closed")
            ))
            ->add('closedWednesday',ChoiceType::class,array(
                'mapped'=>false,
                'expanded'=>true,
                'multiple'=>true,
                'choices'=>array('Closed'=>'Closed'),
                'attr'=>array( 'class'=>"closed")
            ))
            ->add('closedThursday',ChoiceType::class,array(
                'mapped'=>false,
                'expanded'=>true,
                'multiple'=>true,
                'choices'=>array('Closed'=>'Closed'),
                'attr'=>array( 'class'=>"closed")
            ))
            ->add('closedFriday',ChoiceType::class,array(
                'mapped'=>false,
                'expanded'=>true,
                'multiple'=>true,
                'choices'=>array('Closed'=>'Closed'),
                'attr'=>array( 'class'=>"closed")
            ))
            ->add('closedSaturday',ChoiceType::class,array(
                'mapped'=>false,
                'expanded'=>true,
                'multiple'=>true,
                'choices'=>array('Closed'=>'Closed'),
                'attr'=>array( 'class'=>"closed")
            ))
            ->add('closedSunday',ChoiceType::class,array(
                'mapped'=>false,
                'expanded'=>true,
                'multiple'=>true,
                'choices'=>array('Closed'=>'Closed'),
                'attr'=>array( 'class'=>"closed")
            ))
            ->add('mondayOpening',ChoiceType::class,array(
                'choices' => $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)
               ))
            ->add('mondayClosing',ChoiceType::class,array(
                'choices' =>  $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)
                ))
            ->add('tuesdayOpening',ChoiceType::class,array(
                'choices' => $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('tuesdayClosing',ChoiceType::class,array(
                'choices' => $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('wednesdayOpening',ChoiceType::class,array(
                'choices' =>  $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('wednesdayClosing',ChoiceType::class,array(
                'choices' =>  $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('thursdayOpening',ChoiceType::class,array(
                'choices' => $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('thursdayClosing',ChoiceType::class,array(
                'choices' =>  $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('fridayOpening',ChoiceType::class,array(
                'choices' => $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('fridayClosing',ChoiceType::class,array(
                'choices' =>  $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('saturdayOpening',ChoiceType::class,array(
                'choices' =>  $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('saturdayClosing',ChoiceType::class,array(
                'choices' => $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('sundayOpening',ChoiceType::class,array(
                'choices' =>  $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)))
            ->add('sundayClosing',ChoiceType::class,array(
                'choices' => $times,
                'choices_as_values' => true,
                'attr'=>array('disabled'=>false)));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Availability'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_availability';
    }


}
