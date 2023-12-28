<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class ProgramFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $programsData = [
            [
                'title' => 'Walking Dead',
                'synopsis' => 'Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BZmFlMTA0MmUtNWVmOC00ZmE1LWFmMDYtZTJhYjJhNGVjYTU5XkEyXkFqcGdeQXVyMTAzMDM4MjM0._V1_.jpg',
                'category_id' => CategoryFixture::CAT_HORROR,
            ],
            [
                'title' => 'The Haunting Of Hill House',
                'synopsis' => 'Plusieurs frères et sœurs qui, enfants, ont grandi dans la demeure qui allait devenir la maison hantée la plus célèbre des États-Unis, sont contraints de se réunir pour finalement affronter les fantômes de leur passé.',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BMTU4NzA4MDEwNF5BMl5BanBnXkFtZTgwMTQxODYzNjM@._V1_SY1000_CR0,0,674,1000_AL_.jpg',
                'category_id' => CategoryFixture::CAT_HORROR,
            ],
            [
                'title' => 'American Horror Story',
                'synopsis' => 'A chaque saison, son histoire. American Horror Story nous embarque dans des récits à la fois poignants et cauchemardesques, mêlant la peur, le gore et le politiquement correct.',
                'poster' => 'https://m.media-amazon.com/images/M/MV5BODZlYzc2ODYtYmQyZS00ZTM4LTk4ZDQtMTMyZDdhMDgzZTU0XkEyXkFqcGdeQXVyMzQ2MDI5NjU@._V1_SY1000_CR0,0,666,1000_AL_.jpg',
                'category_id' => CategoryFixture::CAT_HORROR,
            ],
        ];


        foreach ($programsData as $programData) {
            
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setPoster($programData['poster']);
            $program->setCategory($this->getReference($programData['category_id']));

            // $program->setCategory($programData['category_id']);
            // $program->setCategory($this->getReference(CategoryFixtures::));


            $manager->persist($program);

            $manager->flush();

        }

    }

}

