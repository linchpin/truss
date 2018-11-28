<?php
/**
 * Truss Options page
 *
 * This is the main controller for the Truss theme options
 * Some items are derived from other "blank" themes including
 * Blank, _s, and Roots etc.
 *
 * @package Truss
 * @since   1.0
 */

namespace Truss;

/**
 * Class Options
 */
class Options {

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'theme_options_add_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_notices', array( $this, 'validate_required_settings' ) );

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
	public function init() {
		if ( false === self::get_theme_options() ) {
			add_option( 'truss_theme_options', self::get_default_theme_options() );
		}

		register_setting( 'truss_options', 'truss_theme_options', array( &$this, 'theme_options_validate' ) );
	}

	/**
	 * Display additional header scripts entered in the admin
	 */
	public function wp_head() {
		$truss_options = self::get_theme_options();

		if ( ! empty( $truss_options['additional_header_scripts'] ) ) {
			echo wp_kses(
				$truss_options['additional_header_scripts'],
				array(
					'script' => array(
						'src'   => array(),
						'async' => array(),
						'type'  => array(),
					),
					'img'    => array(
						'src'    => array(),
						'height' => array(),
						'width'  => array(),
						'style'  => array(),
						'alt'    => array(),
					),
					'div'    => array(
						'style' => array(),
					),
				)
			);
		}
	}

	/**
	 * Display additional footer scripts entered in the admin
	 */
	public function wp_footer() {
		$truss_options = self::get_theme_options();

		if ( ! empty( $truss_options['additional_footer_scripts'] ) ) {
			echo wp_kses(
				$truss_options['additional_footer_scripts'],
				array(
					'script' => array(
						'src'   => array(),
						'async' => array(),
						'type'  => array(),
					),
					'img'    => array(
						'src'    => array(),
						'height' => array(),
						'width'  => array(),
						'style'  => array(),
						'alt'    => array(),
					),
					'div'    => array(
						'style' => array(),
					),
				)
			);
		}
	}

	/**
	 * Validation of our required settings.
	 *
	 * @todo we need to validate the settings better
	 */
	public function validate_required_settings() {
	}

	/**
	 * Define our default theme options.
	 *
	 * @access public
	 *
	 * @return mixed
	 */
	public static function get_default_theme_options() {
		$default_options = array(
			'additional_footer_scripts' => '',
			'additional_header_scripts' => '',
		);

		return apply_filters( 'truss_default_theme_options', $default_options );
	}

	/**
	 * Add in our options pages. This includes a specific display for activation as well
	 * as our regular theme options.
	 */
	public function theme_options_add_page() {

		$theme_page = add_theme_page(
			esc_html__( 'Additional Options', '<%= text_domain %>' ),
			esc_html__( 'Additional Options', '<%= text_domain %>' ),
			'edit_theme_options',
			'theme_options',
			array( &$this, 'theme_options_render_page' )
		);

		add_action( 'admin_head-' . $theme_page, array( &$this, 'admin_head' ) );
	}

	/**
	 * Render our theme options page. Trying to match as many of the common structures
	 * and styles within the WordPress admin. The more we stay inline with the admin
	 * the more likely we are to not confuse the client.
	 *
	 * @since 1.0
	 */
	public function theme_options_render_page() {
		?>
		<div class="wrap">
			<div id="truss-wrap">

			<?php
			$active_tab       = wp_unslash( sanitize_text_field( $_GET['tab'] ) );
			$active_tab       = isset( $active_tab ) ? $active_tab : 'display_options';
			$active_tab_class = ( 'display_options' === $active_tab ) ? 'nav-tab-active' : '';
			$current_theme    = wp_get_theme();
			?>

			<h2 class="nav-tab-wrapper">
				<a href="?page=theme_options&tab=display_options"
				class="nav-tab <?php echo esc_attr( $active_tab_class ); ?>">
					<?php
					printf(
						esc_html(
							// translators: 1. blog Name
							__( '%s Additional Footer Content', '<%= text_domain %>' )
						),
						$current_theme->get( 'Name' )
					);
					?>
				</a>
				<a href="?page=theme_options&tab=script_options"
				class="nav-tab <?php echo ( 'script_options' === $active_tab ) ? 'nav-tab-active' : ''; ?>">
					<?php
					printf(
						esc_html(
							// translators: 1. blog Name
							__( '%s Additional Scripts', '<%= text_domain %>' )
						),
						$current_theme->get( 'Name' )
					);
					?>
				</a>
			</h2>

			<?php settings_errors(); ?>

			<form method="post" action="options.php">

				<?php settings_fields( 'truss_options' );
				if ( 'display_options' === $active_tab ) {
					include 'admin-options/theme.php';
				} elseif ( 'script_options' === $active_tab ) {
					include 'admin-options/integrations.php';
				}
				?>
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
	public function admin_enqueue_scripts( $hook ) {

		$scripts = array();
		$styles  = array();

		if ( 'widgets.php' === $hook ) {
			$scripts = array(
				'admin-controls' => array( '/js/admin.js' ),
			);
		} elseif ( 'appearance_page_theme_options' === $hook ) {

			// Enqueue our javascript files.
			$scripts = array(
				'jquery-cookie'  => array( '/js/jquery.cookie/jquery.cookie.js', array( 'jquery' ) ),
				'admin-controls' => array( '/js/admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ) ),
			);

			// Enqueue our styles
			$styles = array(
				'launchpad_wp_admin_css' => array( '/css/admin.css' ),
			);
		}

		wp_enqueue_scripts(
			array(
				'jquery',
				'editor',
				'jquery-ui-core',
				'jquery-ui-tabs',
			)
		);

		if ( ! empty( $scripts ) ) {
			foreach ( $scripts as $key => $script ) {
				if ( ! empty( $script[0] ) ) {

					$dependencies = array();

					if ( ! empty( $script[1] ) ) {
						$dependencies = $script[1];
					}

					wp_register_script( $key, get_stylesheet_directory_uri() . $script[0], $dependencies, <%= prefix_caps %>VERSION, true );
					wp_enqueue_script( $key );
				}
			}
		}

		if ( ! empty( $styles ) ) {
			foreach ( $styles as $key => $style ) {
				if ( ! empty( $style[0] ) ) {
					wp_register_style( $key, get_stylesheet_directory_uri() . $style[0], array(), <%= prefix_caps %>VERSION );
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

	}

	/**
	 * Embed our javascript and styles needed for our theme.
 	 *
	 * This includes custom styling for our tabbed navigation.
	 *
	 */
	public function admin_head() {
	?>
		<script type="text/javascript">
			//<![CDATA[
			var truss = {
				ajaxurl: "<?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>",
				nonce: "<?php echo wp_create_nonce( 'truss-nonce' ); ?>"
			};
			//]]>
		</script>
	<?php
	}

	/**
	 * Scripts being added to the footer of the admin.
	 *
	 *
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

	/**
	 * get_theme_options function.
	 *
	 * @access public
	 * @return array of theme options
	 */
	public static function get_theme_options() {
		return get_option( 'truss_theme_options', self::get_default_theme_options() );
	}
}
