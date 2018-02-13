<?php

namespace App\Controller;

use App\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{


    /**
     * @Route("/student", name="student_show")
     */
    public function showAction()
    {
        $student = new Student(1, 'matt', 'smith');

        $template = 'student/show.html.twig';
        $args = [
            'student' => $student
        ];
        return $this->render($template, $args);
    }
}
