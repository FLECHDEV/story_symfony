<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('character_firstname')
            ->add('character_lastname')
            ->add('character_nickname')
            ->add('character_age')
            ->add('character_job')
            ->add('character_city')
            ->add('character_ethnic')
            ->add('character_link')
            ->add('character_information')
            ->add('category_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
