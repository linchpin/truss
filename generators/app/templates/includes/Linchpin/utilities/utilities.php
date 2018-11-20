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
