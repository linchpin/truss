<?php
/**
 * No Content Found Template
 *
 * The template used for displaying a "No posts found" message.
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Templates
 */

?>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_before' ); ?>

<header class="page-header">
	<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'truss' ); ?></h1>
</header>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'truss' ), array( 'a' => array( 'href' ) ) ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'truss' ); ?></p>
		<?php get_search_form(); ?>

	<?php else : ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'truss' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_after' );
