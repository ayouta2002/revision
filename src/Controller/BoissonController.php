<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Repository\BoissonRepository;
use App\Entity\Boisson;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\BoissonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class BoissonController extends AbstractController
{
    #[Route('/boisson', name: 'app_boisson')]
    public function index(): Response
    {
        return $this->render('boisson/index.html.twig', [
            'controller_name' => 'BoissonController',
        ]);
    }

    #[Route('/Affichageboisson', name: 'app_affichageboisson')]
    public function affiche (BoissonRepository $repository)
    {
     $boisson=$repository->findall(); //select*
     return $this->render("boisson/affiche.html.twig",['boisson'=>$boisson]);
    }

    #[Route('/Addboisson', name: 'app_Addboisson')]
           public function  Add (Request  $request)
         {
              $boisson=new boisson();
              $form =$this->CreateForm(boissonType::class,$boisson);
              $form->add('Ajouter',SubmitType::class);
              $form->handleRequest($request);
           
              if ($form->isSubmitted() && $form->isValid())
    
              {
        $em=$this->getDoctrine()->getManager();
        $em->persist($boisson);
        $em->flush();
        //return $this->redirectToRoute('app_affichageboisson');
              }
                  return $this->render('boisson/Add.html.twig',['f'=>$form->createView()]);
           }

          
           #[Route('/deleteboisson/{id}', name: 'app_deleteboisson')]
           public function delete($id, BoissonRepository $repository)
              {
                  $boisson = $repository->find($id);
   
                   if (!$boisson) {
                    throw $this->createNotFoundException('');  }
           $em = $this->getDoctrine()->getManager();
           $em->remove($boisson);
           $em->flush();
              
              return $this->render('boisson/Add.html.twig');
               }

}
