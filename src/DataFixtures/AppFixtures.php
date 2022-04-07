<?php

namespace App\DataFixtures;

use App\Entity\Cities;
use App\Entity\ContactDisponibility;
use App\Entity\Disponibility;
use App\Entity\Gite;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $generator = \Faker\Factory::create();
        $populator = new \Faker\ORM\Propel\Populator($generator);
        $populator->addEntity(Cities::class, 1000);
        $insertedPKs = $populator->execute();

        for($i = 1; $i <= 2; $i++) {

            $user = new Utilisateur();
            $user->setEmail($faker->email())
                  ->setPassword('')
                  ->setRoles(['ROLE_USER'])
                  ->setFirstName($faker->firstName())
                  ->setLastName($faker->lastName())
                  ->setPhone($faker->phoneNumber());
            $manager->persist($user);
            for($j = 1; $j <= 100; $j++) {
            $gite = new Gite();
            $gite->setTitle($faker->word())
                ->setDescription($faker->realText())
                ->setUser($user)
                ->setImage($faker->imageUrl(360, 480))
                ->setIsAllowed(rand(0, 1))
                ->setIsAllwoedPrice(rand(1 , 30))
                ->setPrice(rand(100, 2000))
                ->setCity($insertedPKs(rand(0,1000)))
                ->setBed(rand(0, 10))
                ->setRoom(rand(0, 10));
            $manager->persist($gite);

            $dispo = new Disponibility();
            $dispo->setGite($gite)
                ->setDateStart($faker->dateTimeBetween('-10 days','now', $timezone = null))
                ->setDateEnd($faker->dateTimeBetween('now','+ 15 days', $timezone = null));
            $manager->persist($dispo);

            $contactDispo = new ContactDisponibility();
            $contactDispo->setUser($user)
                ->setDay($faker->dayOfWeek())
                ->setHourStart(rand(8, 14))
                ->setHourEnd(rand(15, 23));
            $manager->persist($contactDispo);
            }
        }
        $manager->flush();
    }
}
