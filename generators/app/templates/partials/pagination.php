<?php
/**
 * Pagination Partial
 *
 * Display navigation to next/previous pages when applicable.
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackage Partials
 */

?>

<?php do_action( 'rebar_pagination_before' ); ?>

<?php if ( function_exists( 'rebar_pagination' ) ) :
	rebar_pagination( '&laquo;', '&raquo;' );
elseif ( is_paged() ) : ?>
	<nav id="post-nav">
		<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'truss' ) ); ?></div>
		<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'truss' ) ); ?></div>
	</nav>
<?php endif; ?>

<?php do_action( 'rebar_pagination_after' );
