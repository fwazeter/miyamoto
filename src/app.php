<?php
// src/app.php

require __DIR__ . '/../vendor/autoload.php';

use League\Container\Container;
use Miyamoto\Core\Cli;
use Miyamoto\User\UserManager;
use Miyamoto\Setup\Installer;

$container = new Container();

// Container configuration
$container->add(UserManager::class);
$container->add(Installer::class);
$container->add(Cli::class)
	->addArgument(UserManager::class)
	->addArgument(Installer::class);

// Return the container for use in the CLI entry point
return $container;
