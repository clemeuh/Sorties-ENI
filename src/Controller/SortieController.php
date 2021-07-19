<?php


namespace App\Controller;


use App\Entity\Sortie;

use App\Form\SortieType;

use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;





/**
 * @Route("/sortie")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/detail/{id}", name="sortie_detail")
     *
     */
    public function detail(int $id, SortieRepository $sortieRepository): Response {
        $sortie = $sortieRepository->find($id);
        if (!$sortie) {
            throw $this->createNotFoundException("Sortie non trouvé");

        }
        return $this->render('sortie/detailSortie.html.twig', [
            'sortie' => $sortie
        ]);
    }

    /**
     * @Route("/create", name="sortie_create")
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $sortie = new Sortie();
        $formSortie=$this->createForm(SortieType::class, $sortie);
        $formSortie->handleRequest($request);
        if($formSortie ->isSubmitted() &&$formSortie->isValid()){
            $em->persist($sortie);
            $em->flush();
            $this->addFlash("success","La sortie a bien été créee");
            return $this->redirectToRoute("sortie_detail", ['id'=>$sortie->getID()]);
         }
        return $this->render("sortie/createSortie.html.twig", [
            'formSortie' => $formSortie->createView()
        ]);

    }
    
  }