<?php
/**
 * This file contains the Radio Setting class.
 *
 * @package    Nelio_Content
 * @subpackage Nelio_Content/includes/lib/settings
 * @author     David Aguilera <david.aguilera@neliosoftware.com>
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This class represents a Radio setting.
 *
 * @package    Nelio_Content
 * @subpackage Nelio_Content/includes/lib/settings
 * @author     David Aguilera <david.aguilera@neliosoftware.com>
 * @since      1.0.0
 */
class Nelio_Content_Radio_Setting extends Nelio_Content_Abstract_Setting {

	/**
	 * The currently-selected value of this radio.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $value;

	/**
	 * The list of options.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    array
	 */
	protected $options;

	/**
	 * Creates a new instance of this class.
	 *
	 * @param string $name    The name that identifies this setting.
	 * @param string $desc    A text that describes this field.
	 * @param string $more    A link pointing to more information about this field.
	 * @param array  $options The list of options.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct( $name, $desc, $more, $options ) {

		parent::__construct( $name, $desc, $more );
		$this->options = $options;

	}//end __construct()

	/**
	 * Specifies which option is selected.
	 *
	 * @param string $value The currently-selected value of this radio.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function set_value( $value ) {
		$this->value = $value;
	}//end set_value()

	// @Implements
	public function display() { // @codingStandardsIgnoreLine

		// Preparing data for the partial.
		$id       = str_replace( '_', '-', $this->name );
		$name     = $this->option_name . '[' . $this->name . ']';
		$value    = $this->value;
		$options  = $this->options;
		$desc     = $this->desc;
		$more     = $this->more;
		include NELIO_CONTENT_INCLUDES_DIR . '/lib/settings/partials/nelio-content-radio-setting.php';

	}//end display()

	// @Implements
	public function sanitize( $input ) { // @codingStandardsIgnoreLine
		if ( ! isset( $input[ $this->name ] ) ) {
			$input[ $this->name ] = $this->value;
		}
		$is_value_correct = false;
		foreach ( $this->options as $option ) {
			if ( $option['value'] === $input[ $this->name ] ) {
				$is_value_correct = true;
			}
		}
		if ( ! $is_value_correct ) {
			$input[ $this->name ] = $this->value;
		}
		return $input;
	}//end sanitize()

}//end class

