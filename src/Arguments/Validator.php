<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

class Validator implements ValidatorInterface
{
	public function validate ( mixed $value ): bool
	{
		return $criteria( $value );
	}
}