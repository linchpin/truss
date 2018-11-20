<?php
/**
 * Template used for all of our theme integration/javascript options
 *
 * @package Truss
 * @since   1.0
 */

?>
<?php global $truss_options; ?>
<div id="integration-options">
	<h3><?php esc_html_e( 'Integration Options', 'truss' ); ?></h3>
	<table class="form-table">
		<tbody>
		<tr valign="top">
			<td colspan="2">
				<div id="additional-scripts">

					<h4>Below you can add scripts to your theme. Be sure to provide your opening <em>&lt;script&gt;</em>
						and closing <em>&lt;/script&gt;</em> tags</en></h4>

					<table class="form-table">
						<tbody>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Additional Header Scripts', 'truss' ); ?></th>
							<td>
								<div>
									<label class="screen-reader-text"
										   for="additional_header_scripts"><span><?php esc_html_e( 'Additional Head Scripts', 'truss' ); ?></span></label>
									<textarea name="truss_theme_options[additional_header_scripts]"
											  class="html-textarea"
											  id="additional_header_scripts"><?php esc_attr_e( $truss_options[ 'additional_header_scripts' ] ); ?></textarea>
									<p class="description"><?php echo esc_html( __( 'This area will include scripts within the <strong>&lt;HEAD&gt;</strong> tag of your website. In most cases you can use the footer scripts below. Through some scripts require being loaded within the <strong>&lt;HEAD&gt;</strong> tag.' ), 'truss' ); ?></p>
								</div>
							</td>
						</tr>
						</tbody>
					</table>

					<table class="form-table">
						<tbody>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Additional Footer Scripts', 'truss' ); ?></th>

							<td>
								<div>
									<label class="screen-reader-text"
										   for="additional_footer_scripts"><span><?php esc_html_e( 'Additional Footer Scripts', 'truss' ); ?></span></label>
									<textarea name="truss_theme_options[additional_footer_scripts]"
											  class="html-textarea"
											  id="additional_footer_scripts"><?php echo esc_attr( $truss_options[ 'additional_footer_scripts' ] ); ?></textarea>
									<p class="description"><?php esc_html_e( 'Within this area you can include any additional 3rd party scripts. Examples would include javascript needed for Twitter, HubSpot and other features not included by default within your theme', 'truss' ); ?></p>
								</div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
</div>
