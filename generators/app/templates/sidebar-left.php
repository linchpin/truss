<?php
/**
 * Left Sidebar Template
 *
 * Template used when the sidebar is shown on the left
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Sidebars
 */

?>

<?php do_action( 'rebar_sidebar_before' ); ?>

<aside id="sidebar" class="small-12 large-4 columns large-pull-8">

	<?php do_action( 'rebar_sidebar_inside_before' ); ?>

	<?php dynamic_sidebar( 'page-widgets' ); ?>

	<?php do_action( 'rebar_sidebar_inside_after' ); ?>

</aside>

<?php do_action( 'rebar_after_sidebar' );
