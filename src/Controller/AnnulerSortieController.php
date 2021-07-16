<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnulerSortieController extends AbstractController
{
    /**
     * @Route ("/annulerSortie", name="annulerSortie")
     */
    public function accueil() {
        return $this->render('annulerSortie/annulerSortie.html.twig');
    }
}