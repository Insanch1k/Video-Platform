<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        foreach($this->CommentData() as [$content, $user, $video, $created_at])
//        {
//            $comment = new Comment();
//            $user = $manager->getRepository(User::class)->find($user);
//            $video = $manager->getRepository(Video::class)->find($video);
//
//            $comment->setContent($content);
//            $comment->setUser($user);
//            $comment->setVideo($video);
//            $comment->setCreatedAtForFixtures(new \DateTime($created_at));
//
//            $manager->persist($comment);
//        }
//
//        $manager->flush();
    }

//    private function CommentData()
//    {
//        return [
//            ['Comment1', 7,38,'2020-10-08 23:43:32'],
//            ['Comment2', 7,41,'2020-10-08 23:43:32'],
//            ['Comment3', 8,39,'2020-10-08 23:43:32'],
//            ['Comment4', 8,40,'2020-10-08 23:43:32'],
//        ];
//    }
//
//    public function getDependencies()
//    {
//        return array(
//            UserFixtures::class
//        );
//    }
}
