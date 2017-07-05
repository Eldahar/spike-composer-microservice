<?php

namespace CDI\TestBundle\Handler;

class RestHandler {
    /**
     * @var AnotherHandler
     */
    protected $anotherHandler;

    /**
     * @param AnotherHandler $anotherHandler
     */
    public function __construct(AnotherHandler $anotherHandler) {
        $this->anotherHandler = $anotherHandler;
    }

    public function exec()
    {
        $this->anotherHandler->exec();
    }
}