<?php
// src/Core/Cli.php

namespace Miyamoto\Core;

use Miyamoto\Config\DotenvManager;
use Miyamoto\Setup\Installer;
use Miyamoto\User\UserManager;

class Cli
{

	/**
	 * Installer
	 *
	 * @var Installer
	 */
	protected Installer $installer;

	/**
	 * UserManager
	 *
	 * @var UserManager
	 */
	protected UserManager $userManager;

    /**
     * DotenvManager
     *
     * @var DotenvManager $dotenvManager
     */
    protected DotenvManager $dotenvManager;

    /**
     * Constructor
     *
     * @param UserManager $userManager
     * @param Installer $installer
     * @param DotenvManager $dotenvManager
     */
	public function __construct(UserManager $userManager, Installer $installer, DotenvManager $dotenvManager)
	{
		$this->userManager = $userManager;
		$this->installer = $installer;
        $this->dotenvManager = $dotenvManager;
	}

	public function run()
	{
		$args = $_SERVER['argv'];
		array_shift($args); // Remove the script name

		$command = $args[0] ?? null;

		switch ($command) {
			case 'install':
				$this->install();
				break;
			case 'user':
				$username = $args[1] ?? null;
				$this->userManager->createUser($username);
				break;
            case 'env:set':
                $key = $args[1] ?? null;
                $value = $args[2] ?? null;
                $this->setEnv($key, $value);
                break;
            case 'env:get':
                $key = $args[1] ?? null;
                $this->getEnv($key);
                break;
			default:
				echo "Unknown command: $command\n";
				break;

		}
	}

	public function install(): void
    {
		$this->installer->run();
	}

	protected function createSite($args): void
    {
		// Extract and validate arguments like USER and SITE
		// Implement the logic to create directories, set up environments, etc.
		echo "Creating site...\n";
	}

    protected function setEnv($key, $value): void
    {
        if ($key && $value) {
            $this->dotenvManager->update($key, $value);
            echo "Environment variable '$key' set to '$value'.\n";
        } else {
            echo "Usage: miya env:set KEY VALUE\n";
        }
    }

    protected function getEnv($key): void
    {
        if ($key) {
            // Reload .env file to reflect recent changes.
            $this->dotenvManager->load();

            $value = $this->dotenvManager->get($key);
            if ($value) {
                echo "Environment variable '$key' is set to '$value'.\n";
            } else {
                echo "Environment variable '$key' not found.\n";
            }
        } else {
            echo "Usage: miya env:get KEY\n";
        }
    }
}


