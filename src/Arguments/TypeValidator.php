<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

class TypeValidator implements ValidatorInterface
{
	public const TYPE_ARRAY    = 'array';
	public const TYPE_BOOL     = 'boolean';
	public const TYPE_BOOLEAN  = 'boolean';
	public const TYPE_CALLABLE = 'callable';
	public const TYPE_DOUBLE   = 'double';
	public const TYPE_FLOAT    = 'double'; // Technically, PHP considers Floats as a double.
	public const TYPE_INT      = 'integer';
	public const TYPE_INTEGER  = 'integer';
	public const TYPE_OBJECT   = 'object';
	public const TYPE_STRING   = 'string';
	
	private array $typeValidationFunctions = [
		self::TYPE_ARRAY    => 'is_array',
		self::TYPE_BOOL     => 'is_bool', // Covers both TYPE_BOOL and TYPE_BOOLEAN
		self::TYPE_CALLABLE => 'is_callable',
		self::TYPE_FLOAT    => 'is_float', // Covers both TYPE_DOUBLE and TYPE_FLOAT
		self::TYPE_INT      => 'is_int', // Covers both TYPE_INT and TYPE_INTEGER
		self::TYPE_OBJECT   => 'is_object',
		self::TYPE_STRING   => 'is_string',
	];
	
	private function validateTypes () {}
	
	public function validate ( mixed $value, $criteria = 'validateTypes' ): bool
	{
		return $typeValidationFunction( $value );
	}
	
	public function checkType ( string $type ): ?callable
	{
		// Map alternate type constants to their primary counterparts
		$typeMap = [
			self::TYPE_BOOLEAN => self::TYPE_BOOL,
			self::TYPE_DOUBLE  => self::TYPE_FLOAT,
			self::TYPE_INTEGER => self::TYPE_INT,
		];
		
		// Use the primary type constant if an alternate one is provided
		$primaryType = $typeMap[ $type ] ?? $type;
		
		return $this->typeValidationFunctions[ $primaryType ] ?? null;
	}
}