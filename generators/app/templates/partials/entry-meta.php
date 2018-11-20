<?php
/**
 * Output Post/Entry Meta
 *
 * This is pretty much used in blog posts
 *
 * @since      1.0.0
 *
 * @package    Truss
 * @subpackage TemplateParts
 */
?>
<time class="updated" datetime="<?php echo get_the_time( 'c' ); ?>" pubdate>
	<?php
	printf(
		esc_html(
			// translators: 1. date of post 2. time of post
			__( 'Posted on %1$s at %2$s.', '<%= text_domain %>' )
		), get_the_time( 'l, F jS, Y' ),
		get_the_time()
	);
	?>
</time>
<p class="byline author" itemprop="author" itemscope itemtype="http://schema.org/Person">
	<?php esc_html_e( 'Written by ', 'truss' ); ?>
	<a href="<?php echo esc_attr( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="fn">
		<span itemprop="name">><?php echo get_the_author(); ?></span
	</a>
</p>
