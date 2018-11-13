<?php
/**
 * Rebar Action Hooks
 *
 * Just a bunch of utility methods associated with our hooks
 *
 * @package Rebar
 * @since 1.0.0
 */

?>

<?php

/**
 * Rebar rebar_comments_before hook.
 * Add extra content before the comments are started.
 *
 * @since 2.0.0
 */
function rebar_comments_before() {
	do_action( 'rebar_comments_before' );
}

/**
 * Rebar rebar_comments_after hook.
 * Add extra content after the comments are done.
 *
 * @since 2.0.0
 */
function rebar_comments_after() {
	do_action( 'rebar_comments_after' );
}

/**
 * Rebar rebar_head_scripts hook.
 * Allow for additional scripts be be hooked into.
 * We utilize this for additional_head_scripts.
 *
 * @since 2.0.0
 */
function rebar_head_scripts() {
	do_action( 'rebar_head_scripts' );
}

/**
 * Rebar rebar_header_before hook.
 * Ability to add stuff before our headers.
 *
 * @since 2.0.0
 */
function rebar_header_before() {
	do_action( 'rebar_header_before' );
}

/**
 * Rebar rebar_header_inner_before hook.
 * Add some content within our header but before the rest
 * of our navigation.
 *
 * @since 2.0.0
 */
function rebar_header_inner_before() {
	do_action( 'rebar_header_inner_before' );
}

/**
 * Rebar rebar_header_inner_after
 * Add some content within our header but before the rest
 * of our navigation.
 *
 * @since 2.0.0
 */
function rebar_header_inner_after() {
	do_action( 'rebar_header_inner_after' );
}

/**
 * Rebar header_after hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function rebar_header_after() {
	do_action( 'rebar_header_after' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function rebar_content_before() {
	do_action( 'rebar_content_before' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0.0
 */
function rebar_content_after() {
	do_action( 'rebar_content_after' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_post_before() {
	do_action( 'rebar_post_before' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_post_after() {
	do_action( 'rebar_post_after' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_post_inside_before() {
	do_action( 'rebar_post_inside_before' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_post_inside_after() {
	do_action( 'rebar_post_inside_after' );
}

/**
 * Rebar rebar_loop_before hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_loop_before() {
	do_action( 'rebar_loop_before' );
}

/**
 * Rebar rebar_loop_after hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_loop_after() {
	do_action( 'rebar_loop_after' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_sidebar_before() {
	do_action( 'rebar_sidebar_before' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_sidebar_inner_before() {
	do_action( 'rebar_sidebar_inner_before' );
}

/**
 * Middleman rebar hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_sidebar_inner_after() {
	do_action( 'rebar_sidebar_inner_after' );
}

/**
 * Rebar rebar_sidebar_after hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_sidebar_after() {
	do_action( 'rebar_sidebar_after' );
}

/**
 * Rebar rebar_footer_before hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_footer_before() {
	do_action( 'rebar_footer_before' );
}

/**
 * Rebar rebar_main_footer_inner_before hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_main_footer_inner_before() {
	do_action( 'rebar_main_footer_inner_before' );
}

/**
 * Rebar rebar_main_footer_inner_after hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_main_footer_inner_after() {
	do_action( 'rebar_main_footer_inner_after' );
}

/**
 * Rebar rebar_sub_footer_inner_before hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_sub_footer_inner_before() {
	do_action( 'rebar_sub_footer_inner_before' );
}

/**
 * Rebar rebar_sub_footer_inner_after hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_sub_footer_inner_after() {
	do_action( 'rebar_sub_footer_inner_after' );
}

/**
 * Rebar rebar_footer_after hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_footer_after() {
	do_action( 'rebar_footer_after' );
}

/**
 * Rebar rebar_footer_scripts hook
 *
 * @package Rebar
 * @subpackage hooks
 *
 * @since 2.0
 */
function rebar_body_before_close() {
	do_action( 'rebar_body_before_close' );
}
