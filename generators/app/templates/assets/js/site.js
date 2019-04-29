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
        $error   = $('.gfield_description.validation_message'),

        $mega_menu = $('.is-mega-menu');

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

    // Fixed Header
    if ( $body.hasClass('header-click') ) {
        $window.scroll( function() {
            clickedHeader();
        })
    }

    // Mega Menu
    if ( $mega_menu.length ) {

        $( document ).ready( function() {
            $('.top-bar-right .mega.equal').each( function() {

                var total_li = $( ' > ul.dropdown > li', $(this)).length,
                    percentage = 100 / total_li;

                $( ' > ul.dropdown > li', $(this)).each( function() {
                    $(this).outerWidth( percentage + '%' );
                });
            });
        });

        $body.on('click', '.is-mega-menu > li > a', triggerMegaMenu );
        $body.on('click', '.mega-overlay', triggerMegaMenu );

        $window.resize(function () {
            megaMenuDropdown('close');
            $('.menu-item-has-children.menu-item-has-children-open').removeClass('menu-item-has-children-open');
        } );
    }

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

    function clickedHeader() {

        var menu_position = $('.utility-menu-container').offset().top + $('.utility-menu-container').outerHeight(),
            admin_bar = 0;

        if ( $body.hasClass('admin-bar') ) {
            admin_bar = 32;
        }

        if ( menu_position <= $doc.scrollTop() + admin_bar ) {
            $body.addClass( 'header-clicked' );
        } else {
            $body.removeClass( 'header-clicked' );
        }

    }

    /**
     * Everything for Mega Menu
     * triggerMegaMenu() and megaMenuDropdown
     */
    function triggerMegaMenu( event ) {

        if ( $(this).hasClass('mega-overlay') ) {

            var open_class = 'menu-item-has-children-open',
                visible_class = 'mihco-visible'

            $('.menu-item-has-children').removeClass(visible_class);
            $('.mega-widget-bg').css('background-color', '');

            $(this).delay(150).queue(function () {
                $('.menu-item-has-children').removeClass(open_class);
                megaMenuDropdown('close');
                $(this).dequeue();
            });

        } else {

            var $this = $(this).parent('.menu-item-has-children'),
                open_class = 'menu-item-has-children-open',
                visible_class = 'mihco-visible',
                menu_item_open = $('.menu-item-has-children.' + open_class).length;

            if (!$this.hasClass('menu-item-has-children')) {
                $('.menu-item-has-children.' + open_class).removeClass(visible_class);

                $(this).delay(150).queue(function () {
                    $('.menu-item-has-children.' + open_class).removeClass(open_class);
                    $(this).dequeue();
                });

            } else {

                event.preventDefault();

                //
                // if a menu is already open, either close this, or close this and open another
                //

                if (menu_item_open) {

                    if ($this.hasClass(open_class)) {
                        $this.removeClass(visible_class);
                        $('.mega-widget-bg').css('background-color', '');

                        $(this).delay(150).queue(function () {
                            $this.removeClass(open_class);
                            megaMenuDropdown('close');
                            $(this).dequeue();
                        });

                    } else {
                        $('.menu-item-has-children.' + open_class).removeClass(visible_class);

                        $(this).delay(150).queue(function () {
                            $('.menu-item-has-children.' + open_class).removeClass(open_class);
                            $this.addClass(open_class);
                            megaMenuDropdown('open');
                            $(this).dequeue();
                        });

                        $(this).delay(300).queue(function () {
                            $this.addClass(visible_class);
                            $(this).dequeue();
                        });

                    }

                    //
                    // Otherwise, just open this one
                    //

                } else {
                    $this.addClass(open_class);
                    megaMenuDropdown('open');

                    $(this).delay(150).queue(function () {
                        $('.mega-menu-bg').addClass('mega-menu-visible');
                        $(this).dequeue();
                    });

                    $(this).delay(300).queue(function () {
                        $this.addClass(visible_class);
                        $(this).dequeue();
                    });


                }
            }
        }
    }

    function megaMenuDropdown( event ) {
        var $mega_bg = $('.mega-menu-bg'),
            $mega_widget_bg = $('.mega-widget-bg');

        if ('open' == event) {

            $mega_bg.addClass('mega-menu-open');
            $body.addClass('mega-open');

            var $open = $('.menu-item-has-children-open'),
                menu_offset = $open.offset().left,
                menu_width = $open.outerWidth(),
                menu_border = 4,
                menu_padding = 32;

            var arrow_offset = 0,
                arrow_direction = 1, //Position Number for left aligned arrow
                total_width = 0,
                total_height = 0,
                window_width = $window.width();

            if ( ( $open ).hasClass('full') ) {
                $mega_bg.addClass('mega-menu-full');
            } else {
                $mega_bg.removeClass('mega-menu-full');
            }

            //
            // Max width of grid-container is 1200px;
            //

            if ( $window.width() > 1200 ) {
                window_width = 1200;
            }

            var top_menu_offset = ( $open.offset().left - ( ($window.width() - window_width ) / 2 ) );

            if ( $open.hasClass('mega') ) {

                //
                // .mega will be limited to width of li's, .mega.full will extend to 1200px
                //

                $('> ul', $open).css('left', '' );

                var items_width = 0;
                total_height = $('> ul', $open).outerHeight();
                total_width = $('> ul', $open).outerWidth();


                //
                // Run through each direct li from the open sub menu, get all of the widths
                //

                $('> ul > li', $open).each(function () {

                    var item_width = $(this).outerWidth();
                    items_width = items_width + item_width;

                });

                items_width = items_width + menu_padding; // Add in padding

                //
                // If we want a full width, 1200px menu ( plus background overhang to edge )
                //

                if ( $open.hasClass('full') ) {
                    total_width = '100%';
                    arrow_offset = menu_offset;
                    menu_offset = 0;

                    if ( $open.hasClass('equal') ) {
                        var total_li = $( ' > ul.dropdown > li', $open).length,
                            percentage = 100 / total_li;

                        $( ' > ul.dropdown > li', $open).each( function() {
                            $(this).outerWidth( percentage + '%' );
                        });
                    }


                } else {

                    //
                    // otherwise, let the content width stay (no background to edge)
                    //

                    if (items_width > ( window_width - 10 )) { // Account for padding, with extra spacing in case font size is not 0
                        total_width = '100%';
                        arrow_offset = menu_offset;
                        menu_offset = 0;

                        $('> ul', $open).css('left', '0');

                    } else {

                        total_width = items_width; // 32 for padding

                        menu_offset = ( window_width - total_width );
                        arrow_offset = menu_offset - ((window_width - total_width) / 2 );

                        //if (total_width + menu_offset < $open.offset().left + menu_width) {

                        // menu_offset = $open.offset().left + menu_width - total_width;
                        // arrow_offset = total_width;
                        // arrow_direction = -1;

                        //}

                        //
                        // If menu is too short and goes too far left
                        //

                        if ( menu_offset > top_menu_offset + $open.width() ) {

                            menu_offset = top_menu_offset + $open.width() - items_width;
                        }

                        $('> ul', $open).css('left', menu_offset);
                    }

                    total_height = $('> ul', $open).outerHeight();

                }

                //
                // If it's not a mega menu, let's just get the height and width for background transitions
                //

            } else {
                total_height = $('> ul', $open).outerHeight();
                total_width = $('> ul', $open).outerWidth();

                items_width = $('> ul', $open).outerWidth();

                menu_offset = top_menu_offset + menu_width - items_width;
            }

            var arrow_position = top_menu_offset - menu_offset + (menu_width / 2 * arrow_direction) - 20; // 20 for 40px width arrow

            $mega_bg.width( total_width ).height( total_height - menu_border );
            $mega_bg.css('left', menu_offset );
            $('.mega-arrow').css('left', arrow_position );

            if ( $('.mega-menu-widget', $open).length > 0 ) {
                var mega_widget_bg = $('.mega-menu-widget', $open).data('bg'),
                    mega_widget_width = $('.mega-menu-widget', $open).width();

                $mega_widget_bg.width( mega_widget_width );

            } else {
                $mega_widget_bg.css('background-color', '' ).width('0');
            }

            $(this).delay(250).queue(function() {
                $mega_widget_bg.css('background-color', mega_widget_bg );
                $(this).dequeue();
            });

        } else {
            $mega_bg.removeClass('mega-menu-visible').removeClass('mega-menu-open').removeClass('mega-menu-full').removeClass('after-white');
            $body.removeClass('mega-open');
        }
    }

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
