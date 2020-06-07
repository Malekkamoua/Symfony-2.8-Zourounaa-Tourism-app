<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',null,array(
            'label' => false,
            'required'=>false))
        ->add('last_name',null,array(
            'label' => false,
            'required'=>false))
        ->add('telephone',null,array(
            'label' => false,
            'required'=>false))
        ->add('subject',null,array(
            'label' => false))
        ->add('addressMail',EmailType::class,array(
            'label' => false))
        ->add('object',TextareaType::class,array(
            'label' => false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mail'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_mail';
    }


}
