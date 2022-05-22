<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Haie;
use App\Form\HaieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class CreerHaieController extends AbstractController
{
    /**
     * @Route("/creer/haie", name="creer_haie")
     */
    public function index(Request $request): Response
    {
        $haie = new Haie();
        $form = $this->createForm(HaieType::class, $haie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $haie = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($haie);
            $em->flush();

            echo 'Haie ajoutée';
        }
        return $this->render('creer_haie/index.html.twig', 
            array('form' => $form->createView())
        );
    }
}
