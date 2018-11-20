<?php
/**
 * Foundation Base Class
 *
 * Where is all starts. Includes all of our Classes
 *
 * @package Truss
 * @subpackage Foundation
 * @since 1.0
 */

global $foundation_utilities;

$foundation_classes_dir = get_stylesheet_directory() . '/includes/Foundation/';

require_once $foundation_classes_dir . 'foundation-utilities.php';
require_once $foundation_classes_dir . 'foundation-cleanup.php';
require_once $foundation_classes_dir . 'foundation-shortcodes.php';
require_once $foundation_classes_dir . 'foundation-clearing.php';

/**
 * Class Foundation
 */
class Foundation {

	/**
	 * Construct.
	 */
	function __construct() {

		$foundation_utilities = new FoundationUtilities();
		$foundation_cleanup   = new FoundationCleanup();
		$foundation_clearing  = new FoundationClearing();

		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

		add_filter( 'wp_list_pages',      array( $this, 'wp_list_pages' ), 10, 2 );
		add_filter( 'nav_menu_css_class', array( $this, 'add_active_nav_class' ), 10, 2 );

		add_action( 'wp_default_scripts', array( $this, 'wp_enqueue_jquery_in_footer' ) );

		add_filter( 'post_class', array( $this, 'post_class' ), 10, 3 );
	}

	/**
	 *
	 * Use the active class of ZURB Foundation on wp_list_pages output.
	 *
	 * From required+ Foundation http://themes.required.ch
	 *
	 * @access public
	 * @param mixed $input input makup for our list element.
	 * @return mixed
	 */
	function wp_list_pages( $input ) {

		$pattern = '/current_page_item/';
	    $replace = 'current_page_item active';

	    $output = preg_replace( $pattern, $replace, $input );

	    return $output;
	}

	/**
	 * Add end class to the last post in a query.
	 *
	 * @param array $classes Array of classes passed to the filter.
	 * @param mixed $class Default class passed to filter.
	 * @param mixed $post_id If specifically needed.
	 * @return array
	 */
	function post_class( $classes, $class, $post_id ) {
		global $wp_query;

		if ( $wp_query->current_post + 1 === $wp_query->found_posts ) {
			$classes[] = 'end';
		}

		return $classes;
	}

	/**
	 * Print jQuery library in the footer.
	 *
	 * @since 1.0
	 *
	 * @param mixed $scripts Our scripts we are listing.
	 */
	function wp_enqueue_jquery_in_footer( $scripts ) {
		if ( ! is_admin() ) {
			$scripts->add_data( 'jquery', 'group', 1 );
		}
	}

	/**
	 * If we are displaying the kitchen sink print out extra js
	 *
	 * @since 1.0
	 */
	function wp_enqueue_scripts() {
		if ( is_page_template( 'kitchen-sink.php' ) ) {
			wp_enqueue_script( 'kitchen-sink', get_stylesheet_directory_uri() . '/js/kitchen-sink.js', array( 'jquery' ), '1.0.0', true );
		}
	}

	/**
	 * Add Foundation 'active' class for the current menu item
	 *
	 * @param mixed $classes Our classes array.
	 * @param mixed $item The item we're setting to active.
	 * @return string
	 */
	function add_active_nav_class( $classes, $item ) {

	    if ( $item->current === 1 || $item->current_item_ancestor === true ) {
		    $classes[] = 'active';
	    }

	    return $classes;
	}
} 
