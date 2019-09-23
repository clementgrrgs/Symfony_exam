<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Users;

class UserFixture extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        $count = 0;
        while ($count < 20) {
            $user = new Users();
            $user->setName($faker->word);

            $manager->persist($user);
            $count++;
        }

        $manager->flush();
    }

    function getOrder()
    {
        return 1;
    }
}
