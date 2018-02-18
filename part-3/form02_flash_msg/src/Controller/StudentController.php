<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    // * @Route("/student/processNewForm", name="student_process_new_form", methods={"POST"})


    /**
     * @Route("/student/processNewForm", name="student_process_new_form")
     */
    public function processNewFormAction(Request $request)
    {
        // extract name values from POST data
        $firstName = $request->request->get('firstName');
        $surname = $request->request->get('surname');

        // valid if neither value is EMPTY
        $isValid = !empty($firstName) && !empty($surname);

        if(!$isValid){
            $this->addFlash(
                'error',
                'student firstName/surname cannot be an empty string'
            );

            // forward this to the createAction() method
            return $this->newFormAction($request);
        }

        // forward this to the createAction() method
        return $this->createAction($firstName, $surname);
    }

    /**
     * @Route("/student/create/{firstName}/{surname}", name="student_create")
     */
    public function createAction($firstName, $surname)
    {
        $student = new Student();
        $student->setFirstName($firstName);
        $student->setSurname($surname);

        $em = $this->getDoctrine()->getManager();
        $em->persist($student);
        $em->flush();

        return $this->listAction();
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
     * @Route("/student/delete/{id}", name="student_delete")
     */
    public function deleteAction(Student $student)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();
        $studentRepository = $this->getDoctrine()->getRepository('App:Student');

        $id = $student->getId();
        $em->remove($student);
        $em->flush();

        return $this->listAction();
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

    /**
     * @Route("/student/new", name="student_new_form")
     */
    public function newFormAction()
    {
        $argsArray = [
        ];

        $templateName = 'student/new';
        return $this->render($templateName . '.html.twig', $argsArray);
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


}
