<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments\Types;

use Miyamoto\Arguments\Argument;

class StringArgument extends Argument
{
	public function __construct ( string $value )
	{
		parent::__construct( $value, Argument::TYPE_STRING );
	}
}