<?php

namespace App\Controller;

use App\Entity\Arrazoia;
use App\Entity\Balioespena;
use App\Entity\Egoera;
use App\Entity\Fitxak;
use App\Form\FitxakSearchFormType;
use App\Form\FitxakType;
use App\Repository\FitxakRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale<%supported_locales%>}/fitxak')]
class FitxakController extends BaseController
{

    public function __construct(private readonly Security $security, private readonly FitxakRepository $fitxakRepository, private readonly EntityManagerInterface $em)
    {
    }

    #[Route(path: '/', name: 'fitxak_index', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $this->loadQueryParameters($request);
        $filters = $this->preloadFilter();
        $form = $this->createForm(FitxakSearchFormType::class, $filters, [

        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $filters = $form->getData();
            if ( isset($filters['toDate']) && $filters['toDate'] !== null ) {
                $filters['toDate'] = DateTime::createFromFormat('Y-m-d H:i:s', ($filters['toDate'])->format('Y-m-d'). ' 23:59:59' );
            }
            $this->queryParams['page'] = 0;
        }
        $fitxaks = $this->fitxakRepository->findFitxakByCriteria($filters);
        return $this->render('fitxak/index.html.twig', [
            'fitxaks' => $fitxaks,
            'form' => $form,
        ]);
    }

    #[Route(path: '/new', name: 'fitxak_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $fitxak = new Fitxak();
        $form = $this->createForm(FitxakType::class, $fitxak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($fitxak);
            $this->em->flush();

            return $this->redirectToRoute('fitxak_index');
        }

        return $this->render('fitxak/new.html.twig', [
            'fitxak' => $fitxak,
            'form' => $form
        ]);
    }

    #[Route(path: '/{id}', name: 'fitxak_show', methods: ['GET'])]
    public function show(Request $request, Fitxak $fitxak): Response
    {
        $this->loadQueryParameters($request);
        return $this->render('fitxak/show.html.twig', [
            'fitxak' => $fitxak,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'fitxak_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fitxak $fitxak): Response
    {
        $this->loadQueryParameters($request);
        $form = $this->createForm(FitxakType::class, $fitxak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('fitxak_index');
        }

        $validate_error = "false";
        if ($form->isSubmitted() && !$form->isValid()) {
            $validate_error = "true";
        }

        return $this->render('fitxak/edit.html.twig', [
            'fitxak' => $fitxak,
            'form' => $form,
            'validateError' => $validate_error
        ]);
    }

    #[Route(path: '/{id}/assign-me', name: 'fitxak_assign_me', methods: ['GET', 'POST'])]
    public function assign(Request $request, Fitxak $fitxak) {
        $this->loadQueryParameters($request);
        /** @var User $user */
        $user = $this->getUser();
        $fitxak->setErabiltzailea($user->getUsername());
        $this->em->persist($fitxak);
        $this->em->flush();
        return $this->redirect($request->get('returnUrl'));
    }

    #[Route(path: '/{id}', name: 'fitxak_delete', methods: ['POST'])]
    public function delete(Request $request, Fitxak $fitxak): Response
    {
        $returnUrl = $request->get('returnUrl');
        if ($this->isCsrfTokenValid('delete' . $fitxak->getId(), $request->request->get('_token'))) {
            $this->em->remove($fitxak);
            $this->em->flush();
        }

        return $this->redirect($returnUrl);
    }

    private function preloadFilter() {
        $params = [];
        foreach ($this->queryParams as $key => $value) {
            if ( $key !== 'page' && $key !== 'pageSize' && $key !== 'sortName' && $key !== 'sortOrder' && $key !== 'returnUrl' ) {
                if ( $key === 'egoera') {
                    $egoera = $this->em->getRepository(Egoera::class)->find($value);
                    $params[$key] = $egoera;
                } elseif ( $key === 'balioespena' ) {
                    $balioespena = $this->em->getRepository(Balioespena::class)->find($value);
                    $params[$key] = $balioespena;
                } elseif ( $key === 'arrazoiaBigarrenMaila' ) {
                    $arrazoia = $this->em->getRepository(Arrazoia::class)->find($value);
                    $params[$key] = $arrazoia;
                } elseif ( $key === 'arrazoia' ) {
                    $arrazoia = $this->em->getRepository(Arrazoia::class)->find($value);
                    $params[$key] = $arrazoia;
                }
                elseif ( $key === 'fromDate' ) {
                    $date = DateTime::createFromFormat('Y-m-d', $value);
                    $params[$key] = $date;
                }
                elseif ( $key === 'toDate' ) {
                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $value. ' 23:59:59');
                    $params[$key] = $date;
                }
                else {
                    $params[$key] = $value;
                }
            }
        }
        return $params;
    }

}