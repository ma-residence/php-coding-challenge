<?php

namespace App\Form;

use App\Entity\Knight;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KnightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('strength', NumberType::class, array('required'=> true))
            ->add('weaponPower', NumberType::class, array('required'=> true))
            ->add('name', TextType::class, array('required'=> true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Knight::class,
        ]);
    }
}
