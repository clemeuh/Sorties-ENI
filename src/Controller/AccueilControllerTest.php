<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilControllerTest extends AbstractController
{
    /**
     * @Route ("/accueiltest", name="accueiltest")
     */
    public function accueil() {
        return $this->render('accueil/accueiltest.html.twig');
    }
}