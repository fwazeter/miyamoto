<?php

namespace Miyamoto\Core;

class InputHandler
{
    /**
     * Prompts the user with a message and returns the trimmed input.
     *
     * @param string $message The message to display to the user.
     * @return string The user's input.
     */
    public function prompt(string $message): string
    {
        echo $message;
        return trim(fgets(STDIN));
    }

    /**
     * Prompts the user with a yes/no question and returns a boolean.
     *
     * @param string $message The message to display to the user.
     * @return bool True if the user answers yes, false otherwise.
     */
    public function confirm(string $message): bool
    {
        $response = strtolower($this->prompt($message . " (y/n): "));
        return in_array($response, ['y', 'yes']);
    }

    /**
     * Prompts the user with a message until a non-empty response is given.
     *
     * @param string $message The message to display to the user.
     * @return string The user's input.
     */
    public function requiredInput(string $message): string
    {
        $input = '';
        while (empty($input)) {
            $input = $this->prompt($message . " (required): ");
            if (empty($input)) {
                echo "This field cannot be empty. Please enter a value.\n";
            }
        }
        return $input;
    }
}