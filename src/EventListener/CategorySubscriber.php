<?php

namespace App\EventListener;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(Events::prePersist, method: 'prePersist', entity: Category::class )]
class CategorySubscriber 
{

    public function prePersist(Category $category):void
    {
        // dd($category);
    }

}