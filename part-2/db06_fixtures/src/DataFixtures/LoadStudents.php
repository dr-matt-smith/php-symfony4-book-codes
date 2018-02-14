<?php
namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStudents extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $s1 = new Student();
        $s1->setFirstName('matt');
        $s1->setSurname('smith');
        $s2 = new Student();
        $s2->setFirstName('joe');
        $s2->setSurname('bloggs');
        $s3 = new Student();
        $s3->setFirstName('joelle');
        $s3->setSurname('murph');


        $manager->persist($s1);
        $manager->persist($s2);
        $manager->persist($s3);

        $manager->flush();
    }
}