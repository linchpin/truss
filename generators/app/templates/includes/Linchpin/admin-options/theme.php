<?php
/**
 * Template to control our base theme options
 *
 * Handle footer information and footer legal/copyright info
 *
 * @package Truss
 * @package Options
 * @since   1.0
 */

$truss_options         = \Truss\Options::get_theme_options();
$truss_default_options = \Truss\Options::get_default_theme_options();

?>
<?php global $truss_options; ?>
<div id="theme-options">
	<h3><?php esc_html_e( 'Theme Options', '<%= text_domain %>' ); ?></h3>
	<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Additional Footer Information', '<%= text_domain %>' ); ?></th>
			<td>
				<div>
					<label class="screen-reader-text" for="footer_info"><span><?php esc_html_e( 'Additional Footer Information', '<%= text_domain %>' ); ?></span></label>
					<?php
					$footer_info = '';

					if ( ! empty( $truss_options['footer_info'] ) ) {
						$footer_info = $truss_options['footer_info'];
					}

					wp_editor(
						html_entity_decode( $footer_info ),
						'footerinfo',
						array(
							'textarea_name' => 'truss_theme_options[footer_info]',
							'textarea_rows' => 8,
						)
					);
					?>
					<p class="description"><?php esc_html_e( 'Free area to place additional information in your footer such as address information or extra phone numbers', '<%= text_domain %>' ); ?></p>
				</div>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Terms & Conditions', '<%= text_domain %>' ); ?></th>
			<td>
				<div>
					<label class="screen-reader-text" for="footer_info"><span><?php esc_html_e( 'Terms & Conditions', '<%= text_domain %>' ); ?></span></label>

					<?php
					$terms = '';

					if ( ! empty( $truss_options['terms_conditions'] ) ) {
						$terms = $truss_options['terms_conditions'];
					}

					wp_editor(
						html_entity_decode( $terms ),
						'termsconditions',
						array(
							'textarea_name' => 'truss_theme_options[terms_conditions]',
							'textarea_rows' => 4,
							'teeny'         => true,
						)
					);
					?>
					<p class="description"><?php esc_html_e( 'This is an area for simple copyright or other terms. Your &copy; Year and Company name will automatically be added to your site unless you input your own terms above', '<%= text_domain %>' ); ?></p>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
</div>
