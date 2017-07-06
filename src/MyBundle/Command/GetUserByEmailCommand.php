<?php

namespace MyBundle\Command;

use MyBundle\Document\User;
use MyBundle\Repository\UserRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetUserByEmailCommand extends AbstractCommand {

    protected function configure()
    {
        $this->setName('mongo:user:getbyemail');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();
        $user->setEmail('petyus18+1@gmail.com');
        $user->setName('Kalman Peter');

        $doctrine = $this->getDoctrine();

        /** @var UserRepository $repository */
        $repository = $doctrine->getRepository('MyBundle:User');

        $users = $repository->findAllByEmail('petyus18+1@gmail.com');

        foreach ($users as $user){
            var_dump($user);
        }
    }

}