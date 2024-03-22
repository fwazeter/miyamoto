<?php

namespace Miyamoto\Contracts\BaseOps;


/**
 * Defines a universal interface for reading data from various sources. This interface abstracts the read operation,
 * making it adaptable for different data sources such as files, input streams, databases, or external services.
 * It's designed to be flexible enough to accommodate simple direct reads, interactive CLI inputs with prompts,
 * and more complex scenarios involving specific read configurations.
 * Implementations of this interface should handle the specifics of connecting to the data source, performing the read
 * operation, and returning the data in an appropriate format. Implementers are encouraged to provide detailed
 * documentation on the supported context and options for their specific read operation.
 * Example Usage:
 * Reading from a file:
 * ```php
 * $fileReader = new FileReader();
 * $content = $fileReader->read('/path/to/file.txt');
 * ```
 * Reading from CLI with a prompt:
 * ```php
 * $cliReader = new CLIReader();
 * $userInput = $cliReader->read(null, 'Please enter your name: ');
 * ```
 * Reading with options (e.g., timeout, encoding):
 * ```php
 * $webServiceReader = new WebServiceReader();
 * $responseData = $webServiceReader->read('https://api.example.com/data', null, ['timeout' => 30, 'encoding' =>
 * 'UTF-8']);
 * ```
 * Implementations should throw a `ReadException` or a derived exception when read operations fail, providing as much
 * context as possible to aid in diagnosing the issue.
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Contracts
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface ReadInterface
{
	/**
	 * Reads data from a specified source. The method can be implemented to support various sources like input streams,
	 * files, or external APIs. The method's behavior and return type can vary based on the implementation, context,
	 * and provided options.
	 *
	 * @example /Examples/FileReader.php Example implementation of this interface.
	 */
	public function read (): mixed;
}

