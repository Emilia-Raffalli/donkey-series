<?php

namespace App\Twig\Components;

use App\Form\CategorySearchType;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class SearchLive extends AbstractController
{
    use DefaultActionTrait;

    use ComponentWithFormTrait;

    public function instantiateForm(): FormInterface
    {

        return $this->createForm(CategoryType::class);
    }

    #[LiveProp(writable: true)]
    public ?string $query = null;
    public array $categories = [];

    public function __construct(private CategoryRepository $categoryRepository, PaginatorInterface $paginator)
    {
        
    }


    public function getCategories(): array
    {

        return $this->categoryRepository->getListQuery($this->query)->getQuery()->getResult();
    }

    #[LiveAction]
    public function save(EntityManagerInterface $em)
    {
        $this->submitForm();

        $em->persist($this->getForm()->getData());
        $em->flush();

        $this->resetForm();
    }
}
