<?php
/**
 * HatchActivate
 *
 * Handles all of our activation hooks. Handle compatibility.
 *
 * @package Hatch
 * @since 1.0
 */

/**
 * Class HatchActivate
 */
class HatchActivate {

	/**
	 *  Construct
	 */
	function __construct() {
		add_filter( 'option_page_capability_rebar_activation_options', array( $this, 'activation_options_page_capability' ) );
	}

	/**
	 * Activation_options_page_capability function.
	 *
	 * @access private
	 * @param mixed $capability The capability needed to see this page.
	 * @return string
	 */
	function activation_options_page_capability( $capability ) {
		return 'edit_theme_options';
	}
}

/**
 * Add some help to our theme.
 * Use 'callback' instead of 'content' for a function callback that renders the tab content.
 *
 * @todo add more help as time goes on.
 *
 * @access public
 * @return void
 */
function rebar_add_help_tabs_to_theme_page() {
	$screen = get_current_screen();
	$screen->add_help_tab( array(
		'id' => 'hatch-activation-help', // This should be unique for the screen.
		'title' => 'Prepare for Launch',
		'content' => '<p>Within this page contains the basic setup options for your theme.</p>',
	) );
}
