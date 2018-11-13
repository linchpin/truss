<?php
/**
 * Hero/Slideshow area
 *
 * @since 1.0.0
 *
 * @package 
 * @subpackge Templates
 *
 * Template Part: Hero
 */

?>
<header id="homepage-hero" class="container text-center" role="banner">
	<div class="row">
		<div class="columns">
			<h1><?php bloginfo( 'name' ); ?></h1>
			<h4><?php _e( get_bloginfo( 'description' ), 'clientname' ); ?></h4>
		</div>

		<div class="columns">
			<a class="download large button hide-for-small" href="https://github.com/linchpin/truss"><?php esc_html_e( 'Download Truss', 'clientname' ); ?></a>
		</div>
	</div>
</header>
