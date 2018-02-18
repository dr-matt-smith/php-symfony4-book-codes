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
     * @Route("/student/new", name="student_new",  methods={"POST", "GET"})
     */
    public function newAction(Request $request)
    {
        // attempt to find values in POST variables
        $firstName = $request->request->get('firstName');
        $surname = $request->request->get('surname');

        // valid if neither value is EMPTY
        $isValid = !empty($firstName) && !empty($surname);

        // was form submitted with POST method?
        $isSubmitted = $request->isMethod('POST');

        // if SUBMITTED & VALID - go ahead and create new object
        if ($isSubmitted && $isValid) {
            return $this->createAction($firstName, $surname);
        }

        // if submitted and NOT valid, add a FLASH ERROR message
        if ($isSubmitted && !$isValid) {
            $this->addFlash(
                'error',
                'student firstName/surname cannot be an empty string'
            );
        }

        // render the form for the user
        $template = 'student/new.html.twig';
        $argsArray = [
            'firstName' => $firstName,
            'surname' => $surname
        ];

        return $this->render($template, $argsArray);
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

        return $this->listAction($student->getId());
    }

    /**
     * @Route("/student", name="student_list")
     */
    public function listAction($highlightId = -1)
    {
        $studentRepository = $this->getDoctrine()->getRepository('App:Student');
        $students = $studentRepository->findAll();

        $template = 'student/list.html.twig';
        $args = [
            'students' => $students,
            'highlightId' => $highlightId,
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
