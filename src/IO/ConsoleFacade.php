<?php

namespace Miyamoto\IO;

use Miyamoto\IO\Streams\{Input, Output};

class ConsoleFacade
{
    protected Input $input;
    protected Output $output;

    public function __construct(Input $input, Output $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    public function prompt( string $question ): string
    {
        return $this->input->read($question);
    }

    public function inform( string $message, array $options = [] ): void
    {
        $this->output->write($message . "\n");
    }
}