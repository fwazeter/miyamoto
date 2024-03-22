<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

/**
 * Represents a generic argument in a system that requires input parameters. This interface
 * provides a foundational contract for retrieving the value of an argument, regardless of its
 * specific type or source. Implementations of this interface can represent command-line arguments,
 * configuration settings, or other input parameters, and are responsible for encapsulating the
 * logic necessary to obtain the argument's value.
 *
 * Example Usage:
 * Accessing a command-line argument:
 * ```php
 *      $usernameArg = new CommandLineArgument('username');
 *      echo $usernameArg->get(); // Outputs the value of the 'username' command-line argument
 * ```
 *
 * Retrieving a configuration setting:
 * ```php
 *      $configArg = new ConfigArgument('database.host');
 *      echo $configArg->get(); // Outputs the value of the 'database.host' configuration setting
 * ```
 *
 * Implementations should ensure that the value returned is in a usable format for the context
 * in which the argument is employed and should document any transformations or default values
 * that are applied to the raw input.
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Argument
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface ArgumentInterface
{
	/**
	 * Retrieves the value of the argument. The method's implementation is responsible for
	 * resolving and returning the argument's value, potentially performing type coercion,
	 * applying default values, or other preprocessing as necessary.
	 *
	 * @return mixed The value of the argument, which can be of any type depending on the
	 *               implementation and the nature of the argument.
	 */
	public function get (): mixed;
}