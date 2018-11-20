<?php
/**
 * Template Name: Slim Header
 *
 * Template for pages with a smaller header
 *
 * @since 1.0.0
 *
 * @package
 * @subpackage Templates
 */

?>

<?php get_header(); ?>
<?php get_template_part( 'partials/pageheader' ); ?>
	<div class="grid-x container">
		<div class="small-12 cell" role="main">
			<?php get_template_part( 'partials/loop', get_post_type() ); ?>
		</div>
	</div>
<?php get_footer();
