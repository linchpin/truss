<?php
/**
 * Truss
 *
 * Houses various utility methods.
 *
 * @package Truss
 * @since   1.0
 */

namespace Truss;

/**
 * Class Utilities
 */
class Utilities {

	/**
	 * __construct function.
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'edit_category', array( $this, 'category_transient_flusher' ) );
		add_action( 'save_post', array( $this, 'category_transient_flusher' ) );

		add_action( 'truss_before_content', array( 'TrussUtilities', 'breadcrumbs' ) );
	}

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 * @return bool
	 */
	public static function categorized_blog() {

		$all_the_cool_cats = get_transient( 'truss_categories' );

		if ( false === $all_the_cool_cats ) {

			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					'number'     => 2, // We only need to know if there is more than one category.
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'truss_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so test_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so test_categorized_blog should return false.
			return false;
		}
	}

	/**
	 * Flush out the transients used in test_categorized_blog.
	 *
	 * @access public
	 * @return void
	 */
	public function category_transient_flusher() {
		delete_transient( 'truss_categories' );
	}

	/**
	 * Define our breadcrumbs
	 * Loosely based on http://cazue.com/articles/wordpress-creating-breadcrumbs-without-a-plugin-2013
	 *
	 * @since 1.2.0
	 *
	 * If WordPress SEO Breadcrumbs are enabled use that instead.
	 * If the site uses Breadcrumbs NavXT use that instead.
	 *
	 * @access public
	 * @return void
	 */
	public static function breadcrumbs() {

		// If Yoast Breadcrumbs are installed and enabled.
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb();
			return;
		}

		// Use BreadCrumbNavXT is available.
		if ( function_exists( 'bcn_display' ) ) : ?>
			<ul class="breadcrumbs">
				<?php bcn_display(); ?>
			</ul>
		<?php
			return;
		endif; // End bcn check.
		?>

		<ul class="breadcrumbs">
		<?php

		global $post;

		if ( ! is_home() ) {
		?>
			<li>
				<a href="<?php echo esc_attr( get_option( 'home' ) ); ?>">
					<?php esc_html_e( 'Home', '<%= text_domain %>' ); ?>
				</a>
			</li>
			<?php
			if ( is_category() || is_single() ) :
				$categories = get_the_category()
			?>
				<?php if ( ! empty( $categories ) ) : ?>
					<li>
						<a href="<?php echo esc_attr( get_term_link( current( $categories ), 'category' ) ); ?>"><?php echo esc_html( current( $categories )->name ); ?></a>
					</li>
				<?php endif; ?>

				<?php if ( is_single() ) : ?>
					<li><?php the_title(); ?></li>
				<?php endif; ?>

			<?php elseif ( is_page() ) : ?>

				<?php

				if ( $post->post_parent ) :
					$anc = get_post_ancestors( $post->ID );

					foreach ( $anc as $ancestor ) :
					?>
						<li>
							<a href="<?php echo esc_attr( get_permalink( $ancestor ) ); ?>" title="<?php echo esc_attr( get_the_title( $ancestor ) ); ?>"><?php echo esc_html( get_the_title( $ancestor ) ); ?></a>
						</li>
					<?php endforeach; ?>

					<li class="current"><?php echo esc_html( get_the_title() ); ?></li>

				<?php else : ?>

					<li class="current"><?php echo esc_html( get_the_title() ); ?></li>

				<?php endif; ?>
			<?php endif; ?>
		<?php
		} elseif ( is_tag() ) {
			single_tag_title();
		} elseif ( is_day() ) {
		?>
			<li>
			<?php
			// translators: %s Archive Day.
			sprintf( esc_html__( 'Archive for %s', '<%= text_domain %>' ), the_time( 'F jS, Y' ) );
			?>
			</li>
		<?php } elseif ( is_month() ) { ?>
			<li>
			<?php
			// translators: %s Archive Month.
			sprintf( esc_html__( 'Archive for %s', '<%= text_domain %>' ), the_time( 'F, Y' ) );
			?>
			</li>
		<?php } elseif ( is_year() ) { ?>
			<li>
			<?php
			// translators: %s Year Month.
			sprintf( esc_html__( 'Archive for %s', '<%= text_domain %>' ), the_time( 'Y' ) );
			?>
		<?php } elseif ( is_author() ) { ?>
			<li><?php esc_html__( 'Author Archive', '<%= text_domain %>' ); ?></li>
		<?php } elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { // WPCS ignore. ?>
			<li><?php esc_html__( 'Blog Archives', '<%= text_domain %>' ); ?></li>
		<?php } elseif ( is_search() ) { ?>
			<li><?php esc_html__( 'Search Results', '<%= text_domain %>' ); ?></li>
		<?php } ?>
		</ul>
	<?php
	}

	/**
	 * Define our comment nav
	 *
	 * @since 1.2.0
	 *
	 * @access public
	 * @return void
	 */
	public static function comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', '<%= text_domain %>' ); ?></h2>
			<div class="nav-links">
				<?php

				$prev_link = get_previous_comments_link( esc_html__( 'Older Comments', '<%= text_domain %>' ) );

				if ( $prev_link ) {
					printf( '<div class="nav-previous">%s</div>', $prev_link ); // WPCS xss ok.
				}

				$next_link = get_next_comments_link( esc_html__( 'Newer Comments', '<%= text_domain %>' ) );

				if ( $next_link ) {
					printf( '<div class="nav-next">%s</div>', $next_link ); // WPCS xss ok.
				}
				?>
			</div>
		</nav>
		<?php
		endif;
	}

	/**
	 * Determine if we should show the header in the content or not
	 *
	 * @return bool
	 */
	public static function show_header_in_content() {

		$templates_with_title = array(
			'page-large-header.php',
			'page-slim-header.php',
		);

		$templates_with_title = apply_filters( 'truss_templates_with_title', $templates_with_title );

		return ! in_array( basename( get_page_template() ), $templates_with_title, true );
	}
}
