<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Users;
use App\Entity\Questions;
use App\Entity\Answers;
use Symfony\Component\Console\Question\Question;

class AnswerFixture extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $questions = $manager->getRepository(Questions::class)->findAll();

        $count = 0;
        while ($count < 20) {
            $question = $questions[rand(0,19)];
            $answer = new Answers();

            $answer->setContent($faker->text);
            $answer->setQuestionId($question);
            $answer->setStatus($faker->boolean);

            $manager->persist($answer);
            $count++;
        }

        $manager->flush();
    }

    function getOrder()
    {
        return 3;
    }
}