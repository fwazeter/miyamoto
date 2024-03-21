<?php
// src/Setup/Installer.php

namespace Miyamoto\Setup;

class Installer
{
	public function run()
	{
		echo "Preparing to construct additional Pylons...\n";

		// Check for dependencies like PHP and WP-CLI
		$this->checkDependencies();

		// Set up the master WordPress installation
		$this->setupMasterWordPress();

		echo "Installation completed successfully.\n";
	}

	protected function checkDependencies()
	{
        echo "Checking dependencies...\n";

        // Check for PHP version
        echo "Checking for PHP version...\n";
        if (version_compare(PHP_VERSION, '8.1', '<')) {
            echo "Error: PHP 8.1 or higher is required.\n";
            exit(1);
        } else {
            echo "Success! Your PHP version is (" . PHP_VERSION . "). Miyamoto requires at least PHP 8.1. [Press Enter to continue]";
            fgets(STDIN);  // Wait for user to press Enter
        }

        $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
        $wpCliCommand = $isWindows ? 'php vendor/bin/wp' : 'vendor/bin/wp';
        $wpCliInfo = shell_exec($wpCliCommand . ' --info');

        // Check for WP-CLI locally
        if (empty($wpCliInfo)) {
            // If not found locally, check globally (especially for Unix-like systems)
            echo "WP-CLI is not installed. Would you like to install it now? (y/n): ";
            $handle = fopen("php://stdin", "r");
            $line = fgets($handle);
            if (trim($line) != 'y') {
                echo "WP-CLI installation aborted. Exiting...\n";
                exit(1);
            }
            fclose($handle);
            $this->installWpCli($isWindows);
        }

        echo "WP-CLI is installed. [Press Enter to continue]";
        fgets(STDIN);  // Wait for user to press Enter

		echo "All dependencies are met.\n";
	}

    protected function installWpCli($isWindows)
    {
        echo "Installing WP-CLI...\n";

        if ($isWindows) {
            // For Windows, download the wp-cli.phar file and create a batch script to execute it
            file_put_contents("wp-cli.phar", fopen("https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar", 'r'));
            $batContent = "@ECHO OFF\nphp \"%~dp0wp-cli.phar\" %*\n";
            file_put_contents("wp.bat", $batContent);
            echo "WP-CLI installed successfully for Windows.\n";
        } else {
            // For Unix-like systems, download the Phar file and make it executable
            shell_exec("curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar");
            shell_exec("chmod +x wp-cli.phar");
            shell_exec("sudo mv wp-cli.phar /usr/local/bin/wp");
            echo "WP-CLI installed successfully for Unix-like systems.\n";
        }
    }

	protected function setupMasterWordPress()
	{
		echo "Setting up core WordPress installation...\n";

        shell_exec('wp core download --path=app/wp');
		// Implement the logic to download and configure the master WordPress instance
	}

	// Additional installation tasks can be added as methods here...
}
