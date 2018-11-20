<?php
/**
 * Modifications to the TinyMCE editor.
 *
 * @package Truss
 * @since   1.2.0
 */

namespace Truss;

/**
 * Class truss_TinyMCE
 */
class TinyMCE {

	/**
	 * Construct.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	/**
	 * Add custom css to our admin editor
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 */
	public function admin_init() {
		add_editor_style( 'css/admin-editor.css' );
	}
}
