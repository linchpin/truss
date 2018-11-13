<?php
/**
 * FoundationUtilities.
 *
 * @package Foundation
 * @since 1.0
 */

/**
 * Class FoundationUtilities
 */
class FoundationUtilities {

	/**
	 * __construct function.
	 *
	 * @since 1.0
	 *
	 * @access public
	 */
	function __construct() {
		include_once( 'foundation-walkernavmenu.php' );
	}

	/**
	 * Pagination links.
	 *
	 * @todo Should probably convert the options to an array to add more flexiblity to the formatting @aware
	 *
	 * @access public
	 *
	 * @param string $prev_text (default: '&laquo').
	 * @param string $next_text (default: '&raquo').
	 *
	 * @return string
	 */
	public static function paginate_links( $prev_text = '&laquo;', $next_text = '&raquo;' ) {

		global $wp_query;

		$big        = 999999999; // Need an unlikely integer.
		$pagination = '';
		$current    = max( 1, get_query_var( 'paged' ) );

		$pages = paginate_links( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'current'   => $current,
			'total'     => $wp_query->max_num_pages,
			'prev_next' => false,
			'type'      => 'array',
			'prev_next' => true,
			'prev_text' => __( $prev_text ),
			'next_text' => __( $next_text ),
		) );

		if ( is_array( $pages ) ) {
			$paged = ( get_query_var( 'paged' ) === 0 ) ? 1 : get_query_var( 'paged' );

			$pagination .= '<ul class="pagination">';

			$start_page = ( 1 === $current ) ? 1 : 0; // Need to offset if using prev_text / next_text.
			$page_count = $start_page;

			foreach ( $pages as $page ) {
				$pagination .= '<li' . ( ( $page_count === $paged ) ? ' class="current"' : '' ) . ">$page</li>";
				$page_count ++;
			}

			$pagination .= '</ul>';
		}

		return $pagination;
	}

	/**
	 * Define our menu fallback
	 *
	 * @return string
	 */
	public static function menu_fallback() {

		$html = '<div class="alert-box secondary">';

		$html .= sprintf( esc_html( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.' ), 'truss' ),
			sprintf( wp_kses( __( '<a href="%s">Menus</a>', 'truss' ), array( 'a' => array('href') ) ), get_admin_url( get_current_blog_id(), 'nav-menus.php' ) ),
			sprintf( wp_kses( __( '<a href="%s">Customize</a>', 'truss' ), array( 'a' => array('href') ) ), get_admin_url( get_current_blog_id(), 'customize.php' ) )
		);
		$html .= '</div>';

		return $html;
	}
}

/**
 *    Some backwards compatibility
 */

/**
 * FoundationPress_menu_fallback function.
 * A fallback when no navigation is selected by default.
 *
 * @since 1.0
 *
 * @access public
 */
function truss_menu_fallback() {
	echo FoundationUtilities::menu_fallback();
}

/**
 * Truss pagination pass through function.
 *
 * @since 1.0
 *
 * @access public
 *
 * @param mixed $prev_text Text for our previous link.
 * @param mixed $next_text Text for our next link.
 */
function truss_pagination( $prev_text, $next_text ) {
	echo FoundationUtilities::paginate_links( $prev_text, $next_text );
}

/**
 * Add some meta information about our post
 *
 * @todo: This needs a filter.
 *
 * @access public
 * @return void
 */
function truss_entry_meta() {
	?>
	<time class="updated" datetime="<?php echo get_the_time( 'c' ); ?>" pubdate><?php printf( esc_html( __( 'Posted on %s at %s.', 'truss' ) ), get_the_time( 'l, F jS, Y' ), get_the_time() ); ?></time>
	<p class="byline author"><?php esc_html_e( 'Written by ', 'truss' ); ?><a href="<?php esc_attr_e( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></p>
	<?php
}

/**
 * Left top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function truss_top_bar_l() {
	wp_nav_menu( array(
		'container'       => false,
		'container_class' => '',
		'menu'            => '',
		'menu_class'      => 'top-bar-menu left',
		'theme_location'  => 'top-bar-l',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 5,
		'fallback_cb'     => false,
		'walker'          => new Foundation_Walker_Nav_Menu(),
	) );
}

/**
 * Right top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function truss_top_bar_r() {
	wp_nav_menu( array(
		'container'       => false,
		'container_class' => '',
		'menu'            => '',
		'menu_class'      => 'top-bar-menu right',
		'theme_location'  => 'top-bar',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 5,
		'fallback_cb'     => false,
		'walker'          => new Foundation_Walker_Nav_Menu(),
	) );
}

/**
 * Footer
 */
function truss_footer() {
	wp_nav_menu( array(
		'container'       => false,
		'container_class' => '',
		'menu'            => '',
		'menu_class'      => 'inline-list footer-menu',
		'theme_location'  => 'footer',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 5,
		'fallback_cb'     => false,
	) );
}

/**
 * Mobile off-canvas
 */
function truss_mobile_off_canvas() {
	wp_nav_menu( array(
		'container'       => false,
		'container_class' => '',
		'menu'            => '',
		'menu_class'      => 'off-canvas-list',
		'theme_location'  => 'mobile-off-canvas',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 5,
		'fallback_cb'     => false,
		'walker'          => new Foundation_Walker_Nav_Menu(),
	) );
}
