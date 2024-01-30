<?php

namespace App\Controller;

use App\Entity\Bizitokia;
use App\Form\BizitokiaType;
use App\Repository\BizitokiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/bizitokia')]
class BizitokiaController extends AbstractController
{
    public function __construct(private readonly \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    
    #[Route(path: '/', name: 'bizitokia_index', methods: ['GET'])]
    public function index(BizitokiaRepository $bizitokiaRepository): Response
    {
        return $this->render('bizitokia/index.html.twig', [
            'bizitokias' => $bizitokiaRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'bizitokia_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $bizitokium = new Bizitokia();
        $form = $this->createForm(BizitokiaType::class, $bizitokium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($bizitokium);
            $entityManager->flush();

            return $this->redirectToRoute('bizitokia_index');
        }

        return $this->render('bizitokia/new.html.twig', [
            'bizitokium' => $bizitokium,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'bizitokia_show', methods: ['GET'])]
    public function show(Bizitokia $bizitokium): Response
    {
        return $this->render('bizitokia/show.html.twig', [
            'bizitokium' => $bizitokium,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'bizitokia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bizitokia $bizitokium): Response
    {
        $form = $this->createForm(BizitokiaType::class, $bizitokium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('bizitokia_index');
        }

        return $this->render('bizitokia/edit.html.twig', [
            'bizitokium' => $bizitokium,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'bizitokia_delete', methods: ['POST'])]
    public function delete(Request $request, Bizitokia $bizitokium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bizitokium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove($bizitokium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bizitokia_index');
    }
}
