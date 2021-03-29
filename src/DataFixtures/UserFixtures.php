<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $countries = [];
        $faker = Factory::create('fr_FR');
        // for ($i = 0; $i <= 30; $i++) {
        //     $country = new Country();
        //     $country->setName($faker->country);
        //     $country->setEnglishName($faker->countryCode);
        //     $manager->persist($country);
        //     $countries[] = $country;
        // }

        for ($nbUsers = 1; $nbUsers <= 30; $nbUsers++) {
            $user = new User();
            $user->setEmail($faker->email);
            if ($nbUsers === 1)
                $user->setRoles(['ROLE_ADMIN']);
            else
                $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'azerty'));
            $user->setLastName($faker->lastName);
            $user->setPhone($faker->e164PhoneNumber);
            $user->setFirstname($faker->firstName);
            $user->setCreateAt($faker->dateTime);
            $manager->persist($user);

            // Enregistre l'utilisateur dans une référence
            $this->addReference('user_' . $nbUsers, $user);
        }

        $manager->flush();
    }

    // public function load(ObjectManager $manager)
    // {
    //     $faker = Factory::create('fr_FR');

    //     $countries = [];
    //     for ($i = 0; $i <= 10; $i++) {
    //         $country = new Country();
    //         $country->setName($faker->country);
    //         $country->setEnglishName($faker->countryCode);
    //         $manager->persist($country);
    //         $countries[] = $country;
    //     }

    //     // $user = new User();

    //     $manager->persist($this->createUser($faker, ['ROLE_ADMIN'], $countries));

    //     for ($i = 0; $i < 10; $i++) {
    //         $manager->persist($this->createUser($faker, ['ROLE_USER'], $countries));
    //     }
    //     $manager->flush();
    // }

    // private function createUser($faker, $roles, $countries): User
    // {
    //     $user = new User();

    //     $user->setLastName($faker->name);
    //     $user->setFirstName($faker->firstName);
    //     $user->setUseMail($faker->email);
    //     $user->setPhone($faker->e164PhoneNumber);
    //     $user->setPassword($this->passwordEncoder->encodePassword($user, 'azerty'));
    //     $user->setCreateAt($faker->dateTime);
    //     $user->setUrl($faker->url);
    //     $user->setRoles($roles);
    //     $user->setIp($faker->ipv4);
    //     $user->setCountry($countries[random_int(0, 9)]);
    //     $this->addReference('user_' . $i, $user);

    //     return $user;
    // }
}
