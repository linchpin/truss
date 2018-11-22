<?php
/**
 * Foundation Utilities
 *
 * @since      1.0
 *
 * @package    Truss
 * @subpackage Foundation
 */

namespace Foundation;

/**
 * Class Utilities
 */
class Utilities {

	/**
	 * __construct function.
	 *
	 * @since 1.0
	 *
	 * @access public
	 */
	public function __construct() {
		include_once 'class-walkernavmenu.php';
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

		$pages = paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => $current,
				'total'     => $wp_query->max_num_pages,
				'type'      => 'array',
				'prev_next' => true,
				'prev_text' => esc_html( $prev_text ),
				'next_text' => esc_html( $next_text ),
			)
		);

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

		$html .= sprintf(
			// translators: 1. Menu Link 2. Customize Links
			wp_kses( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.' ), '<%= text_domain %>', array( 'a' => array( 'href' ) ) ),
			self::sanitize_menu_fallback( 'nav-menus.php', __( 'Menu', '<%= text_domain %>' ) ),
			self::sanitize_menu_fallback( 'customize.php', __( 'Customize', '<%= text_domain %>' ) )
		);
		$html .= '</div>';

		return $html;
	}

	/**
	 * Simple utility method to get a menu item and a destination
	 *
	 * @since 1.0
	 */
	public static function sanitize_menu_fallback( $target_page, $label ) {

		$allowed_html = array(
			'a' => array( 'href' ),
		);

		$menu_item = sprintf(
			wp_kses(
				// translators: 1. Menu Link 2. Customize Links
				__( '<a href="%1$s">%2$s</a>', '<%= text_domain %>' ),
				$allowed_html
			),
			get_admin_url( get_current_blog_id(), $target_page ),
			$label
		);

		return $menu_item;
	}
}
