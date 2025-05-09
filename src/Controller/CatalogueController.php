<?php

namespace App\Controller;

use App\Repository\FormationsRepository;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'app_catalogue')] // chemin pour la page catalogue
    public function index(FormationsRepository $formationsRepository, CategoryRepository $categoryRepository): Response
    {
        $formations = $formationsRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('catalogue/index.html.twig', [
            'formations' => $formations,
            'categories' => $categories,
        ]);
    }

    #[Route('/catalogue/categorie/{id}', name: 'app_catalogue_par_categorie')] // chemin pour les chemins de categorie (trié par id)
    public function parCategorie(Category $category, FormationsRepository $formationsRepository, CategoryRepository $categoryRepository): Response
    {
        $formations = $formationsRepository->findBy(['category' => $category]);
        $categories = $categoryRepository->findAll();

        return $this->render('catalogue/index.html.twig', [
            'formations' => $formations,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }
}
