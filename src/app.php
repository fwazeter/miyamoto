<?php
// src/app.php

require __DIR__ . '/../vendor/autoload.php';

use Miyamoto\Core\Cli;
use Miyamoto\User\UserManager;
use Miyamoto\Setup\Installer;
use Miyamoto\IO\Streams\{ Input, Output };
use Miyamoto\Config\DotenvManager;

// External dependencies
use League\Container\Container;

$container = new Container();

// Input & Output classes
$container->add(Input::class);
$container->add(Output::class);

// DotenvManager & registered dependencies.
$container->add(DotenvManager::class)
    ->addArgument('C:\Users\frank\Documents\GitHub\miyamoto\.env')
    ->addArgument(Input::class)
    ->addArgument(Output::class);

// Other class Container configurations
$container->add(UserManager::class);
$container->add(Installer::class);

// CLI
$container->add(Cli::class)
	->addArgument(UserManager::class)
	->addArgument(Installer::class)
    ->addArgument(DotenvManager::class);

// Return the container for use in the CLI entry point
return $container;
