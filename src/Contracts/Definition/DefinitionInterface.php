<?php

namespace Miyamoto\Contracts\Definition;

/**
 * Interface for defining structured elements within various contexts such as CLI commands, interactive prompts, or
 * configuration settings. This interface allows for the addition of elements, their arguments, and options, providing
 * a flexible and extensible framework for constructing complex definitions. Implementations should ensure that
 * elements, arguments, and options are correctly processed and integrated according to their specific domain logic.
 *
 * Example Usage: Defining a CLI command with a concrete class and arguments:
 *
 * ```php
 *      $commandDefinition->add('greet', GreetCommand::class)
 *                         ->addArgument('name', 'World')
 *                         ->addOption('yell', 'If set, the greeting will be uppercase', false);
 * ```
 *
 * Configuring an interactive prompt with a closure and a default response:
 * ```php
 *      $promptDefinition->add('confirm', function() {  'prompt logic'  })
 *                       ->addArgument('question', 'Are you sure?')
 *                       ->addOption( [ 'color' => 'red' ] );
 * ```
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Contracts\Definition
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface DefinitionInterface
{
	/**
	 * Adds a new element to the definition, serving as a primary unit within the structure being defined.
	 * The element can be represented by various types, providing flexibility in defining the element's behavior.
	 * This method allows for defining commands, prompts, configuration settings, or any other structured elements
	 * within an application.
	 *
	 * Example Usage:
	 *
	 * Defining a CLI command:
	 * ```php
	 *      $definition->add('greet', GreetCommand::class);
	 * ```
	 *
	 * Defining an interactive prompt with a closure:
	 * ```php
	 *      $definition->add('confirm', function() {  `prompt logic`  });
	 * ```
	 *
	 * Defining a configuration setting with a simple value:
	 * ```php
	 *      $definition->add('database.host', 'localhost');
	 * ```
	 *
	 * @param string                      $id       The identifier or name of the element to add. This serves as a
	 *                                              unique identifier within the structure and is used to reference
	 *                                              the element.
	 * @param string|callable|object|null $concrete The concrete implementation of the element. This can be a class
	 *                                              name, a closure, or an object instance, depending on the element's
	 *                                              nature. If null, the element is assumed to be self-contained or
	 *                                              defined elsewhere, allowing for later specification or default
	 *                                              behavior.
	 *
	 * @return DefinitionInterface Allows method chaining by returning the current instance, enabling the definition
	 *                             of additional properties, arguments, or options for the element.
	 */
	public function add ( string $id, string|callable|object|null $concrete = null ): DefinitionInterface;
	
	/**
	 * Associates an argument with the most recently added element, providing additional data or configuration.
	 * The default value should match the expected type of the argument.
	 *
	 * Example Usage:
	 *
	 * ```php
	 *      $definition->addArgument('file', '/path/to/default/file');
	 *      $definition->addArgument('options', ['opt1' => 'value1', 'opt2' => 'value2']);
	 * ```
	 *
	 * @param string     $name    The name of the argument, serving as a unique identifier within the element.
	 * @param mixed|null $default An optional default value for the argument, used when no explicit value is provided.
	 *                            This can be of any type, but it should match the expected type of the argument.
	 *
	 * @return DefinitionInterface Allows method chaining by returning the current instance.
	 */
	public function addArgument ( string $name, mixed $default = null ): DefinitionInterface;
	
	/**
	 * Adds an option to the most recently added element, offering a form of optional argument that can modify the
	 * element's behavior. The details array allows for specifying various properties of the option, such as its
	 * shortcut, mode, description, and default value.
	 *
	 * Example Usage:
	 *
	 * ```php
	 *      $definition->addOption('verbose', [
	 *          'shortcut' => 'v',
	 *          'mode' => InputOption::VALUE_NONE,
	 *          'description' => 'Increase the verbosity of messages.',
	 *      ]);
	 *      $definition->addOption('config', [
	 *          'mode' => InputOption::VALUE_REQUIRED,
	 *          'description' => 'Provide a custom configuration file.',
	 *          'default' => '/path/to/default/config',
	 *      ]);
	 * ```
	 *
	 * @param string $name    The name of the option, serving as a unique identifier within the element.
	 * @param array  $details An associative array containing the option's details. Possible keys include:
	 *                        - 'shortcut': An optional shortcut for the option, providing an abbreviated alias.
	 *                        - 'mode': The mode of the option, indicating whether it requires a value, is boolean,
	 *                        etc.
	 *                        - 'description': A brief description of the option, explaining its purpose and effect.
	 *                        - 'default': An optional default value for the option, used when the option is not
	 *                        explicitly set.
	 *
	 * @return DefinitionInterface Allows method chaining by returning the current instance.
	 */
	public function addOption ( string $name, array $details = [] ): DefinitionInterface;
}
