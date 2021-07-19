<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ModifierSortieController extends AbstractController
{
    /**
     * @Route ("/modifierSortie", name="modifierSortie")
     */
    public function accueil() {
        return $this->render('modifierSortie/modifierSortie.html.twig');
    }
}