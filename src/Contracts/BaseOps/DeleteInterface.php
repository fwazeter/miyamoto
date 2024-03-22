<?php

namespace Miyamoto\Contracts\BaseOps;

/**
 * Defines a universal interface for deleting content from various destinations. This interface focuses on
 * the removal of content, making it adaptable for different contexts such as deleting records from a database,
 * removing files, or clearing data in external services.
 * Implementations are responsible for handling the specifics of the delete operation, including identifying the
 * target content, ensuring safe deletion practices, and managing any dependencies or constraints. Implementers
 * should provide clear documentation on how deletions are performed and any prerequisites.
 * Example Usage:
 * Deleting a database record:
 * ```php
 * $dbDeleter = new DatabaseDeleter();
 * $dbDeleter->delete(['id' => 1]); // Delete record where id is 1
 * ```
 * Removing a file:
 * ```php
 * $fileDeleter = new FileDeleter();
 * $fileDeleter->delete('/path/to/file.txt'); // Delete file.txt
 * ```
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Contracts
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface DeleteInterface
{
	/**
	 * Deletes content from a specified destination based on provided identifiers or conditions.
	 */
	public function delete (): void;
}
