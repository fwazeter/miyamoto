<?php

namespace Miyamoto\Directors;

use Miyamoto\Collectors\UserCollector;
use Miyamoto\Builders\UserBuilder;


class AccountDirector
{
    /**
     * Collects user information necessary for build.
     *
     * @var UserCollector $userCollector
     */
    private UserCollector $userCollector;
    /**
     * Builds user information.
     *
     * @var UserBuilder $userBuilder
     */
    private UserBuilder $userBuilder;
    private DatabaseBuilder $databaseBuilder;
    private DirectoryBuilder $directoryBuilder;
    private EnvFileBuilder $envFileBuilder;

    /**
     * Constructor.
     *
     * @param UserCollector $userCollector
     * @param UserBuilder $userBuilder
     * @param DatabaseBuilder $databaseBuilder
     * @param DirectoryBuilder $directoryBuilder
     * @param EnvFileBuilder $envFileBuilder
     */
    public function __construct(
            UserCollector $userCollector,
            UserBuilder $userBuilder,
            DatabaseBuilder $databaseBuilder,
            DirectoryBuilder $directoryBuilder,
            EnvFileBuilder $envFileBuilder)
    {
        // User Collection & Build Actions.
        $this->userCollector = $userCollector;
        $this->userBuilder = $userBuilder;

        // Database Collection & Build Actions.
        $this->databaseBuilder = $databaseBuilder;
        $this->directoryBuilder = $directoryBuilder;
        $this->envFileBuilder = $envFileBuilder;
    }

    public function accountSetup(): void
    {
        // Step 1: Collect & build user information.
        $userInfo = $this->userCollector->collect();
        $this->userBuilder->build($userInfo);

        // Step 2: Collect & build database information.
        $database = $this->databaseBuilder->build();

        // Step 3: Collect & build directory information.
        $directory = $this->directoryBuilder->build();

        // Step 4: Initialize .env file with collected information.
        $envData = array_merge($user, $database);
        $this->envFileBuilder->build($user['ENV_USER'], $user['DOMAIN'], $envData);

        // Additional steps like setting up the database can be added here

    }
}