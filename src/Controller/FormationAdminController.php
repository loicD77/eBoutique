<?php

namespace App\Controller;

use App\Entity\Formations;
use App\Form\FormationType;
use App\Repository\FormationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adminformations')]
class FormationAdminController extends AbstractController
{
    #[Route('/', name: 'admin_formation_index')]
    public function index(FormationsRepository $repository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('adminformations/index.html.twig', [
            'formations' => $repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_formation_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $formation = new Formations();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formation->setCreatedAt(new \DateTimeImmutable());
            $formation->setUpdatedAt(new \DateTimeImmutable());

            $em->persist($formation);
            $em->flush();

            $this->addFlash('success', 'Formation créée avec succès.');
            return $this->redirectToRoute('admin_formation_index');
        }

        return $this->render('adminformations/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'admin_formation_edit')]
    public function edit(Formations $formation, Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formation->setUpdatedAt(new \DateTimeImmutable());
            $em->flush();

            $this->addFlash('success', 'Formation mise à jour.');
            return $this->redirectToRoute('admin_formation_index');
        }

        return $this->render('adminformations/edit.html.twig', [
            'form' => $form->createView(),
            'formation' => $formation,
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_formation_delete', methods: ['POST'])]
    public function delete(Formations $formation, Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $em->remove($formation);
            $em->flush();
            $this->addFlash('success', 'Formation supprimée.');
        }

        return $this->redirectToRoute('admin_formation_index');
    }
}
