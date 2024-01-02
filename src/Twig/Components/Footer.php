<?php

namespace App\Twig\Components;

use App\Repository\CategoryRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Footer
{
    use DefaultActionTrait;

    private CategoryRepository $categoryRepository;
    public array $categories = [];

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function mount(): array
    {
        $this->categories = $this->categoryRepository->findAll();

        return ['categories' => $this->categories];
    }


}
