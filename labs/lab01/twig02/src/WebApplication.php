<?php

namespace Itb;

use Twig_Environment;
use Twig_Loader_Filesystem;

class WebApplication
{
    const PATH_TO_TEMPLATES = __DIR__ . '/../templates';

    public function run()
    {
        //-------- setup Twig --------
        $twig = new Twig_Environment(
            new Twig_Loader_Filesystem(WebApplication::PATH_TO_TEMPLATES)
        );


        $studentRepository = new StudentRepository();
        $students = $studentRepository->getAll();


        $template = 'homepage.html.twig';
        $args = [
            'students' => $students
        ];
        
        $html = $twig->render($template, $args);
        print $html;
    }
    
}
