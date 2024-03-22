<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

/**
 * Class ResolvableArgument
 *
 * Enhances argument resolution for CLI commands, API interactions, and other operations by providing
 * more flexible and context-aware resolution mechanisms.
 */
class ResolvableArgument implements ResolvableArgumentInterface
{
	protected string $value;
	
	public function __construct ( string $value )
	{
		$this->value = $value;
	}
	
	public function get (): string
	{
		return $this->value;
	}
}