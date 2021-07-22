<?php

namespace App\Controller;

use App\Entity\Upload;
use App\Form\RegistrationFormType;
use App\Form\UploadType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class UploadController extends AbstractController
{
    /**
     * @Route("/image", name="upload")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $upload = new Upload;
        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $upload->getName();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move($this->getParameter('images_directory'), $fileName);
            $upload->setName($fileName);


            $entityManager->persist($upload);
            $entityManager->flush();

            $this->addFlash('notice',
                'Votre profil à bien été créé !!'
            );

            return $this->redirectToRoute('affichage');
        }
        return $this->render('upload/image.html.twig', ['upload' => $form->createView()]);
    }
}


