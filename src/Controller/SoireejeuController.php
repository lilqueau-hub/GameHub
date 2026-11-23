<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SoireejeuController extends AbstractController
{
    #[Route('/soireejeu', name: 'app_soireejeu')]
    public function index(): Response
    {
        return $this->render('soireejeu/index.html.twig', [
            'controller_name' => 'SoireejeuController',
        ]);
    }
}
