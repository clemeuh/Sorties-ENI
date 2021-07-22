<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\CreationCampusType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * @Route("/campus", name="campus")
     */
    public function listesCampus(EntityManagerInterface $entityManager, Request $request): Response
    {
        $campus = new Campus();
        $campusliste = $entityManager->getRepository(Campus::class)->findAll();
        $CampusForm = $this->createForm(CreationCampusType::class, $campus);


        $CampusForm->handleRequest($request);

        if ($CampusForm->isSubmitted() && $CampusForm->isValid()) {
            $entityManager->persist($campus);
            $entityManager->flush();

            $this->addFlash('success', 'Campus ajouté !');
            return $this->redirectToRoute('campus');
        }

        return $this->render('campus/CampusEdit.html.twig', [
            'campusForm' => $CampusForm->createView(),
            'campus' => $campusliste
        ]);
    }
    /* /**
     * @Route("/CreationCampus", name="app_CreationCampus")
     */
    /* public function create(Request $request, EntityManagerInterface $entityManager): Response
     {
         $campus = new Campus();
         $CampusForm = $this->createForm(CreationCampusType::class, $campus);

         $CampusForm->handleRequest($request);

         if ($CampusForm->isSubmitted() && $CampusForm->isValid()){
             $entityManager->persist($campus);
             $entityManager->flush();

             $this->addFlash('success', 'Campus ajouté !');
             return $this->redirectToRoute('app_login');
         }

         return $this->render('registration/CreationCampus.html.twig', [
             'campusForm' => $CampusForm->createView()
         ]);
     }

    return $this->render('registration/CreationCampus.html.twig', [
             'campusForm' => $CampusForm->createView()
         ]);
 }*/
}