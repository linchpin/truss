<?php
/**
 * Modifications to the TinyMCE editor.
 *
 * @package Truss
 * @since 1.2.0
 */

/**
 * Class truss_TinyMCE
 */
class truss_TinyMCE {

	/**
	 * Construct.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 */
	function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	/**
	 * Add custom css to our admin editor
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 */
	function admin_init() {
		add_editor_style( 'css/admin-editor.css' );
	}
}

$truss_tinymce = new truss_TinyMCE();
