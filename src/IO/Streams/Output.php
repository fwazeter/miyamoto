<?php

namespace Miyamoto\IO\Streams;

class Output implements OutputStreamInterface
{
    /**
     * Output writing occurs here. `echo` is a language construct that outputs one or more strings.
     * Here, it outputs the message passed to it.
     *
     * TODO: Apply formatting as needed based on options. Likely split up into separate methods.
     *
     * @param string $message
     * @param array $options
     */
    public function write(string $message, array $options = []): void
    {
        // Applies formatting based on options.
        if (!empty($options['newline'])) {
            $message  .= PHP_EOL;
        }

        if (!empty($options['color'])) {
            $message = $this->setColor($message, $options['color']);
        }

        echo $message;
    }

    /**
     * Applies color to text. Mostly future enhancement.
     *
     * @param string $message
     * @param string $color
     * @return string
     */
    protected function setColor(string $message, string $color): string
    {
        // Define color codes or escape sequences for CLI colors.
        $colors = [
          'red' => "\033[0;31m",
          'green' => "\033[0;32m",
        ];

        // Reset color to default.
        $reset = "\033[0m";

        return isset($colors[$color]) ? $colors[$color] . $message . $reset : $message;
    }
}