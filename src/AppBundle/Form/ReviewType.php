<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ratings = array('What do you think of this activity?' => 'What do you think of this activity?', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5');
        $builder
            ->add('content', TextType::class, array(
                'label' => 'Content', 'attr' => array('class' => 'form-control ', 'placeholder' => "Add a review")))
            ->add('rating', ChoiceType::class, array(
                'required' => true,
                'choices' => $ratings,
                'choices_as_values' => true,
                'attr' => array('class' => 'form-control')));;

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_review';
    }


}
