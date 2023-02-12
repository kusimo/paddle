<?php 
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists('paddle_header_st2' ) ) {
    function paddle_header_st2($css_style) {
        $paddle_default_header_style = get_theme_mod( 'paddle_header_layout_style', PADDLE_DEFAULT_OPTION['paddle_header_layout_style'] ); 
        $paddle_header_number = paddle_get_default_header_number($paddle_default_header_style);
        if ( '1-4' !== $paddle_header_number ) return '';

        $paddle_header_logo_align  = get_theme_mod('paddle_header_logo_align', PADDLE_DEFAULT_OPTION['paddle_header_logo_align']);
        $paddle_header_logo_size   = absint(get_theme_mod('header_logo_size', PADDLE_DEFAULT_OPTION['header_logo_size']));
        $site_title_font_size	   = absint(get_theme_mod('site_title_font_size', PADDLE_DEFAULT_OPTION['site_title_font_size']));
        $site_has_search           = absint( get_theme_mod( 'paddle_header_search_button', PADDLE_DEFAULT_OPTION['paddle_header_search_button'] ) );
        $paddle_cta_enable         = absint(get_theme_mod('paddle_header_cta', PADDLE_DEFAULT_OPTION['paddle_header_cta']));
        $paddle_cta_padding_left   = absint(get_theme_mod('header_cta_padding_left', PADDLE_DEFAULT_OPTION['header_cta_padding_left']));
        $border_top_enable         = absint(get_theme_mod('menu_border_top', PADDLE_DEFAULT_OPTION['menu_border_top']));
        $border_bottom_enable      = absint(get_theme_mod('menu_border_bottom', PADDLE_DEFAULT_OPTION['menu_border_bottom']));
        $header_border_color      = paddle_theme_get_color('paddle_header_border_color');
        $paddle_header_logo_padding				 = absint(get_theme_mod('header_logo_padding', PADDLE_DEFAULT_OPTION['header_logo_padding']));
        $menu_wrap = get_theme_mod('paddle_menu_spacing', PADDLE_DEFAULT_OPTION['paddle_menu_spacing']); //paddle_menu_spacing
        $menu_padding				 = absint(get_theme_mod('header_menu_padding', PADDLE_DEFAULT_OPTION['header_menu_padding']));
        $menu_item_margin_right				 = absint(get_theme_mod('menu_item_margin', PADDLE_DEFAULT_OPTION['menu_item_margin']));//menu_item_margin
        $paddle_menu_align  = get_theme_mod('paddle_menu_items_alignment', PADDLE_DEFAULT_OPTION['paddle_menu_items_alignment']);
        $menu_align = 'justify' === $paddle_menu_align ? 'space-between' : $paddle_menu_align;
        $paddle_header_search_button_type = get_theme_mod('paddle_header_search_button_type', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type']);
        $paddle_header_search_button_type_mobile = get_theme_mod('paddle_header_search_button_type_mobile', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type_mobile']);
        $paddle_theme_color_search_icon = paddle_theme_get_color('paddle_header_search_icon_color');
        $paddle_theme_color_buttons = paddle_theme_get_color('paddle_theme_color_buttons');
        $icon_color_mobile = $paddle_theme_color_search_icon;
        $icon_color_desktop = $paddle_theme_color_search_icon;

        if ('input' === $paddle_header_search_button_type_mobile) {
          $icon_color_mobile = $paddle_theme_color_search_icon === $paddle_theme_color_buttons ? '#FFFFFF' : $paddle_theme_color_search_icon;
        } 
        if ('input' === $paddle_header_search_button_type) {
          $icon_color_desktop = $paddle_theme_color_search_icon === $paddle_theme_color_buttons ? '#FFFFFF' : $paddle_theme_color_search_icon;
        } 


        $css = '';

        $site_branding_order = 0;
        $site_logo_position = 'center';
        if('paddle-header-1' === $paddle_default_header_style ) {
          $site_branding_order = 2;
          $site_logo_position = 'left';
        } elseif ('paddle-header-3' === $paddle_default_header_style ) {
          $site_logo_position = 'center';
          $site_branding_order = 2;
          //$site_branding_order = 2;
        } elseif ('paddle-header-4' === $paddle_default_header_style ) {
          $site_logo_position = 'left';
        }
        
        // Header Border Top / Bottom.
        $site_header_border = '';
        if($border_bottom_enable || $border_top_enable) {
          $site_header_border .= '.site-header {';
           $site_header_border .= $border_bottom_enable ? 'border-bottom: 1px solid '.$header_border_color.';' : '';
           $site_header_border .= $border_top_enable ? 'border-top: 1px solid '.$header_border_color.';' : '';
          $site_header_border .= '}';
          $css .= $site_header_border;
        }
       
      

        $css .='.site-branding {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }';
        $css .='.site-branding .site-logo {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            text-align: '.$site_logo_position.';
            -webkit-box-ordinal-group: 3;
            -ms-flex-order: 2;
            order: 2;
            padding-top: '.$paddle_header_logo_padding.'px;
            padding-bottom: '.$paddle_header_logo_padding.'px;
        }';
        // Logo Image
        $paddle_custom_logo_id = get_theme_mod( 'custom_logo' );
        if ( $paddle_custom_logo_id ) :
            $css .='.custom-logo-link {
                display: inline-block;
                align-self: ' . $paddle_header_logo_align . ';
                max-width:  ' . $paddle_header_logo_size . 'px;
                width: ' . $paddle_header_logo_size . 'px;
            }';
            $css .= '.site-header .site-logo img {
                display: inline-block;
                /*max-height: 80px;*/
                width: 100%;
                max-width: 516px;
                height: auto;
            }';
            $css .='@media screen and (min-width: 992px) {
               /* .site-header .site-logo img {max-height: ' . $paddle_header_logo_size . 'px} */
            }';
        endif;

        // Site title
        $css .= '.site-header .site-title {font-size: ' . $site_title_font_size . 'px; margin: 0; line-height: 1.2069;}';
        
        if ( is_front_page() || is_home() ) {
            $css .='.site-branding .site-logo h1 {margin-top: 0;}';
        } else {
            $css .='p.site-title {
                line-height: 0;
                font-weight: var(--paddle-font-h1-weight);
            }';
        }

        // Site Description
        $css .= '.site-branding .site-logo .site-description {text-align: '.$site_logo_position.'; margin-bottom: 0}';

        // Search Icon Position
        $css .='.site-branding .header-content-2nd {
            align-items: center;
            -webkit-box-ordinal-group: 1;
            -ms-flex-order: '.$site_branding_order.';
            order: '.$site_branding_order.';
        }';
    
        
      
        // Navigation
        $css .= '
        #main-header-navigation {
            display: none; }
            #main-header-navigation a {
              text-decoration: none; }
          
          @media (min-width: 992px) {
            #main-header-navigation {
              display: block; } }';
        
        $css .= '[data-nav="1-4"] {
            width: auto;
            line-height: 0;
          }
            [data-nav="1-4"] div#primary-menu,
            [data-nav="1-4"] .container {
              text-align: center; }
              [data-nav="1-4"] div#primary-menu ul:first-child,
              [data-nav="1-4"] .container ul:first-child {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                    -ms-flex-align: center;
                        align-items: center;
                -webkit-box-pack: center;
                    -ms-flex-pack: center;
                        justify-content: center;
                min-height: 50px; 
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
              }
                /*[data-nav="1-4"] div#primary-menu ul:first-child > li,*/
                [data-nav="1-4"] .container ul:first-child > li {
                  margin-right: '.$menu_item_margin_right.'px;
                  }
                  [data-nav="1-4"] div#primary-menu ul:first-child > li:last-child,
                  [data-nav="1-4"] .container ul:first-child > li:last-child {
                    margin-right: 0; }
            [data-nav="1-4"] div#primary-menu {
              padding-right: 2rem;
              padding-left: 2rem; }
            [data-nav="1-4"] ul#primary-menu {
              display: -webkit-box;
              display: -ms-flexbox;
              display: flex; 
              justify-content: '.$menu_align.';
              -ms-flex-wrap: '.$menu_wrap.';
              flex-wrap: '.$menu_wrap.';
              padding-top:'.$menu_padding.'px;
              padding-bottom: '.$menu_padding.'px;
            }
            [data-nav="1-4"] ul {
              display: inline-block;
              clear: both;
              line-height: 1;
              margin: 0;
              width: 100%;
              padding: 0; }
              [data-nav="1-4"] ul ul.sub-menu ul,
              [data-nav="1-4"] ul ul.children ul {
                margin-left: 0; }
              [data-nav="1-4"] ul li.menu-item-has-children.focus > ul,
              [data-nav="1-4"] ul li.page_item_has_children.focus > ul {
                left: auto;
                opacity: 1;
                -webkit-transition: opacity 0.15s linear, -webkit-transform 0.15s linear;
                transition: opacity 0.15s linear, -webkit-transform 0.15s linear;
                transition: opacity 0.15s linear, transform 0.15s linear;
                transition: opacity 0.15s linear, transform 0.15s linear, -webkit-transform 0.15s linear; }
              [data-nav="1-4"] ul li.menu-item-has-children li.focus > ul,
              [data-nav="1-4"] ul li.page_item_has_children li.focus > ul {
                left: -100%; }
              [data-nav="1-4"] ul li,
              [data-nav="1-4"] ul li {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                margin-right: 16px; }
                [data-nav="1-4"] ul li:hover ul li > ul,
                [data-nav="1-4"] ul li:hover ul li > ul {
                  -webkit-animation: move-right 400ms ease both;
                          animation: move-right 400ms ease both; }
                [data-nav="1-4"] ul li ul li > ul,
                [data-nav="1-4"] ul li ul li > ul {
                  -webkit-transition-delay: .15s;
                          transition-delay: .15s; }
              [data-nav="1-4"] ul > li > a {
                padding: 0.7em 0.5em;
                line-height: 22px;
                text-decoration: none; }
              [data-nav="1-4"] ul > li.current-menu-item > a {
                color: #000000; }
              [data-nav="1-4"] ul > li:hover > a,
              [data-nav="1-4"] ul > li.current-menu-item > a,
              [data-nav="1-4"] ul > li.current-menu-ancestor > a {
                color: #000000; }
              [data-nav="1-4"] ul li:hover ul.sub-menu,
              [data-nav="1-4"] ul li:hover ul.children {
                -webkit-animation: move-right 400ms ease both;
                        animation: move-right 400ms ease both; }
            [data-nav="1-4"] li {
              float: left;
              list-style: none;
              position: relative; }
              [data-nav="1-4"] li li.menu-item-has-children ul.sub-menu,
              [data-nav="1-4"] li li.page_item_has_children ul.children {
                margin-left: 0px;
                left: auto;
                top: 0; }
              [data-nav="1-4"] li .menu-item-has-children > a,
              [data-nav="1-4"] li .page_item_has_children > a {
                padding-right: 26px; }
              [data-nav="1-4"] li ul li span.submenu-expand {
                -webkit-transform: rotate(-90deg) !important;
                        transform: rotate(-90deg) !important; }
              [data-nav="1-4"] li:hover ul li span.submenu-expand {
                -webkit-transform: none;
                        transform: none; }
              [data-nav="1-4"] li:hover > a {
                color: #000000; }
              [data-nav="1-4"] li:hover > .sub-menu,
              [data-nav="1-4"] li:hover > .children {
                left: auto;
                opacity: 1;
                padding: 0; }
              [data-nav="1-4"] li.menu-item-has-children > a,
              [data-nav="1-4"] li.menu_item_has_children > a {
                padding-right: 26px; }
              [data-nav="1-4"] li a:not(.btn) {
                border: none;
                color: #000000;
                display: block;
                font-size: 1rem;
                font-weight: 500;
                line-height: 18px;
                position: relative;
                text-decoration: none;
                text-align: left; }
              [data-nav="1-4"] li:hover span.submenu-expand {
                -webkit-transform: rotate(180deg);
                        transform: rotate(180deg); }
              [data-nav="1-4"] li.menu-item-has-children:hover ul,
              [data-nav="1-4"] li.page_item_has_children:hover ul {
                -webkit-animation: move-right 400ms ease both;
                        animation: move-right 400ms ease both; }
              [data-nav="1-4"] li.menu-item-has-children li:hover ul,
              [data-nav="1-4"] li.page_item_has_children li:hover > ul {
                left: -100%; }
            [data-nav="1-4"] .sub-menu,
            [data-nav="1-4"] .children {
              left: -9999px;
              opacity: 0;
              padding: 7px;
              position: absolute;
              width: 180px;
              z-index: 99;
              margin: 0;
              background: #fafafa;
              min-width: 15rem;
              -webkit-transition: all 0.5s ease;
              transition: all 0.5s ease;
              top: calc(100% - 1px); }
              [data-nav="1-4"] .sub-menu li,
              [data-nav="1-4"] .children li {
                float: none;
                margin-right: 0;
                margin-left: 0; }
                [data-nav="1-4"] .sub-menu li a,
                [data-nav="1-4"] .children li a {
                  padding-right: .9rem;
                  padding-left: .9rem; }
            [data-nav="1-4"] .submenu-expand {
              -webkit-transition: 300ms;
              transition: 300ms;
              position: absolute;
              right: 8px;
              top: 50%;
              margin-top: -4px;
              line-height: 0;
              background: transparent;
              padding: 0;
              border: 0; }
              [data-nav="1-4"] .submenu-expand svg {
                width: 10px;
                height: 10px; }
            [data-nav="1-4"].active .menu-item.menu-item-has-children,
            [data-nav="1-4"].active .page_item.menu_item_has_children {
              position: relative; }
            [data-nav="1-4"].active .menu > li + li {
              border-top: 1px solid #eee; }
            [data-nav="1-4"].active .submenu-expand {
              position: absolute;
              right: 0;
              top: 0;
              width: 32px;
              height: 56px;
              text-align: center;
              line-height: 0;
              cursor: pointer;
              outline: none; }
              [data-nav="1-4"].active .submenu-expand.expanded {
                -webkit-transform: rotate(180deg);
                        transform: rotate(180deg); }
                [data-nav="1-4"].active .submenu-expand.expanded + .sub-menu,
                [data-nav="1-4"].active .submenu-expand.expanded + .children {
                  display: block; }
              [data-nav="1-4"].active .submenu-expand:hover svg,
              [data-nav="1-4"].active .submenu-expand.expanded svg {
                fill: transparent; }
            [data-nav="1-4"] ul ul .menu-item-has-children > .submenu-expand > svg,
            [data-nav="1-4"] ul ul .page_item_has_children > .submenu-expand > svg {
              margin-top: -7px;
              left: auto;
              position: absolute;
              right: 9px;
              top: 50%;
              margin-top: unset;
              -webkit-transform: rotate(-270deg);
                      transform: rotate(-270deg); }
            [data-nav="1-4"] button.toggle.submenu-expand {
              background-color: transparent !important; }';


        // Header Mobile Layout
        $css .='.toggler{ display: flex}
        ';
        $css .= '@media screen and (max-width:992px) {'; 
          $css .='.site-branding .header-content-2nd { order: 0 }
          .site-branding .site-logo, .site-branding .site-logo .site-description {text-align: center;}

          .site-header button.searchsubmit::after,.btn.button-search::after {
            border-color: '.$icon_color_mobile.';
          }
          .site-header button.searchsubmit::before, .btn.button-search::before {
            background-color:'.$icon_color_mobile.';
          }
          ';
        $css .='}'; // End media query.
        //________ WooCommerce
        $search_button_order = '0';
        if ( class_exists( 'WooCommerce' ) ) {
          $search_button_order = '4';
        }

        $header_1 = '';
        $header_1 .= '@media screen and (max-width:992px) {';   // Start media query.
      
        $header_1 .= '.brand-wrap {
            flex-wrap: wrap;
        }
        .toggler {
         order: -1;
       }';

       // Search Type.
       if( 'input' === $paddle_header_search_button_type_mobile ) {
        $header_1 .='
          .header-content-2nd.d-flex.flex-row {
            flex-basis: 100%;
            order: '.$search_button_order.';
          }';
       } else {
        // Add padding to search icon container
        $header_1 .= '.site-branding .header-content-2nd {padding: 0 5px}';
       }
      
      $header_1  .='
        .site-logo.header-content-left {
            order: -1;
        }
        ';
       
        $header_1 .='}'; // End media query.

        // Avoid the small screen dropping shopping cart on a new line
        $header_1 .= '@media screen and (max-width:360px) {.site-branding .header-content-2nd {padding: 0}}';

        // If using header 1.
      //  $css .= $header_1;

     // If using mobile header 2
     //___________HEADER 2_____________
      $header_2 = '';

      $header_2 .= '@media screen and (max-width:992px) {';   // Start media query.
        $header_2 .= '.brand-wrap {
          flex-wrap: wrap;
      }
     ';

      if( 'input' === $paddle_header_search_button_type_mobile ) {
        $header_2 .='
          .header-content-2nd.d-flex.flex-row {
            order: 4;
          }
          .site-header .woo-header-utilities { order : 4!important}
          .header-content-2nd.d-flex.flex-row {flex-basis: 100%;}
          ';
       } 
       if( 'input' === $paddle_header_search_button_type_mobile && class_exists( 'WooCommerce' ) ) {
        $header_2 .=' .site-branding .site-logo,  .header-content-2nd.d-flex.flex-row {flex-basis: 80%;}';
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
        $header_2 .='}'; // End media query.

        $css .= $header_2;
       



        return paddle_minimize_css($css);
    }
 }
 add_filter('paddle_header_style', 'paddle_header_st2'); 