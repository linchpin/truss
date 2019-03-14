<?php
/**
 * Default Page Template
 *
 * Default template utilized for all pages
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage Templates
 */

?>

<?php get_header(); ?>
    <div class="grid-x">
        <div class="small-12 cell" role="main">
			<?php get_template_part( 'partials/loop', get_post_type() ); ?>
        </div>
    </div>
<?php
get_footer();
