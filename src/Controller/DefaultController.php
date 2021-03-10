<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $x = 'hello';
        $response = $this->render('base.html.twig', [ 'x' => $x ]);
        $response->headers->set('status', 418);

        return $response;
    }

    /**
     * @Route("/api/{input}", name="api")
     */
    public function api($input = Null): Response
    {
        if ($input == Null){ 
            return new Response('<html><body><h1>504 - Torweg Zeitaus</h1></body><style>h1{text-align: center;}</style></html>',504,['Content-Type' => 'text/html']); 
        }

        return new Response('{"key":"'.$input.'"}',200,['Content-Type' => 'application/json']); 
    }

    /**
     * @Route("/{any}", requirements={"any"=".+"}, priority=-999, name="notfound")
     */
    public function notfound($any): Response
    {
        $response = $this->render('notfound.html.twig', [ 'any' => $any ]);
        $response->headers->set('status', 404);

        return $response;
    }
}