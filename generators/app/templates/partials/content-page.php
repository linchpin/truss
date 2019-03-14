<?php
/**
 * Content Template
 *
 * The default template for displaying content within pages.
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage TemplateParts
 */
?>

<div class="grid-container grid-x">
    <div class="small-12 cell">

        <?php
        /** This action is documented in includes/Linchpin/utilities/hooks.php */
        do_action( 'truss_post_before' );
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if ( truss_show_header_in_content() ) : ?>
                <header>
                    <h1><?php the_title(); ?></h1>
                </header>
            <?php endif; ?>

            <?php
            /** This action is documented in includes/Linchpin/utilities/hooks.php */
            do_action( 'truss_post_entry_content_before' );
            ?>

            <div class="entry-content">
                <?php the_content( esc_html__( 'Continue reading...', '<%= text_domain %>' ) ); ?>
            </div>

            <?php
            /** This action is documented in includes/Linchpin/utilities/hooks.php */
            do_action( 'truss_post_entry_content_after' );
            ?>
        </article>

        <?php
        /** This action is documented in includes/Linchpin/utilities/hooks.php */
        do_action( 'truss_post_after' );
        ?>

    </div>
</div>
