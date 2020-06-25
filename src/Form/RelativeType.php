<?php

namespace App\Form;

use App\Entity\Relative;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelativeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
                'label' => false,
            ])
            ->add('lastName', null, [
                'label' => false,
            ])
            ->add('birthdate', DateType::class, [
                'label' => false,
                'format' => 'MM-dd-yyyy',
            ])
            ->add('gender', ChoiceType::class, [
                'label' => false,
                'placeholder' => 'Gender',
                'choices' => [
                    'Male' => 'male',
                    'Female' => 'female',
                ],
            ])
            ->add('relationship', ChoiceType::class, [
                'label' => false,
                'placeholder' => 'Relationship',
                'choices' => [
                    'Child' => 'child',
                    'Parent' => 'parent',
                    'Friend' => 'friend',
                    'GrandParent' => 'grandparent',
                    'Other' => 'other',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Relative::class,
        ]);
    }
}
