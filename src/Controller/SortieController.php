<?php


namespace App\Controller;


use App\Entity\Campus;
use App\Entity\Participant;
use App\Entity\Sortie;

use App\Form\SortieType;

use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


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
    public function create(Request $request, EntityManagerInterface $em, Security $security): Response
    {
        $sortie = new Sortie();
        $user = $security->getUser();
        $admin = $em->getRepository(Participant::class)->find(8);
        $campus = $em->getRepository(Campus::class)->find(1);

        $formSortie=$this->createForm(SortieType::class, $sortie);
        $formSortie->handleRequest($request);

        if($formSortie ->isSubmitted() &&$formSortie->isValid()){
            $sortie -> setEtat("En cours");
            $sortie ->setOrganisateur($admin);
            $sortie ->setCampus($campus);
            $sortie ->setLieu($campus);

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