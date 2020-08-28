<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    private $categoryRepository;
    private $entityManager;

    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $entityManager;
    }

    /**
    * @Route("/category", name="list_categories")
    * @param Request $request
    * @return Response
    */
    public function create_category(Request $request)
    {
        // Create new Category with data form
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Add Category in database
            $this->entityManager->persist($category);
            $this->entityManager->flush();

            // Add notification message
            $this->addFlash("notification", "Catégorie d'instrument " . $category->getName() . " a été ajouté");

            return $this->redirectToRoute("list_categories");
        }

        // Get all Categories
        $categories = $this->categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            "form" => $form->createView(),
            "categories" =>  $categories
        ]);
    }
}
