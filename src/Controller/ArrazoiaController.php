<?php

namespace App\Controller;

use App\Entity\Arrazoia;
use App\Form\ArrazoiaType;
use App\Repository\ArrazoiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale<%supported_locales%>}/arrazoia")
 */
class ArrazoiaController extends AbstractController
{
    /**
     * @Route("/", name="arrazoia_index", methods={"GET"})
     */
    public function index(Request $request, ArrazoiaRepository $arrazoiaRepository): Response
    {
        $locale = $request->getLocale();
        
        return $this->render('arrazoia/index.html.twig', [
            //'arrazoias' => $arrazoiaRepository->findAll(),
            'arrazoias' => $arrazoiaRepository->treeList(),
            
        ]);
    }

    /**
     * @Route("/new", name="arrazoia_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
    
                
        $arrazoia = new Arrazoia();
        $form = $this->createForm(ArrazoiaType::class, $arrazoia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($arrazoia);
            $entityManager->flush();

            return $this->redirectToRoute('arrazoia_index');
        }

        return $this->render('arrazoia/new.html.twig', [
            'arrazoia' => $arrazoia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="arrazoia_show", methods={"GET"})
     */
    public function show(Arrazoia $arrazoia): Response
    {
        return $this->render('arrazoia/show.html.twig', [
            'arrazoia' => $arrazoia,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="arrazoia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Arrazoia $arrazoia): Response
    {
        $form = $this->createForm(ArrazoiaType::class, $arrazoia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arrazoia_index');
        }

        return $this->render('arrazoia/edit.html.twig', [
            'arrazoia' => $arrazoia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="arrazoia_delete", methods={"POST"})
     */
    public function delete(Request $request, Arrazoia $arrazoia): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arrazoia->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($arrazoia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('arrazoia_index');
    }
}
