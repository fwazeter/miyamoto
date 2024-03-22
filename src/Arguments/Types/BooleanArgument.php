<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments\Types;

use Miyamoto\Arguments\Argument;

class BooleanArgument extends Argument
{
	public function __construct ( bool $value )
	{
		parent::__construct( $value, Argument::TYPE_BOOL );
	}
}