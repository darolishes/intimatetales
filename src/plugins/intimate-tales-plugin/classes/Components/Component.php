<?php
namespace IntimateTales\Components;

use IntimateTales\Plugin;

/**
 * Class Component
 *
 * @package IntimateTales
 * @subpackage Components
 * @since 1.0.0
 */
abstract class Component
{

	public Plugin $plugin;

	/**
	 * _Component constructor.
	 * 
	 * @param Plugin $plugin
	 * @return void
	 */
	public function __construct(Plugin $plugin)
	{
		$this->plugin = $plugin;
		$this->on_create();
	}

	/**
	 * overwrite this method in component implementations
	 * 
	 * @return void
	 */
	public function on_create(): void
	{
	}
}
