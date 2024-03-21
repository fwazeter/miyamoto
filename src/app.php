<?php
// src/app.php

require __DIR__ . '/../vendor/autoload.php';

use Miyamoto\Core\Cli;
use Miyamoto\User\UserManager;
use Miyamoto\Setup\Installer;
use Miyamoto\IO\Streams\{ Input, Output };
use Miyamoto\IO\ConsoleFacade;
use Miyamoto\Config\DotenvManager;
use Miyamoto\Collectors\{ UserCollector, DatabaseCollector };

// External dependencies
use League\Container\Container;

$container = new Container();

// Input & Output classes
$container->add(Input::class);
$container->add(Output::class);

// ConsoleFacade
$container->add(ConsoleFacade::class)
    ->addArgument(Input::class)
    ->addArgument(Output::class);

// Collectors
$container->add(UserCollector::class)
    ->addArgument(ConsoleFacade::class);

$container->add(DatabaseCollector::class)
    ->addArgument(ConsoleFacade::class);

// DotenvManager & registered dependencies.
$container->add(DotenvManager::class)
    ->addArgument('C:\Users\frank\Documents\GitHub\miyamoto\.env')
    ->addArgument(ConsoleFacade::class);

// Other class Container configurations
$container->add(UserManager::class);
$container->add(Installer::class);

// CLI
$container->add(Cli::class)
	->addArgument(UserManager::class)
	->addArgument(Installer::class)
    ->addArgument(DotenvManager::class)
    ->addArgument(Input::class);

// Return the container for use in the CLI entry point
return $container;
