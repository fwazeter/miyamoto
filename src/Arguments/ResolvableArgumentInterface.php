<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

/**
 * Specializes the ArgumentInterface for arguments whose values need to be resolved or computed
 * at runtime. This interface is useful for arguments that depend on dynamic conditions, such as
 * environment variables, runtime configurations, or other arguments.
 *
 * Implementations of this interface should document the resolution process, including any
 * dependencies on external factors and how conflicts or errors in resolution are handled.
 *
 * Example Usage:
 * Resolving an argument based on environment variables:
 * ```php
 *      $envArg = new EnvironmentVariableArgument('APP_ENV');
 *      echo $envArg->get(); // Outputs the value of the 'APP_ENV' environment variable
 * ```
 *
 * Computing an argument value based on other arguments:
 * ```php
 *      $outputPathArg = new ComputedArgument(['inputPath', 'fileName'], function($inputPath, $fileName) {
 *          return $inputPath . '/' . $fileName;
 *      });
 *      echo $outputPathArg->get(); // Outputs the computed output path
 * ```
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Arguments
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface ResolvableArgumentInterface extends ArgumentInterface
{
	/**
	 * Resolves and retrieves the value of the argument. Unlike the basic `get` method in the
	 * ArgumentInterface, implementations of this method are expected to perform additional
	 * logic to compute or resolve the argument's value at runtime.
	 *
	 * @return string The resolved value of the argument. While the return type is specified
	 *                as a string for simplicity, implementations may choose to return other
	 *                types based on the context and document this behavior accordingly.
	 */
	public function get (): string;
}
