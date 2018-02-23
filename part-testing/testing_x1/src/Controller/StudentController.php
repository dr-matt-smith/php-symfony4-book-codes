<?php
/**
 * about this file
 */
namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\StudentType;

/**
 * Class StudentController
 * @package App\Controller
 */
class StudentController extends Controller
{
    /**
    /**
     * display new form / process submission of new form
     * @Route("/student/new", name="student_new",  methods={"POST", "GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);

        // if was POST submission, extract data and put into '$student'
        $form->handleRequest($request);

        // if SUBMITTED & VALID - go ahead and create new object
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->createAction($student);
        }

        // render the form for the user
        $template = 'student/new.html.twig';
        $argsArray = [
            'form' => $form->createView(),
        ];

        return $this->render($template, $argsArray);
    }

    /**
     * given a Student object, add it to DB
     *
     * @param Student $student
     *
     * @return Response
     */
    public function createAction(Student $student)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($student);
        $em->flush();

        return $this->listAction($student->getId());
    }

    /**
     * list all students
     * @Route("/student", name="student_list")
     *
     * @param int $highlightId
     *
     * @return Response
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
     * delete given student
     * @Route("/student/delete/{id}", name="student_delete")
     *
     * @param Student $student
     *
     * @return Response
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
     * given new values update student record
     * @Route("/student/update/{id}/{newFirstName}/{newSurname}")
     *
     * @param Student $student
     * @param         $newFirstName
     * @param         $newSurname
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
     *
     * display a given student
     * @Route("/student/{id}", name="student_show")
     *
     * @param Student $student
     *
     * @return Response
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
