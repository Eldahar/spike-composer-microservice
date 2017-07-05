#!/usr/bin/env php
<?php

$before = microtime(true);
$mbefore = memory_get_usage();
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/container.php';

use Symfony\Component\Console\Application;

$application = new Application();

$container = new MyContainer();

$application->add($container->get('first.command'));
$application->setAutoExit(false);

$application->run();
$after = microtime(true);
$mafter = memory_get_usage();
printf("%s sec, %s memory\n", $after-$before, $mafter-$mbefore);