<?php

namespace Miyamoto\Collectors;

use JetBrains\PhpStorm\ArrayShape;

class UserCollector extends AbstractInfoCollector
{
    #[ArrayShape([
        'ENV_USER' => "string",
        'DOMAIN' => "string"
    ])]
    protected function getInfo(): array
    {
        return [
            'ENV_USER' => [
                'question' => "Choose unique username (e.g. miya): ",
                'validate' => function($input) { return !empty($input); },// Must not be empty.
                'error' => "User (ENV_USER) cannot be empty. Please enter a unique username.",
            ],
            'DOMAIN' => [
                'question' => "Enter unique domain name (e.g. miyamoto.io): ",
                'validate' => function($input) { return !empty($input); },// Must not be empty.
                'error' => "Domain (DOMAIN) cannot be empty. Please enter a unique domain name.",
            ],
        ];
    }

    /**
     * Collect the user input
     *
     * @return array
     */
    public function collect(): array
    {
        $data = [];
        foreach ($this->getInfo() as $key => $details) {
            do {
                $input = $this->consoleFacade->prompt($details['question']);
                $isValid = $details['validate']($input);
                if (!$isValid) {
                    $this->consoleFacade->inform($details['error']);
                }
            } while (!$isValid);

            $data[$key] = $input;
        }
        return $data;
    }
}