<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Haie;
use App\Entity\Devis;
use App\Entity\Client;

class DevisController extends AbstractController
{
    /**
     * @Route("/devis", name="devis")
     */
    public function index(): Response
    {
        $request = Request::createFromGlobals();
        $idDevis = $request->get('idDevis');
        if(isset($_POST["end"])){
            $haie = $this->getDoctrine()->getRepository(Haie::class)->find($_POST["haie"]);

            $tailler = new Tailler();
            $tailler->setNoDevis($idDevis);
            $tailler->setIdHaie($haie->getId());
            $tailler->setHauteur($_POST['hauteur']);
            $tailler->setLongueur($_POST["longueur"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tailler);
            $em->flush();
        }

       

        $devis = $this->getDoctrine()
        ->getRepository(Devis::class)
        ->find($idDevis);
        $idClient = $devis->getIdClient();
        $taillers = $devis->getTaillers();
        

        $client = $this->getDoctrine()
        ->getRepository(Client::class)
        ->find($idClient);

        $total = 0;
        $remiseTotale = 0;
        $haies = array();
        $lesPrix = array();
        foreach ($taillers as $tailler) {
            $sousTotal = 0;
            $haie = $this->getDoctrine()
            ->getRepository(Haie::class)
            ->find($tailler->getIdHaie());

            array_push($haies, $haie->getNom());

            $longueur = $tailler->getLongueur();
            $hauteur = $tailler->getHauteur();
            $remise = 0;
            
            $sousTotal += $haie->getPrix() * $longueur/100;

            if($hauteur > 150){
                $sousTotal = $sousTotal * 1.5;
            }
            if($client->getTypeClient() == "Entreprise"){
                $remise = $sousTotal * 0.10;
                $sousTotal = $sousTotal - $remise;
            }
            array_push($lesPrix, $sousTotal);
            $total += $sousTotal;
            $remiseTotale += $remise;
        }

        return $this->render('devis/index.html.twig', [ 'controller_name' => 'DevisController', 
            'client' => $client,'taillers'=> $taillers, 'devis' => $devis, 'totalPrix' => $total, 'totalRemise' => $remiseTotale, 'haies' => $haies, 'lesPrix' => $lesPrix
        ]);
    }
}
