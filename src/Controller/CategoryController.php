<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }




    #[Route('/category/new', name: 'app_category_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/category_new.html.twig', [
            'form' => $form
        ]);
            
     }


     #[Route('/category/edit/{id<^\d+$>}', name: 'app_category_edit')]
    public function edit(Request $request, EntityManagerInterface $em, Category $category ): Response
    {

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/category_edit.html.twig', [
            'form' => $form,
            'category' => $category
        ]);
            
     }








     #[Route('/category/{id<^\d+$>}/delete', name:'app_category_delete')]
     public function delete(Category $category, EntityManagerInterface $em): Response
     {
         $em->remove($category);
         $em->flush();
     
         return $this->redirectToRoute('app_category');
     }
 




    #[Route('/category/{categoryName}', name: 'app_category_show', methods: ['GET'])]
    public function show(string $categoryName, CategoryRepository $categoryRepository, EntityManagerInterface $em): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException("Aucune catégorie trouvée avec le nom = $categoryName");
            
        }

        $programs = $em->getRepository(Program::class)
            ->findBy(['category' => $category], ['id' => 'DESC'], 3);

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
        ]);
    }

    

}
