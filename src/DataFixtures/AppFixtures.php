<?php

namespace App\DataFixtures;

use App\Entity\Jeu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
    ['Valorant', 0, 'images/Valorant.jpg', 'FPS', 'Un FPS tactique 5v5 gratuit développé par Riot Games.', 999],
    ['Elden Ring', 59.99, 'images/elden_ring.jpg', 'RPG', 'Un RPG open world difficile et immersif développé par FromSoftware.', 5],
    ['Rocket League', 0, 'images/rocket_league.jpg', 'Sport', 'Un jeu de football avec des voitures rocket-propulsées.', 999],
    ['Minecraft', 26.95, 'images/minecraft.jpg', 'Survie / Créatif', 'Le jeu de construction et de survie le plus vendu au monde.', 10],
    ['Smash Bros Ultimate', 59.99, 'images/smash_bros.avif', 'Combat', 'Le jeu de combat ultime avec plus de 80 personnages.', 3],
    ['Hades', 24.99, 'images/hades.avif', 'Roguelike', 'Un roguelike d\'action où tu incarnes Zagreus, fils du dieu des Enfers.', 8],
    ['Animal Crossing', 49.99, 'images/animal_crossing.avif', 'Simulation', 'Crée ta vie de rêve sur une île déserte.', 0],
    ['The Legend of Zelda', 69.99, 'images/zelda.jpg', 'Aventure', 'Tears of the Kingdom, la suite de Breath of the Wild.', 7],
    ['Stardew Valley', 13.99, 'images/stardew_valley.jpg', 'Simulation', 'Quitte la ville pour reprendre la ferme de ton grand-père.', 15],
    ['Guild Wars 2', 0, 'images/guild_wars_2.jpg', 'MMO RPG', 'Un MMO RPG gratuit avec un monde vivant et dynamique.', 999],
];

        foreach ($data as [$nom, $prix, $image, $genre, $desc, $stock]) {
    $jeu = new Jeu();
    $jeu->setNom($nom);
    $jeu->setPrix($prix);
    $jeu->setImage($image);
    $jeu->setGenre($genre);
    $jeu->setDescription($desc);
    $jeu->setStock($stock);
    $manager->persist($jeu);
}

        $manager->flush();
    }
}