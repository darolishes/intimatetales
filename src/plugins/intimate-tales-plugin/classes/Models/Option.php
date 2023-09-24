<?php
namespace IntimateTales\Model;

/**
 * Class Option
 * 
 * @package IntimateTales
 * @subpackage Model
 * @since 1.0.0
 */
class Option 
{
	/**
	 * @var string
	 */
	public string $value;

	/**
	 * @var string
	 */
	public string $label;

	/**
	 * Option constructor.
	 *
	 * @param string $value
	 * @param string $label
	 */
	public function __construct( string $value, string $label ) {
		$this->value = $value;
		$this->label = $label;
	}

	/**
	 * @param string $value
	 * @param string $label
	 *
	 * @return static
	 */
	public static function build( $value, $label ) {
		return new static( $value, $label );
	}
}
