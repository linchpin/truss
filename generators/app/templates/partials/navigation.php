<?php
/**
 * Navigation
 *
 * This template handles our main navigation markup
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage TemplateParts
 */

?>
<?php
$options = get_option( '<%= text_domain %>_theme_options' );

if ( isset( $options['logo_upload'] ) ) {
	$logo = true;
}
?>
<nav class="top-bar show-for-small-only">
	<section class="top-bar-title">
		<a href="<?php echo esc_attr( home_url() ); ?>">
			<?php if ( ! empty( $logo ) ) : ?>
				<img src="<?php echo esc_attr( $options['logo_upload'] ); ?>" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"/>
			<?php else : ?>
				<?php bloginfo( 'name' ); ?>
			<?php endif; ?>
		</a>
	</section>

	<section class="top-bar-right">
		<a class="right-off-canvas-toggle menu-icon" data-toggle="offCanvas"><span></span></a>
	</section>
</nav>

<?php
$has_utility = '';
$mega_container = '';
$mega_class = ' is-traditional-menu ';

if ( $options['menu_type'] == 'mega' ) {
	$mega_container = ' mega-menu-container ';
	$mega_class = ' is-mega-menu ';
}
?>

<?php if ( has_nav_menu( 'utility' ) ): ?>

	<?php $has_utility = 'has-utility'; ?>

    <div class="utility-menu-container show-for-desktop">
        <div class="grid-container">
			<?php
			wp_nav_menu(
				array(
					'container'       => false,
					'container_class' => '',
					'menu'            => '',
					'menu_id'         => 'utility',
					'menu_class'      => 'utility-menu menu',
					'theme_location'  => 'utility',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'depth'           => 1,
					'fallback_cb'     => false,
					'walker'          => new \Foundation\Walker_Nav_Menu(),
				)
			);
			?>
        </div>
    </div>
<?php endif; ?>

<div class="header-spacer"></div>

<div id="main-menu" class="show-for-medium" data-parent="<?php echo esc_attr( get_post_type() ); ?>">
	<div class="top-bar grid-container" data-topbar="">
		<div class="top-bar-title">
			<a href="<?php echo esc_attr( home_url() ); ?>">
				<?php if ( ! empty( $logo ) ) : ?>
					<img src="<?php echo esc_attr( $options['logo_upload'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
				<?php else : ?>
					<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>
		</div>

		<div class="top-bar-right">
			<?php
			wp_nav_menu(
				array(
					'container'       => false,
					'container_class' => '',
					'menu'            => '',
					'menu_id'         => 'primary-menu',
					'menu_class'      => 'dropdown menu',
					'theme_location'  => 'top-bar',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'depth'           => 5,
					'fallback_cb'     => false,
					'walker'          => new \Foundation\Walker_Nav_Menu(),
				)
			);
			?>
		</div>
	</div>
</div>
