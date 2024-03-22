<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

class RequiredArgument extends ResolvableArgument
{
	/**
	 * Indicates whether the argument is required.
	 * In this base class, it's always true since this is a RequiredArgument.
	 */
	protected bool $required = true;
	
	/**
	 * Constructor for the RequiredArgument class.
	 *
	 * @param string $value The name or identifier of the argument.
	 */
	public function __construct ( string $value )
	{
		parent::__construct( $value );
	}
	
	/**
	 * Checks if the argument is required.
	 *
	 * @return bool Returns true because this is a RequiredArgument.
	 */
	public function isRequired (): bool
	{
		return $this->required;
	}
	
	/**
	 * Optionally, you can add logic to ensure a value has been set for this argument.
	 * This method can be called before executing a command to ensure all required arguments are provided.
	 *
	 * @throws \InvalidArgumentException If the required argument value has not been set.
	 */
	public function has (): void
	{
		if ( $this->get() === null ) {
			throw new \InvalidArgumentException( "The requirement '{$this->value}' is missing." );
		}
	}
}