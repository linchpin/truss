<?php
/**
 * Large Header
 *
 * @since      <%= theme_version %>
 *
 * @package    <%= class_name %>
 * @subpackage TemplateParts
 */
?>

<div class="full-page-header container large">
	<div class="grid-x">
		<div class="small-12 cell">
			<?php
			the_title( '<h1>', '</h1>', true );

			if ( function_exists( 'the_simple_subtitle' ) ) {
				the_simple_subtitle();
			}
			?>
		</div>
	</div>
</div>
