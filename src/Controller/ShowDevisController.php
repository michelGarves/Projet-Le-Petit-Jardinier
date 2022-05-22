<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Devis;
class ShowDevisController extends AbstractController
{
    /**
     * @Route("/show/devis", name="show_devis")
     */
    public function index(): Response
    {

        $request = Request::createFromGlobals();
        if($request->get('id')){
            $id = $request->get('id');
            $devis = $this->getDoctrine()
            ->getRepository(Haie::class)
            ->find($id);

            return $this->render('show_devis/index.html.twig', [
                'controller_name' => 'ShowDevisController',
                'devis' => $devis,
            ]);
        }else{
            
        }
        



        return $this->render('show_devis/index.html.twig', [
            'controller_name' => 'ShowDevisController',
        ]);
    }
}
