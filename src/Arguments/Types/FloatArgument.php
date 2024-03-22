<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments\Types;

use Miyamoto\Arguments\Argument;

class FloatArgument extends Argument
{
	public function __construct ( float $value )
	{
		parent::__construct( $value, Argument::TYPE_FLOAT );
	}
}