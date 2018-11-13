<?php
/**
 * Template used for all of our theme integration/javascript options
 *
 * @package Hatch
 * @since 1.0
 */

?>
<?php global $rebar_options; ?>
<div id="integration-options">
    <h3><?php esc_html_e( 'Integration Options', 'hatch' ); ?></h3>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Typekit ID', 'hatch' ); ?></th>
                <td>
                    <div>
						<?php
						$typekit_id = '';

						if ( isset( $rebar_options['typekit_id'] ) ) {
							$typekit_id = esc_attr( $typekit_id );
						}
						?>
						<label class="screen-reader-text" for="typekit_id"><span><?php esc_html_e( 'Typekit ID', 'hatch' ); ?></span></label> <input type="text" name="rebar_theme_options[typekit_id]" class="regular-text" id="typekit_id" value="<?php esc_attr_e( $typekit_id ); ?>"> <label class="screen-reader-text" for="typekit_async"><span><?php esc_html_e( 'Load TypeKit Asyncronously', 'hatch' ); ?></span></label> <select name="rebar_theme_options[typekit_async]" id="rebar_theme_options[typekit_async]">
                            <option value="true" <?php selected( $rebar_options['typekit_async'], true ); ?>>
                                <?php esc_html_e( 'Yes', 'hatch' ); ?>
                            </option>
                            <option value="false" <?php selected( $rebar_options['typekit_async'], false ); ?>>
                                <?php esc_html_e( 'No', 'hatch' ); ?>
                            </option>
                        </select>
                        <p class="description"><?php printf( esc_html( __( 'Enter your Typekit ID. You can get the Kit ID from the "Embed Options" of your kit within typekit.com. If you would like to load typekit asyncronously you can select that as well. There are some additional styles that need to be applied manually if you select asyncronously load the font' ), 'hatch' ) ); ?></p>
                    </div>
                </td>
            </tr>

            <tr valign="top">
                <td colspan="2">
                    <div id="additional-scripts">

                        <h4>Below you can add scripts to your theme. Be sure to provide your opening <em>&lt;script&gt;</em> and closing <em>&lt;/script&gt;</em>  tags</en></h4>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php esc_html_e( 'Additional Header Scripts', 'hatch' ); ?></th>
                                    <td>
                                        <div>
                                            <label class="screen-reader-text" for="additional_header_scripts"><span><?php esc_html_e( 'Additional Head Scripts', 'hatch' ); ?></span></label>
                                            <textarea name="rebar_theme_options[additional_header_scripts]" class="html-textarea" id="additional_header_scripts"><?php esc_attr_e( $rebar_options['additional_header_scripts'] ); ?></textarea>
                                            <p class="description"><?php printf( esc_html( __( 'This area will include scripts within the <strong>&lt;HEAD&gt;</strong> tag of your website. In most cases you can use the footer scripts below. Through some scripts require being loaded within the <strong>&lt;HEAD&gt;</strong> tag.' ), 'hatch' ) ); ?></p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php esc_html_e( 'Additional Footer Scripts', 'hatch' ); ?></th>

                                    <td>
                                        <div>
                                            <label class="screen-reader-text" for="additional_footer_scripts"><span><?php esc_html_e( 'Additional Footer Scripts', 'hatch' ); ?></span></label>
                                            <textarea name="rebar_theme_options[additional_footer_scripts]" class="html-textarea" id="additional_footer_scripts"><?php esc_attr_e( $rebar_options['additional_footer_scripts'] ); ?></textarea>
                                            <p class="description"><?php printf( esc_html( __( 'Within this area you can include any additional 3rd party scripts. Examples would include javascript needed for Twitter, HubSpot and other features not included by default within your theme' ), 'hatch' ) ); ?></p>
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
