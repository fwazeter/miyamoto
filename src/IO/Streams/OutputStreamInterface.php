<?php

namespace Miyamoto\IO\Streams;

interface OutputStreamInterface
{
    public function write(string $message, array $options = []): void;
}