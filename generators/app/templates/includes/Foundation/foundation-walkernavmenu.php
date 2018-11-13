<?php
/**
 * Foundation Nav Walker Class
 *
 * This is a custom nav walker that will add in custom styles based on
 * the foundation structure and the items found in FoundationPress
 *
 * @package Foundation
 * @author olfredrik, aware
 * @since 1.0
 */

/**
 * Class Foundation_Walker_Nav_Menu
 */
class Foundation_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Display our menu element
	 *
	 * @since 1.0
	 *
	 * @param object $element Menu element.
	 * @param array  $children_elements List of child element.
	 * @param int    $max_depth Max depth of children.
	 * @param int    $depth Current Depth.
	 * @param array  $args Extra args for control.
	 * @param string $output HTML output.
	 *
	 * @return mixed
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$element->has_children = ! empty( $children_elements[ $element->ID ] );
		$element->classes[]    = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
		$element->classes[]    = ( $element->has_children ) ? 'has-dropdown' : '';

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Start our element structure.
	 *
	 * @since 1.0
	 *
	 * @param string $output HTML output.
	 * @param object $object Our current object.
	 * @param int    $depth Out current depth.
	 * @param array  $args More args for control.
	 * @param int    $current_object_id Our current object.
	 */
	function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {

		$item_html = '';

		parent::start_el( $item_html, $object, $depth, $args );

		$classes = empty( $object->classes ) ? array() : (array) $object->classes;

		if ( in_array( 'label', $classes ) ) {
			$item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html );
		}

		if ( in_array( 'divider', $classes ) ) {
			$item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '', $item_html );
		}

		$output .= $item_html;
	}

	/**
	 * Start our current level
	 *
	 * @since 1.0
	 *
	 * @param string $output HTML output.
	 * @param int    $depth Our current depth.
	 * @param array  $args More output customization.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n<ul class=\"sub-menu dropdown\">\n";
	}
}
