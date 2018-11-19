<?php
/**
 * Search Results Template
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Search
 */

?>
<?php get_header(); ?>

	<div class="grid-x container">
	<div class="small-12 large-8 cell" role="main">

		<h2><?php esc_html_e( 'Search Results for', 'clientname' ); ?>
			"<?php esc_html_e( get_search_query() ); ?>"</h2>

		<?php
		/** This action is documented in includes/Linchpin/truss-hooks.php */
		do_action( 'truss_content_before' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			/** This action is documented in includes/Linchpin/truss-hooks.php */
			do_action( 'truss_loop_before' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/loop-post', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php
			/** This action is documented in includes/Linchpin/truss-hooks.php */
			do_action( 'truss_loop_after' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		<?php
		/** This action is documented in includes/Linchpin/truss-hooks.php */
		do_action( 'truss_content_after' ); ?>

		<?php get_template_part( 'partials/pagination' ); ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer();
