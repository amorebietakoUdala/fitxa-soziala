<?php

namespace App\Controller;

use App\Entity\Balioespena;
use App\Form\BalioespenaType;
use App\Repository\BalioespenaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/balioespena')]
class BalioespenaController extends AbstractController
{
    public function __construct(private readonly \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    #[Route(path: '/', name: 'balioespena_index', methods: ['GET'])]
    public function index(BalioespenaRepository $balioespenaRepository): Response
    {
        return $this->render('balioespena/index.html.twig', [
            'balioespenas' => $balioespenaRepository->treeList(),
            //'balioespenas' => $balioespenaRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'balioespena_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $balioespena = new Balioespena();
        $form = $this->createForm(BalioespenaType::class, $balioespena);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($balioespena);
            $entityManager->flush();

            return $this->redirectToRoute('balioespena_index');
        }

        return $this->render('balioespena/new.html.twig', [
            'balioespena' => $balioespena,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'balioespena_show', methods: ['GET'])]
    public function show(Balioespena $balioespena): Response
    {
        return $this->render('balioespena/show.html.twig', [
            'balioespena' => $balioespena,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'balioespena_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Balioespena $balioespena): Response
    {
        $form = $this->createForm(BalioespenaType::class, $balioespena);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('balioespena_index');
        }

        return $this->render('balioespena/edit.html.twig', [
            'balioespena' => $balioespena,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'balioespena_delete', methods: ['POST'])]
    public function delete(Request $request, Balioespena $balioespena): Response
    {
        if ($this->isCsrfTokenValid('delete'.$balioespena->getId(), $request->request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove($balioespena);
            $entityManager->flush();
        }

        return $this->redirectToRoute('balioespena_index');
    }
}
