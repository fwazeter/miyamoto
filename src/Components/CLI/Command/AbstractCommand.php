<?php

namespace Miyamoto\Components\CLI\Command;

use Miyamoto\Contracts\Definition\DefinitionInterface;

/**
 * Base class for all CLI commands.
 * This class provides the foundational structure for CLI commands, including methods for configuration,
 * execution, and interaction with the user. Commands extending this class can override specific methods
 * to implement their unique functionalities.
 */
abstract class AbstractCommand implements DefinitionInterface
{
	protected $name;
	protected $concrete;
	protected $arguments = [];
	protected $options   = [];
	
	/**
	 * {@inheritdoc }
	 */
	public function add ( string $id, $concrete = null ): DefinitionInterface
	{
		$this->name     = $id;
		$this->concrete = $concrete;
		
		return $this;
	}
	
	/**
	 * {@inheritdoc }
	 */
	public function addArgument ( string $name, $default = null ): DefinitionInterface
	{
		$this->arguments[ $name ] = $default;
		
		return $this;
	}
	
	/**
	 * {@inheritdoc }
	 */
	public function addOption ( string $name, array $details = [] ): DefinitionInterface
	{
		$this->options[ $name ] = $details;
		
		return $this;
	}
	
	/**
	 * Abstract method to execute the command. Must be implemented by concrete command classes.
	 *
	 * @return mixed
	 */
	abstract public function execute ();
	
	// Additional methods specific to CLI commands can be added here, such as helpers for input/output handling.
}
