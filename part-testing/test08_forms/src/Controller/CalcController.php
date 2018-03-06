<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CalcController extends Controller
{
    /**
     * @Route("/calc", name="calc_home")
     */
    public function indexAction()
    {
        return $this->render('calc/index.html.twig', []);
    }

    /**
     * @Route("/calc/process", name="calc_process")
     */
    public function processAction(Request $request)
    {
        // extract name values from POST data
        $n1 = $request->request->get('num1');
        $n2 = $request->request->get('num2');
        $operation = $request->request->get('operation');

        $answer = '(not yet implemented)';

        return $this->render(
            'calc/result.html.twig',
            [
                'n1' => $n1,
                'n2' => $n2,
                'operation' => $operation,
                'answer' => $answer
            ]
        );
    }
}
