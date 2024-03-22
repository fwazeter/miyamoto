<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

/**
 * Extends the ArgumentInterface to include functionality for arguments that have a default value.
 * This interface is particularly useful for scenarios where an argument might not be explicitly
 * provided by the user or the calling context, and a sensible default value should be used instead.
 *
 * Implementations of this interface should document how the default value is determined and
 * under what circumstances it is used. This is especially important for complex scenarios where
 * the presence of other arguments or external conditions might influence the default value.
 *
 * Example Usage:
 * Specifying a default value for a command-line option:
 * ```php
 *      $logLevelArg = new DefaultCommandLineArgument('log-level', 'INFO');
 *      echo $logLevelArg->getDefault(); // Outputs 'INFO' if the 'log-level' option is not provided
 * ```
 *
 * Providing a fallback configuration setting:
 * ```php
 *      $timeoutArg = new DefaultConfigArgument('connection.timeout', 30);
 *      echo $timeoutArg->getDefault(); // Outputs '30' if the 'connection.timeout' setting is not specified
 * ```
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Arguments
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface DefaultValueInterface extends ArgumentInterface
{
	/**
	 * Retrieves the default value of the argument. This method should return the value that
	 * is used when the argument is not explicitly provided. The nature of the default value
	 * and how it is determined should be clearly documented by implementations.
	 *
	 * @return mixed The default value of the argument, which can be of any type depending on
	 *               the implementation and the context in which the argument is used.
	 */
	public function getDefault (): mixed;
}