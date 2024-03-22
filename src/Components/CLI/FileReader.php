<?php

namespace Miyamoto\Console;

use Miyamoto\Contracts\Console\FileReaderInterface;

class FileReader implements FileReaderInterface
{
	
	public function read (): string
	{
		// TODO: Implement read() method.
	}
	
	public function readLines ( string $filePath, ?int $lines = null ): array
	{
		// TODO: Implement readLines() method.
	}
}