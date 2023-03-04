<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'paddle_header_5_6' ) ) {
	function paddle_header_5_6( $css_style ) {
		$paddle_default_header_style = get_theme_mod( 'paddle_header_layout_style', PADDLE_DEFAULT_OPTION['paddle_header_layout_style'] );
		$paddle_header_mobile_layout = get_theme_mod( 'paddle_header_mobile_layout', PADDLE_DEFAULT_OPTION['paddle_header_mobile_layout'] );
		$paddle_header_number        = paddle_get_default_header_number( $paddle_default_header_style );
		if ( '5-6' !== $paddle_header_number ) {
			return '';
		}

		$paddle_header_logo_align                = get_theme_mod( 'paddle_header_logo_align', PADDLE_DEFAULT_OPTION['paddle_header_logo_align'] );
		$paddle_header_logo_size                 = absint( get_theme_mod( 'header_logo_size', PADDLE_DEFAULT_OPTION['header_logo_size'] ) );
		$site_title_font_size                    = absint( get_theme_mod( 'site_title_font_size', PADDLE_DEFAULT_OPTION['site_title_font_size'] ) );
		$site_has_search                         = absint( get_theme_mod( 'paddle_header_search_button', PADDLE_DEFAULT_OPTION['paddle_header_search_button'] ) );
		$paddle_cta_enable                       = absint( get_theme_mod( 'paddle_header_cta', PADDLE_DEFAULT_OPTION['paddle_header_cta'] ) );
		$paddle_cta_padding_left                 = absint( get_theme_mod( 'header_cta_padding_left', PADDLE_DEFAULT_OPTION['header_cta_padding_left'] ) );
		$border_top_enable                       = absint( get_theme_mod( 'menu_border_top', PADDLE_DEFAULT_OPTION['menu_border_top'] ) );
		$border_bottom_enable                    = absint( get_theme_mod( 'menu_border_bottom', PADDLE_DEFAULT_OPTION['menu_border_bottom'] ) );
		$header_border_color                     = paddle_theme_get_color( 'paddle_header_border_color' );
		$paddle_header_logo_padding              = absint( get_theme_mod( 'header_logo_padding', PADDLE_DEFAULT_OPTION['header_logo_padding'] ) );
		$menu_wrap                               = get_theme_mod( 'paddle_menu_spacing', PADDLE_DEFAULT_OPTION['paddle_menu_spacing'] ); // paddle_menu_spacing
		$menu_padding                            = absint( get_theme_mod( 'header_menu_padding', PADDLE_DEFAULT_OPTION['header_menu_padding'] ) );
		$menu_item_margin_right                  = absint( get_theme_mod( 'menu_item_margin', PADDLE_DEFAULT_OPTION['menu_item_margin'] ) );// menu_item_margin
		$paddle_menu_align                       = get_theme_mod( 'paddle_menu_items_alignment', PADDLE_DEFAULT_OPTION['paddle_menu_items_alignment'] );
		$menu_align                              = 'justify' === $paddle_menu_align ? 'space-between' : $paddle_menu_align;
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

		 // Header Border Top / Bottom.
		 $site_header_border = '';
		if ( $border_bottom_enable || $border_top_enable ) {
			$site_header_border .= '.site-header::after {';
			$site_header_border .= $border_bottom_enable ? 'border-bottom: 1px solid ' . $header_border_color . ';' : '';
			//$site_header_border .= $border_top_enable ? 'border-top: 1px solid ' . $header_border_color . ';' : '';
			$site_header_border .= '}';
			$css                .= $site_header_border;
		}

		$css .= '.site-branding {
            line-height: 1;
            -ms-flex-item-align: center;
            align-self: center;
        }';
		$css .= '.site-branding-wrap {
            padding: 8px 0;
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
            padding-top: ' . $paddle_header_logo_padding . 'px;
            padding-bottom: ' . $paddle_header_logo_padding . 'px;
            text-align: left;
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
                max-height: fit-content;
                width: 100%;
                max-width: 516px;
                height: auto;
            }';
			$css .= '@media screen and (min-width: 992px) {
                .site-header .site-logo img {max-height: ' . $paddle_header_logo_size . 'px}
            }';
		endif;

		// Site title
		$css .= '.site-header .site-title {font-size: ' . $site_title_font_size . 'px; margin: 0; line-height: 1.2069;}';

		if ( is_front_page() || is_home() ) {
			$css .= '.site-branding .site-logo h1 {margin-top: 0;}';
		} else {
			$css .= 'p.site-title {
                line-height: 0;
                font-weight: var(--paddle-font-h1-weight);
            }';
		}

		// Site Description
		$css .= '.site-branding .site-logo .site-description {text-align: center; margin-bottom: 0}';

		// Search Icon Position
		$css .= '.site-branding .header-content-2nd {
            -webkit-box-ordinal-group: 1;
            -ms-flex-order: 0;
            order: 0;
        }';

		// Navigation

		$css .= paddle_header_css_for_navigation();

		$css .= '@media (min-width: 992px) {
          #main-header-navigation { flex: 1;}
        }';

		// Header Mobile Layout
		$css   .= '.toggler{ display: flex}
        ';
		$logo_padding_left = '';
		
		if ( 'input' === $paddle_header_search_button_type_mobile && $site_has_search && 'mobile-header-2' === $paddle_header_mobile_layout ) {
			$logo_padding_left = 'padding-left: 42px;';
		}
		
		$css   .= '@media screen and (max-width:992px) {';
		  $css .= ' .header-content-2nd { order: 0 }
          .site-logo {flex: 1; order: 2; '.$logo_padding_left.'}
          .site-logo,  .site-logo .site-description {text-align: center; }

          .site-header button.searchsubmit::after,.btn.button-search::after {
            border-color: ' . $icon_color_mobile . ';
          }
          .site-header button.searchsubmit::before, .btn.button-search::before {
            background-color:' . $icon_color_mobile . ';
          }
          ';
		$css   .= '}'; // End media query.

		$logo_padding_right = '';
		if('mobile-header-1' === $paddle_header_mobile_layout && 'input' === $paddle_header_search_button_type_mobile) {
			$logo_padding_right = 'padding-right: 42px;';
		}
		// ________ WooCommerce
		
		$search_button_order = '0';
		if ( class_exists( 'WooCommerce' )) {
			$search_button_order = '4';
			$logo_padding_right = '';
		}
		if($site_has_search && 'mobile-header-1' === $paddle_header_mobile_layout) {
			$logo_padding_left = '';
		}

		$header_1  = '';
		
		$header_1 .= '@media screen and (max-width:992px) {';   // Start media query.

		$header_1 .= 'div[id="header-style-2"] {
            flex-wrap: wrap;
        }
        .toggler {
         order: -1;
       }';

		// Search Type.
		if ( 'input' === $paddle_header_search_button_type_mobile ) {
			$header_1 .= '
          .header-content-2nd {
            flex-basis: 100%;
            order: ' . $search_button_order . ';
          }';
		} else {
			// Add padding to search icon container
			$header_1 .= ' .header-content-2nd {padding: 0 5px}';
		}

		$header_1 .= '
        .site-logo.header-content-left {
            order: 0;
			'.$logo_padding_right.'
        }
        ';

		$header_1 .= '}'; // End media query.

		// Avoid the small screen dropping shopping cart on a new line
		$header_1 .= '@media screen and (max-width:360px) { .header-content-2nd {padding: 0}}';

		

		// If using mobile header 2
		// ___________HEADER 2_____________
		$header_2 = '';

		$header_2 .= '@media screen and (max-width:992px) {';   // Start media query.
		$header_2 .= 'div[id="header-style-2"] {
          flex-wrap: wrap;
      }
     ';

	 // Check if no search and woocommerce
	 if('mobile-header-2' === $paddle_header_mobile_layout && !class_exists( 'WooCommerce' ) && !$site_has_search) {
		 $header_2 .= '.site-logo {padding-left: 0px; text-align: left}';
	 }
	 if('mobile-header-2' === $paddle_header_mobile_layout && class_exists( 'WooCommerce' ) && !$site_has_search) {
		$header_2 .= '.site-logo {padding-left: 0px; text-align: left}';
	 }

		if ( 'input' === $paddle_header_search_button_type_mobile ) {
			$header_2 .= '
          .header-content-2nd {
            order: 4;
          }
          .site-header .woo-header-utilities { order : 4!important}
          .header-content-2nd {flex-basis: 100%;}
          ';
		}
		if ( 'input' === $paddle_header_search_button_type_mobile && class_exists( 'WooCommerce' ) ) {
			$header_2 .= '  .site-logo,  .header-content-2nd {flex-basis: 80%;}';
		}
		if('mobile-header-2' === $paddle_header_mobile_layout && !$site_has_search) {
			$header_2 .= '.header-content-2nd {display: none;}
			.site-logo{flex-basis: unset;}
			';
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
 add_filter( 'paddle_header_5_6', 'paddle_header_5_6' );
