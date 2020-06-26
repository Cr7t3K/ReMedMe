<?php

namespace App\Form;

use App\Entity\Medic;
use App\Entity\RelativeHasMedic;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelativeHasMedicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dose', null, [
                'label' => false,
            ])
            ->add('nb_times', null, [
                'label' => false,
            ])
            ->add('endAt', DateType::class, [
                'label' => false,
                'format' => 'MM-dd-yyyy',
            ])
            ->add('medicId', EntityType::class, [
                'placeholder' => 'Medic',
                'label' => false,
                'class' => Medic::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RelativeHasMedic::class,
        ]);
    }
}
