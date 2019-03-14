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

<?php if ( function_exists( 'mesh_display_sections' ) ) {
	mesh_display_sections();
} ?>

<?php
get_footer();
