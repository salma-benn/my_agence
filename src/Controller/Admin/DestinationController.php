<?php

namespace App\Controller\Admin;

use App\Entity\Destination;
use App\Form\DestinationType;
use App\Repository\DestinationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/destinations')]
class DestinationController extends AbstractController
{
    #[Route('/', name: 'app_admin_destination')]
    public function index(DestinationRepository $destinationRepository): Response
    {
        $destinations = $destinationRepository->findAll();
        return $this->render('admin/destination/list.html.twig', [
            'destinations' => $destinations,
        ]);
    }


    #[Route('/new', name: 'destinations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $destination = new Destination();
        $form = $this->createForm(DestinationType::class, $destination);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_destination', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/destination/new.html.twig', [
            'destination' => $destination,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'destinations_show', methods: ['GET'])]
    public function show(Destination $destination): Response
    {
        return $this->render('admin/destination/show.html.twig', [
            'destination' => $destination,
        ]);
    }

    #[Route('/{id}/edit', name: 'destinations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Destination $destination, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DestinationType::class, $destination);
        $form->handleRequest($request);
        $picture = $destination->getPicture();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($destination);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_destination', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/destination/edit.html.twig', [
            'destination' => $destination,
            'picture'=> $picture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'destinations_delete', methods: ['POST'])]
    public function delete(Request $request, Destination $destination, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$destination->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($destination);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_destination', [], Response::HTTP_SEE_OTHER);
    }
}
