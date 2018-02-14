<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class StudentController extends Controller
{
    /**
     * @Route("/student/create/{firstName}/{surname}", name="student_create")
     */
    public function createAction($firstName, $surname)
    {
        $student = new Student();
        $student->setFirstName($firstName);
        $student->setSurname($surname);

        // entity manager
        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($student);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Created new student with id '.$student->getId());
    }

    /**
     * @Route("/student", name="student_list")
     */
    public function listAction()
    {
        $studentRepository = $this->getDoctrine()->getRepository('App:Student');
        $students = $studentRepository->findAll();

        $template = 'student/list.html.twig';
        $args = [
            'students' => $students
        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/student/{id}", name="student_show")
     */
    public function showAction(Student $student)
    {
        $template = 'student/show.html.twig';
        $args = [
            'student' => $student
        ];

        if (!$student) {
            $template = 'error/404.html.twig';
        }

        return $this->render($template, $args);
    }

    /**
     * @Route("/student/delete/{id}")
     */
    public function deleteAction(Student $student)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();
        $studentRepository = $this->getDoctrine()->getRepository('App:Student');


        // store ID before deleting, so can report ID later
        $id = $student->getId();

        // tells Doctrine you want to (eventually) delete the Student (no queries yet)
        $em->remove($student);

        // actually executes the queries (i.e. the DELETE query)
        $em->flush();

        return new Response('Deleted student with id = '. $id);
    }

    /**
     * @Route("/student/update/{id}/{newFirstName}/{newSurname}")
     */
    public function updateAction(Student $student, $newFirstName, $newSurname)
    {
        $em = $this->getDoctrine()->getManager();

        $student->setFirstName($newFirstName);
        $student->setSurname($newSurname);
        $em->flush();

        return $this->redirectToRoute('student_show', [
            'id' => $student->getId()
        ]);
    }
}
