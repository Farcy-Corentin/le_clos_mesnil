<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $countries = [];
        for ($i = 0; $i <= 10; $i++) {
            $country = new Country();
            $country->setName($faker->country);
            $country->setEnglishName($faker->countryCode);
            $manager->persist($country);
            $countries[] = $country;
        }
        // $manager->flush();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setLastName($faker->name);
            $user->setFirstName($faker->firstName);
            $user->setUseMail($faker->email);
            $user->setPhone($faker->e164PhoneNumber);
            $user->setPassword($faker->password);
            $user->setCreateAt($faker->dateTime);
            $user->setUrl($faker->url);
            $user->setRoles(['ROLE_USER']);
            $user->setIp($faker->ipv4);
            $user->setCountry($countries[random_int(0, 9)]);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
