<?php

namespace Miyamoto\IO\Streams;

class Input implements InputStreamInterface
{
    /**
     * Input reading and trimming occur here. `fget` reads a line from the file pointer (STDIN),
     * which is almost always user input from keyboard. `trim` removes any leading or trailing whitespace, while
     * `fget` reads until a newline character is encountered. If no more input, returns false.
     *
     * Cleans up input strings for things like DB_NAME, DB_USER, and DB_PASSWORD.
     * @param string $prompt
     * @return string
     */
    public function read(string $prompt = ''): string
    {
        if(!empty($prompt)) {
            // Display prompt message to user.
            echo $prompt;
        }

        $input = fgets(STDIN);
        if ($input === false) {
            // Handle the error or return a default/fallback string. TBD.
            return '';
        }
        return trim($input);
    }

    /**
     * Reads input silently, without echoing the input back to the user.
     *
     * Temporarily sets callback function where first parameter is an empty string because no prompt needed.
     * Second parameter is a callback function. The goal is simply to turn off echoing, not process
     * input with a callback.
     *
     * More on readline here: [PHP docs](https://www.php.net/manual/en/function.readline.php)
     *
     * @return string
     */
    public function readSilently(): string
    {
        if(function_exists('readline_callback_install')) {
            readline_callback_handler_install('', function() {});
            $input = $this->read();

            readline_callback_handler_remove();

            return $input;
        } elseif(strpos(PHP_OS, 'WIN') === false) {
            // Fallback for Unix systems. Turn off echo.
            system('stty -echo');
            $input = $this->read();
            // turn on echo.
            system('stty echo');
            echo PHP_EOL;
            return $input;
        }

        // Fallback or future alternative for reading sensitive data.
        echo "Enter sensitive data (warning: input may be visible): ";
        return $this->read();
    }
}