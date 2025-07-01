<?php

namespace App\Controller;

use App\Repository\ArrazoiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: '/{_locale<%supported_locales%>}/arrazoia')]
class ApiController extends AbstractController
{
    public function __construct(private readonly ArrazoiaRepository $repo, private readonly SerializerInterface $serializer)
    {
    }

    #[Route(path: '/children', name: 'api_get_arrazoiak', methods: ['GET'])]
    public function listLevel(Request $request): JsonResponse
    {
        $id = $request->get('id');
        if ( null == $id ) {
            return JsonResponse::fromJsonString('[]');
        }
        $children = $this->repo->arrazoiaByParent($id);
        $jsonContent = $this->serializer->serialize($children, 'json', [
            'groups' => 'list'
        ]);

        return JsonResponse::fromJsonString($jsonContent);
    }
}
