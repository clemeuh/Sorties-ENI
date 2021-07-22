<?php

namespace App\Controller;


use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilControllerTest extends AbstractController
{
    /**
     * @Route ("/accueiltest", name="accueiltest")
     */
    public function accueil(EntityManagerInterface $em) {

        $user = $em->getRepository(Participant::class);

        return $this->render('accueil/accueiltest.html.twig', [
            'user' => $user,
        ]);
    }
}