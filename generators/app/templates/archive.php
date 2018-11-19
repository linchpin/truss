<?php
/**
 * Archive Template
 *
 * Template for displaying all default archive pages.
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<div class="row container">
	<div class="small-12 medium-8 columns" role="main">
		<?php
		/** This action is documented in includes/Linchpin/truss-hooks.php */
		do_action( 'truss_content_before' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
			/** This action is documented in includes/Linchpin/truss-hooks.php */
			do_action( 'truss_loop_before' );
			?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/loop', get_post_type() ); ?>

			<?php endwhile; ?>

			<?php
			/** This action is documented in includes/Linchpin/truss-hooks.php */
			do_action( 'truss_loop_after' );
			?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		<?php
		/** This action is documented in includes/Linchpin/truss-hooks.php */
		do_action( 'truss_content_after' );
		?>

		<?php get_template_part( 'includes/partials/pagination' ); ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
