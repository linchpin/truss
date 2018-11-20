<?php
/**
 * Shortcodes
 *
 * @package    Truss
 * @subpackage Foundation
 * @since 1.0
 */

namespace Foundation;

/**
 * Class hortcodes
 */
class Shortcodes {

	/**
	 * Construct
	 */
	public function __construct() {
		add_shortcode( 'wp_caption', array( $this, 'fixed_img_caption_shortcode' ) );
		add_shortcode( 'caption', array( $this, 'fixed_img_caption_shortcode' ) );
	}

	/**
	 * Remove default inline style of wp-caption
	 *
	 * @since 1.0
	 *
	 * @param mixed $attr Customization attributes.
	 * @param mixed $content Output of our content.
	 *
	 * @return string
	 */
	public function fixed_img_caption_shortcode( $attr, $content = null ) {
		if ( ! isset( $attr['caption'] ) ) {
			if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
				$content         = $matches[1];
				$attr['caption'] = trim( $matches[2] );
			}
		}

		$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );

		if ( '' !== $output ) {
			return $output;
		}

		shortcode_atts(
			array(
				'id'      => '',
				'align'   => 'alignnone',
				'width'   => '',
				'caption' => '',
			),
			$attr
		);

		if ( 1 > (int) $attr['width'] || empty( $attr['caption'] ) ) {
			return $content;
		}

		if ( isset( $id ) ) {
			$id = 'id="' . esc_attr( $attr['id'] ) . '" '; // @todo ID isn't used here is it needed? -aware
		}

		return '<figure>' . do_shortcode( $content ) . '<figcaption>' . $attr['caption'] . '</figcaption></figure>';
	}
}
