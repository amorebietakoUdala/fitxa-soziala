<?php

namespace App\Controller;

use App\Entity\Gaitasuna;
use App\Form\GaitasunaType;
use App\Repository\GaitasunaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/gaitasuna')]
class GaitasunaController extends AbstractController
{
    public function __construct(private readonly \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    #[Route(path: '/', name: 'gaitasuna_index', methods: ['GET'])]
    public function index(GaitasunaRepository $gaitasunaRepository): Response
    {
        return $this->render('gaitasuna/index.html.twig', [
            'gaitasunas' => $gaitasunaRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'gaitasuna_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $gaitasuna = new Gaitasuna();
        $form = $this->createForm(GaitasunaType::class, $gaitasuna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($gaitasuna);
            $entityManager->flush();

            return $this->redirectToRoute('gaitasuna_index');
        }

        return $this->render('gaitasuna/new.html.twig', [
            'gaitasuna' => $gaitasuna,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'gaitasuna_show', methods: ['GET'])]
    public function show(Gaitasuna $gaitasuna): Response
    {
        return $this->render('gaitasuna/show.html.twig', [
            'gaitasuna' => $gaitasuna,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'gaitasuna_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gaitasuna $gaitasuna): Response
    {
        $form = $this->createForm(GaitasunaType::class, $gaitasuna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('gaitasuna_index');
        }

        return $this->render('gaitasuna/edit.html.twig', [
            'gaitasuna' => $gaitasuna,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'gaitasuna_delete', methods: ['POST'])]
    public function delete(Request $request, Gaitasuna $gaitasuna): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gaitasuna->getId(), $request->request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove($gaitasuna);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gaitasuna_index');
    }
}
