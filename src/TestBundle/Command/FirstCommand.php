<?php

namespace TestBundle\Command;

use TestBundle\Handler\RestHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FirstCommand extends Command {
    /**
     * @var RestHandler
     */
    protected $handler;

    /**
     * @param RestHandler $handler
     */
    public function setHandler(RestHandler $handler)
    {
        $this->handler = $handler;
    }


    protected function configure()
    {
        $this->setName('test:first');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->handler->exec();
    }

}