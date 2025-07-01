<?php

namespace App\DataFixtures;

use App\Entity\Chef;
use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $chefs = [];

        for ($i = 0; $i < 10; $i++) {
            $chef = new Chef;
            $chef
                ->setName($faker->name);

            $manager->persist($chef);
            $chefs[] = $chef;
        }

        for ($i = 0; $i < 25; $i++) {

            $recette = new Recette;
            $recette
                ->setTitle($faker->sentence())
                ->setDescription($faker->paragraph())
                ->setCreatedAt($faker->dateTimeBetween('-2 years'))
                ->setImage($faker->imageUrl(320, 200, 'food', true))
                ->setIsPublished($faker->boolean(85))
                ->setNbPersonne($faker->numberBetween(2, 12))
                ->setTempsPreparation($faker->numberBetween(15, 90))
                ->setChef($faker->randomElement($chefs));

            $manager->persist($recette);
        }


        $manager->flush();
    }
}
