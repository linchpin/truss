<?php
/**
 * Truss Base Class
 *
 * Where is all starts. Includes all of our Classes
 *
 * @package Truss
 * @since 1.0
 */

include( 'truss-options.php' );
include( 'truss-activate.php' );
include( 'truss-utilities.php' );
include( 'truss-menu.php' );
include( 'truss-tinymce.php' );

/**
 * Class Truss
 */
class Truss {

	/**
	 * Construct
	 */
	function __construct() {
		$truss_activate = new TrussActivate();
		$truss_option_controls = new TrussOptions();
		$truss_utilities = new TrussUtilities();
		$truss_menu = new TrussMenu();
	}
}
