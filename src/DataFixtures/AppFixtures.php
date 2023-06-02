<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Character;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Story;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    public function __construct(
        // private PasswordHasherFactoryInterface $passwordHasherFactoryInterface
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        // Creating User
        $user = new User();
        $user->setFirstname('Franck');
        $user->setLastname('Lechangeur');
        $user->setEmail('franck@test.fr');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'franck'
        );
        $user->setPassword($hashedPassword);

        // $user->setRoles(['ROLE_USER']);

        // $product = new Product();
        $manager->persist($user);

        $characters = [];
        for ($i = 0; $i < 6; $i++) {
            $character = new Character();
            $character->setCharacterLastname($faker->lastName());
            $character->setCharacterFirstname($faker->firstName());
            $character->setCharacterNickname($faker->name());
            $character->setCharacterCity($faker->city());
            $character->setCharacterInformation($faker->text());
            $character->setCharacterLink($faker->text(100));
            $character->setCharacterJob($faker->jobTitle());
            $character->setCharacterAge($faker->numberBetween(2, 90));
            $character->setCharacterEthnic(array_rand(['Caucasien', 'Asiatique', 'africain']));
            $manager->persist($character);
        }


        // Creating stories
        $stories = [];
        for ($i = 0; $i < 4; $i++) {
            $story = new Story();
            $story->setStoryName($faker->sentence());
            $story->setUserId($user);
            $stories[] = $story;
            $manager->persist($story);
        }

        $categories = [];
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setCategoryName($faker->word());
            $category->setStoryId($stories[rand(0, count($stories))]);
            $categories[] = $category;
            $manager->persist($category);
        }


        $manager->flush();
    }
}
