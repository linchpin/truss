<?php
/**
 * Template Name: Left Sidebar
 *
 * Sidebar on left
 *
 * @since <%= theme_version %>
 *
 * @package <%= class_name %>
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

<div class="grid-x container">
	<div class="small-12 large-8 large-push-4 cell" role="main">
		<?php get_template_part( 'partials/loop', get_post_type() ); ?>
	</div>
	<?php get_sidebar( 'left' ); ?>
</div>
<?php get_footer();
