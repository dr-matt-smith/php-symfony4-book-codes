<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 23/01/2018
 * Time: 12:21
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\StudentRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/",name="homepage")
     */
    public function indexAction()
    {
        $template = 'homepage.html.twig';
        $args = [
            'name' => 'Matt Smith'
        ];

        return $this->render($template, $args);
    }


    /**
     * @Route("/students",name="student_list")
     */
    public function listStudentsAction()
    {

        $studentRepository = new StudentRepository();
        $students = $studentRepository->getAll();
        
        $template = 'students/list.html.twig';
        $args = [
            'students' => $students
        ];

        return $this->render($template, $args);
    }



}