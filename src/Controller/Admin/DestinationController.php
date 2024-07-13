<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DestinationController extends AbstractController
{
    #[Route('/admin/destination', name: 'app_admin_destination')]
    public function index(): Response
    {
        return $this->render('admin/destination/index.html.twig', [
            'controller_name' => 'DestinationController',
        ]);
    }
}
