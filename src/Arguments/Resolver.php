<?php

declare( strict_types = 1 );

namespace Miyamoto\Arguments;

/**
 * Class ResolverArgument
 *
 * Enhances argument resolution for CLI commands, API interactions, and other operations by providing
 * more flexible and context-aware resolution mechanisms.
 */
class Resolver implements ResolvableArgumentInterface
{
	/**
	 * Context or configuration that might influence argument resolution.
	 *
	 * @var array
	 */
	protected $context;
	
	/**
	 * Constructor to optionally set up initial context or configuration.
	 *
	 * @param array $context Initial context or configuration for argument resolution.
	 */
	public function __construct ( array $context = [] )
	{
		$this->context = $context;
	}
	
	/**
	 * Resolves an array of arguments for CLI operations or API interactions.
	 * This method provides context-aware resolution, handling different types of arguments based on the provided
	 * context.
	 *
	 * @param array $arguments The array of arguments to resolve.
	 *
	 * @return array The resolved arguments.
	 */
	public function resolveArguments ( array $arguments ): array
	{
		foreach ( $arguments as &$arg ) {
			// Handle callables with context
			if ( is_callable( $arg ) ) {
				$arg = call_user_func( $arg, $this->context );
				continue;
			}
			
			// Example: Resolving environment variables with fallbacks defined in context
			if ( is_string( $arg ) && strpos( $arg, 'env:' ) === 0 ) {
				$envVar = substr( $arg, 4 );
				$arg    = getenv( $envVar ) ?: ( $this->context[ $envVar ] ?? null );
				continue;
			}
			
			// Add more resolution logic as needed, considering the context...
		}
		
		return $arguments;
	}
	
	/**
	 * Updates or sets the context for argument resolution.
	 *
	 * @param array $context New context or configuration for argument resolution.
	 *
	 * @return void
	 */
	public function setContext ( array $context ): void
	{
		$this->context = $context;
	}
	
	// Additional methods for reflecting arguments, handling defaults, etc., can be added as needed.
	public function getValue (): string
	{
		return $this->value;
	}
}



