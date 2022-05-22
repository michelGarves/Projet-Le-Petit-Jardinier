<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Haie;
use App\Form\TaillerType;
use App\Entity\Client;
use App\Entity\Tailler;
use App\Entity\Devis;
use Symfony\Component\Validator\Constraints\Date;

class MesureController extends AbstractController
{
    /**
     * @Route("/mesure", name="mesure")
     */
    public function index(Request $request): Response
    {
        

        if(!$request->get('session')){
            $session = new Session();
        }else{
            $session =$request->get('session');
        }
        
        
        if(!$session->get('idClient')){
            $idClient = $request->get('selectClient');
            $client = $this->getDoctrine()->getRepository(Client::class)->find($idClient);
        }else if($session->get('idClient')){
            $idClient = $session->get('idClient');
            $devis = $this->getDoctrine()->getRepository(Devis::class)->find($session->get('idDevis'));
            $client = $this->getDoctrine()->getRepository(Client::class)->find($idClient);
        }
        
        
        if (isset($_POST["confirmChoix"])) {
            
            $devis = new Devis();
            $today = new \DateTime(); 
            $devis->setDate($today);
            $devis->setIdClient($client);
            $em = $this->getDoctrine()->getManager();
            $em->persist($devis);
            $em->flush();
        }
        

        $tailler = new Tailler();
        $form = $this->createForm(TaillerType::class, $tailler);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('idClient', $idClient);
            $session->set('idDevis', $idClient);
            var_dump($session->get('idClient'));
            $tailler = $form->getData();
            $tailler->setNoDevis($devis->getId());
            $tailler->setIdHaie($request->get('haie'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($tailler);
            $em->flush();

            
            
        }
        $lesHaies = $this->getDoctrine()->getRepository(Haie::class)->findAll();

       
       
        return $this->render('mesure/index.html.twig', [
            'controller_name' => 'MesureController',
            'lesHaies' => $lesHaies,
            'leClient' => $client,
            'idDevis' => $devis->getId(),
            'form' => $form->createView()
        ]);
    }
}