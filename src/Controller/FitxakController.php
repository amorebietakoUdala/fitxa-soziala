<?php

namespace App\Controller;

use App\Entity\Fitxak;

use App\Form\FitxakType;
use App\Repository\FitxakRepository;
use App\Repository\OharrakRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;


use Symfony\Component\Security\Core\Security;


/**
 * @Route("/{_locale<%supported_locales%>}/fitxak")
 */
class FitxakController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {

        $this->security = $security;
    }

    /**
     * @Route("/", name="fitxak_index", methods={"GET"})
     */
    public function index(Request $request, FitxakRepository $fitxakRepository): Response
    {
        return $this->render('fitxak/index.html.twig', [
            'fitxaks' => $fitxakRepository->zerrenda()
        ]);
    }

    /**
     * @Route("/new", name="fitxak_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $locale = $request->getLocale();

        $fitxak = new Fitxak();
        $form = $this->createForm(FitxakType::class, $fitxak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fitxak);
            $entityManager->flush();

            return $this->redirectToRoute('fitxak_index');
        }

        return $this->render('fitxak/new.html.twig', [
            'fitxak' => $fitxak,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="fitxak_show", methods={"GET"})
     */
    public function show(Fitxak $fitxak): Response
    {
        return $this->render('fitxak/show.html.twig', [
            'fitxak' => $fitxak,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fitxak_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fitxak $fitxak): Response
    {

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(FitxakType::class, $fitxak);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fitxak_index');
        }

        $validate_error = "false";
        if ($form->isSubmitted() && !$form->isValid()) {
            $validate_error = "true";
        }

        return $this->render('fitxak/edit.html.twig', [
            'fitxak' => $fitxak,
            'form' => $form->createView(),
            'validateError' => $validate_error
        ]);
    }

    /**
     * @Route("/{id}", name="fitxak_delete", methods={"POST"})
     */
    public function delete(Request $request, Fitxak $fitxak): Response
    {
        if ($this->isCsrfTokenValid('delete' . $fitxak->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fitxak);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fitxak_index');
    }
}
