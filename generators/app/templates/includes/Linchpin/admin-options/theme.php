<?php
/**
 * Template to control our base theme options
 *
 * Handle footer information and footer legal/copyright info
 *
 * @package Truss
 * @since 1.0
 */

?>
<?php global $truss_options; ?>
<div id="theme-options">
	<h3><?php esc_html_e( 'Theme Options', 'truss' ); ?></h3>
	<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Additional Footer Information', 'truss' ); ?></th>
			<td>
				<div>
					<label class="screen-reader-text" for="footer_info"><span><?php esc_html_e( 'Additional Footer Information', 'truss' ); ?></span></label>

					<?php $footer_info = '';

					if ( ! empty( $truss_options['footer_info'] ) ) {
						$footer_info = $truss_options['footer_info'];
					}

					wp_editor( html_entity_decode( $footer_info ), 'footerinfo', array( 'textarea_name' => 'truss_theme_options[footer_info]', 'textarea_rows' => 8 ) ); ?>

					<p class="description"><?php printf( esc_html( __( 'Free area to place additional information in your footer such as address information or extra phone numbers' ), 'truss' ) ); ?></p>
				</div>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Terms & Conditions', 'truss' ); ?></th>
			<td>
				<div>
					<label class="screen-reader-text" for="footer_info"><span><?php esc_html_e( 'Terms & Conditions', '<%= text_domain %>' ); ?></span></label>

					<?php $terms = '';

					if ( ! empty( $truss_options['terms_conditions'] ) ) {
						$terms = $truss_options['terms_conditions'];
					}

					wp_editor( html_entity_decode( $terms ), 'termsconditions', array( 'textarea_name' => 'truss_theme_options[terms_conditions]', 'textarea_rows' => 4, 'teeny' => true ) ); ?>

					<p class="description"><?php printf( esc_html( __( 'This is an area for simple copyright or other terms. Your &copy; Year and Company name will automatically be added to your site unless you input your own terms above' ), 'truss' ) ); ?></p>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
</div>
