<?php
/**
 * Page Loop Template
 *
 * The default template for displaying looped content within pages
 *
 * @since 1.0.0
 *
 * @package    Truss
 * @subpackage Templates
 */

?>

<?php
/** This action is documented in includes/Linchpin/utilities/hooks.php */
do_action( 'truss_post_before' );
?>

<article <?php post_class( 'small-12 medium-6 large-4 cell' ); ?> id="post-<?php the_ID(); ?>" data-equalizer-watch>

	<header>
		<?php the_title( '<h3 class="entry-title" itemprop="name"><a href="' . get_the_permalink() . '" itemprop="url">', '</a></h3>' ); ?>
		<?php truss_entry_meta(); ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="grid-x">
			<div class="small-12 cell" itemprop="image">
				<?php the_post_thumbnail( '', array( 'class' => 'th' ) ); ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="entry-content" itemprop="articleBody">
		<?php
		/** This action is documented in includes/Linchpin/utilities/hooks.php */
		do_action( 'truss_post_entry_content_before' );
		?>
		<?php the_excerpt(); ?>
		<?php
		/** This action is documented in includes/Linchpin/utilities/hooks.php */
		do_action( 'truss_post_entry_content_after' );
		?>
	</div>

</article>
<?php
/** This action is documented in includes/Linchpin/utilities/hooks.php */
do_action( 'truss_post_after' );
