<?php
/**
 * Base template for all comments
 *
 * @todo This file could definitely use some cleanup -aware
 *
 * @since 1.0.0
 *
 * @package
 * @subpackage Comments
 */


/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) : ?>

<section id="comments">
	<div class="notice">
		<p class="bottom"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', '<%= text_domain %>' ); ?></p>
	</div>
</section>

<?php else: ?>

<?php
/** This action is documented in includes/Linchpin/truss-hooks.php */
do_action( 'truss_comments_before' ); ?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', '<%= text_domain %>' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>

		<?php truss_comment_nav(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php truss_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', '<%= text_domain %>' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->

<?php
/** This action is documented in includes/Linchpin/truss-hooks.php */
do_action( 'truss_comments_after' );

endif;
