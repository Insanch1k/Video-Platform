<?php

namespace App\Controller\Admin\Superadmin;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Video;
use App\Form\VideoType;
use App\Utils\Interfaces\UploaderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/admin/su")
 */
class SuperAdminController extends AbstractController
{


    /**
     * @Route("/upload-video-locally", name="upload_video_locally")
     */
    public function uploadVideoLocally(Request $request, UploaderInterface $fileUploader)
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        //make upload function here

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file = $video->getUploadedVideo();

            //$filename = $fileUploader->upload($file);

            $base_path = Video::uploadFolder;

            $video->setPath($base_path);
            $video->setTitle('to-do');

            $em->persist($video);
            $em->flush();
            return $this->redirectToRoute('videos');
        }

        return $this->render('admin/upload_video_locally.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route ("/delete-video/{video}", name="delete_video", requirements={"path"=".+"})
     */
    public function deleteVideo(Video $video, UploaderInterface $fileUploader)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($video);
        $em->flush();

//        if ($fileUploader->delete($path)) {
            $this->addFlash(
                'success',
                'The video was deleted'
            );
//        } else {
//            $this->addFlash(
//                'danger',
//                'We were not able to delete'
//            );
//        }
        return $this->redirectToRoute('videos');
    }


    /**
     * @Route("/users", name="users")
     */
    public function users()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findBy([], ['name' => 'ASC']);
        return $this->render('admin/users.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route ("/delete-user/{user}", name="delete_user")
     */
    public function deleteUser(User $user)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('users');
    }

    /**
     * @Route ("/update-video-category/{video}", methods={"POST"},name="update_video_category")
     */
    public function updateVideoCategory(Request $request, Video $video)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $this->getDoctrine()->getRepository(Category::class)->find
        ($request->request->get('video_category'));

        $video->setCategory($category);
        $em->persist($video);
        $em->flush();

        return $this->redirectToRoute('videos');
    }
}