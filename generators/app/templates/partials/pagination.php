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

<?php do_action( 'truss_pagination_before' ); ?>

<?php if ( function_exists( 'truss_pagination' ) ) :
	truss_pagination( '&laquo;', '&raquo;' );
elseif ( is_paged() ) : ?>
	<nav id="post-nav">
		<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'clientname' ) ); ?></div>
		<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'clientname' ) ); ?></div>
	</nav>
<?php endif; ?>

<?php do_action( 'truss_pagination_after' );
