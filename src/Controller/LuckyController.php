<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    #[Route('/lucky', name: 'app_lucky')]
    public function number(): Response
    {
        $number = random_int(0,100);
        return new response ("Hello Lucky, ton numéro chance du jour est le " .$number . "!" );
    }
}
