<?php
/**
 * Truss Options page
 *
 * This is the main controller for the Truss theme options
 * Some items are derived from other "blank" themes including
 * Blank, _s, and Roots etc.
 *
 * @package Truss
 * @since 1.0
 */

/**
 * Class TrussOptions
 */
class TrussOptions {

	/**
	 * Construct
	 */
	function __construct() {
		add_action( 'admin_init',            array( $this, 'init' ) );
		add_action( 'admin_menu',            array( $this, 'theme_options_add_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_notices',         array( $this, 'validate_required_settings' ) );

		add_action( 'wp_head', array( $this, 'wp_head' ) );
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
	}

	/**
	 * Initialize and get our default theme options
	 *
	 * @since 1.0
	 * @access public
	 * @return void
	 */
	function init() {
		if ( false === truss_get_theme_options() ) {
			add_option( 'truss_theme_options', self::get_default_theme_options() );
		}

		register_setting( 'truss_options', 'truss_theme_options', array( &$this, 'theme_options_validate' ) );
	}

	/**
	 * Display additional header scripts entered in the admin
	 */
	function wp_head() {
		$truss_options = truss_get_theme_options();

		if( ! empty ( $truss_options['additional_header_scripts'] ) ) {
			echo wp_kses( $truss_options['additional_header_scripts'], array(
				'script' => array(
					'src' => array(),
					'async'=> array(),
			        'type' => array()
			    ),
			    'img'    => array(
			    	'src' => array(),
                    'height' => array(),
                    'width' => array(),
                    'style' => array(),
                    'alt' => array()
                ),
				'div' => array(
					'style' => array()
				)
			) );
		}
	}

	/**
	 * Display additional footer scripts entered in the admin
	 */
	function wp_footer() {
		$truss_options = truss_get_theme_options();

		if( ! empty ( $truss_options['additional_footer_scripts'] ) ) {
			echo wp_kses( $truss_options['additional_footer_scripts'], array(
				'script' => array(
					'src' => array(),
					'async'=> array(),
			        'type' => array()
			    ),
			    'img'    => array(
			    	'src' => array(),
                    'height' => array(),
                    'width' => array(),
                    'style' => array(),
                    'alt' => array()
                ),
				'div' => array(
					'style' => array()
				)
			) );
		}
	}

	/**
	 * Validation of our required settings.
	 *
	 * @todo we need to validate the settings better
	 */
	function validate_required_settings() {
		global $truss_options;
	}

	/**
	 * Define our default theme options.
	 *
	 * @access public
	 * @static
	 * @return mixed|void
	 */
	static function get_default_theme_options() {
		$default_theme_options = array(
			'additional_footer_scripts' => '',
			'additional_header_scripts' => '',
			'typekit_async'             => false,
		);

		return apply_filters( 'truss_default_theme_options', $default_theme_options );
	}

	/**
	 * Add in our options pages. This includes a specific display for activation as well
	 * as our regular theme options.
	 */
	function theme_options_add_page() {

		$theme_page = add_theme_page(
			__( 'Additional Options', 'truss' ),
			__( 'Additional Options', 'truss' ),
			'edit_theme_options',
			'theme_options',
			array( &$this, 'theme_options_render_page' )
		);

		add_action( 'admin_footer-' . $theme_page, array( &$this, 'admin_footer' ) );
		add_action( 'admin_head-' . $theme_page, array( &$this, 'admin_head' ) );
	}

	/**
	 * Render our theme options page. Trying to match as many of the common structures
	 * and styles within the wordpress admin. The more we stay inline with the admin
	 * the more likely we are to not confuse the client.
	 *
	 * @since 1.0
	 */
function theme_options_render_page() {
	global $truss_options, $linchpin_classes_dir;
	?>
	<div class="wrap">
		<div id="truss-wrap">

		<?php

		$active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'display_options';

		$current_theme = wp_get_theme();

		?>

		<h2 class="nav-tab-wrapper">
			<a href="?page=theme_options&tab=display_options"
			   class="nav-tab <?php echo ( 'display_options' === $active_tab ) ? 'nav-tab-active' : ''; ?>"><?php printf( esc_html( __( '%s Additional Footer Content', 'truss' ) ), esc_html( $current_theme->get( 'Name' ) ) ); ?></a>
			<a href="?page=theme_options&tab=script_options"
			   class="nav-tab <?php echo ( 'script_options' === $active_tab ) ? 'nav-tab-active' : ''; ?>"><?php printf( esc_html( __( '%s Additional Scripts', 'truss' ) ), esc_html( $current_theme->get( 'Name' ) ) ); ?></a>
		</h2>

		<?php settings_errors(); ?>

		<form method="post" action="options.php">

			<?php settings_fields( 'truss_options' );
			$truss_options         = truss_get_theme_options();
			$truss_default_options = self::get_default_theme_options();

			if ( 'display_options' === $active_tab ) {
				include_once( 'truss-options/theme-options.php' );
			} elseif ( 'script_options' === $active_tab ) {
				include_once( 'truss-options/integration-options.php' );
			} ?>
			<input type="hidden" value="1" name="truss_theme_options[first_run]"/>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

/**
 * Enqueue all of our scripts and styles needed for our theme admin. These scripts will
 * be used in conjunction with the custom code utilized within core.js
 *
 * @todo We should add in wp-pointer settings to guide users through the setup process
 * @since 1.0
 *
 * @param string $hook Page we are currently viewing.
 */
function admin_enqueue_scripts( $hook ) {

	$scripts = array();
	$styles  = array();

	if ( 'widgets.php' === $hook ) {
		$scripts = array(
			'admin-controls' => array( '/js/admin.js' ),
		);
	} else if ( 'appearance_page_theme_options' === $hook ) {

		// Enqueue our javascript files.
		$scripts = array(
			'jquery-cookie'        => array( '/js/jquery.cookie/jquery.cookie.js', array( 'jquery' ) ),
			'codemirror'           => array( '/includes/codemirror/lib/codemirror.js' ),
			'codemirror-xml'       => array( '/includes/codemirror/mode/xml/xml.js' ),
			'codemirror-css'       => array( '/includes/codemirror/mode/css/css.js' ),
			'codemirror-js'        => array( '/includes/codemirror/mode/javascript/javascript.js' ),
			'codemirror-htmlmixed' => array( '/includes/codemirror/mode/htmlmixed/htmlmixed.js' ),
			'admin-controls'       => array( '/js/admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ) ),
		);

		// Enqueue our styles
		$styles = array(
			'codemirror_css'         => array( '/includes/codemirror/lib/codemirror.css' ),
			'launchpad_wp_admin_css' => array( '/css/admin.css' ),
		);
	}

	wp_enqueue_script( array( 'jquery', 'editor', 'jquery-ui-core', 'jquery-ui-tabs', ) );

	if ( ! empty( $scripts ) ) {
		foreach ( $scripts as $key => $script ) {
			if ( ! empty( $script[0] ) ) {

				$dependencies = array();

				if ( ! empty( $script[1] ) ) {
					$dependencies = $script[1];
				}

				wp_register_script( $key, get_stylesheet_directory_uri() . $script[0], $dependencies );
				wp_enqueue_script( $key );
			}
		}
	}

	if ( ! empty( $styles ) ) {
		foreach ( $styles as $key => $style ) {
			if ( ! empty( $style[0] ) ) {
				wp_register_style( $key, get_stylesheet_directory_uri() . $style[0] );
				wp_enqueue_style( $key );
			}
		}
	}

	$wp_sidebars = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets.

	$sidebars = array();

	foreach ( $wp_sidebars as $key => $sidebar ) {
		$sidebars[ 'sidebar_layout_' . $key ] = get_option( 'truss_sidebar_layout_' . $key, '' );
	}

	$sidebar_options = array(
		'sidebars'          => $sidebars,
		'save_layout_nonce' => wp_create_nonce( 'save_layout' ),
	);

	wp_localize_script( 'admin-controls', 'sidebars', $sidebar_options );

} // END Admin Scripts.

/**
 * Embed our javascript and styles needed for our theme
 * options page. This includes custom styling for our tabbed navigation
 *
 * @author aware
 */
function admin_head() {
global $truss_options;
?>
	<script type="text/javascript">
		//<![CDATA[
		var truss = {
			ajaxurl: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			nonce: "<?php echo wp_create_nonce( 'truss-nonce' ) ?>"
		};
		//]]>
	</script>
<?php
}

/**
 * admin_footer function.
 *
 * @author aware
 * @access public
 * @return void
 */
function admin_footer() {
?>
	<script>
		//<![CDATA[
		var footer_editor = CodeMirror.fromTextArea(document.getElementById("additional_footer_scripts"), {
			lineNumbers: true,
			matchBrackets: true,
			mode: "text/html",
			tabMode: "indent"
		});

		var head_editor = CodeMirror.fromTextArea(document.getElementById("additional_header_scripts"), {
			lineNumbers: true,
			matchBrackets: true,
			mode: "text/html",
			tabMode: "indent"
		});
		//]]>
	</script>
	<?php
}

	/**
	 * Validate our theme options.
	 *
	 * @access public
	 *
	 * @param array $input (default: array())
	 * @param string $key (default: '')
	 * @param string $required (default: '')
	 *
	 * @return string theme options
	 */
	function validate_theme_option( $input = array(), $key = '', $required = '' ) {

		if ( isset( $required ) && '' !== $required ) {
			if ( 'google_analytics_id' === $key && isset( $input[ $key ] ) ) {
				if ( preg_match( '/^ua-\d{4,9}-\d{1,4}$/i', $input[ $key ] ) ) {
					$output[ $key ] = $input[ $key ];
				} else {
					return null;
				}
			} else {
				if ( isset( $input[ $key ] ) ) {

					// do some extra checks for backwards compatibilty with yes/no answers

					if ( 'yes' === $input[ $key ] || 'true' === $input[ $key ] ) {
						$input[ $key ] = true;
					} elseif ( 'no' === $input[ $key ] || 'false' === $input[ $key ] ) {
						$input[ $key ] = false;
					}
				} else {
					return null;
				}
			}
		} else {
			if ( isset( $input[ $key ] ) && '' !== $key ) {

				// Do some extra checks for backwards compatibility with yes/no answers.

				if ( 'yes' === $input[ $key ] || 'true' === $input[ $key ] ) {
					$input[ $key ] = true;
				} elseif ( 'no' === $input[ $key ] || 'false' === $input[ $key ] ) {
					$input[ $key ] = false;
				}
			} else {
				return;
			}
		}

		return $input[ $key ];
	}

	/**
	 * Theme_options_validation function.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param mixed $input
	 *
	 * @return bool validation
	 */
	function theme_options_validate( $input ) {

		$options = array(
			'typekit_id'                => '',
			'additional_footer_scripts' => '',
			'additional_header_scripts' => '',
			'terms_conditions'          => '',
			'footer_info'               => '',
			'truss_tracking'            => '',
		);

		$output = $defaults = self::get_default_theme_options();

		// Loop through each option and validate

		$invalid = array();

		foreach ( $options as $key => $option ) {

			$theme_option = self::validate_theme_option( $input, $key, $option );

			if ( null !== $theme_option ) {
				$output[ $key ] = $theme_option;
			} else {
				$invalid[ $key ] = $option;
			}
		}

		return apply_filters( 'truss_theme_options_validate', $output, $input, $defaults );
	}
}

?>
<?php
/**
 * truss_get_theme_options function.
 *
 * @access public
 * @return array of theme options
 */
function truss_get_theme_options() {
	return get_option( 'truss_theme_options', TrussOptions::get_default_theme_options() );
}
