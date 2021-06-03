<?php

namespace App\Controller;

use App\Entity\Eragilea;
use App\Form\EragileaType;
use App\Repository\EragileaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/{_locale<%supported_locales%>}/eragilea")
 */
class EragileaController extends AbstractController
{

    /**
     * @Route("/", name="eragilea_index", methods={"GET"})
     */
    public function index(EragileaRepository $eragileaRepository, TranslatorInterface $translator ): Response
    {
    
        
        //echo "zzzAAA>>>>: ". print_r($translator,1);
        
        $edit=$translator->trans("edit");
        
        
        $options = array(
            'decorate' => true,
            'rootOpen' => '<ul>',
            'rootClose' => '</ul>',
            'childOpen' => '<li>',
            'childClose' => '</li>',
            'nodeDecorator' => function($node ) {
                
                return $node['eragilea_eu'] . ' // ' . $node['eragilea_es'] .'<a href="'.$this->generateUrl('eragilea_edit', array('id'=>$node['id']) ).'">'.'edit'.'</a>';
            }
        );
        $htmlTree = $eragileaRepository->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* true: load all children, false: only direct */
            $options
        );
    
    
    
    
    
    
    
    
        //$repo = $em->getRepository('Entity\Eragilea');

        //$tree = $eragileaRepository->createQueryBuilder('node')->getQuery()
         //   ->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true)
         //   ->getResult('tree');
        
        $tree = $eragileaRepository->getNodesHierarchy();
        return $this->render('eragilea/index.html.twig', [
            'eragileas' => $eragileaRepository->findAll(),
            'htmlTree' => $htmlTree
            //'eragileas' =>$tree
        ]);
    }

    /**
     * @Route("/new", name="eragilea_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $eragilea = new Eragilea();
        $form = $this->createForm(EragileaType::class, $eragilea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eragilea);
            $entityManager->flush();

            return $this->redirectToRoute('eragilea_index');
        }

        return $this->render('eragilea/new.html.twig', [
            'eragilea' => $eragilea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eragilea_show", methods={"GET"})
     */
    public function show(Eragilea $eragilea): Response
    {
        return $this->render('eragilea/show.html.twig', [
            'eragilea' => $eragilea,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="eragilea_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Eragilea $eragilea): Response
    {
        $form = $this->createForm(EragileaType::class, $eragilea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('eragilea_index');
        }

        return $this->render('eragilea/edit.html.twig', [
            'eragilea' => $eragilea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eragilea_delete", methods={"POST"})
     */
    public function delete(Request $request, Eragilea $eragilea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eragilea->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eragilea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('eragilea_index');
    }
}
