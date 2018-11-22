<?php
/**
 * Foundation Cleanup
 *
 * Help cleanup markup on image elements. Make sure images don't autop, cleanup some recent comment styling
 *
 * @since 1.0
 *
 * @package Truss
 * @subpackage Foundation
 */

namespace Foundation;

/**
 * Class Cleanup
 */
class Cleanup {

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'start_cleanup' ) );
	}

	/**
	 * Start our theme cleanup.
	 *
	 * @access public
	 * @return void
	 */
	public function start_cleanup() {
		add_action( 'wp_head', array( $this, 'remove_recent_comments_style' ), 1 );           // Clean up comment styles in the head.
		add_filter( 'wp_head', array( $this, 'remove_wp_widget_recent_comments_style' ), 1 ); // Remove injected css for recent comments widget.

		add_filter( 'gallery_style', array( $this, 'gallery_style' ) );                       // Clean up gallery output in WordPress.
		add_filter( 'get_image_tag_class', array( $this, 'image_tag_class' ), 0, 4 );         // Additional post related cleaning.
		add_filter( 'get_image_tag', array( $this, 'image_editor' ), 0, 4 );
		add_filter( 'the_content', array( $this, 'img_unautop' ), 30 );
		add_filter( 'edit_comment_link', array( $this, 'edit_comment_link' ) );
	}

	/**
	 * Filter our Edit Comment Link
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $link Our Link we are filtering.
	 * @return string
	 */
	public function edit_comment_link( $link ) {

		$link = str_replace( 'class="comment-edit-link"', 'class="comment-edit-link button tiny error"', $link );

		return $link;
	}

	/**
	 * Remove injected CSS for recent comments widget
	 *
	 * @access public
	 * @return void
	 */
	public function remove_wp_widget_recent_comments_style() {
		if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
			remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
		}
	}

	/**
	 * Wrap images with figure tag
	 *
	 * @param mixed $input_p_tag Our simple <p> tag.
	 * @return string
	 */
	public function img_unautop( $input_p_tag ) {
		return preg_replace( '/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '$1', $input_p_tag );
	}

	/**
	 * Remove width and height in editor, for a better responsive world.
	 *
	 * @todo see if this is still relevant, not sure if we need to remove this? -aware
	 *
	 * @since 1.0
	 *
	 * @param mixed $html HTML markup of image.
	 * @param mixed $image_id ID of the image.
	 * @param mixed $image_alt ALT Tag attribute of the image.
	 * @param mixed $title Title of our image.
	 *
	 * @return string
	 */
	public function image_editor( $html, $image_id, $image_alt, $title ) {
		return preg_replace( array( '/\s+width="\d+"/i', '/\s+height="\d+"/i', '/alt=""/i' ), array( '', '', '', 'alt="' . $title . '"' ), $html );
	}

	/**
	 * Remove injected CSS from recent comments widget
	 *
	 * @since 1.0
	 */
	public function remove_recent_comments_style() {
		global $wp_widget_factory;

		if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
	}

	/**
	 * Remove injected CSS from gallery
	 *
	 * @param mixed $css CSS styles of the gallery.
	 *
	 * @return string
	 */
	public function gallery_style( $css ) {
		return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
	}

	/**
	 * Clean the output of attributes of images in editor
	 *
	 * @since 1.0
	 *
	 * @param mixed $class CSS class on the element.
	 * @param mixed $image_id ID of the element.
	 * @param mixed $align Alignment of the image left|center|right.
	 * @param mixed $size Size of the image.
	 *
	 * @return string
	 */
	public function image_tag_class( $class, $image_id, $align, $size ) {
		$align = 'align' . esc_attr( $align );
		return $align;
	}
}
