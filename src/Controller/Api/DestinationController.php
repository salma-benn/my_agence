<?php

namespace App\Controller\Api;

use App\Repository\DestinationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/destinations')]

class DestinationController extends AbstractController
{
    #[Route('/', name: 'app_api_destination')]
    public function list(DestinationRepository $destinationRepository): Response
    {
        $destinations = $destinationRepository->getDestinations();
        return $this->json($destinations);
    }
}
