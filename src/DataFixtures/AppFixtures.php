<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\ReservationFixtures;
use App\DataFixtures\PostFixtures;

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
            UserFixtures::class,
            ReservationFixtures::class,
            PostFixtures::class
        ];
    }
}
