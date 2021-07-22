<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffichageController extends AbstractController
{
    /**
     * @Route("/affichage", name="affichage")
     */
    public function affichages(UserRepository $userRepository): Response
    {
        $user = new User();
        $user = $userRepository->findAll();


        return $this->render('main/affichageProfil.html.twig',);
    }
}
