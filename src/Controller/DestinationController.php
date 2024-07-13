<?php

namespace App\Controller;

use App\Entity\Destination;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{

    #[Route('/destination', name: 'destination')]
    public function listDestination(Request $request, EntityManagerInterface $entityManager): Response
    {
       $destinations =  $entityManager->getRepository(Destination::class)->findAll();
        return $this->render('Destination/list.html.twig', [
            'destinations' => $destinations,
        ]);
    }

    #[Route('/destination/{id}', name: 'destination_detail')]
    public function detail(int $id, EntityManagerInterface $entityManager): Response
    {
        $destination = $entityManager->getRepository(Destination::class)->find($id);

        if (!$destination) {
            throw $this->createNotFoundException('The destination does not exist');
        }
        return $this->render('destination/detail.html.twig', [
            'destination' => $destination,
        ]);
    }
}
