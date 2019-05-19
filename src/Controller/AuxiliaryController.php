<?php

namespace App\Controller;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuxiliaryController extends AbstractController
{
    /**
     * @Route("/api/check", name="check", methods={"GET"})
     * @ApiProperty()
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(['status' => 'OK'], JsonResponse::HTTP_OK);
    }
}
