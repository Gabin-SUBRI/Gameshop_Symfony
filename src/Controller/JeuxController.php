<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;

final class JeuxController extends AbstractController
{
    public function __construct(private RequestStack $requestStack) {}

    #[Route('/jeux', name: 'app_jeux')]
    public function index(): Response
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);

        $jeux = [
    ['nom' => 'Valorant', 'prix' => 0, 'image' => 'images/Valorant.jpg', 'genre' => 'FPS', 'description' => 'Un FPS tactique 5v5 gratuit développé par Riot Games. Choisis ton agent et utilise ses capacités pour éliminer l\'équipe adverse.'],
    ['nom' => 'Elden Ring', 'prix' => 59.99, 'image' => 'images/elden_ring.jpg', 'genre' => 'RPG', 'description' => 'Un RPG open world difficile et immersif développé par FromSoftware. Explore les Terres Intermédiaires et affronte des boss légendaires.'],
    ['nom' => 'Rocket League', 'prix' => 0, 'image' => 'images/rocket_league.jpg', 'genre' => 'Sport', 'description' => 'Un jeu de football avec des voitures rocket-propulsées. Marque des buts spectaculaires dans des matchs 1v1 jusqu\'à 4v4.'],
    ['nom' => 'Minecraft', 'prix' => 26.95, 'image' => 'images/minecraft.jpg', 'genre' => 'Survie / Créatif', 'description' => 'Le jeu de construction et de survie le plus vendu au monde. Construis, explore et survie dans un monde généré aléatoirement.'],
    ['nom' => 'Smash Bros Ultimate', 'prix' => 59.99, 'image' => 'images/smash_bros.avif', 'genre' => 'Combat', 'description' => 'Le jeu de combat ultime avec plus de 80 personnages issus de franchises Nintendo et au-delà. Affronte tes amis en local ou en ligne.'],
    ['nom' => 'Hades', 'prix' => 24.99, 'image' => 'images/hades.avif', 'genre' => 'Roguelike', 'description' => 'Un roguelike d\'action où tu incarnes Zagreus, fils du dieu des Enfers, tentant de s\'échapper du royaume de son père.'],
    ['nom' => 'Animal Crossing', 'prix' => 49.99, 'image' => 'images/animal_crossing.avif', 'genre' => 'Simulation', 'description' => 'Crée ta vie de rêve sur une île déserte. Pêche, collectionne des insectes, décore ton île et rends visite à tes voisins animaux.'],
    ['nom' => 'The Legend of Zelda', 'prix' => 69.99, 'image' => 'images/zelda.jpg', 'genre' => 'Aventure', 'description' => 'Tears of the Kingdom, la suite de Breath of the Wild. Explore Hyrule dans toutes ses dimensions avec de nouveaux pouvoirs inédits.'],
    ['nom' => 'Stardew Valley', 'prix' => 13.99, 'image' => 'images/stardew_valley.jpg', 'genre' => 'Simulation', 'description' => 'Quitte la ville pour reprendre la ferme de ton grand-père. Cultive, élève des animaux, explore des mines et crée des liens avec les habitants.'],
    ['nom' => 'Guild Wars 2', 'prix' => 0, 'image' => 'images/guild_wars_2.jpg', 'genre' => 'MMO RPG', 'description' => 'Un MMO RPG gratuit avec un monde vivant et dynamique. Explore Tyrie, rejoins des guildes et affronte des boss géants en groupe.'],
];

        $total = 0;
        foreach ($jeux as $jeu) {
            if (in_array($jeu['nom'], $panier)) {
                $total += $jeu['prix'];
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
    $jeux = [
        ['nom' => 'Valorant', 'prix' => 0, 'image' => 'images/Valorant.jpg', 'genre' => 'FPS', 'description' => 'Un FPS tactique 5v5 gratuit développé par Riot Games. Choisis ton agent et utilise ses capacités pour éliminer l\'équipe adverse.'],
        ['nom' => 'Elden Ring', 'prix' => 59.99, 'image' => 'images/elden_ring.jpg', 'genre' => 'RPG', 'description' => 'Un RPG open world difficile et immersif développé par FromSoftware. Explore les Terres Intermédiaires et affronte des boss légendaires.'],
        ['nom' => 'Rocket League', 'prix' => 0, 'image' => 'images/rocket_league.jpg', 'genre' => 'Sport', 'description' => 'Un jeu de football avec des voitures rocket-propulsées. Marque des buts spectaculaires dans des matchs 1v1 jusqu\'à 4v4.'],
        ['nom' => 'Minecraft', 'prix' => 26.95, 'image' => 'images/minecraft.jpg', 'genre' => 'Survie / Créatif', 'description' => 'Le jeu de construction et de survie le plus vendu au monde. Construis, explore et survie dans un monde généré aléatoirement.'],
        ['nom' => 'Smash Bros Ultimate', 'prix' => 59.99, 'image' => 'images/smash_bros.avif', 'genre' => 'Combat', 'description' => 'Le jeu de combat ultime avec plus de 80 personnages issus de franchises Nintendo et au-delà. Affronte tes amis en local ou en ligne.'],
        ['nom' => 'Hades', 'prix' => 24.99, 'image' => 'images/hades.avif', 'genre' => 'Roguelike', 'description' => 'Un roguelike d\'action où tu incarnes Zagreus, fils du dieu des Enfers, tentant de s\'échapper du royaume de son père.'],
        ['nom' => 'Animal Crossing', 'prix' => 49.99, 'image' => 'images/animal_crossing.avif', 'genre' => 'Simulation', 'description' => 'Crée ta vie de rêve sur une île déserte. Pêche, collectionne des insectes, décore ton île et rends visite à tes voisins animaux.'],
        ['nom' => 'The Legend of Zelda', 'prix' => 69.99, 'image' => 'images/zelda.jpg', 'genre' => 'Aventure', 'description' => 'Tears of the Kingdom, la suite de Breath of the Wild. Explore Hyrule dans toutes ses dimensions avec de nouveaux pouvoirs inédits.'],
        ['nom' => 'Stardew Valley', 'prix' => 13.99, 'image' => 'images/stardew_valley.jpg', 'genre' => 'Simulation', 'description' => 'Quitte la ville pour reprendre la ferme de ton grand-père. Cultive, élève des animaux, explore des mines et crée des liens avec les habitants.'],
        ['nom' => 'Guild Wars 2', 'prix' => 0, 'image' => 'images/guild_wars_2.jpg', 'genre' => 'MMO RPG', 'description' => 'Un MMO RPG gratuit avec un monde vivant et dynamique. Explore Tyrie, rejoins des guildes et affronte des boss géants en groupe.'],
    ];

    $jeuTrouve = null;
    foreach ($jeux as $jeu) {
        if ($jeu['nom'] === $nom) {
            $jeuTrouve = $jeu;
            break;
        }
    }

    if (!$jeuTrouve) {
        throw $this->createNotFoundException('Jeu introuvable');
    }

    return $this->render('jeux/detail.html.twig', [
        'jeu' => $jeuTrouve,
    ]);
}
}