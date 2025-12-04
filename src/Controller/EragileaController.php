<?php

namespace App\Controller;

use App\Entity\Eragilea;
use App\Form\EragileaType;
use App\Repository\EragileaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Contracts\Translation\TranslatorInterface;

#[Route(path: '/{_locale<%supported_locales%>}/eragilea')]
class EragileaController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly EragileaRepository $eragileaRepository, 
    )
    {
    }

    #[Route(path: '/', name: 'eragilea_index', methods: ['GET'])]
    public function index( ): Response
    {
        $options = ['decorate' => true, 'rootOpen' => '<ul>', 'rootClose' => '</ul>', 'childOpen' => '<li>', 'childClose' => '</li>', 'nodeDecorator' => fn($node) => $node['eragilea_eu'] . ' // ' . $node['eragilea_es'] .'<a href="'.$this->generateUrl('eragilea_edit', ['id'=>$node['id']] ).'">'.'edit'.'</a>'];
        $htmlTree = $this->eragileaRepository->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* true: load all children, false: only direct */
            $options
        );
    
        //$repo = $em->getRepository('Entity\Eragilea');

        //$tree = $this->eragileaRepository->createQueryBuilder('node')->getQuery()
         //   ->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true)
         //   ->getResult('tree');
        
        $tree = $this->eragileaRepository->getNodesHierarchy();
        return $this->render('eragilea/index.html.twig', [
            'eragileas' => $this->eragileaRepository->findAll(),
            'htmlTree' => $htmlTree
            //'eragileas' =>$tree
        ]);
    }

    #[Route(path: '/new', name: 'eragilea_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $eragilea = new Eragilea();
        $form = $this->createForm(EragileaType::class, $eragilea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($eragilea);
            $this->entityManager->flush();

            return $this->redirectToRoute('eragilea_index');
        }

        return $this->render('eragilea/new.html.twig', [
            'eragilea' => $eragilea,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'eragilea_show', methods: ['GET'])]
    public function show(Eragilea $eragilea): Response
    {
        return $this->render('eragilea/show.html.twig', [
            'eragilea' => $eragilea,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'eragilea_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, #[MapEntity(id: 'id')] Eragilea $eragilea): Response
    {
        $form = $this->createForm(EragileaType::class, $eragilea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('eragilea_index');
        }

        return $this->render('eragilea/edit.html.twig', [
            'eragilea' => $eragilea,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'eragilea_delete', methods: ['POST'])]
    public function delete(Request $request, #[MapEntity(id: 'id')] Eragilea $eragilea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eragilea->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($eragilea);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('eragilea_index');
    }
}
