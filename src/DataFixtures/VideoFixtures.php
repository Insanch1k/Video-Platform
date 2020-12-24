<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Video;
use App\Entity\Category;
use App\Entity\User;

class VideoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->VideoData() as [$title, $path, $category_id])
        {
            $duration = random_int(10,300);
            $category = $manager->getRepository(Category::class)->find($category_id);
            $video = new Video();
            $video->setTitle($title);
            $video->setPath('https://player.vimeo.com/video/'.$path);
            $video->setCategory($category);
            $video->setDuration($duration);
            $manager->persist($video);
        }

        $manager->flush();

        $this->loadLikes($manager);
        $this->loadDislikes($manager);
    }

    public function loadLikes($manager)
    {
        foreach ($this->likesData() as [$video_id, $user_id])
        {
            $video = $manager->getRepository(Video::class)->find($video_id);
            $user = $manager->getRepository(User::class)->find($user_id);

            $video->addUserThatLike($user);
            $manager->persist($video);
        }

        $manager->flush();
    }

    public function loadDislikes($manager)
    {
        foreach ($this->dislikesData() as [$video_id, $user_id])
        {
            $video = $manager->getRepository(Video::class)->find($video_id);
            $user = $manager->getRepository(User::class)->find($user_id);

            $video->addUsersThatDontLike($user);
            $manager->persist($video);
        }
        $manager->flush();
    }

    private function likesData()
    {
        return [
            [12,1],
            [12,2],
            [11,2],
            [10,1],
            [10,2],
            [9,1],
            [5,2],
            [4,1],
            [8,2],
        ];
    }

    private function dislikesData()
    {
        return [
            [9,2],
            [8,1],
            [8,2],
            [7,1]
        ];
    }

    public function videoData()
    {
        return [
            ['Movies 1', 215233656,4],
            ['Movies 2', 211233434,4],
            ['Movies 3', 210233234,4],
            ['Movies 4', 289233677,4],
            ['Movies 5', 243234562,4],
            ['Movies 6', 212233123,4],
            ['Movies 7', 213333451,4],
            ['Toy1', 232323156, 2],
            ['Toy2', 232303431, 2],
            ['Toy3', 232383578, 2],
            ['Toy4', 232313456, 2],
            ['Toy5', 232343145, 2]
        ];
    }

}
