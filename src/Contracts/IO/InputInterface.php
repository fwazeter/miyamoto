<?php

declare( strict_types = 1 );

namespace Miyamoto\Contracts\IO;

interface InputInterface
{
	/**
	 * Gets a value by name, which could be an argument or an option.
	 *
	 * @param string $name The name of the argument or option.
	 *
	 * @return mixed The value of the argument or option.
	 */
	public function get ( string $name ): mixed;
	
	/**
	 * Sets a value by name, which could be for an argument or an option.
	 *
	 * @param string $name  The name of the argument or option.
	 * @param mixed  $value The value to set.
	 */
	public function set ( string $name, $value );
	
	/**
	 * Checks if an argument or an option is present by name.
	 *
	 * @param string $name The name of the argument or option.
	 *
	 * @return bool True if the argument or option exists, false otherwise.
	 */
	public function has ( string $name ): bool;
	
	/**
	 * Checks if the input is interactive.
	 *
	 * @return bool True if the input is interactive, false otherwise.
	 */
	/*public function isInteractive (): bool;*/
}