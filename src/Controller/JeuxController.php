<?php

namespace App\Controller;

use App\Repository\JeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;

final class JeuxController extends AbstractController
{
    public function __construct(
        private RequestStack $requestStack,
        private JeuRepository $jeuRepository
    ) {}

    #[Route('/jeux', name: 'app_jeux')]
    public function index(): Response
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);

        $jeux = $this->jeuRepository->findAll();

        $total = 0;
        foreach ($jeux as $jeu) {
            if (in_array($jeu->getNom(), $panier)) {
                $total += $jeu->getPrix();
            }
        }

        return $this->render('jeux/index.html.twig', [
            'jeux' => $jeux,
            'panier' => $panier,
            'total' => $total,
        ]);
    }

    #[Route('/jeux/{nom}', name: 'app_jeux_detail')]
    public function detail(string $nom): Response
    {
        $jeu = $this->jeuRepository->findOneBy(['nom' => $nom]);

        if (!$jeu) {
            throw $this->createNotFoundException('Jeu introuvable');
        }

        return $this->render('jeux/detail.html.twig', [
            'jeu' => $jeu,
        ]);
    }
}