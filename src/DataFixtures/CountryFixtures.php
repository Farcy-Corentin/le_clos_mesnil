<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 20; $i++) {

            $country = new Country();
            $faker = Factory::create();
            $country->setName($faker->country);
            $country->setEnglishName($faker->countryCode);
            $manager->persist($country);
        }
        $manager->flush();
    }
}
