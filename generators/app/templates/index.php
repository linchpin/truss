<?php
/**
 * Catch All Template
 *
 * Catch all template file within the Template Hierarchy.
 *
 * @since 1.0
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
