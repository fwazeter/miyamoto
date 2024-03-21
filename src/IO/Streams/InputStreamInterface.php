<?php

namespace Miyamoto\IO\Streams;

/**
 * The read method is a simple function designed to read a line of input such as the standard input stream (STDIN) in a command-line interface (CLI) environment, trim any leading or trailing whitespace, and then return the resulting string.
 *
 * Interface InputStreamInterface
 * @package Miyamoto\IO\Streams
 * @since 0.0.2
 * @param string $prompt The message to display to the user.
 * @return string The user's input.
 */
interface InputStreamInterface
{
    public function read( string $prompt = '' ): string;
}