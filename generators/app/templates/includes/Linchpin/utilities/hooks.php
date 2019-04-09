<?php
/**
 * Truss Action Hooks
 *
 * Just a bunch of utility methods associated with our hooks
 *
 * @package Truss
 * @since 1.0.0
 */

/**
 * Truss truss_comments_before hook.
 * Add extra content before the comments are started.
 *
 * @since 2.0.0
 */
function truss_comments_before() {
	do_action( 'truss_comments_before' );
}

/**
 * Truss truss_comments_after hook.
 * Add extra content after the comments are done.
 *
 * @since 2.0.0
 */
function truss_comments_after() {
	do_action( 'truss_comments_after' );
}

/**
 * Truss truss_head_scripts hook.
 * Allow for additional scripts be be hooked into.
 * We utilize this for additional_head_scripts.
 *
 * @since 2.0.0
 */
function truss_head_scripts() {
	do_action( 'truss_head_scripts' );
}

/**
 * Truss truss_header_before hook.
 * Ability to add stuff before our headers.
 *
 * @since 2.0.0
 */
function truss_header_before() {
	do_action( 'truss_header_before' );
}

/**
 * Truss truss_header_inner_before hook.
 * Add some content within our header but before the rest
 * of our navigation.
 *
 * @since 2.0.0
 */
function truss_header_inner_before() {
	do_action( 'truss_header_inner_before' );
}

/**
 * Truss truss_header_inner_after
 * Add some content within our header but before the rest
 * of our navigation.
 *
 * @since 2.0.0
 */
function truss_header_inner_after() {
	do_action( 'truss_header_inner_after' );
}

/**
 * Truss header_after hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function truss_header_after() {
	do_action( 'truss_header_after' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function truss_content_before() {
	do_action( 'truss_content_before' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function truss_content_after() {
	do_action( 'truss_content_after' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_post_before() {
	do_action( 'truss_post_before' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_post_after() {
	do_action( 'truss_post_after' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_post_inside_before() {
	do_action( 'truss_post_inside_before' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_post_inside_after() {
	do_action( 'truss_post_inside_after' );
}

/**
 * Truss truss_loop_before hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_loop_before() {
	do_action( 'truss_loop_before' );
}

/**
 * Truss truss_loop_after hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_loop_after() {
	do_action( 'truss_loop_after' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_sidebar_before() {
	do_action( 'truss_sidebar_before' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_sidebar_inner_before() {
	do_action( 'truss_sidebar_inner_before' );
}

/**
 * Middleman truss hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_sidebar_inner_after() {
	do_action( 'truss_sidebar_inner_after' );
}

/**
 * Truss truss_sidebar_after hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_sidebar_after() {
	do_action( 'truss_sidebar_after' );
}

/**
 * Truss truss_footer_before hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_footer_before() {
	do_action( 'truss_footer_before' );
}

/**
 * Truss truss_main_footer_inner_before hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_main_footer_inner_before() {
	do_action( 'truss_main_footer_inner_before' );
}

/**
 * Truss truss_main_footer_inner_after hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_main_footer_inner_after() {
	do_action( 'truss_main_footer_inner_after' );
}

/**
 * Truss truss_sub_footer_inner_before hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_sub_footer_inner_before() {
	do_action( 'truss_sub_footer_inner_before' );
}

/**
 * Truss truss_sub_footer_inner_after hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_sub_footer_inner_after() {
	do_action( 'truss_sub_footer_inner_after' );
}

/**
 * Truss truss_footer_after hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_footer_after() {
	do_action( 'truss_footer_after' );
}

/**
 * Truss truss_footer_scripts hook
 *
 * @package Truss
 * @subpackage hooks
 *
 * @since 2.0
 */
function truss_body_before_close() {
	do_action( 'truss_body_before_close' );
}


/**
 * Fallback wp_body_open hook
 *
 * @package Truss
 * @subpackge hooks
 * 
 * @since 2.1
 */

if ( ! function_exists( 'wp_body_open' ) ) {
	do_action( 'wp_body_open' );
}	