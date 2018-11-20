<?php
/**
 * Default Page Template
 *
 * Default template utilized for all pages
 *
 * @since 1.0.0
 *
 * @package
 * @subpackage Templates
 */

?>

<?php get_header(); ?>
	<div class="grid-x container">
		<div class="small-12 cell" role="main">
			<?php get_template_part( 'partials/loop', get_post_type() ); ?>
		</div>
	</div>
<?php get_footer();
