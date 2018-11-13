<?php
/**
 * Loop Template
 *
 * The default template for displaying looped content.
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Templates
 */

?>

<?php
/** This action is documented in includes/Linchpin/truss-hooks.php */
do_action( 'truss_post_before' ); ?>

	<article <?php post_class( 'small-12 medium-6 large-4 columns' ) ?> id="post-<?php the_ID(); ?>" data-equalizer-watch>

		<header>
			<?php the_title( '<h3 class="entry-title"><a href="' . get_the_permalink() . '">', '</a></h3>' ); ?>
			<?php truss_entry_meta(); ?>
		</header>

		<div class="entry-content">

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="row">
					<div class="small-12 columns">
						<?php the_post_thumbnail( '', array( 'class' => 'th' ) ); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php
			/** This action is documented in includes/Linchpin/truss-hooks.php */
			do_action( 'truss_post_entry_content_before' ); ?>

			<?php the_excerpt(); ?>

			<?php get_template_part( 'partials/edit-controls' ); ?>

			<?php
			/** This action is documented in includes/Linchpin/truss-hooks.php */
			do_action( 'truss_post_entry_content_after' ); ?>
		</div>

	</article>
<?php
/** This action is documented in includes/Linchpin/truss-hooks.php */
do_action( 'truss_post_after' );
