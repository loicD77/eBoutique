<?php

namespace App\Controller;

use App\Entity\Formations;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier_index')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $panier = $request->getSession()->get('panier', []);
        $total = 0;
        $items = [];

        foreach ($panier as $id => $quantite) {    // boucle pour parcourir les formations
            $formation = $em->getRepository(Formations::class)->find($id);
            if ($formation) {
                $totalItem = $formation->getPrice() * $quantite;
                $total += $totalItem;
                $items[] = [
                    'formation' => $formation,
                    'quantity' => $quantite,
                    'total' => $totalItem,
                ];
            }
        }

        return $this->render('catalogue/panier.html.twig', [ // Méthode render de AbstractController !
            'items' => $items,
            'grand_total' => $total,
            'transport' => 10,
        ]);
    }

    #[Route('/panier/ajouter/{id}', name: 'panier_ajouter')]  // ajouter à partir d'un id
    public function ajouter(Formations $formation, Request $request): Response
    {
        $session = $request->getSession(); 
        $panier = $session->get('panier', []);
        $id = $formation->getId();

        $panier[$id] = ($panier[$id] ?? 0) + 1;
        $session->set('panier', $panier);

        return $this->redirectToRoute('panier_index');
    }

    #[Route('/panier/diminuer/{id}', name: 'panier_diminuer')] // On diminue le nombre de formation d'un id particulier , exemple "Leadership Stratégique" de Management
    public function diminuer(Formations $formation, Request $request): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $id = $formation->getId();

        if (isset($panier[$id])) {
            $panier[$id]--;
            if ($panier[$id] <= 0) {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('panier_index');
    }

    #[Route('/panier/vider', name: 'panier_vider', methods: ['POST'])]
    public function vider(SessionInterface $session): Response
    {
        $session->remove('panier');
        $this->addFlash('success', '🗑️ Votre panier a été vidé.');
        return $this->redirectToRoute('panier_index');
    }

   /* #[Route('/panier/valider', name: 'panier_valider', methods: ['POST'])]
    public function validerCommande(Request $request): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('danger', 'Vous devez être connecté pour valider votre commande.');
            return $this->redirectToRoute('app_login');
        }

       $address = $user->getAddress(); 
        if ($address) {
            $this->addFlash('success', "✅ Vous avez bien passé votre commande à l'adresse : $address");
        } else {
            $this->addFlash('warning', "Commande enregistrée, mais aucune adresse n'est définie sur votre profil.");
        }

        $request->getSession()->remove('panier'); // suppression du panier à partir de la Session

        return $this->redirectToRoute('order_success');
    }*/
}
