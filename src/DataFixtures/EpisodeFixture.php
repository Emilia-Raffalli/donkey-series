<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class EpisodeFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [SeasonFixture::class];
    }
    public function load(ObjectManager $manager): void
    {

        $seasons = $manager->getRepository(Season::class)->findAll();
        
        foreach ($seasons as $season) {
            for ($i=1 ; $i<=12 ; $i++) {
                $episode = new Episode();
                $episode->setTitle('Episode ' . $i);
                $episode->setNumber($i);
                $episode->setSynopsis('Synopsis de l\'épisode ' . $i . ' de ' . $season->getProgram()->getTitle());
                $episode->setSeason($season);

                $manager->persist($episode);


            }
        }

        $manager->flush();
 
    }
}
