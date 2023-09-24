<?php
namespace IntimateTales\Models;

/**
 * Dependencies Class
 * 
 * @package IntimateTales
 * @subpackage Model
 * @since 1.0.0
 */
class Dependencies 
{
	/**
	 * @var string[]
	 */
	private array $handles = [];

	/**
	 * @param string $handle
	 */
	public function add_handle( string $handle ) 
	{
		// empty handles are invalid
		if(empty($handle)) return;

		// only add once
		if(in_array($handle, $this->handles)) return;

		$this->handles[] = $handle;
	}

	/**
	 * @return string[]
	 */
	public function get(): array {
		return $this->handles;
	}
}