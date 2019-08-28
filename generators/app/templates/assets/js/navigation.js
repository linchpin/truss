import jQuery from 'jquery';

let $ = jQuery;

export default function navigation() {

    // Private Variables
    let $window    = $(window),
        $doc       = $(document),
        $body      = $('body'),
        $mega_menu = $('.is-mega-menu');

    // Fixed Header
    if ( $body.hasClass('header-click') ) {
        $window.scroll( function() {
            clickedHeader();
        })
    }

    if ( $body.hasClass('with-scroll-utility') ) {
        var position    = $window.scrollTop(),
            scroll_dir  = '',
            last_scroll = 0;

        $window.scroll( function() {
            scrollUtility();
        });
    }

    // Mega Menu
    if ( $mega_menu.length ) {

        $( document ).ready( function() {

            $('.top-bar-right .mega.equal').each( function() {

                var total_li = $( ' > ul.dropdown > li', $(this) ).length,
                    percentage = 100 / total_li;

                $( ' > ul.dropdown > li', $(this) ).each( function() {
                    $(this).outerWidth( percentage + '%' );
                });
            });
        });

        $body
            .on('click', '.is-mega-menu > li > a', triggerMegaMenu )
            .on('click', '.mega-overlay', triggerMegaMenu );

        $window.resize(function () {
            megaMenuDropdown('close');
            $('.menu-item-has-children.menu-item-has-children-open').removeClass('menu-item-has-children-open');
        } );
    }

    //////////////////////////
    //                      //
    // Functions Below Here //
    //                      //
    //////////////////////////


    function clickedHeader() {

        var $utilityMenuContainer = $('.utility-menu-container'),
            menu_position         = $utilityMenuContainer.offset().top + $utilityMenuContainer.outerHeight(),
            admin_bar             = 0;

        if ( $body.hasClass('admin-bar') ) {
            admin_bar = 32;
        }

        if ( menu_position <= $doc.scrollTop() + admin_bar ) {
            $body.addClass( 'header-clicked' );
        } else {
            $body.removeClass( 'header-clicked' );
        }
    }

    function scrollUtility() {
        var $utilityMenuContainer = $('.utility-menu-container'),
            utility_height        = $utilityMenuContainer.outerHeight(),
            admin_bar             = 0;

        if ( $body.hasClass('admin-bar') ) {
            admin_bar = 32;
        }

        if ( $doc.scrollTop() + admin_bar >  utility_height + 30 ) {

            if ( !$body.hasClass('anchor-scrolling') ) {

                var scroll = $(window).scrollTop();

                if (scroll > position) { // Down

                    if (scroll_dir == 'up') {
                        last_scroll = scroll;
                    }

                    if (last_scroll < scroll - 80) {
                        $body.addClass('hide-utility');
                    }

                    scroll_dir = 'down';


                } else { // Up

                    if (scroll_dir == 'down') {
                        last_scroll = scroll;
                    }

                    if (last_scroll > scroll + 80) {
                        $body.removeClass('hide-utility');
                    }

                    scroll_dir = 'up';
                }

                position = scroll;
            } else {
                $body.addClass( 'hide-utility' );
            }


        } else {
            $body.removeClass( 'hide-utility' );
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

}
