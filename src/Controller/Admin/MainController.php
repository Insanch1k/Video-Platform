<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use App\Utils\AbstractClasses\CategoryTreeAdminOptionList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route ("/admin")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="admin_main_page")
     */
    public function index(): Response
    {
        return $this->render('admin/my_profile.html.twig');
    }

    public function getAllCategories(CategoryTreeAdminOptionList $categories,
                                     $editedCategory=0)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $categories->getCategoryList($categories->buildTree());
        return $this->render('admin/_all_categories.html.twig',[
            'categories'=>$categories,
            'editedCategory'=>$editedCategory
        ]);
    }

    /**
     * @Route("/su/users", name="users")
     */
    public function users()
    {
        return $this->render('admin/users.html.twig');
    }


    /**
     * @Route("/videos", name="videos")
     */
    public function videos()
    {
        if($this->isGranted('ROLE_ADMIN'))
        {
            $videos = $this->getDoctrine()->getRepository(Video::class)->findAll();
        }
        else {
            $videos = $this->getUser()->getLikedVideos();
        }
        return $this->render('admin/videos.html.twig',[
            'videos'=>$videos
        ]);
    }
}
