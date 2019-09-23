<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Users;
use App\Entity\Questions;

class QuestionFixture extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $users = $manager->getRepository(Users::class)->findAll();

        $count = 0;
        while ($count < 20) {

            $user = $users[rand(0,19)];
            $question = new Questions();

            $question->setContent($faker->text);
            $question->setTitle($faker->title);
            $question->setUserId($user);

            $manager->persist($question);
            $count++;
        }

        $manager->flush();
    }

    function getOrder()
    {
        return 2;
    }
}
