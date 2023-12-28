<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;


class SeasonFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            ProgramFixture::class, // j'invoque la classe ProgramFixture dont dépend ma requête suivante
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $programs = $manager->getRepository(Program::class)->findAll(); // je récupère tous les programmes de ProgramFixture

        foreach ($programs as $program) {
            for ($i = 1; $i <= 3; $i++) {  // je crée 3 saisons pour chaque programme
                $season = new Season();
                $season->setProgram($program);
                $season->setDescription('Saison ' . $i . ' de ' . $program->getTitle());
                $season->setNumber($i);

                $manager->persist($season);
            }
        }

        $manager->flush();
    }
}