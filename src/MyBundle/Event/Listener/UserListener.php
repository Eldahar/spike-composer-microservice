<?php

namespace MyBundle\Event\Listener;


use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;

class UserListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $document = $args->getDocument();

    }
}