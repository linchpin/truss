<?php
/**
 * Template Name: Large Header
 *
 * @since <%= theme_version %>
 *
 * @package <%= class_name %>
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

	<?php get_template_part( 'partials/pageheader', 'large' ); ?>

	<div class="grid-x container">

		<div class="small-12 cell" role="main">

			<?php
			/** This action is documented in includes/Linchpin/utilities/hooks.php */
			do_action( 'truss_content_before' );
			?>

			<?php if ( have_posts() ) : ?>

				<?php
				/** This action is documented in includes/Linchpin/utilities/hooks.php */
				do_action( 'truss_loop_before' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php endwhile; ?>

				<?php
				/** This action is documented in includes/Linchpin/utilities/hooks.php */
				do_action( 'truss_loop_after' );
				?>

			<?php else : ?>

				<?php get_template_part( 'partials/content', 'none' ); ?>

			<?php endif; ?>

			<?php
			/** This action is documented in includes/Linchpin/utilities/hooks.php */
			do_action( 'truss_content_after' );
			?>
		</div>

	</div>
<?php get_footer();
