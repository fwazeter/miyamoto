<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments\Types;

use Miyamoto\Arguments\Argument;

class CallableArgument extends Argument
{
	public function __construct ( callable $value )
	{
		parent::__construct( $value, Argument::TYPE_CALLABLE );
	}
}