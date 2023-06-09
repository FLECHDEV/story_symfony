<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Story;
use App\Entity\Chapter;
use App\Entity\Category;
use App\Entity\Character;
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


        $categories = [];
        for ($i = 0; $i < 4; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $manager->persist($category);
            $categories[] = $category;
        }

        // Creating stories
        $stories = [];
        for ($i = 0; $i < 4; $i++) {
            $story = new Story();
            $story->setName($faker->sentence());
            $story->setUser($user);
            $story->addCategory($categories[$i]);
            $stories[] = $story;
            $manager->persist($story);
        }

        $chapters = [];
        for ($i = 0; $i < 10; $i++) {
            $chapter = new Chapter();
            $chapter->setChapterName($faker->word(12));
            $chapter->setChapterIdeas($faker->text());
            $chapter->setStory($stories[rand(0, count($stories) - 1)]);
            $manager->persist($chapter);
            $chapters[] = $chapter;
        }


        $characters = [];
        for ($i = 0; $i < 6; $i++) {
            $character = new Character();
            $character->setLastname($faker->lastName());
            $character->setFirstname($faker->firstName());
            $character->setNickname($faker->name());
            $character->setCity($faker->city());
            $character->setInformation($faker->text());
            $character->setLink($faker->text(100));
            $character->setJob($faker->jobTitle());
            $character->setAge($faker->numberBetween(2, 90));
            $character->setEthnic(array_rand(['Caucasien', 'Asiatique', 'africain']));
            $storyRelated = $stories[rand(0, count($stories) - 1)];
            $character->setStory($storyRelated);
            $categoriesOfStory = $storyRelated->getCategories();
            $character->setCategory($categoriesOfStory[rand(0, count($categoriesOfStory) - 1)]);
            $manager->persist($character);
            $characters[] = $character;
        }


        $manager->flush();
    }
}
