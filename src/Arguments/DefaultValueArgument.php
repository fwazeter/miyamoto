<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

class DefaultValueArgument extends ResolvableArgument implements DefaultValueInterface
{
	protected mixed $defaultValue;
	
	public function __construct ( string $value, mixed $defaultValue )
	{
		$this->defaultValue = $defaultValue;
		parent::__construct( $value );
	}
	
	public function getDefault (): mixed
	{
		return $this->defaultValue;
	}
}