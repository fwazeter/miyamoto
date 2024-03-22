<?php

namespace Miyamoto\Contracts\BaseOps;

/**
 * Defines a universal interface for creating content to various destinations. This streamlined interface focuses on
 * the essential action of persisting or outputting content, making it adaptable for different contexts such as
 * file writing, output streams, databases, or external services.
 * Implementations of this interface are responsible for handling the specifics of the write operation, including
 * connecting to the destination and performing the write action. The simplicity of this interface allows for
 * flexibility in how these operations are implemented, but implementers should provide clear documentation on
 * how the content is handled, especially regarding encoding, formatting, and error handling.
 * Example Usage:
 * Writing to a file:
 * ```php
 * $fileWriter = new FileWriter();
 * $fileWriter->write('Hello, World!');
 * ```
 * Outputting to CLI:
 * ```php
 * $cliWriter = new CLIWriter();
 * $cliWriter->write('Command executed successfully.');
 * ```
 * Persisting to a database:
 * ```php
 * $dbWriter = new DatabaseWriter();
 * $dbWriter->write(['name' => 'John Doe', 'email' => 'john@example.com']);
 * ```
 * Writing with options (e.g., append mode, encoding):
 * ```php
 * $logWriter = new LogWriter();
 * $logResult = $logWriter->write($content = 'Error: File not found.', $path = '/var/log/app.log',
 * $options = ['mode' => 'append', 'encoding' => 'UTF-8']);
 * ```
 * Implementations should aim to provide feedback on the success or failure of the write operation, potentially
 * through return values or exceptions.
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Contracts
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface CreateInterface
{
	/**
	 * Writes content to a specified destination. The implementation should support various types of content,
	 * including strings, arrays, or more complex data structures, and handle them appropriately based on the
	 * destination's requirements.
	 * Example Param:
	 * $content The content to write. This could be text, binary data, structured data, or
	 * any other format suitable for the destination.
	 */
	public function create (): void;
}
