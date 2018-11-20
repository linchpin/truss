<?php
/**
 * Search Form Template
 *
 * Typically used in headers or Top Bars
 *
 * @since 1.0.0
 *
 * @package
 * @subpackage Search
 */

?>

<?php do_action( 'truss_searchform_before' ); ?>

<form role="search" method="get" id="searchform" action="<?php echo esc_html( home_url( '/' ) ); ?>">
	<div class="grid-x collapse">
		<?php do_action( 'truss_searchform_inner_before' ); ?>

		<div class="small-8 cell">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', '<%= text_domain %>' ); ?>">
		</div>

		<div class="small-4 cell">

			<?php do_action( 'truss_searchform_search_button_before' ); ?>

			<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', '<%= text_domain %>' ); ?>" class="prefix button">

			<?php do_action( 'truss_searchform_search_button_after' ); ?>
		</div>

		<?php do_action( 'truss_searchform_inner_after' ); ?>
	</div>
</form>

<?php
do_action( 'truss_searchform_after' );
