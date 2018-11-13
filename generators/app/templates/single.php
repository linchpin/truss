<?php
/**
 * Single Post Template
 *
 * Default template utilized for single posts
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

	<div class="row container">
		<div class="small-12 medium-8 columns" role="main">

			<?php do_action( 'truss_content_before' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content' ); ?>

			<?php endwhile; ?>

			<?php do_action( 'truss_after_content' ); ?>

		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer();
