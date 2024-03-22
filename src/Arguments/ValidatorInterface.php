<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

interface ValidatorInterface
{
	public function validate ( mixed $value ): bool;
}
