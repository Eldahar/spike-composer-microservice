<?php

namespace MyBundle\Command;

use Doctrine\ODM\MongoDB\DocumentManager;
use MyBundle\Document\User;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends AbstractCommand {


    protected function configure()
    {
        $this->setName('mongo:user:create');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();
        $user->setEmail('petyus18+1@gmail.com');
        $user->setName('Kalman Peter');

        $doctrine = $this->getDoctrine();
        /** @var DocumentManager $dm */
        $dm = $doctrine->getManager();

        $dm->persist($user);
        $dm->flush();

        $id = $user->getId();

        $dbUser = $doctrine->getRepository('MyBundle:User')->find($id);

        var_dump($dbUser);

    }

}