<?php

namespace App\Controller;

use App\Entity\Jarduerak;
use App\Form\JarduerakType;
use App\Repository\JarduerakRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/jarduerak')]
class JarduerakController extends AbstractController
{
    public function __construct(private readonly \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    #[Route(path: '/', name: 'jarduerak_index', methods: ['GET'])]
    public function index(JarduerakRepository $jarduerakRepository): Response
    {
        return $this->render('jarduerak/index.html.twig', [
            //'jardueraks' => $jarduerakRepository->findAll(),
            'jardueraks' => $jarduerakRepository->treeList(),
        ]);
    }

    #[Route(path: '/new', name: 'jarduerak_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $jarduerak = new Jarduerak();
        $form = $this->createForm(JarduerakType::class, $jarduerak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($jarduerak);
            $entityManager->flush();

            return $this->redirectToRoute('jarduerak_index');
        }

        return $this->render('jarduerak/new.html.twig', [
            'jarduerak' => $jarduerak,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'jarduerak_show', methods: ['GET'])]
    public function show(Jarduerak $jarduerak): Response
    {
        return $this->render('jarduerak/show.html.twig', [
            'jarduerak' => $jarduerak,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'jarduerak_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jarduerak $jarduerak): Response
    {
        $form = $this->createForm(JarduerakType::class, $jarduerak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('jarduerak_index');
        }

        return $this->render('jarduerak/edit.html.twig', [
            'jarduerak' => $jarduerak,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'jarduerak_delete', methods: ['POST'])]
    public function delete(Request $request, Jarduerak $jarduerak): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jarduerak->getId(), $request->request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove($jarduerak);
            $entityManager->flush();
        }

        return $this->redirectToRoute('jarduerak_index');
    }
}
