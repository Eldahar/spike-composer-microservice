<?php
namespace MyBundle\Handler;

class DataHandler
{

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}