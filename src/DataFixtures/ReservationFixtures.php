<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use App\Entity\Season;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReservationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $seasons = [];
        for ($i = 1; $i <= 10; $i++) {
            $faker = Factory::create();
            $season = new Season();
            $season->setName($faker->name);
            $season->setPrice($faker->numberBetween(1, 300));
            $season->setDateStart($faker->dateTime);
            $season->setDateEnd($faker->dateTime);
            $manager->persist($season);
            $seasons[] = $season;
        }

        for ($i = 1; $i <= 10; $i++) {
            $faker = Factory::create();
            $user = $this->getReference('user_' . $faker->numberBetween(1, 20));
            $reservation = new Reservation();
            // champs users_id
            $reservation->setUsers($user);
            // champs season_id
            $reservation->setSeason($seasons[random_int(1, 9)]);
            $reservation->setDate($faker->dateTime);
            $reservation->setDateStart($faker->dateTime);
            $reservation->setDateEnd($faker->dateTime);
            $reservation->setPrice($faker->randomDigit);
            $reservation->setPaymentDate($faker->dateTime);
            $manager->persist($reservation);
        }
        $manager->flush();
    }
}
