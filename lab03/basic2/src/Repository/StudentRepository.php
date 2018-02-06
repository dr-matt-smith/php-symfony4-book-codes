<?php
namespace App\Repository;

use App\Entity\Student;

class StudentRepository
{
    private $students = [];

    public function __construct()
    {
        $s1 = new Student(1, 'matt', 'smith');
        $this->students[] = $s1;
        $s2 = new Student(2, 'joelle', 'murphy');
        $this->students[] = $s2;
        $s3 = new Student(3, 'frances', 'mcguinness');
        $this->students[] = $s3;
    }

    public function findAll()
    {
        return $this->students;
    }
}
