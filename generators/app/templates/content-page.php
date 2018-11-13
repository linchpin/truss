<?php
/**
 * Content Template
 *
 * The default template for displaying content. Used within single and index/archive/search templates.
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Templates
 */

global $truss_templates_with_title;
?>

<?php
/** This action is documented in includes/Linchpin/truss-hooks.php */
do_action( 'truss_post_before' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( ! in_array( basename( get_page_template() ), $truss_templates_with_title ) ) : ?>
        <header>
            <h1><?php the_title(); ?></h1>
        </header>
    <?php endif; ?>

	<?php
	/** This action is documented in includes/Linchpin/truss-hooks.php */
	do_action( 'truss_post_entry_content_before' ); ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading...', 'clientname' ) ); ?>
	</div>

	<?php
	/** This action is documented in includes/Linchpin/truss-hooks.php */
	do_action( 'truss_post_entry_content_after' ); ?>

	<?php get_template_part( 'partials/edit-controls' ); ?>
</article>

<?php
/** This action is documented in includes/Linchpin/truss-hooks.php */
do_action( 'truss_post_after');
