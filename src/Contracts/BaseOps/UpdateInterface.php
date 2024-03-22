<?php

namespace Miyamoto\Contracts\BaseOps;

/**
 * Defines a universal interface for updating content at various destinations. This interface focuses on
 * modifying existing content, making it adaptable for different contexts such as updating records in a database,
 * modifying files, or adjusting data in external services.
 * Implementations are responsible for handling the specifics of the update operation, including identifying the
 * target content, applying the updates, and ensuring data integrity. Implementers should provide clear documentation
 * on how updates are performed and any prerequisites or constraints.
 * Example Usage:
 * Updating a database record:
 * ```php
 * $dbUpdater = new DatabaseUpdater();
 * $dbUpdater->update(['name' => 'Jane Doe'], ['id' => 1]); // Update name where id is 1
 * ```
 * Modifying a configuration file:
 * ```php
 * $configUpdater = new ConfigFileUpdater();
 * $configUpdater->update('config.ini', ['timeout' => 30]); // Set timeout to 30 in config.ini
 * ```
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Contracts\Operations
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface UpdateInterface
{
	/**
	 * Updates content at a specified destination based on provided criteria or identifiers.
	 * Example Params:
	 * $updates  The changes to apply. This could be key-value pairs for databases, configuration settings, etc.
	 * $criteria Identifiers or conditions that specify where or what to update.
	 */
	public function update (): void;
}
