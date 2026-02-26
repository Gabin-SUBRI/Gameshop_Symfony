<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Repository\JeuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(JeuRepository $jeuRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'jeux' => $jeuRepository->findAll(),
        ]);
    }

    #[Route('/jeu/ajouter', name: 'app_admin_ajouter')]
public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
{
    if ($request->isMethod('POST')) {
        $fichier = $request->files->get('image');
        $nomFichier = uniqid() . '.' . $fichier->getClientOriginalExtension();
        $fichier->move($this->getParameter('kernel.project_dir') . '/public/images', $nomFichier);

        $jeu = new Jeu();
        $jeu->setNom($request->request->get('nom'));
        $jeu->setPrix((float) $request->request->get('prix'));
        $jeu->setImage('images/' . $nomFichier);
        $jeu->setGenre($request->request->get('genre'));
        $jeu->setDescription($request->request->get('description'));
        $jeu->setStock((int) $request->request->get('stock'));

        $entityManager->persist($jeu);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin');
    }

    return $this->render('admin/ajouter.html.twig');
}

    #[Route('/jeu/supprimer/{id}', name: 'app_admin_supprimer')]
    public function supprimer(int $id, JeuRepository $jeuRepository, EntityManagerInterface $entityManager): Response
    {
        $jeu = $jeuRepository->find($id);

        if ($jeu) {
            $entityManager->remove($jeu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin');
    }
}