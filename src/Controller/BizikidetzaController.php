<?php

namespace App\Controller;

use App\Entity\Bizikidetza;
use App\Form\BizikidetzaType;
use App\Repository\BizikidetzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/{_locale<%supported_locales%>}/bizikidetza")
 */
class BizikidetzaController extends AbstractController
{
    /**
     * @Route("/", name="bizikidetza_index", methods={"GET"})
     */
    public function index(BizikidetzaRepository $bizikidetzaRepository): Response
    {
        return $this->render('bizikidetza/index.html.twig', [
            'bizikidetzas' => $bizikidetzaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bizikidetza_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bizikidetza = new Bizikidetza();
        $form = $this->createForm(BizikidetzaType::class, $bizikidetza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bizikidetza);
            $entityManager->flush();

            return $this->redirectToRoute('bizikidetza_index');
        }

        return $this->render('bizikidetza/new.html.twig', [
            'bizikidetza' => $bizikidetza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bizikidetza_show", methods={"GET"})
     */
    public function show(Bizikidetza $bizikidetza): Response
    {
        return $this->render('bizikidetza/show.html.twig', [
            'bizikidetza' => $bizikidetza,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bizikidetza_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bizikidetza $bizikidetza): Response
    {
        $form = $this->createForm(BizikidetzaType::class, $bizikidetza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bizikidetza_index');
        }

        return $this->render('bizikidetza/edit.html.twig', [
            'bizikidetza' => $bizikidetza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bizikidetza_delete", methods={"POST"})
     */
    public function delete(Request $request, Bizikidetza $bizikidetza): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bizikidetza->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bizikidetza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bizikidetza_index');
    }
}
