#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';
//import console application stack
use Symfony\Component\Console\Application;
//import commands

use JScarton\Commands\Version\VersionCommand;
use JScarton\Commands\Configure\ConfigureCommand;
use JScarton\Commands\Run\RunCommand;


$application = new Application();
$application->add(new ConfigureCommand());
$application->add(new RunCommand());
$application->add(new VersionCommand());
$application->run();