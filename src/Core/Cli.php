<?php
// src/Core/Cli.php

namespace Miyamoto\Core;

use Miyamoto\Config\DotenvManager;
use Miyamoto\IO\Streams\Input;
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
     * Input
     *
     * @var Input
     */
    protected Input $input;

    /**
     * Constructor
     *
     * @param UserManager $userManager
     * @param Installer $installer
     * @param DotenvManager $dotenvManager
     */
	public function __construct(UserManager $userManager, Installer $installer, DotenvManager $dotenvManager, Input $input)
	{
		$this->userManager = $userManager;
		$this->installer = $installer;
        $this->dotenvManager = $dotenvManager;
        $this->input = $input;
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
            case 'create':
                $userName = $args[1] ?? null;
                $domainName = $args[2] ?? null;
                $this->createUser($userName, $domainName);
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

	protected function createUser(string $userName, string $domainName): void
    {
		// Prompt for USER & DOMAIN NAME
        $userName = $this->input->read("Enter username: ");
        $domainName = $this->input->read("Enter domain name: ");

        // Define the user's home directory
        $userHomeDir = __DIR__ . "/../../web/sites/$userName/$domainName";

        // Create the user's home directory
        if(!file_exists($userHomeDir)) {
            mkdir($userHomeDir, 0750, true);
            echo "Directory created: $userHomeDir\n";
        } else {
            echo "Directory already exists: $userHomeDir\n";
        }

        // Initialize the .env file with USER & DOMAIN NAME
        $content = "USER=$userName\n
                    DOMAIN=$domainName";
        file_put_contents("$userHomeDir/.env", $content);
        echo ".env file initialized in $userHomeDir\n";
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


