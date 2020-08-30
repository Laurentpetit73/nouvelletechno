<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AnnonceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
     /**
     * @Route("/annonce/ajout", name="annonce_ajout")
     */
    public function ajoutAnnonce(Request $request)
    {
        $annonce = new Annonce;
        $form = $this->createForm(AnnonceType::class,$annonce);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $annonce->setActive(false);
            $annonce->setUsers($this->getUser());
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($annonce);
            $manager->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('user/annonce/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
