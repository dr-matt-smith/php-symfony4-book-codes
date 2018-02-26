<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function indexAction()
    {
        $colours = [
            'foreground' => 'black',
            'background' => 'white'
        ];
        $default_colours = true;

        $template = 'default/index.html.twig';
        $args = [
            'colours' => $colours,
            'default_colours' => $default_colours
        ];
        return $this->render($template, $args);
    }
}
