<?php
/**
 * Hero Video Area
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage TemplateParts
 */

?>
<header id="homepage-hero" class="container text-center" role="banner">
	<div class="grid-x">
		<div class="cell">
			<h1><?php bloginfo( 'name' ); ?></h1>
			<h4><?php echo esc_html( get_bloginfo( 'description' ) ); ?></h4>
		</div>

		<div class="cell">
			<a class="download large button hide-for-small" href="https://github.com/linchpin/truss"><?php esc_html_e( 'Download Truss', '<%= text_domain %>' ); ?></a>
		</div>
	</div>
</header>
