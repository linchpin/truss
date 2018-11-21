<?php
/**
 * Public access to various methods in Truss
 */

/**
 * Utility method for truss_breadcrumbs function.
 *
 * @since 1.0
 *
 * @access public
 */
function truss_breadcrumbs() {
	\Truss\Utilities::breadcrumbs();
}

/**
 * Utility method for truss_categorized_blog function.
 *
 * @since 1.0
 *
 * @access public
 */
function truss_categorized_blog() {
	\Truss\Utilities::categorized_blog();
}

/**
 * Utility method for truss_comment_nav function.
 *
 * @since 1.0
 *
 * @access public
 */
function truss_comment_nav() {
	\Truss\Utilities::comment_nav();
}

/**
 * Should we show the header in the content?
 *
 * @since 1.0
 *
 * @return bool
 */
function truss_show_header_in_content() {
	return \Truss\Utilities::show_header_in_content();
}

/**
 * Add some meta information about our post
 *
 * @todo: This needs a filter.
 *
 * @access public
 * @return void
 */
function truss_entry_meta() {
	get_template_part( 'partials/entry-meta' );
}

/**
 * FoundationPress_menu_fallback function.
 * A fallback when no navigation is selected by default.
 *
 * @since 1.0
 *
 * @access public
 */
function truss_menu_fallback() {
	echo \Foundation\Utilities::menu_fallback(); // WPCS xss ok.
}

/**
 * Truss pagination pass through function.
 *
 * @since 1.0
 *
 * @access public
 *
 * @param mixed $prev_text Text for our previous link.
 * @param mixed $next_text Text for our next link.
 */
function truss_pagination( $prev_text, $next_text ) {
	echo \Foundation\Utilities::paginate_links( $prev_text, $next_text ); // WPCS xss ok.
}

/**
 * Left top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function truss_top_bar_l() {
	wp_nav_menu(
		array(
			'container'       => false,
			'container_class' => '',
			'menu'            => '',
			'menu_class'      => 'top-bar-menu left',
			'theme_location'  => 'top-bar-l',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 5,
			'fallback_cb'     => false,
			'walker'          => new \Foundation\Walker_Nav_Menu(),
		)
	);
}

/**
 * Right top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function truss_top_bar_r() {
	wp_nav_menu(
		array(
			'container'       => false,
			'container_class' => '',
			'menu'            => '',
			'menu_class'      => 'top-bar-menu right',
			'theme_location'  => 'top-bar',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 5,
			'fallback_cb'     => false,
			'walker'          => new \Foundation\Walker_Nav_Menu(),
		)
	);
}

/**
 * Footer
 */
function truss_footer() {
	wp_nav_menu(
		array(
			'container'       => false,
			'container_class' => '',
			'menu'            => '',
			'menu_class'      => 'inline-list footer-menu',
			'theme_location'  => 'footer',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 5,
			'fallback_cb'     => false,
		)
	);
}

/**
 * Mobile off-canvas
 */
function truss_mobile_off_canvas() {
	wp_nav_menu(
		array(
			'container'       => false,
			'container_class' => '',
			'menu'            => '',
			'menu_class'      => 'off-canvas-list',
			'theme_location'  => 'mobile-off-canvas',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 5,
			'fallback_cb'     => false,
			'walker'          => new \Foundation\Walker_Nav_Menu(),
		)
	);
}
