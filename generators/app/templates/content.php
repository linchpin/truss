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

?>

<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_before' ); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		<header>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php rebar_entry_meta(); ?>
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
			/** This action is documented in includes/Linchpin/hatch-hooks.php */
			do_action( 'rebar_post_entry_content_before' ); ?>

			<?php the_content(); ?>

			<?php
			/** This action is documented in includes/Linchpin/hatch-hooks.php */
			do_action( 'rebar_post_entry_content_after' ); ?>
		</div>

		<footer>
			<?php wp_link_pages( array(
				'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'truss' ),
				'after'  => '</p></nav>',
			) ); ?>
			<div class="tags"><?php the_tags(); ?></div>
		</footer>

		<?php get_template_part( 'partials/edit-controls' ); ?>

		<hr/>

		<?php

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif; ?>

	</article>
<?php
/** This action is documented in includes/Linchpin/hatch-hooks.php */
do_action( 'rebar_post_after' );
