<?php
/**
 * <%= theme_name %>
 *
 * @author  <%= theme_author %>
 * @package <%= class_name %>
 */

/**
 * Class <%= class_name %>
 */
class <%= class_name %> {

	/**
	 * Apple favicon sizes.
	 */
	public $apple_favicon_sizes = array(
		57,
		60,
		72,
		76,
		114,
		120,
		144,
		152,
		180,
	);

	/**
	 * Generic favicon sizes.
	 */
	public $favicon_sizes = array(
		16,
		32,
		96,
		192,
	);

	/**
	 * __construct function.
	 */
	public function __construct() {

		$foundation = new \Foundation\Foundation();
		$truss      = new \Truss\Core();

		add_filter( 'upload_mimes', array( $this, 'upload_mimes' ) );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
		add_filter( 'site_icon_image_sizes', array( $this, 'site_icon_image_sizes' ) );
		add_filter( 'site_icon_meta_tags', array( $this, 'site_icon_meta_tags' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_styles' ) );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'after_setup_theme', array( $this, 'add_editor_styles' ) );
	}

	/**
	 * Registers the menu in the WordPress admin menu editor.
	 *
	 * @access public
	 * @return void
	 */
	public function init() {
		register_nav_menus(
			array(
				'top-bar'           => esc_html__( 'Top Bar', '<%= text_domain %>' ),
				'footer'            => esc_html__( 'Footer', '<%= text_domain %>' ),
				'mobile-off-canvas' => esc_html__( 'Mobile (Off Canvas)', '<%= text_domain %>' ),
				'social'            => esc_html__( 'Social Links', '<%= text_domain %>' ),
			)
		);
	}

	/**
	 * Add in the theme author info, truss info and be sure to keep love for WordPress
	 * admin_footer_text function.
	 *
	 * @access public
	 */
	public function admin_footer_text() {
		echo 'Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Created by <a href="https://linchpin.com/?utm_source=truss&utm_medium=truss_footer&utm_campaign=truss_notice" target="_blank">Linchpin</a> and <a href="http://github.com/linchpin/truss/?utm_source=truss&utm_medium=truss_footer&utm_campaign=truss_notice" target="_blank">Truss</a> on top';
	}

	/**
	 * Save custom favicon sizes from customizer upload.
	 *
	 * @since 1.0
	 *
	 * @param  array $sizes Array of image sizes to save.
	 *
	 * @return array $sizes Array Merged array containing custom favicon sizes.
	 */
	public function site_icon_image_sizes( $sizes = array() ) {
		foreach ( $this->apple_favicon_sizes as $apple_favicon_size ) {
			$sizes[] = $apple_favicon_size;
		}

		foreach ( $this->favicon_sizes as $favicon_size ) {
			$sizes[] = $apple_favicon_size;
		}

		return $sizes;
	}

	/**
	 * Insert favicon meta tags to the head of the site.
	 *
	 * @param array $meta_tags Array of meta tags returned to output.
	 *
	 * @return array
	 */
	public function site_icon_meta_tags( $meta_tags = array() ) {
		foreach ( $this->apple_favicon_sizes as $apple_favicon_size ) {
			$meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="%s" href="%s" />', $apple_favicon_size . 'x' . $apple_favicon_size, esc_url( get_site_icon_url( $apple_favicon_size ) ) );
		}

		foreach ( $this->favicon_sizes as $favicon_size ) {
			$meta_tags[] = sprintf( '<link rel="icon" type="image/png" sizes="%s" href="%s" />', $favicon_size . 'x' . $favicon_size, esc_url( get_site_icon_url( $favicon_size ) ) );
		}

		return $meta_tags;
	}

	/**
	 * We have found that these are pretty much 3 areas that clients request
	 * for easier customizations.
	 *
	 * Registers our 3 base sidebars
	 * Home Widgets
	 * Page Widgets
	 * Footer Widgets
	 *
	 * @access public
	 * @return void
	 */
	public
	function widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Home Widgets', '<%= text_domain %>' ),
			'id'            => 'home-widgets',
			'description'   => esc_html__( 'Widgets that are displayed on the home page.', '<%= text_domain %>' ),
			'class'         => 'home-widgets',
			'before_widget' => '<div id="%1$s" class="widget small-4 cell %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Page Widgets', '<%= text_domain %>' ),
			'id'            => 'page-widgets',
			'description'   => esc_html__( 'Widgets that are displayed on interior pages.', '<%= text_domain %>' ),
			'class'         => 'page-widgets',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widgets', '<%= text_domain %>' ),
			'id'            => 'footer-widgets',
			'description'   => esc_html__( 'Widgets that are displayed in the footer.', '<%= text_domain %>' ),
			'class'         => 'footer-widgets',
			'before_widget' => '<div id="%1$s" class="right %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widgettitle">',
			'after_title'   => '</h5>',
		) );
	}

	/**
	 * print_jquery_in_footer function.
	 * Removes the jquery library from the header and prints it in the footer
	 *
	 * @access public
	 *
	 * @param array &$scripts
	 *
	 * @return void
	 */
	public function print_jquery_in_footer( &$scripts ) {
		if ( ! is_admin() ) {
			$scripts->add_data( 'jquery', 'group', 1 );
		}
	}

	/**
	 * Hook into after_setup_theme
	 *
	 * @access public
	 * @return void
	 */
	public function after_setup_theme() {
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		update_option( 'image_default_link_type', 'none' );
	}

	/**
	 * Add wp_enqueue_scripts.
	 *
	 * @access public
	 * @return void
	 */
	public function wp_enqueue_scripts() {
		wp_enqueue_script( '<%= text_domain %>-js', get_stylesheet_directory_uri() . '/js/<%= text_domain %>.js', array( 'jquery' ), <%= prefix_caps %>VERSION, true );
	}

	/**
	 * Enqueue our theme styles.
	 *
	 * @access public
	 * @return void
	 */
	public function wp_enqueue_styles() {
		if ( ! is_admin() ) {
			wp_enqueue_style('<%= text_domain %>-css', get_stylesheet_directory_uri() . '/css/<%= text_domain %>.css', array(), <%= prefix_caps %>VERSION );
		}
	}

	/*
	 * Customize_register function.
	 *
	 * Allows header logo to be set-up from
	 * the customize panel under Appearance within the WordPress Admin
	 *
	 * Also allow for the .svg extension within logo uploading
	 *
	 * @since 1.0
	 *
	 * @param $wp_customize
	 */
	public function customize_register( $wp_customize ) {

		$wp_customize->add_section(
			'<%= text_domain %>_logo', array(
				'title'    => esc_html__( 'Site Logo', '<%= text_domain %>' ),
				'priority' => 80,
			)
		);

		$wp_customize->add_setting(
			'<%= text_domain %>_theme_options[logo_upload]', array(
				'default'    => get_stylesheet_directory_uri() . '/assets/images/linchpin-icon-white.svg',
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array(
				'label'      => esc_html__( 'Site Logo', '<%= text_domain %>' ),
				'section'    => '<%= text_domain %>_logo',
				'settings'   => '<%= text_domain %>_theme_options[logo_upload]',
				'extensions' => array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);
	}

	/**
	 * linchpin_upload_mimes function.
	 *
	 * @access public
	 *
	 * @param array $mimes (default: array())
	 *
	 * @return array
	 */
	public function upload_mimes( $mimes = array() ) {
		$mimes[ 'svg' ] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Add customized styles to the WordPress admin to match frontend editing.
	 */
	public function add_editor_styles() {
		$admin_style = get_stylesheet_directory_uri() . '/css/admin-editor.css';

		add_editor_style( $admin_style );
	}
}
