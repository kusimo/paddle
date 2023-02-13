<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'paddle_header_6' ) ) {
	function paddle_header_6( $css_style ) {
		$paddle_default_header_style = get_theme_mod( 'paddle_header_layout_style', PADDLE_DEFAULT_OPTION['paddle_header_layout_style'] );
		$paddle_header_mobile_layout = get_theme_mod( 'paddle_header_mobile_layout', PADDLE_DEFAULT_OPTION['paddle_header_mobile_layout'] );
		$paddle_header_number        = paddle_get_default_header_number( $paddle_default_header_style );
		if ( '6' !== $paddle_header_number ) {
			return '';
		}

		$menu_wrap              = get_theme_mod( 'paddle_menu_spacing', PADDLE_DEFAULT_OPTION['paddle_menu_spacing'] ); // paddle_menu_spacing
		$menu_padding           = absint( get_theme_mod( 'header_menu_padding', PADDLE_DEFAULT_OPTION['header_menu_padding'] ) );
		$menu_item_margin_right = absint( get_theme_mod( 'menu_item_margin', PADDLE_DEFAULT_OPTION['menu_item_margin'] ) );// menu_item_margin
		$paddle_menu_align      = get_theme_mod( 'paddle_menu_items_alignment', PADDLE_DEFAULT_OPTION['paddle_menu_items_alignment'] );
		$menu_align             = 'justify' === $paddle_menu_align ? 'space-between' : $paddle_menu_align;

		$border_top_enable    = absint( get_theme_mod( 'menu_border_top', PADDLE_DEFAULT_OPTION['menu_border_top'] ) );
		$border_bottom_enable = absint( get_theme_mod( 'menu_border_bottom', PADDLE_DEFAULT_OPTION['menu_border_bottom'] ) );
		$header_border_color  = paddle_theme_get_color( 'paddle_header_border_color' );

		$paddle_header_logo_align = get_theme_mod( 'paddle_header_logo_align', PADDLE_DEFAULT_OPTION['paddle_header_logo_align'] );
		$paddle_header_logo_size  = absint( get_theme_mod( 'header_logo_size', PADDLE_DEFAULT_OPTION['header_logo_size'] ) );
		$site_title_font_size     = absint( get_theme_mod( 'site_title_font_size', PADDLE_DEFAULT_OPTION['site_title_font_size'] ) );
		$site_has_search          = absint( get_theme_mod( 'paddle_header_search_button', PADDLE_DEFAULT_OPTION['paddle_header_search_button'] ) );
		$paddle_cta_enable        = absint( get_theme_mod( 'paddle_header_cta', PADDLE_DEFAULT_OPTION['paddle_header_cta'] ) );
		$menu_options             = get_theme_mod( 'paddle_split_menu_options', PADDLE_DEFAULT_OPTION['paddle_split_menu_options'] );
		$paddle_cta_padding_left  = absint( get_theme_mod( 'header_cta_padding_left', PADDLE_DEFAULT_OPTION['header_cta_padding_left'] ) );

		$paddle_header_search_button_type        = get_theme_mod( 'paddle_header_search_button_type', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type'] );
		$paddle_header_search_button_type_mobile = get_theme_mod( 'paddle_header_search_button_type_mobile', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type_mobile'] );
		$paddle_theme_color_search_icon          = paddle_theme_get_color( 'paddle_header_search_icon_color' );
		$paddle_theme_color_buttons              = paddle_theme_get_color( 'paddle_theme_color_buttons' );
		$icon_color_mobile                       = $paddle_theme_color_search_icon;
		$icon_color_desktop                      = $paddle_theme_color_search_icon;

		if ( 'input' === $paddle_header_search_button_type_mobile ) {
			$icon_color_mobile = $paddle_theme_color_search_icon === $paddle_theme_color_buttons ? '#FFFFFF' : $paddle_theme_color_search_icon;
		}
		if ( 'input' === $paddle_header_search_button_type ) {
			$icon_color_desktop = $paddle_theme_color_search_icon === $paddle_theme_color_buttons ? '#FFFFFF' : $paddle_theme_color_search_icon;
		}
		$css = '';

		// WooCommerce Active.
		if ( class_exists( 'WooCommerce' ) ) {

			$css .= '@media (min-width: 992px) {'; // Media Query.
			$css .= '
          #main-header-navigation ul#primary-menu {position: relative;}
          #main-header-navigation ul#primary-menu::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 15px;
            width:  100vw;
            max-width:  100vw;
            margin-left:  calc(50% - 50vw);
            height: 1px;
            background-color: ' . $header_border_color . ';
            z-index: 1;
          }';
			$css .= '}'; // End Media Query.

			if ( 'icon' === $paddle_header_search_button_type ) {
				$css .= '

            @media (min-width: 992px) {
              #main-header-navigation {
                flex-basis: 100%;
              }
            }
             
              #search-glass::after {
                content: "";
                position: absolute;
                width: 2px;
                background-color: ' . $header_border_color . ';
                left: calc(50% + 40px);
                margin-right: 40px;
                height: 40px;
                border-radius: 0;
                z-index: -1;
                transform: rotate(19deg);
            }';

				$css .= '
            div#search-glass>button {position: relative;}
            #search-glass {
              position: relative;
              flex-basis: 80%;
              margin-bottom: 15px;
            }
            
            ';
			}
			if ( 'input' === $paddle_header_search_button_type ) {
				$css .= '
             @media (min-width: 992px) {
              .full-width-search-container.icon-with-input {
                flex-basis: 80%;
                padding-top:0;
              }
              #main-header-navigation ul#primary-menu::after { bottom: 15px}
            }';
			}
		} else {
			// WooCommerce is not active - arrange search icon if enable
			if ( $site_has_search && $paddle_cta_enable
			&& 'icon' === $paddle_header_search_button_type && strpos( $menu_options, 'cta' ) !== false ) {
				$css .= '
            @media (min-width: 992px) {
              #search-glass {
                order: -1;
                padding-right: 15px;
              }
            }';
			} else {
				$css .= ' @media (min-width: 992px) { 
              #search-glass {padding-left: 22px;}
              .full-width-search-container.icon-with-input { width: unset; padding-left: 22px;}
            }';

			}
		}

		 // Header Border Top / Bottom.
		 $site_header_border = '';
		if ( $border_bottom_enable || $border_top_enable ) {
			$site_header_border .= '@media (min-width: 992px) {';

			$site_header_border .= '}'; // End media query

			$site_header_border .= '.site-header {';
			$site_header_border .= $border_bottom_enable ? 'border-bottom: 1px solid ' . $header_border_color . ';' : '';
			$site_header_border .= $border_top_enable ? 'border-top: 1px solid ' . $header_border_color . ';' : '';
			$site_header_border .= '}';
			$css                .= $site_header_border;
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$flex_wrap = ' flex-wrap: wrap;';
		} else {
			$flex_wrap = ' flex-wrap: nowrap;';
		}

		$css .= '#header-style-6 {display: flex; align-items: center; justify-content: center; ' . $flex_wrap . '}

        @media (min-width: 992px) {
          #main-header-navigation {
            display: flex;
          } 
        }   
        ';

		$css .= '
        @media screen and (min-width: 992px) {
        .site-title, .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }}';
		$css .= '#masthead ul#primary-menu li {margin-right: 0}';
		$css .= '.site-branding {
            line-height: 1;
            -ms-flex-item-align: center;
            align-self: center;
        }';
		$css .= '.site-branding-wrap {
            padding: 8px 16px;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            vertical-align: middle;
        }';
		$css .= '.site-logo {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            text-align: center;
            -webkit-box-ordinal-group: 3;
            -ms-flex-order: 2;
            order: 2;
            padding-top: 8px;
            padding-bottom: 8px;
        }';
		// Logo Image
		$paddle_custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $paddle_custom_logo_id ) :
			$css .= '.custom-logo-link {
                display: inline-block;
                align-self: ' . $paddle_header_logo_align . ';
                max-width:  ' . $paddle_header_logo_size . 'px;
                width: ' . $paddle_header_logo_size . 'px;
            }';
			$css .= '.site-header .site-logo img {
                display: inline-block;
                max-height: 80px;
                width: 100%;
                max-width: 516px;
                height: auto;
            }';
			$css .= '@media screen and (min-width: 992px) {
                .site-header .site-logo img {max-height: ' . $paddle_header_logo_size . 'px}
            }';
		endif;

		// Site title
		$css .= '.site-header [data-nav="6"] li a.site-title {font-size: ' . $site_title_font_size . 'px; margin: 0; line-height: 1.2069;}';

		if ( is_front_page() || is_home() ) {
			$css .= '.site-logo h1 {margin-top: 0;}';
		} else {
			$css .= '[data-nav="6"] li a.site-title {
                line-height: 0;
                font-weight: var(--paddle-font-h1-weight);
            }';
		}

		// Site Description
		$css .= '.site-logo .site-description {text-align: center; margin-bottom: 0}';

		// Search Icon Position
		$css .= '.site-branding {
            -webkit-box-ordinal-group: 1;
            -ms-flex-order: 0;
            order: 0;
        }';

		// Navigation
		$css .= paddle_header_css_for_navigation();

		// ________________MOBILE____________________.

		$header_1  = '';
		$header_1 .= '@media screen and (max-width:992px) {';   // Start media query.

		$header_1 .= 'div[id="header-style-6"], #header-style-6 {
            display: flex;
            flex-wrap: wrap;
        }
        .toggler {
         order: -1;
       }';

		$search_button_order = '-1';
		if ( class_exists( 'WooCommerce' ) ) {
			$search_button_order = '-1';
		}

		// Search Type.
		if ( 'input' === $paddle_header_search_button_type_mobile ) {
			$header_1 .= '
          .full-width-search-container {
            flex-basis: 100%;
            order: 4;
          }';
		} else {
			// Add padding to search icon container
			$header_1 .= ' .header-content-2nd {padding: 0 5px}';
		}

		$header_1 .= '
        .site-logo.header-content-left {
            order: 0;
        }
        ';

		$header_1 .= '}'; // End media query.

		// Avoid the small screen dropping shopping cart on a new line
		$header_1 .= '@media screen and (max-width:360px) { .header-content-2nd {padding: 0}}';

		// If using header 1.
		// $css .= $header_1;

		// If using mobile header 2
		// ___________HEADER 2_____________
		$header_2 = '';

		$header_2 .= '@media screen and (max-width:992px) {';   // Start media query.
		$header_2 .= 'div[id="header-style-6"] {
          display: flex;
          flex-wrap: wrap;
      }
      .site-branding {order: 2}
     ';

		if ( 'input' === $paddle_header_search_button_type_mobile ) {
			$header_2 .= '
          .full-width-search-container {
            order: 4;
          }
          .site-header .woo-header-utilities { order: 5!important;
            justify-content: end;
            justify-items: flex-end;
            flex-basis: 20%;}
          .full-width-search-container {flex-basis: 100%;}
          ';
		}
		if ( 'input' === $paddle_header_search_button_type_mobile && class_exists( 'WooCommerce' ) ) {
			$header_2 .= '  .site-logo,  .full-width-search-container {flex-basis: 80%;}';
		}

		$search_button_order = '-1';
		if ( class_exists( 'WooCommerce' ) ) {
			$search_button_order = '-1';
		}

		$header_2 .= '
        .toggler {
          order: 4;
        }
        ';
		$header_2 .= '}'; // End media query.

		switch ( $paddle_header_mobile_layout ) {
			case 'mobile-header-1':
				$css .= $header_1;
				break;
			case 'mobile-header-2';
				$css .= $header_2;
			break;

		}

		return paddle_minimize_css( $css );
	}
}
 add_filter( 'paddle_header_6', 'paddle_header_6' );
