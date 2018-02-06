<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 23/01/2018
 * Time: 12:08
 */

namespace Itb;


class StudentRepository
{
    private $students;

    public function __construct()
    {
        $s = new Student(1, 'matt', 'smith');
        $this->students[] = $s;
        $s = new Student(2, 'joelle', 'murphy');
        $this->students[] = $s;
    }

    public function getAll()
    {
        return $this->students;
    }
    
}