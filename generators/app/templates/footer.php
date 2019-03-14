<?php
/**
 * Footer Template
 *
 * All stuff that should typically be in the footer.
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage TemplatesParts
 */

?>

                </section>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'truss_footer_before' );
                ?>

                <footer id="footer">
                    <div class="main-footer container small">
                        <div class="grid-container">
                            <?php
                            /** This action is documented in includes/Linchpin/utilities/hooks.php */
                            do_action( 'truss_sub_footer_inner_before' );
                            ?>

                            <div class="grid-x">
                                <div class="small-12 medium-8 cell">
                                    <?php

                                    if ( !has_nav_menu( 'footer' ) ): ?>
                                        <small><?php esc_html_e( 'Add a menu assigned to Footer, or remove this message', '<%= text_domain %>'); ?></small>
                                    <?php else:
	                                    wp_nav_menu(
		                                    array(
			                                    'container'       => false,
			                                    'container_class' => '',
			                                    'menu'            => '',
			                                    'menu_class'      => 'footer-menu menu',
			                                    'theme_location'  => 'footer',
			                                    'before'          => '',
			                                    'after'           => '',
			                                    'link_before'     => '',
			                                    'link_after'      => '',
			                                    'depth'           => 5,
			                                    'fallback_cb'     => false,
			                                    'walker'          => new \Foundation\Walker_Nav_Menu(),
		                                    )
	                                    );
                                    endif;
                                    ?>
                                </div>

                                <div class="small-12 medium-4 cell">
                                    <?php

                                    if ( !has_nav_menu( 'social' ) ): ?>
                                        <small><?php esc_html_e( 'Add a menu assigned to Social Links, or remove this message', '<%= text_domain %>'); ?></small>
                                    <?php else:
	                                    wp_nav_menu(
		                                    array(
			                                    'container'       => false,
			                                    'container_class' => '',
			                                    'menu'            => '',
			                                    'menu_class'      => 'social menu text-center medium-text-right',
			                                    'theme_location'  => 'social',
			                                    'before'          => '',
			                                    'after'           => '',
			                                    'link_before'     => '',
			                                    'link_after'      => '',
			                                    'depth'           => 5,
			                                    'fallback_cb'     => false,
			                                    'walker'          => new \Foundation\Walker_Nav_Menu(),
		                                    )
	                                    );
                                    endif;
                                    ?>
                                </div>
                            </div>

                            <?php
                            /** This action is documented in includes/Linchpin/utilities/hooks.php */
                            do_action( 'truss_sub_footer_inner_after' );
                            ?>
                        </div>
                    </div>

                    <div class="copyright-footer">
                        <div class="grid-container">
	                        <?php
	                        printf(
	                        // translators: 1. Year, 2. Blog Name.
		                        esc_html__( '&copy; %1$s %2$s. All Rights Reserved.', '<%= text_domain %>' ),
		                        esc_html( date( 'Y' ) ),
		                        esc_html( get_bloginfo( 'name' ) )
	                        );
	                        ?>
                            <div class="copyright-menu-container">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'container'       => false,
                                        'container_class' => '',
                                        'menu'            => '',
                                        'menu_class'      => 'copyright-menu menu text-center medium-text-left',
                                        'theme_location'  => 'copyright',
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
                </footer>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'truss_footer_after' );
                ?>

                <a class="exit-off-canvas"></a>

                <?php
                /** This action is documented in includes/Linchpin/utilities/hooks.php */
                do_action( 'truss_layout_end' );
                ?>
            </div>
        </div>

        <?php wp_footer(); ?>

        <?php
        /**
         * Additional Footer Scripts is attached to this action
         * If this action is removed from your Additional Footer Scripts
         * area within the Theme Settings will no longer print to the
         * front end of your theme
         */
        /** This action is documented in includes/Linchpin/utilities/hooks.php */
        do_action( 'truss_body_before_close' );
        ?>

    </body>
</html>
