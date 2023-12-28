<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;




class CategoryFixture extends Fixture
{
    public const CAT_DRAMA = 'CAT_DRAMA';
    public const CAT_COMEDY = 'CAT_COMEDY';
    public const CAT_FANTASY = 'CAT_FANTASY';
    public const CAT_THRILLER = 'CAT_THRILLER';
    public const CAT_HORROR = 'CAT_HORROR';
    public const CAT_DOCU = 'CAT_DOCU';
    public const CAT_POLITIC = 'CAT_POLITIC';
    public const CAT_ACTION = 'CAT_ACTION';

    public function load(ObjectManager $manager): void
    {
        $categoriesData = [
            'Drame' => self::CAT_DRAMA,
            'Comedie' => self::CAT_COMEDY,
            'Fantaisie' => self::CAT_FANTASY,
            'Thriller' => self::CAT_THRILLER,
            'Horreur' => self::CAT_HORROR,
            'Documentaire' => self::CAT_DOCU,
            'Politique' => self::CAT_POLITIC,
            'Action' => self::CAT_ACTION,
        ];

        foreach ($categoriesData as $name => $constant) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $this->addReference($constant, $category);
        }

        $manager->flush();
    }
}



// ANCIEN MODELE :

// class CategoryFixture extends Fixture
// {
//     public const CAT_DRAMA = 'CAT_DRAMA';
//     public const CAT_COMEDY = 'CAT_COMEDY';

//     public function load(ObjectManager $manager): void
//     {
//         $drama = new Category();
//         $drama->setName('Drame');
//         $manager->persist($drama);
//         $this->addReference(self::CAT_DRAMA, $drama);

//         $comedy = new Category();
//         $comedy->setName('Comédie');
//         $manager->persist($comedy);
//         $this->addReference(self::CAT_COMEDY, $comedy);


//         $manager->flush();

//     }
// }









// class CategoryFixture extends Fixture
// {
//     public function load(ObjectManager $manager): void
//     {


//         public const CAT_DRAMA = 'CAT_DRAMA';
//         public const CAT_COMEDY = 'CAT_COMEDY';
//         public const CAT_FANTAISY = 'CAT_FANTAISY';
//         public const CAT_THRILLER ='CAT_THRILLER';
//         public const CAT_HORROR ='CAT_HORROR';
//         public const CAT_DOCU ='CAT_DOCU';
//         public const CAT_POLITIC ='CAT_POLITIC';
//         public const CAT_ACTION ='CAT_ACTION';



//         $categories = [
//             'Drame',
//             'Comedie',
//             'Fantaisie',
//             'Thriller',
//             'Horreur',
//             'Documentaire',
//             'Politique',
//             'Action',
//         ];

//         foreach ($categories as $name) {

//             $category = new Category();
//             $category->setName($name);
//             $manager->persist($category);

//         }


//         $manager->flush();
//     }
// }


