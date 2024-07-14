<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Repository\DestinationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{

    #[Route('/destination', name: 'destination')]
    public function listDestination(Request $request, DestinationRepository $destinationRepository): Response
    {
        return $this->render('Destination/list.html.twig', [
            'destinations' => $destinationRepository->findAll(),
        ]);
    }

    #[Route('/destination/{id}', name: 'destination_detail')]
    public function detail(int $id, DestinationRepository $destinationRepository): Response
    {
        $destination = $destinationRepository->find($id);

        if (!$destination) {
            throw $this->createNotFoundException('The destination does not exist');
        }
        return $this->render('destination/detail.html.twig', [
            'destination' => $destination,
        ]);
    }
}
