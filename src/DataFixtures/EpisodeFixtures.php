<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'name' => 'La veuve noire',
            'synopsis' => "Six mois après la mort de son mari, Norma Bates et son fils, Norman, déménagent à White Bine Bay, dans l'Oregon. Elle a acheté un hôtel dans une vente aux enchères. Le site est petit, mais elle espère faire tourner cette affaire malgré les mises en garde et les menaces de l'ancien propriétaire Keith Summers. La ville projette, en effet, de construire une route contournant la ville.",
            'number' => 1,
            'seasonReference' => 'saison_1_BatesMotel',
        ],
        [
            'name' => 'Suspicions',
            'synopsis' => "Dylan, le fils aîné de Norma issu d'un précédent mariage, arrive en ville. Les relations tendues qu'il entretient avec sa mère bousculent l'équilibre de la famille...",
            'number' => 2,
            'seasonReference' => 'saison_1_BatesMotel',
        ],
        [
            'name' => 'Hello, New York !',
            'synopsis' => "Hannah, 24 ans, vit à New York et rêve de devenir écrivaine. Elle tombe des nues lorsque ses parents annoncent qu'ils ont décidé de lui couper les vivres. Elle trouve un peu de réconfort dans les bras d'Adam, un acteur excentrique qu'elle fréquente lorsqu'il daigne répondre à ses messages.",
            'number' => 1,
            'seasonReference' => 'saison_1_Girls',
        ],
        [
            'name' => 'Episode 1',
            'synopsis' => "La découverte d'un corps qui serait celui de son frère Axel conduit Zoe Walker à Ibiza. Là-bas, elle renoue avec Marcus, un vieil ami d'Axel, DJ et trafiquant de drogue.",
            'number' => 1,
            'seasonReference' => 'saison_1_WhiteLines',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $episodeName) {
            $episode = new Episode();
            $episode->setName($episodeName['name']);
            $episode->setSeason($this->getReference($episodeName['seasonReference']));
            $episode->setNumber($episodeName['number']);
            $episode->setSynopsis($episodeName['synopsis']);

            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont EpisodeFixtures dépend
        return [
            SeasonFixtures::class,
            
        ];
    }
}
