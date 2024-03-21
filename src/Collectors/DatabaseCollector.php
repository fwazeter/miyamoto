<?php

namespace Miyamoto\Collectors;

use InvalidArgumentException;
use JetBrains\PhpStorm\ArrayShape;
use Miyamoto\IO\ConsoleFacade;

class DatabaseCollector extends AbstractInfoCollector
{
    /**
     * The default values for the database
     * configuration if a name isn't provided.
     *
     * @var array $defaults
     */
    protected array $defaults;

    public function __construct( ConsoleFacade $consoleFacade, array $defaults)
    {
        parent::__construct($consoleFacade);
        $this->defaults = $defaults;

        // Ensure ENV_USER is set
        if (!isset($this->defaults['ENV_USER']) || empty($this->defaults['ENV_USER'])) {
            throw new InvalidArgumentException("ENV_USER must be set before initializing the Database.");
        }
    }
    #[ArrayShape([
        'DB_NAME' => "string",
        'DB_USER' => "string",
        'DB_PASSWORD' => "string",
        'DB_HOST' => "string",
        'DB_PREFIX' => "string"
    ])]
    public function getInfo(): array
    {
        $envUser = $this->defaults['ENV_USER'];

        return [
                'DB_NAME' => [
                    'question' => "Enter DB Name (default will be '{$envUser}_miya_wp'): ",
                    'default' => "{$envUser}_miya_wp",
                ],
                'DB_USER' => [
                    'question' => "Enter DB User (default will be '{$envUser}_mdb'): ",
                    'default' => "{$envUser}_mdb",
                ],
                'DB_PASSWORD' => [
                    'question' => "Enter DB Password: ",
                    // No default for DB_PASSWORD for security reasons
                ],
                'DB_HOST' => [
                    'question' => "Enter DB_HOST: ",
                    'default' => 'localhost',
                ],
                'DB_PREFIX' => [
                    'question' => "Enter DB_PREFIX (default will be 'wp_mm_'): ",
                    'default' => 'wp_mm_',
                ],
        ];
    }
}