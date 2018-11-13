<?php
/**
 * Modifications to the TinyMCE editor.
 *
 * @package Hatch
 * @since 1.2.0
 */

/**
 * Class rebar_TinyMCE
 */
class rebar_TinyMCE {

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

$rebar_tinymce = new rebar_TinyMCE();
