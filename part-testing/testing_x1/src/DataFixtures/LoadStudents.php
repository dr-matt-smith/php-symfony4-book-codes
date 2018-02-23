<?php
namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStudents extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // faker 'factory'
        $faker = \Faker\Factory::create();

        // loop to create and persist 10 students
        $numStudents = 10;
        for ($i=0; $i < $numStudents; $i++) {
            $firstName = $faker->firstNameMale;
            $surname = $faker->lastName;

            $student = new Student();
            $student->setFirstName($firstName);
            $student->setSurname($surname);

            $manager->persist($student);
        }

        // push all changes to the DB
        $manager->flush();
    }
}