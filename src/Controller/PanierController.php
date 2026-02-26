<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\JeuRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PanierController extends AbstractController
{
    public function __construct(private RequestStack $requestStack) {}

    #[Route('/panier', name: 'app_panier')]
    public function index(): Response
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    #[Route('/panier/ajouter/{nom}', name: 'app_panier_ajouter')]
public function ajouter(string $nom): Response
{
    $session = $this->requestStack->getSession();
    $panier = $session->get('panier', []);

    if (!in_array($nom, $panier)) {
        $panier[] = $nom;
        $session->set('panier', $panier);
    }

    return $this->redirectToRoute('app_jeux');
}

    #[Route('/panier/supprimer/{index}', name: 'app_panier_supprimer')]
    public function supprimer(int $index): Response
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);

        unset($panier[$index]);

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_jeux');
    }

    #[Route('/panier/vider', name: 'app_panier_vider')]
public function vider(): Response
{
    $session = $this->requestStack->getSession();
    $session->remove('panier');

    return $this->redirectToRoute('app_jeux');
}

#[Route('/panier/payer', name: 'app_panier_payer')]
public function payer(JeuRepository $jeuRepository, EntityManagerInterface $entityManager): Response
{
    $session = $this->requestStack->getSession();
    $panier = $session->get('panier', []);

    foreach ($panier as $nom) {
        $jeu = $jeuRepository->findOneBy(['nom' => $nom]);
        if ($jeu && $jeu->getStock() > 0) {
            $jeu->setStock($jeu->getStock() - 1);
            $entityManager->persist($jeu);
        }
    }

    $entityManager->flush();
    $session->remove('panier');

    return $this->redirectToRoute('app_confirmation');
}

}