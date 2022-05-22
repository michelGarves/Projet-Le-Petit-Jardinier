<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Haie;

class ListeHaieController extends AbstractController
{
    /**
     * @Route("/liste/haie", name="liste_haie")
     */
    public function index(): Response
    {
        $lesHaies = $this->getDoctrine()
        ->getRepository(Haie::class)
        ->findAll();

        return $this->render('liste_haie/index.html.twig', [
            'controller_name' => 'ListeHaieController',
            'lesHaies' => $lesHaies,
        ]);

    }
}
