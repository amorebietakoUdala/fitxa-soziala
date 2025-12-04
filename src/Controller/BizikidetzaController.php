<?php

namespace App\Controller;

use App\Entity\Bizikidetza;
use App\Form\BizikidetzaType;
use App\Repository\BizikidetzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/bizikidetza')]
class BizikidetzaController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly BizikidetzaRepository $bizikidetzaRepository
    )
    {
    }
    
    #[Route(path: '/', name: 'bizikidetza_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('bizikidetza/index.html.twig', [
            'bizikidetzas' => $this->bizikidetzaRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'bizikidetza_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $bizikidetza = new Bizikidetza();
        $form = $this->createForm(BizikidetzaType::class, $bizikidetza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($bizikidetza);
            $this->entityManager->flush();

            return $this->redirectToRoute('bizikidetza_index');
        }

        return $this->render('bizikidetza/new.html.twig', [
            'bizikidetza' => $bizikidetza,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'bizikidetza_show', methods: ['GET'])]
    public function show(Bizikidetza $bizikidetza): Response
    {
        return $this->render('bizikidetza/show.html.twig', [
            'bizikidetza' => $bizikidetza,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'bizikidetza_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Bizikidetza $bizikidetza): Response
    {
        $form = $this->createForm(BizikidetzaType::class, $bizikidetza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('bizikidetza_index');
        }

        return $this->render('bizikidetza/edit.html.twig', [
            'bizikidetza' => $bizikidetza,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'bizikidetza_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Bizikidetza $bizikidetza): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bizikidetza->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($bizikidetza);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('bizikidetza_index');
    }
}
