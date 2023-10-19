<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\ProfilType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class ProfilController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }



    #[IsGranted('ROLE_USER')]
    #[Route('/profil', name: 'app_profil')]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $this->getUser()->getId();
        $user = $entityManager->getRepository(User::class)->find($id);

        $form = $this->createForm(ProfilType::class, $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();
                $entityManager = $this->manager;
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('app_profil');
            }
        }
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'form' => $form->createView(),
        ]);
    }
}