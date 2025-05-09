<?php

// src/Controller/UserController.php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController  // AbstractController permet d'utiliser des méthodes de Symfony
{
    #[Route('/user/create', name: 'user_create')]
    public function create(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // 🔒 Hash du mot de passe avant de le stocker
            $hashedPassword = $hasher->hashPassword($user, $user->getPassword()); // on hashe le mdp dans la BDD
            $user->setPassword($hashedPassword);

            // On remet les dates à jour manuellement si nécessaire
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTimeImmutable());

            $em->persist($user); // prépare une entité "USER" pour la création
            $em->flush(); // Cette méthode porte les modifications au niveau de la base de données.

            $this->addFlash('success', 'Compte créé avec succès !');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}



?>