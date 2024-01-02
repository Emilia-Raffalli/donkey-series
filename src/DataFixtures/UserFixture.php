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
        $user->setPassword('$2y$13$/PX1fdR87QMQ1fcMg97st.MW.RU84Qchs.DGd9PTdsCbk.3a1r1/O');

        $manager->persist($user);

        $manager->flush();
    }
}
