<?php
/**
 * Front Page Template
 *
 * Default template utilized when your theme has a define "Front Page"
 * within Setting->Reading within the WordPress admin
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage Templates
 */

?>

<?php get_header(); ?>

<?php get_template_part( 'partials/hero' ); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="grid-container">
        	<div class="grid-x">
            	<div class="cell padding-vertical">
					<?php the_title( '<h1>', '</h1>' ); ?>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>

<?php if ( function_exists( 'mesh_display_sections' ) ) {
	mesh_display_sections();
} ?>

<?php
get_footer();
