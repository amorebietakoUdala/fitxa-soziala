<?php

namespace App\Controller;

use App\Entity\Herria;
use App\Form\HerriaType;
use App\Repository\HerriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;

#[Route(path: '/{_locale<%supported_locales%>}/herria')]
class HerriaController extends AbstractController
{
    public function __construct(private readonly \Doctrine\Persistence\ManagerRegistry $managerRegistry)
    {
    }
    #[Route(path: '/', name: 'herria_index', methods: ['GET'])]
    public function index(HerriaRepository $herriaRepository): Response
    {
        return $this->render('herria/index.html.twig', [
            'herrias' => $herriaRepository->findAll(),
        ]);
    }
    
    
    #[Route(path: '/search', name: 'search', methods: ['GET'])]
    public function search(HerriaRepository $herriaRepository): Response
    {
        
        $t="kkk";
        
        $v=$herriaRepository->search($t);
        //echo "<br>SSSSSS:::" . print_r($v,1);
        
        return new JsonResponse($v);
        
        
    }
    
    

    #[Route(path: '/new', name: 'herria_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $herrium = new Herria();
        $form = $this->createForm(HerriaType::class, $herrium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($herrium);
            $entityManager->flush();

            return $this->redirectToRoute('herria_index');
        }

        return $this->render('herria/new.html.twig', [
            'herrium' => $herrium,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'herria_show', methods: ['GET'])]
    public function show(Herria $herrium): Response
    {
        return $this->render('herria/show.html.twig', [
            'herrium' => $herrium,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'herria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Herria $herrium): Response
    {
        $form = $this->createForm(HerriaType::class, $herrium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('herria_index');
        }

        return $this->render('herria/edit.html.twig', [
            'herrium' => $herrium,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'herria_delete', methods: ['POST'])]
    public function delete(Request $request, Herria $herrium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$herrium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove($herrium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('herria_index');
    }
}
