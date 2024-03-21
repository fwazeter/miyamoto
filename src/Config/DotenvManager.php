<?php

namespace Miyamoto\Config;

use Dotenv\Repository\RepositoryBuilder;
use Miyamoto\IO\ConsoleFacade;
// External dependencies
use Dotenv\Dotenv;

class DotenvManager
{
    /**
     * The Dotenv instance.
     * @var Dotenv $dotenv
     */
    protected Dotenv $dotenv;

    /**
     * ConsoleFacade
     *
     * @var ConsoleFacade $consoleFacade
     */
    protected ConsoleFacade $consoleFacade;

    /**
     * The .env file path.
     *
     * @var string $envDirPath
     */
    protected string $envDirPath;

    /**
     * Constructor.
     *
     * @param ConsoleFacade $consoleFacade
     * @param string $envDirPath
     */
    public function __construct(string $envDirPath, ConsoleFacade $consoleFacade)
    {
        $this->envDirPath = $envDirPath;
        $this->consoleFacade = $consoleFacade;

        // Initialize Dotenv with immutable repository.
        $repository = RepositoryBuilder::createWithNoAdapters()
            ->addWriter(\Dotenv\Repository\Adapter\PutenvAdapter::class)
            ->immutable()
            ->make();

        // Dotenv::create expects a directory path. Ensure it's a directory path, not a file path.
        $envDir = is_dir($envDirPath) ? $envDirPath : dirname($envDirPath);
        $this->dotenv = Dotenv::create($repository, $envDir);
    }

    /**
     * Load the .env file.
     *
     * @return void
     */
    public function load(): void
    {
        $this->dotenv->load();
    }

    /**
     * Get an environment variable.
     * [PHP getenv docs](https://www.php.net/manual/en/function.getenv.php)
     *
     * @param string $key
     * @param string $default
     * @return string
     */
    public function get(string $key, string $default = '' ): string
    {
        // Retrieve env var with an optional default value.
        return getenv($key) ?: $default;
    }

    /**
     * Validate the required input.
     * If the required input is not set, prompt the user for it.
     *
     * @param array $requiredInput
     * @return void
     */
    public function validateAndUpdate(array $requiredInput): void
    {
        foreach ($requiredInput as $key) {
            if (empty($this->get($key))) {
                $value = $this->consoleFacade->prompt("Enter value for {$key}: ");
                $this->update($key, $value);
            }
        }
    }

    /**
     * Update an environment variable.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function update(string $key, string $value): void
    {
        //add or update the variable in the env file.
        $content = file_exists($this->envDirPath) ? file_get_contents($this->envDirPath) : '';

        if ($content === false) {
            $this->consoleFacade->inform("Error reading .env file.", ['newline' => true]);
            return;
        }

        $pattern = "/^{$key}=.*/m";
        $replacement = "{$key}={$value}";

        if (preg_match($pattern, $content)) {
            // if variable exists, replace it.
            $content = preg_replace($pattern, $replacement, $content);
        } else {
            // if variable does not exist, add it.
            $content .= (empty($content) ? '' : PHP_EOL) . $replacement;
        }

        if (file_put_contents($this->envDirPath, $content) === false) {
            $this->consoleFacade->inform("Error writing to .env file.", ['newline' => true]);
        }
    }

    /**
     * Set an environment variable.
     * [PHP putenv docs](https://www.php.net/manual/en/function.putenv.php)
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    protected function set(string $key, string $value): void
    {
        putenv("{$key}={$value}");
    }
}