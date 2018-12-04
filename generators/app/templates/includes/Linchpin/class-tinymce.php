<?php
/**
 * Modifications to the TinyMCE editor.
 *
 * @package Truss
 * @since   1.0
 */

namespace Truss;

/**
 * Class truss_TinyMCE
 */
class TinyMCE {

	/**
	 * Construct.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'admin_head', array( $this, 'admin_head_add_typekit_id' ) ); // Add Typekit ID to Customizer
		add_action( 'admin_init', array( $this, 'admin_init' ) ); // Add Base styles to editor
		add_filter( 'mce_external_plugins', array( $this, 'mce_external_plugins_typekit' ) ); // Add Typekit editor if needed
		add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ) ); // Add Dynamic Styles to Editor
	}

	/**
	 * Add custom css to our admin editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_init() {
		add_editor_style( 'css/admin-editor.css' );
	}

	/**
	 * Add Typekit ID to variable so we can grab it from the tinymce script
	 *
	 * @since 1.0.1
	 */
	public function admin_head_add_typekit_id() {
		// Use whichever method you like to grab the Typekit ID
		$typekit_kit = get_theme_mod( 'typekit-kit', '' );
		?>
		<script type="text/javascript">
            var global_typekit_id = '<?php echo esc_attr( $typekit_kit ); ?>';
		</script>
		<?php
	}

	/**
	 * Check to see if we have typekit enabled.
	 * If so add it as a plugin to TinyMCE
	 *
	 * @link https://tomjn.com/2012/09/10/typekit-wp-editor-styles/
	 *
	 * @since 1.0.1
	 *
	 * @param $plugin_array
	 *
	 * @return array
	 */
	public function mce_external_plugins_typekit( $plugins = array() ) {

		// Check if we have Typekit enabled
		$typekit_kit = get_theme_mod( 'typekit-kit', '' );
		$typekit     = get_theme_mod( 'use-typekit', 0 );

		if ( $typekit && $typekit_kit && ! is_customize_preview ) {
			// You may need to update the path to the js file below
			$plugins['typekit'] = get_template_directory_uri() . '/assets/js/tinymce.typekit.js';
		}
		return $plugins;
	}

	/**
	 * Adds styles from customizer to head of TinyMCE iframe.
	 * @link https://www.mattcromwell.com/dynamic-tinymce-editor-styles-wordpress/
	 */
	public function tiny_mce_before_init( $mce_init ) {

		// Add each style to this array
		$styles          = array();
		$secondary_color = get_theme_mod( 'secondary-color' );

		if ( $secondary_color ) {
			$styles[] = 'color: ' . esc_attr( $secondary_color );
		}

		$typekit_kit = showcase_editor_use_typekit();

		if ( $typekit_kit ) {
			$mod = get_theme_mod( 'typekit-font-family', '' );
			$styles[] = 'font-family: ' . $mod . ', sans-serif';
		}
		// Join the $styles array using semi-colon as separator
		// Then add to style rule to pass back to TinyMCE
		$mce_styles = '.mce-content-body { ' . join( ';', $styles ) . ' }';

		// Add a style rule for link colors
		$primary_color = get_theme_mod( 'primary-color' );
		if( $primary_color ) {
			$mce_styles .= '.mce-content-body a { color: ' . $primary_color . ' }';
		}

		// Pass new styles back to TinyMCE
		if ( ! isset( $mce_init['content_style'] ) ) {
			$mce_init['content_style'] = $mce_styles . ' ';
		} else {
			$mce_init['content_style'] .= ' ' . $mce_styles . ' ';
		}
		return $mce_init;
	}
}
