<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments\Types;

use Miyamoto\Arguments\Argument;

class ObjectArgument extends Argument
{
	public function __construct ( object $value )
	{
		parent::__construct( $value, Argument::TYPE_OBJECT );
	}
}