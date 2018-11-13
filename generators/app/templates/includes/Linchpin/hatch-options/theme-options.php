<?php
/**
 * Template to control our base theme options
 *
 * Handle footer information and footer legal/copyright info
 *
 * @package Hatch
 * @since 1.0
 */

?>
<?php global $rebar_options; ?>
<div id="theme-options">
	<h3><?php esc_html_e( 'Theme Options', 'hatch' ); ?></h3>
	<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Additional Footer Information', 'hatch' ); ?></th>
			<td>
				<div>
					<label class="screen-reader-text" for="footer_info"><span><?php esc_html_e( 'Additional Footer Information', 'hatch' ); ?></span></label>

					<?php $footer_info = '';

					if ( ! empty( $rebar_options['footer_info'] ) ) {
						$footer_info = $rebar_options['footer_info'];
					}

					wp_editor( html_entity_decode( $footer_info ), 'footerinfo', array( 'textarea_name' => 'rebar_theme_options[footer_info]', 'textarea_rows' => 8 ) ); ?>

					<p class="description"><?php printf( esc_html( __( 'Free area to place additional information in your footer such as address information or extra phone numbers' ), 'hatch' ) ); ?></p>
				</div>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Terms & Conditions', 'hatch' ); ?></th>
			<td>
				<div>
					<label class="screen-reader-text" for="footer_info"><span><?php esc_html_e( 'Terms & Conditions', 'truss' ); ?></span></label>

					<?php $terms = '';

					if ( ! empty( $rebar_options['terms_conditions'] ) ) {
						$terms = $rebar_options['terms_conditions'];
					}

					wp_editor( html_entity_decode( $terms ), 'termsconditions', array( 'textarea_name' => 'rebar_theme_options[terms_conditions]', 'textarea_rows' => 4, 'teeny' => true ) ); ?>

					<p class="description"><?php printf( esc_html( __( 'This is an area for simple copyright or other terms. Your &copy; Year and Company name will automatically be added to your site unless you input your own terms above' ), 'hatch' ) ); ?></p>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
</div>
