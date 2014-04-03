<?php

namespace mako\common;

/**
 * Configurable manager trait.
 *
 * @author     Frederic G. Østby
 * @copyright  (c) 2008-2013 Frederic G. Østby
 * @license    http://www.makoframework.com/license
 */

trait ConfigurableManagerTrait
{
	//---------------------------------------------
	// Class properties
	//---------------------------------------------

	/**
	 * Name of the default connection.
	 * 
	 * @var string
	 */

	protected $default;

	/**
	 * Configurations.
	 * 
	 * @var array
	 */

	protected $configurations;

	//---------------------------------------------
	// Class constructor, destructor etc ...
	//---------------------------------------------

	/**
	 * Constructor.
	 * 
	 * @access  public
	 * @param   string  $default         Default connection name
	 * @param   array   $configurations  Configurations
	 */

	public function __construct($default, array $configurations)
	{
		$this->default = $default;

		$this->configurations = $configurations;
	}

	//---------------------------------------------
	// Class methods
	//---------------------------------------------

	/**
	 * Adds a configuration.
	 * 
	 * @access  public
	 * @param   string  $name           Connection name
	 * @param   array   $configuration  Configuration
	 */

	public function addConfiguration($name, array $configuration)
	{
		$this->configurations[$name] = $configuration;
	}

	/**
	 * Removes a configuration. 
	 * It will also remove any active connection linked to the configuration.
	 * 
	 * @access  public
	 * @param   string  $name  Connection name
	 */

	public function removeConfiguration($name)
	{
		unset($this->configurations[$name], $this->connections[$name]);
	}
}

