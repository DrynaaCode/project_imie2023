<?php

namespace App\DataFixtures;

use App\Entity\Artists;
use App\Entity\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
      
        for ($i=0; $i < 10 ; $i++) { 
            $artist = new Artists();
            $artist->setName($this->faker->name())
            ->setDescription($this->faker->sentence())
            ->setFollowers(mt_rand(0,1000))
            ->setIsValid(true)
            ->setListeners(mt_rand(0,1000))
            ->setPathPicture($this->faker->imageUrl(640, 480, 'animals', true));
            $manager->persist($artist);
        }
        $manager->flush();
    }
}
