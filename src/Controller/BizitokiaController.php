<?php

namespace App\Controller;

use App\Entity\Bizitokia;
use App\Form\BizitokiaType;
use App\Repository\BizitokiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale<%supported_locales%>}/bizitokia")
 */
class BizitokiaController extends AbstractController
{
    /**
     * @Route("/", name="bizitokia_index", methods={"GET"})
     */
    public function index(BizitokiaRepository $bizitokiaRepository): Response
    {
        return $this->render('bizitokia/index.html.twig', [
            'bizitokias' => $bizitokiaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bizitokia_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bizitokium = new Bizitokia();
        $form = $this->createForm(BizitokiaType::class, $bizitokium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bizitokium);
            $entityManager->flush();

            return $this->redirectToRoute('bizitokia_index');
        }

        return $this->render('bizitokia/new.html.twig', [
            'bizitokium' => $bizitokium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bizitokia_show", methods={"GET"})
     */
    public function show(Bizitokia $bizitokium): Response
    {
        return $this->render('bizitokia/show.html.twig', [
            'bizitokium' => $bizitokium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bizitokia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bizitokia $bizitokium): Response
    {
        $form = $this->createForm(BizitokiaType::class, $bizitokium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bizitokia_index');
        }

        return $this->render('bizitokia/edit.html.twig', [
            'bizitokium' => $bizitokium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bizitokia_delete", methods={"POST"})
     */
    public function delete(Request $request, Bizitokia $bizitokium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bizitokium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bizitokium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bizitokia_index');
    }
}
