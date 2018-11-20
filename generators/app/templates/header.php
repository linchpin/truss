<?php
/**
 * Header Template
 *
 * @since 1.0.0
 *
 * @package    <%= class_name %>
 * @subpackage Templates
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php wp_head(); ?>

	<?php
	/** This action is documented in includes/Linchpin/truss-hooks.php */
	do_action( 'truss_head_scripts' ); ?>

</head>
<body <?php body_class(); ?>>

<?php do_action( 'truss_body_tag_after' ); ?>

<div class="off-canvas-wrapper">
	<div class="off-canvas position-right" id="offCanvas" data-off-canvas>
		<?php
		wp_nav_menu( array(
			'container'       => false,
			'container_class' => '',
			'menu'            => '',
			'menu_class'      => 'off-canvas-list',
			'items_wrap'      => '<ul id="%1$s" class="%2$s" data-drilldown>%3$s</ul>',
			'theme_location'  => 'mobile-off-canvas',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 5,
			'fallback_cb'     => false,
			'walker'          => new Foundation_Walker_Nav_Menu(), // Use Custom Foundation Walker.
		) );
		?>
	</div>

	<div class="inner-wrap off-canvas-content" data-off-canvas-content>

		<?php
		/** This action is documented in includes/Linchpin/truss-hooks.php */
		do_action( 'truss_layout_start' );
		?>

		<?php
		/** This action is documented in includes/Linchpin/truss-hooks.php */
		do_action( 'truss_header_before' );
		?>

		<?php get_template_part( 'partials/navigation' ); ?>

		<?php
		/** This action is documented in includes/Linchpin/truss-hooks.php */
		do_action( 'truss_header_after' );
		?>

		<section role="document">
