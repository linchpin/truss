<?php
/**
 * Hatch Base Class
 *
 * Where is all starts. Includes all of our Classes
 *
 * @package Hatch
 * @since 1.0
 */

include( 'hatch-options.php' );
include( 'hatch-activate.php' );
include( 'hatch-utilities.php' );
include( 'hatch-menu.php' );
include( 'hatch-tinymce.php' );

/**
 * Class Hatch
 */
class Hatch {

	/**
	 * Construct
	 */
	function __construct() {
		$rebar_activate = new HatchActivate();
		$rebar_option_controls = new HatchOptions();
		$rebar_utilities = new HatchUtilities();
		$rebar_menu = new HatchMenu();
	}
}
