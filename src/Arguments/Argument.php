<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

use InvalidArgumentException;

/**
 * The Argument class provides a robust mechanism for defining and managing arguments within
 * various contexts such as command-line interfaces, configuration systems, or any other
 * scenario requiring typed input parameters. This class enforces type safety by allowing
 * the specification of an argument's expected type, ensuring that the value conforms to
 * this expectation, thereby reducing runtime errors and improving code reliability.
 *
 * The class supports a wide range of types, including basic data types like integers and
 * strings, as well as more complex types like arrays and callables. This flexibility makes
 * the Argument class suitable for a diverse set of applications, from simple scripts to
 * complex applications requiring rigorous input validation.
 *
 * Example Usage:
 * Creating a string argument:
 * ```php
 *      $nameArg = new Argument('John Doe', Argument::TYPE_STRING);
 *      echo $nameArg->get(); // Outputs 'John Doe'
 * ```
 *
 * Defining an integer argument:
 * ```php
 *      $ageArg = new Argument(25, Argument::TYPE_INT);
 *      echo $ageArg->get(); // Outputs '25'
 * ```
 *
 * Specifying a callable argument:
 * ```php
 *      $callbackArg = new Argument(function() { return 'Hello, World!'; }, Argument::TYPE_CALLABLE);
 *      echo $callbackArg->get()(); // Outputs 'Hello, World!'
 * ```
 *
 * Implementations should ensure that the argument value is properly validated against the
 * specified type, throwing an InvalidArgumentException if the type does not match. This
 * behavior enforces strict type adherence and promotes the use of explicit type definitions
 * in applications.
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Arguments
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
class Argument implements ArgumentInterface
{
	public const TYPE_ARRAY    = 'array';
	public const TYPE_BOOL     = 'boolean';
	public const TYPE_BOOLEAN  = 'boolean';
	public const TYPE_CALLABLE = 'callable';
	public const TYPE_DOUBLE   = 'double';
	public const TYPE_FLOAT    = 'double'; // Technically, PHP considers Floats as a double.
	public const TYPE_INT      = 'integer';
	public const TYPE_INTEGER  = 'integer';
	public const TYPE_OBJECT   = 'object';
	public const TYPE_STRING   = 'string';
	
	/**
	 * The value of the argument, which can be of any type.
	 *
	 * @var mixed
	 */
	protected mixed $value;
	
	/**
	 * Constructs a new Argument instance with the specified value and type.
	 * If the value does not match the specified type, an InvalidArgumentException
	 * is thrown, ensuring type safety.
	 *
	 * @throws InvalidArgumentException If the value does not match the specified type.
	 *
	 * @param mixed       $value The value of the argument.
	 * @param string|null $type  The expected type of the argument value. If null, the type
	 *                           is inferred from the value itself.
	 */
	public function __construct ( mixed $value, ?string $type )
	{
		if (
			null === $type
			|| ( $type === self::TYPE_CALLABLE && is_callable( $value ) )
			|| ( $type === self::TYPE_OBJECT && is_object( $value ) )
			|| gettype( $value ) === $type
		) {
			$this->value = $value;
		}
		else {
			$typeReceived = gettype( $value );
			throw new InvalidArgumentException(
				sprintf( 'Expected type: %s, given type: %s for value.', $type, $typeReceived )
			);
		}
	}
	
	/**
	 * Retrieves the value of the argument. This method returns the argument's value
	 * as is, without any additional processing or transformation.
	 *
	 * @return mixed The value of the argument.
	 */
	public function get (): mixed
	{
		return $this->value;
	}
}