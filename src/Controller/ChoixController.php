<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use App\Entity\Devis;

class ChoixController extends AbstractController
{
    /**
     * @Route("/choix", name="choix")
     */
    public function index(): Response
    {
        $lesClients = $this->getDoctrine()
        ->getRepository(Client::class)
        ->findAll();

       
        

        return $this->render('choix/index.html.twig', [
            'controller_name' => 'ChoixController',
            'clients' => $lesClients,
        ]);
    }
}
