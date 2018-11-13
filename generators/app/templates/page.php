<?php
/**
 * Default Page Template
 *
 * Default template utilized for pages
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

	<div class="row container">

		<div class="small-12 columns" role="main">

			<?php
			/** This action is documented in includes/Linchpin/truss-hooks.php */
			do_action( 'truss_content_before' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php
				/** This action is documented in includes/Linchpin/truss-hooks.php */
				do_action( 'truss_loop_before' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

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

		</div>

	</div>
<?php get_footer();
