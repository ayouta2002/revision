<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\AuthorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/ShowAuthor/{name}', name: 'app_ShowAuthor')]
    public function ShowAuthor($name)
    {
        return $this->render('author/show.html.twig',['a'=>$name]);
    }

    #[Route('/Showlist', name: 'app_Showlist')]
    public function list ()
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/vc.jpg','username' => ' Victor
            Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william_shakespear.jpg','username' => '
            William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' =>
            200 ),
            array('id' => 3, 'picture' => '/images/taha_Hussein.jpg','username' => ' Taha
            Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),);
            return $this->render('author/list.html.twig',['authors'=>$authors]);
    }

    #[Route('/auhtorDetails/{id}', name: 'app_authorDetails')]
    public function auhtorDetails($id)
    {
        $author = array(
            array('id' => 1, 'picture' => '/images/vc.jpg','username' => ' Victor
            Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william_shakespear.jpg','username' => '
            William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' =>
            200 ),
            array('id' => 3, 'picture' => '/images/taha_Hussein.jpg','username' => ' Taha
            Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),);
            

        return $this->render("author/showAuthor.html.twig",['author'=>$author[$id-1]]);
        }
        

        #[Route('/Affichage', name: 'app_affichage')]
        public function affiche (AuthorRepository $repository)
        {
         $author=$repository->findall(); //select*
         return $this->render("author/affiche.html.twig",['author'=>$author]);
        }


        #[Route('/AddStatistique', name: 'app_AddStatistique')]
        public function addstatique(EntityManagerInterface $entityManager): Response
        {
             //preparation de l'objet
        $author1=new author();
        $author1->setUsername("test");
        $author1->setEmail("test@gmail.com");

        // Enregistrez l'entité dans la base de données
        $entityManager->persist($author1);
        $entityManager->flush();

        return $this->redirectToRoute('app_affichage'); // Redirigez vers la route 'app_affichage'
            }  
            
           #[Route('/Add', name: 'app_Add')]
           public function  Add (Request  $request)
         {
              $author=new Author();
              $form =$this->CreateForm(AuthorType::class,$author);
              $form->add('Ajouter',SubmitType::class);
              $form->handleRequest($request);
           
              if ($form->isSubmitted() && $form->isValid())
    
              {
        $em=$this->getDoctrine()->getManager();
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute('app_affichage');
              }
                  return $this->render('author/Add.html.twig',['f'=>$form->createView()]);
           }

        #[Route('/delete/{id}', name: 'app_delete')]
        public function delete($id, AuthorRepository $repository)
           {
               $author = $repository->find($id);

                if (!$author) {
                 throw $this->createNotFoundException('Auteur non trouvé');  }
        $em = $this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();
           return $this->redirectToRoute('app_affichage');
            }

            #[Route('/edit/{id}', name: 'app_edit')]
            public function edit(AuthorRepository $repository, $id, Request $request)
    {
        $author = $repository->find($id);
        $form = $this->createForm(AuthorType::class, $author);
        $form->add('Edit', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush(); // Correction : Utilisez la méthode flush() sur l'EntityManager pour enregistrer les modifications en base de données.
            return $this->redirectToRoute('app_affichage');
        }

        return $this->render('author/edit.html.twig', [
            'f' => $form->createView(),
        ]);
    }

        }

