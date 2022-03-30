<?php

namespace App\DataFixtures;

use App\Entity\ContactDisponibility;
use App\Entity\Disponibility;
use App\Entity\Gite;
use App\Entity\Option;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\DateTime;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for($i = 1; $i <= 10; $i++) {

            $user = new Utilisateur();
            $user->setEmail('test'.$i.'@test.com')
                  ->setPassword(rand(1000,1000000))
                  ->setRoles(['ROLE_USER'])
                  ->setFirstName($faker->firstName())
                  ->setLastName($faker->lastName())
                  ->setPhone($faker->phoneNumber());
            $manager->persist($user);

            $gite = new Gite();
            $gite->setTitle($faker->firstName())
                ->setDescription($faker->realText())
                ->setUser($user)
                ->setImage('https://storage.googleapis.com/epc-photos/photo_b6f6f01d-f5bb-4d72-a270-607bb878029c.png')
                ->setIsAllowed(rand(0, 1))
                ->setIsAllwoedPrice(rand(1 , 30))
                ->setPrice(rand(100, 2000))
                ->setLocation($faker->city())
                ->setBed(rand(0, 10))
                ->setRoom(rand(0, 10));
            $manager->persist($gite);

            $dispo = new Disponibility();
            $dispo->setGite($gite)
                ->setDateStart($faker->dateTime())
                ->setDateEnd($faker->dateTime());
            $manager->persist($dispo);

            $contactDispo = new ContactDisponibility();
            $contactDispo->setUser($user)
                ->setDay("Wednesday")
                ->setHourStart(rand(8, 14))
                ->setHourEnd(rand(15, 23));
            $manager->persist($contactDispo);
        }
        $manager->flush();
    }
}
