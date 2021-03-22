<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    // ...
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $user = new User();
        $roles[] = 'ROLE_ADMIN';
        $country=$manager->getRepository(User::class)->findOneById("FR");
        $user
            ->setFirstName("admin")
            ->setLastName("admin")
            ->setPseudo()
            ->setUseMail("admin@gmail.com")
            ->setPhone($faker->phoneNumber)
            ->setIp($faker->ipv4)
            ->setUrl($faker->url)
            ->setRoles($roles)
            ->setCountry($country);
        $password = $this->encoder->encodePassword($user, 'pass_1234');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
