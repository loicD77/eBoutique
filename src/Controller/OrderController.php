<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/commande', name: 'order_index')]
    public function index(OrdersRepository $ordersRepository): Response
    {
        $orders = $ordersRepository->findBy(['user' => $this->getUser()]);

        return $this->render('order/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    // ✅ Ce bloc doit être avant /commande/{id}
    #[Route('/commande/success', name: 'order_success')]
    public function success(): Response
    {
        return $this->render('order/success.html.twig');
    }

    #[Route('/commande/{id}', name: 'order_show')]
    public function show($id, OrdersRepository $ordersRepository): Response
    {
        // Teste ce que Symfony reçoit
        // dd($id); ← à activer si tu veux tester encore

        $order = $ordersRepository->find($id);

        if (!$order) {
            throw $this->createNotFoundException('Commande introuvable.');
        }

        /** @var \App\Entity\User|null $user */
        $user = $this->getUser();

        if (!$user || $order->getUser()->getId() !== $user->getId()) {
            $commandeUserId = $order->getUser()->getId();
            $connectedUserId = $user ? $user->getId() : 'aucun utilisateur';

            return new Response(<<<HTML
                ⚠️ Accès refusé :<br>
                Commande appartenant à user_id = $commandeUserId<br>
                Mais utilisateur connecté = $connectedUserId
            HTML
            );
        }

        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/panier/valider', name: 'panier_valider', methods: ['POST'])]
    public function validerCommande(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('danger', 'Vous devez être connecté pour valider une commande.');
            return $this->redirectToRoute('app_login');
        }

        // TODO : logique de création de la commande ici

        $this->addFlash('success', 'Votre commande a bien été validée.');
        return $this->redirectToRoute('order_success');
    }
}
