<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function indexAction()
    {
        $template = 'default/index.html.twig';
        $args = [
        ];
        return $this->render($template, $args);
    }

    /**
     * @Route("/pinkblue", name="pinkblue")
     */
    public function pinkBlueAction()
    {
        // create colours array
        $colours = [
            'foreground' => 'blue',
            'background' => 'pink'
        ];

        // store colours in session 'colours'
        $session = new Session();
        $session->set('colours', $colours);

        return $this->redirectToRoute('default');
    }


    /**
     * @Route("/reset", name="reset")
     */
    public function resetAction()
    {
        $session = new Session();
        $session->remove('colours');
        $session->clear();

        return $this->redirectToRoute('default');
    }

}
