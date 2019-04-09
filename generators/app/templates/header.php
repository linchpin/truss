<?php
/**
 * Header Template
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage TemplateParts
 */

$url = 'http://' . $_SERVER['SERVER_NAME'];
$parsed = parse_url($url, PHP_URL_HOST);
$exploded = explode(".", $parsed );
$test_tld = 'tld-' . end($exploded);

$header_position = 'header-static';
$options = get_option( '<%= text_domain %>_theme_options' );

if ( $options['header_position'] == 'fixed' ) {
	$header_position = 'header-fixed';

	if ( has_nav_menu( 'utility' ) ) {
		$header_position = 'header-fixed with-utility';

		if ( $options['utility_menu_position'] == 'click' ) {
			$header_position = 'header-click';
		}
	}
}

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
	<?php
	/** This action is documented in includes/Linchpin/utilities/hooks.php */
	do_action( 'truss_head_scripts' );
	?>
</head>
<body <?php body_class( $test_tld . ' ' . $header_position ); ?>>

<?php do_action( 'wp_body_open' ); ?>

<div class="off-canvas-wrapper">
	<div class="off-canvas position-right" id="offCanvas" data-off-canvas>
		<?php
		wp_nav_menu(
			array(
				'container'       => false,
				'container_class' => '',
				'menu'            => '',
				'menu_class'      => 'off-canvas-list',
				'items_wrap'      => '<ul id="%1$s" class="vertical menu drilldown %2$s" data-drilldown>%3$s</ul>',
				'theme_location'  => 'mobile-off-canvas',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'depth'           => 5,
				'fallback_cb'     => false,
				'walker'          => new \Foundation\Walker_Nav_Menu(), // Use Custom Foundation Walker.
			)
		);
		?>
	</div>

	<div class="inner-wrap off-canvas-content" data-off-canvas-content>

		<?php
		/** This action is documented in includes/Linchpin/utilities/hooks.php */
		do_action( 'truss_layout_start' );
		?>

		<?php
		/** This action is documented in includes/Linchpin/utilities/hooks.php */
		do_action( 'truss_header_before' );
		?>

		<?php get_template_part( 'partials/navigation' ); ?>

		<?php
		/** This action is documented in includes/Linchpin/utilities/hooks.php */
		do_action( 'truss_header_after' );
		?>

		<section role="document">
