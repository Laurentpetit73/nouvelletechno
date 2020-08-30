<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(AnnonceRepository $repo)
    {
        $annonces = $repo->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'annonces' => $annonces
        ]);
    }
}
