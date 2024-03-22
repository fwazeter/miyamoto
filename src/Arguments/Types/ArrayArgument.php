<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments\Types;

use Miyamoto\Arguments\Argument;

class ArrayArgument extends Argument
{
	public function __construct ( array $value )
	{
		parent::__construct( $value, Argument::TYPE_ARRAY );
	}
}