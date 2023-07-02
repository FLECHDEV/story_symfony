<?php

namespace App\Form;

use App\Entity\Story;
use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', options:['label' => 'Prénom'])
            ->add('lastname', options:['label' => 'Nom'])
            ->add('nickname', options:['label' => 'Surnom'])
            ->add('age', options:['label' => 'Age'])
            ->add('job', options:['label' => 'Travail'])
            ->add('city', options:['label' => 'Ville'])
            ->add('ethnic', options:['label' => 'Ethnie'])
            ->add('link', options:['label' => 'Liens'])
            ->add('information', options:['label' => 'Information'])
            ->add('story', EntityType::class, [
                'class' => Story::class,
                'label' => 'Storiz'
            ])
            ->add('category', options:['label' => 'Catégorie']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
