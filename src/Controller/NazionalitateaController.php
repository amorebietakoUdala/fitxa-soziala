<?php

namespace App\Controller;

use App\Entity\Nazionalitatea;
use App\Form\NazionalitateaType;
use App\Repository\NazionalitateaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/nazionalitatea')]
class NazionalitateaController extends AbstractController
{
    public function __construct(private readonly \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    #[Route(path: '/', name: 'nazionalitatea_index', methods: ['GET'])]
    public function index(NazionalitateaRepository $nazionalitateaRepository): Response
    {
        return $this->render('nazionalitatea/index.html.twig', [
            //'nazionalitateas' => $nazionalitateaRepository->findAll(),
            'nazionalitateas' => $nazionalitateaRepository->treeList(),
        ]);
    }

    #[Route(path: '/new', name: 'nazionalitatea_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $nazionalitatea = new Nazionalitatea();
        $form = $this->createForm(NazionalitateaType::class, $nazionalitatea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($nazionalitatea);
            $entityManager->flush();

            return $this->redirectToRoute('nazionalitatea_index');
        }

        return $this->render('nazionalitatea/new.html.twig', [
            'nazionalitatea' => $nazionalitatea,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'nazionalitatea_show', methods: ['GET'])]
    public function show(Nazionalitatea $nazionalitatea): Response
    {
        return $this->render('nazionalitatea/show.html.twig', [
            'nazionalitatea' => $nazionalitatea,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'nazionalitatea_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nazionalitatea $nazionalitatea): Response
    {
        $form = $this->createForm(NazionalitateaType::class, $nazionalitatea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('nazionalitatea_index');
        }

        return $this->render('nazionalitatea/edit.html.twig', [
            'nazionalitatea' => $nazionalitatea,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'nazionalitatea_delete', methods: ['POST'])]
    public function delete(Request $request, Nazionalitatea $nazionalitatea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nazionalitatea->getId(), $request->request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove($nazionalitatea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nazionalitatea_index');
    }
}
