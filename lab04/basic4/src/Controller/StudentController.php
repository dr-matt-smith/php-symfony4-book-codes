<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentController extends Controller
{
    /**
     * @Route("/student/{id}", name="student_show")
     */
    public function showAction($id)
    {
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);

        // we are assuming $student is not NULL....

        $template = 'student/show.html.twig';
        $args = [
            'student' => $student
        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/student", name="student_list")
     */
    public function listAction()
    {
        $studentRepository = new StudentRepository();
        $students = $studentRepository->findAll();

        $template = 'student/list.html.twig';
        $args = [
            'students' => $students
        ];
        return $this->render($template, $args);
    }
}
