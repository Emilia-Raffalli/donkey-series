<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $drama = new Category();
        $drama->setName('Drame');
        $manager->persist($drama);

        $comedy = new Category();
        $comedy->setName('Comedie');
        $manager->persist($comedy);

        $fantaisy = new Category();
        $fantaisy->setName('Fantaisie');
        $manager->persist($fantaisy);

        $thriller = new Category();
        $thriller->setName('Thriller');
        $manager->persist($thriller);

        $horror = new Category();
        $horror->setName('Horreur');
        $manager->persist($horror);

        $documentary = new Category();
        $documentary->setName('Documentaire');
        $manager->persist($documentary);

        $political = new Category();
        $political->setName('Politique');
        $manager->persist($political);

        $action = new Category();
        $action->setName('Action');
        $manager->persist($action);

        $manager->flush();
    }
}
