<?php

namespace App\Listeners;

//use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Video;
use App\Entity\User;
use Twig\Environment;
class NewVideoListener
{
    public function __construct(Environment $templating, \Swift_Mailer $mailer)
    {
        $this->mailer=$mailer;
        $this->templating=$templating;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if(!$entity instanceof Video)
        {
            return;
        }

        $entityManager = $args->getObjectManager();

        $users = $entityManager->getRepository(User::class)->findAll();

        foreach ($users as $user)
        {
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('send@d.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->templating->render(
                        'emails/new_video.html.twig',
                        [
                            'name'=>$user->getName(),
                            'video'=>$entity
                        ]
                    ),
                    'text/html'
                );
            $this->mailer->send($message);
        }

    }
}