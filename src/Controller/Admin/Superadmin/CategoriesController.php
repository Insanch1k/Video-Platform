<?php

namespace App\Controller\Admin\Superadmin;

use App\Utils\AbstractClasses\CategoryTreeAdminOptionList;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Utils\AbstractClasses\CategoryTreeAdminList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends AbstractController{

    public function saveCategory($category, $form, Request $request)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $category->setName($request->request->get('category')['name']);
            $repository = $this->getDoctrine()->getRepository(Category::class);
            $parent = $repository->find($request->request->get('category')['parent']);
            $category->setParent($parent);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return true;
        }
        return false;
    }


    /**
     * @Route("/su/delete-category/{id}", name="delete_category")
     */
    public function deleteCategory(Category $category)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();
        return $this->redirectToRoute('categories');
    }

    /**
     * @Route("/su/edit-category/{id}", name="edit_category", methods={"GET","POST" })
     */
    public function editCategory(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $is_valid = null;

        if ($this->saveCategory($category, $form, $request))
        {
            return $this->redirectToRoute('categories');
        }
        elseif ($request->isMethod('post'))
        {
            $is_valid = 'is-invalid';
        }

        return $this->render('admin/edit_category.html.twig',[
            'category' => $category,
            'form'=>$form->createView(),
            'is_invalid'=> $is_valid
        ]);
    }

    /**
     * @Route("/su/categories", name="categories", methods={"GET", "POST"})
     */
    public function categories(CategoryTreeAdminOptionList $categories, Request $request)
    {
        $categories->getCategoryList($categories->buildTree());

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $is_valid = null;

        if ($this->saveCategory($category, $form, $request))
        {
            return $this->redirectToRoute('categories');
        }
        elseif ($request->isMethod('post'))
        {
            $is_valid = 'is-invalid';
        }

        return $this->render('admin/categories.html.twig',[
            'categories'=>$categories->categorylist,
            'form'=>$form->createView(),
            'is_invalid'=> $is_valid
        ]);
    }

    public function getAllCategories(CategoryTreeAdminOptionList $categories,
                                     $editedCategory = 0)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $categories->getCategoryList($categories->buildTree());
        return $this->render('admin/_all_categories.html.twig', [
            'categories' => $categories,
            'editedCategory' => $editedCategory
        ]);
    }

}