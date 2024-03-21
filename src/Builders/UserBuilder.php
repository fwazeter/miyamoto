<?php

namespace Miyamoto\Builders;

use Miyamoto\Services\DirectoryService;

class UserBuilder implements BuilderInterface
{
    /**
     * Directory service.
     *
     * @var DirectoryService $directoryService
     */
    private DirectoryService $directoryService;

    /**
     * Constructor.
     *
     * @param DirectoryService $directoryService
     */
    public function __construct(DirectoryService $directoryService)
    {
        $this->directoryService = $directoryService;
    }

    /**
     * Build or configure user-related components based on provided user information.
     *
     * @param array $info Array containing user information like username and domain.
     */
    public function build(array $info)
    {
        // Extract user information
        $username = $info['ENV_USER'] ?? null;
        $domain = $info['DOMAIN'] ?? null;

        // Validate required information
        if (!$username || !$domain) {
            throw new \InvalidArgumentException("Missing required user information.");
        }

        // Create user directory structure using DirectoryService
        $directoryPath = __DIR__ . "/../../../users/{$username}/{$domain}";
        $this->directoryService->createDirectory($directoryPath);

        // Additional user-related setup can be performed here
        // For example, initializing user configurations, setting permissions, etc.
    }

}