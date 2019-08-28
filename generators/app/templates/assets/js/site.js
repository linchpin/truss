import jquery from 'jquery';
import whatInput from 'what-input';
import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

let $ = jquery;

export default function site() {

    // Private Variables
    let $window  = $(window),
        $doc     = $(document),
        $body    = $('body'),
        $success = $('.gform_confirmation_message'),
        $error   = $('.gfield_description.validation_message');

    $doc.foundation();

    // Clickable
    $body.on('click', '.clickable', function(event) {

        if ( event.target['href'] == null ) {
            event.preventDefault();
            event.stopPropagation();

            var $tgt = $(this),
                $a = $tgt.find('a:first'),
                $btn = $tgt.find('button:first'),
                uri = $a.attr('href'),
                new_window = $tgt.hasClass('external-link') || $a.hasClass('external-link') || $a.attr('target') == '_blank' || event.metaKey || event.ctrlKey;

            if ($btn.length > 0) {
                event.stopImmediatePropagation();
                $btn.trigger('click');
                return;
            }

            if ($btn.length < 1 && $a.length > 0) {
                if (new_window) {
                    window.open(uri);
                } else {
                    window.location = uri;
                }
            }

            return false;
        } else {
            return;
        }
    });

    // Jetpack Infinite Scrolling
    if ( $('.infinite-container').length ) {
        $body.on( 'click', '#infinite-handle button', afterInfiniteLoad );
    }


    // Mesh Enabled Anchor Bar
    if ( $('.anchor-bar').length ) {

        $( document ).ready(function() {
            anchorBarLoad();
        });

        $window.resize( function() {
            anchorBarScroll();
        });

        $window.scroll( function() {
            anchorBarScroll();
        });

        $body.on('click', '.anchor-bar li', anchorBarClick );

    }

    //////////////////////////
    //                      //
    // Functions Below Here //
    //                      //
    //////////////////////////

    /**
     * Jetpack Infinite Loading, triggers on click of load button and reruns the equalizer
     * @param event
     */
    function afterInfiniteLoad( event ) {
        var loop_length = $('.loop-post' ).length;

        var checkExist = setInterval(function() {
            if ( $('.loop-post' ).length != loop_length ) {
                clearInterval(checkExist);

                $(this).delay(50).queue(function () {
                    Foundation.reInit('equalizer');

                    $(this).dequeue();
                });

            }

        }, 100); // check every 100ms

    }

    /**
     * Anchor Bar Functionality
     * Loading, Sticky Scrolling, and Clicking
     */
    function anchorBarLoad() {
        var anchor_height = ( $('.anchor-bar li.load-active').height() ),
            anchor_width = ( $('.anchor-bar li.load-active').width() ),
            anchor_top = $('.anchor-bar li.load-active span').position().top,
            anchor_left = $('.anchor-bar li.load-active span').position().left;

        $('.anchor-bar .anchor-bg').width( anchor_width ).height( anchor_height ).css({top: anchor_top, left:anchor_left});

        $('.anchor-bar li.load-active').removeClass('load-active');

        $('.anchor-bar-spacer').height( $('.anchor-bar').outerHeight() );
    }

    function anchorBarScroll() {

        var anchor_offset = $('.anchor-bar-container').offset().top,
            fixed_position = $('.header-spacer').outerHeight(),
            admin_bar = 0,
            previous = false,
            active_mesh = false;

        if ( $body.hasClass( 'admin-bar') ) {
            admin_bar = 32;
        }

        if ( anchor_offset < ( $doc.scrollTop() + fixed_position + 0 + admin_bar ) ) { // 0 is for spacing, 25 for rounded bar, 0 for full
            $('.anchor-bar-container').addClass('anchor-bar-fixed');
        } else {
            $('.anchor-bar-container').removeClass('anchor-bar-fixed');
        }

        $( $('.anchor-bar li').get().reverse()).each( function() {

            if ( active_mesh == false ) {

                var scroll_to = $(this).data('scroll-to'),
                    offset_mesh = $('.mesh_section#' + scroll_to).offset().top;

                if ( offset_mesh < $doc.scrollTop() + 215 ) {

                    previous = scroll_to

                    active_mesh = true;
                }

                if ( previous != false ) {

                    var active_height = $('.anchor-bar li[data-scroll-to="' + previous + '"]').height(),
                        active_width = $('.anchor-bar li[data-scroll-to="' + previous + '"]').width(),
                        active_top = $('.anchor-bar li[data-scroll-to="' + previous + '"] span').position().top,
                        active_left = $('.anchor-bar li[data-scroll-to="' + previous + '"] span').position().left;

                    $('.anchor-bar .anchor-bg').width( active_width ).height( active_height ).css({ top: active_top, left: active_left});

                }
            }
        });
    }

    function anchorBarClick( event ) {
        var scroll_to = $(this).data('scroll-to'),
            offset_mesh = $('.mesh_section#' + scroll_to ).offset().top;

        $('html, body').animate({
            scrollTop: offset_mesh - 208 // 13rem
        }, 300, );
    }
}
