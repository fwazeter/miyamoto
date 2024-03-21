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
        $wpCliGlobalInfo = shell_exec('wp --info');


        // Check for WP-CLI locally or globally
        echo "Checking for WP-CLI...\n";

        // Check for WP-CLI locally
        if (empty($wpCliInfo) OR empty($wpCliGlobalInfo)) {
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

    protected function installWpCli($isWindows): void
    {
        echo "Installing WP-CLI...\n";

        $wpCliPhar = 'wp-cli.phar';
        $downloadUrl = 'https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar';

        if($isWindows) {
            // Handle Windows-specific installation steps
        } else {
            // Attempt to download the WP-CLI Phar file
            $downloaded = file_put_contents($wpCliPhar, fopen($downloadUrl, 'r'));
            if ($downloaded === false) {
                echo "Error: Failed to download WP-CLI. Please ensure you have internet access and the necessary permissions.\n";
                return;  // Exit the function early
            }

            // Attempt to make the Phar file executable
            if (!chmod($wpCliPhar, 0755)) {
                echo "Error: Failed to make WP-CLI executable. Check your permissions on the current directory with 'ls -ld .'\n";
                unlink($wpCliPhar);  // Clean up the downloaded file
                return;
            }

            // Attempt to move the Phar file to a global location
            $moveCommand = "sudo mv $wpCliPhar /usr/local/bin/wp";
            exec($moveCommand, $output, $returnVar);
            if ($returnVar !== 0) {  // Check if the command was successful
                echo "Error: Failed to move WP-CLI to a global location. You might need to run the script with elevated permissions (sudo).\n";
                unlink($wpCliPhar);  // Clean up the downloaded file
                return;
            }

            echo "WP-CLI installed successfully.\n";
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
