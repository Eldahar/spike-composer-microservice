#!/usr/bin/env php
<?php

$before = microtime(true);
$mbefore = memory_get_usage();
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/container.php';

use Doctrine\Bundle\MongoDBBundle\Command\ClearMetadataCacheDoctrineODMCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$container = new MyContainer();

/**
 * MongoDB hez kell
 */
Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::registerAnnotationClasses();

$application->add($container->get('first.command'));
$application->add($container->get('my.command.get_user_by_email'));
$application->add($container->get('my.command.create_user'));
$application->add(new ClearMetadataCacheDoctrineODMCommand());
$application->setAutoExit(false);

$application->run();
$after = microtime(true) ;
$mafter = memory_get_usage();
printf("%s sec, %s memory\n", $after-$before, ($mafter-$mbefore));