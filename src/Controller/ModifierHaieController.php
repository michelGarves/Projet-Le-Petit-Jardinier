<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Haie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifierHaieController extends AbstractController
{
    /**
     * @Route("/modifier/haie", name="modifier_haie")
     */
    public function index(): Response
    {
        
        $request = Request::createFromGlobals();
        $id=$request->get('id');
        $defHaie = $this->getDoctrine()
        ->getRepository(Haie::class)
        ->find($id);
        $code = $defHaie->getCode();
        $nom = $defHaie->getNom();
        $tarif = $defHaie->getPrix();
        $defaults = [
            'code' => $code,
            'nom' => $nom,
            'tarif' => $tarif,
        ];
        $form = $this->createFormBuilder($defaults)
        ->add('code', TextType::class, array('label'=>'Code haie'))
        ->add('nom', TextType::class, array('label'=>'Nom haie'))
        ->add('tarif', NumberType::class, array('label'=>'Tarif haie'))
        ->add('save', SubmitType::class, array('label' => 'Valider'))
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $haie = $form->getData();
            $newCode = $haie["code"];
            $newNom = $haie["nom"];
            $newTarif = $haie["tarif"];
            $defHaie->setCode($newCode);
            $defHaie->setNom($newNom);
            $defHaie->setPrix($newTarif);

            $em = $this->getDoctrine()->getManager();
            $em->persist($defHaie);
            $em->flush();
            $code= $defHaie->getCode();
            $nom = $defHaie->getNom();
            $tarif = $defHaie->getPrix();
        }
        
        return $this->render('modifier_haie/index.html.twig',[
            'form' => $form->createView(),
            'code' => $code,
            'nom' => $nom,
            'tarif' => $tarif,
        ]
    );
    }
}
