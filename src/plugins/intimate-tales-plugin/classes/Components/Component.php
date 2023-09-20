<?php

namespace IntimateTales\Components;

use IntimateTales\Plugin;

/**
 * Class Component
 *
 * @package IntimateTales
 * @version 1.0.0
 */
abstract class Component {

	public Plugin $plugin;

	/**
	 * _Component constructor.
	 */
	public function __construct(Plugin $plugin) {
		$this->plugin = $plugin;
		$this->onCreate();
	}

	/**
	 * overwrite this method in component implementations
	 */
	public function onCreate(){}
}
