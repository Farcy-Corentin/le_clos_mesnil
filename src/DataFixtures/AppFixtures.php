<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\CountryFixtures;
use App\DataFixtures\ReservationFixtures;
use App\DataFixtures\SeasonFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CountryFixtures::class,
            UserFixtures::class,
            ReservationFixtures::class,
        ];
    }
}
