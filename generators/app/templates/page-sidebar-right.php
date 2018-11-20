<?php
/**
 * Template Name: Right Sidebar
 *
 * @since 1.0.0
 *
 * @package
 * @subpackage Templates
 */

?>
<?php get_header(); ?>

<div class="grid-x container">
	<div class="small-12 large-8 cell" role="main">
		<?php get_template_part( 'partials/loop', get_post_type() ); ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
