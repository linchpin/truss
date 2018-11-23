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

<div class="grid-container">
	<div class="grid-x">
		<div class="cell small-12" role="main">
			<?php get_template_part( 'partials/loop', 'page' ); ?>
		</div>
	</div>
</div>

<?php
get_footer();
