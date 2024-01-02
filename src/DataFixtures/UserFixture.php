<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('$2y$13$BmHsQdJRNYTT6lSnyllveuufkBgoyPhPz7OCl1fABTYv58AbZUvoy');

        $manager->persist($user);

        $manager->flush();
    }
}
