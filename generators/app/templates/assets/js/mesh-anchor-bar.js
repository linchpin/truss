import jquery from 'jquery';

let $ = jquery;

/**
 * Anchor Bar Functionality
 * Loading, Sticky Scrolling, and Clicking
 */
export default function meshAnchorBar() {

	// Private Variables
	let $window,
		$doc,
		$body,
		$anchorBar;

	/**
	 * Initialize our module
	 * @since 1.0
	 */
	function init() {

		$anchorBar = $( '.anchor-bar' );

		// If we don't have any anchor bars die early.
		if ($anchorBar.length < 1) {
			return;
		}

		$window = $( window );
		$doc    = $( document );
		$body   = $( 'body' );

		$doc.on( 'ready', anchorBarLoad );

		$window
			.on( 'resize', anchorBarScroll )
			.on( 'scroll', anchorBarScroll );

		$body.on( 'click', '.anchor-bar li', anchorBarClick );
	}

	/**
	 * Load the anchor bar
	 *
	 * @since 1.0
	 */
	function anchorBarLoad() {

		let $loadActive   = $anchorBar.find( 'li.load-active' ),
			anchor_height = $loadActive.height(),
			anchor_width  = $loadActive.width(),
			anchor_top    = $loadActive.find( 'span' ).position().top,
			anchor_left   = $loadActive.find( 'span' ).position().left;

		$anchorBar.find( '.anchor-bg' )
			.width( anchor_width )
			.height( anchor_height )
			.css( { top: anchor_top, left: anchor_left } );

		$loadActive.removeClass( 'load-active' );

		$( '.anchor-bar-spacer' ).height( $anchorBar.outerHeight() );
	}

	/**
	 * Scroll anchor bar
	 */
	function anchorBarScroll() {

		let $container     = $( '.anchor-bar-container' ),
			anchor_offset  = $container.offset().top,
			fixed_position = $( '.header-spacer' ).outerHeight(),
			admin_bar      = 0,
			previous       = false,
			active_mesh    = false;

		if ( $body.hasClass( 'admin-bar' ) ) {
			admin_bar = 32;
		}

		if ( anchor_offset < ( $doc.scrollTop() + fixed_position + 0 + admin_bar ) ) { // 0 is for spacing, 25 for rounded bar, 0 for full
			$container.addClass( 'anchor-bar-fixed' );
		} else {
			$container.removeClass( 'anchor-bar-fixed' );
		}

		$( $anchorBar.find('li').get().reverse() ).each( function () {

			if ( false === active_mesh ) {

				let scroll_to   = $( this ).data( 'scroll-to' ),
					offset_mesh = $( '.mesh_section#' + scroll_to ).offset().top;

				if (offset_mesh < $doc.scrollTop() + 215) { // @todo what is this 215 and should it be dynamic?
					previous    = scroll_to;
					active_mesh = true;
				}

				if (previous !== false) {

					let $previous     = $( '.anchor-bar li[data-scroll-to="' + previous + '"]' ),
						active_height = $previous.height(),
						active_width  = $previous.width(),
						active_top    = $previous.find( 'span' ).position().top,
						active_left   = $previous.find( 'span' ).position().left;

					$anchorBar.find( '.anchor-bg' )
						.width( active_width )
						.height( active_height )
						.css( { top: active_top, left: active_left } );

				}
			}
		} );
	}
	/**
	 * Clicking when you utilize the anchorBar
	 * @param event
	 */
	function anchorBarClick(event) {
		let scroll_to   = $(this).data('scroll-to'),
			offset_mesh = $('.mesh_section#' + scroll_to).offset().top;

		$('html, body').animate({
			scrollTop: offset_mesh - 208 // 13rem @todo what is 13rem tall and should this be dynamic?
		}, 300);
	}
}
