<?php

namespace MyBundle\Command;


use \Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class AbstractCommand extends Command  implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getDoctrine(): ManagerRegistry{
        return $this->container->get('doctrine_mongodb');
    }
}