<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments\Types;

use Miyamoto\Arguments\Argument;

class IntegerArgument extends Argument
{
	public function __construct ( int $value )
	{
		parent::__construct( $value, Argument::TYPE_INT );
	}
}