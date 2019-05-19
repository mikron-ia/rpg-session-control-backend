<?php

namespace App\Controller;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Epic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EpicsController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * EpicsController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/api/get-epics", name="epics")
     */
    public function getEpics(): JsonResponse
    {
        $epicRepository = $this->entityManager->getRepository(Epic::class);

        $epics = $epicRepository->findAll();

        $epicsArray = [];

        foreach ($epics as $epic) {
            /** @var Epic $epic */
            $epicsArray[] = [
                'name' => $epic->getName(),
                'system' => $epic->getSystem()->getName(),
                'sessions' => $epic->getGameCount(),
            ];
        }

        return new JsonResponse($epicsArray, JsonResponse::HTTP_OK);
    }
}
