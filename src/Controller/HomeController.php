<?php
// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'message' => 'Bienvenue sur LEFA, l excellence en un clic!',
        ]);
    }

    #[Route('/contact', name: 'contact')] // Ici la méthode render provient de la classe AbstractController, elle permet de pointer au fichier twig de contact pour la page home de mon site
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'message' => 'Contacte-nous ici',
        ]);
    } 

    #[Route('/about', name: 'about')] // Ici la méthode render provient de la classe AbstractController, elle permet de pointer au fichier twig de about pour la page home de mon site
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'message' => 'À propos de notre projet',
        ]);
    }
}
