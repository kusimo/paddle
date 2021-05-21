<?php

/**
 * Check and setup theme's default settings
 *
 * @package paddle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Set default theme options
 */
if ( ! function_exists( 'paddle_setup_theme_default_settings' ) ) {
	/**
	 * Set default theme options
	 *
	 * @return void
	 */
	function paddle_setup_theme_default_settings() {
		// Display menu item in uppercase.
		$paddle_menu_uppercase = get_theme_mod( 'paddle_menu_text_to_uppercase' );
		if ( '' === $paddle_menu_uppercase ) {
			set_theme_mod( 'paddle_menu_text_to_uppercase', 0 );
		}

		// Page Layout.
		$paddle_default_page_layout_width = get_theme_mod( 'paddle_page_layout_width' );
		if ( '' === $paddle_default_page_layout_width ) {
			set_theme_mod( 'paddle_page_layout_width', 1 );
		}
		$paddle_default_page_layout_sidebar = get_theme_mod( 'paddle_page_layout_sidebar' );
		if ( '' === $paddle_default_page_layout_sidebar ) {
			set_theme_mod( 'paddle_page_layout_sidebar', 1 );
		}
		$paddle_remove_woo_single_sidebar = get_theme_mod( 'paddle_remove_woo_single_sidebar' );
		if ( '' === $paddle_remove_woo_single_sidebar ) {
			set_theme_mod( 'paddle_remove_woo_single_sidebar', 1 );
		}

		// Featured Image.
		$paddle_featured_image_style = get_theme_mod( 'paddle_featured_image_style' );
		if ( '' === $paddle_featured_image_style ) {
			set_theme_mod( 'paddle_featured_image_style', 'classic' );
		}
		// Color.
		$paddle_primary_color = get_theme_mod( 'paddle_primary_color' );
		if ( '' === $paddle_primary_color ) {
			set_theme_mod( 'paddle_primary_color', PADDLE_PRIMARY_COLOR );
		}
		// Menu background color.
		$paddle_menu_bgcolor = get_theme_mod( 'paddle_menu_bgcolor' );
		if ( '' === $paddle_menu_bgcolor ) {
			set_theme_mod( 'paddle_menu_bgcolor', '#FFFFFF' );
		}
		// Menu foreground text color.
		$paddle_navlink_text_color = get_theme_mod( 'paddle_navlink_text_color' );
		if ( '' === $paddle_navlink_text_color ) {
			set_theme_mod( 'paddle_navlink_text_color', '#5b6770' );
		}
		// Heading H1 bg color.
		$paddle_h1bg_color = get_theme_mod( 'paddle_h1bg_color' );
		if ( '' === $paddle_h1bg_color ) {
			set_theme_mod( 'paddle_h1bg_color', PADDLE_PRIMARY_COLOR );
		}
		// Center align menu.
		$paddle_center_align_menu = get_theme_mod( 'paddle_center_align_menu' );
		if ( '' === $paddle_center_align_menu ) {
			set_theme_mod( 'paddle_center_align_menu', 0 );
		}
		// Enable solid lines on headings h1 and h2.
		$paddle_title_headings_solid_lines = get_theme_mod( 'paddle_title_headings_solid_lines' );
		if ( '' === $paddle_title_headings_solid_lines ) {
			set_theme_mod( 'paddle_title_headings_solid_lines', 0 );
		}
		// CTA.
		$paddle_header_cta = get_theme_mod( 'paddle_header_cta' );
		if ( '' === $paddle_header_cta ) {
			set_theme_mod( 'paddle_header_cta', 0 );
		}

		// paddle_enable_banner_bgcolor
		$paddle_enable_banner_bgcolor = get_theme_mod( 'paddle_enable_banner_bgcolor' );
		if ( '' === $paddle_enable_banner_bgcolor ) {
			set_theme_mod( 'paddle_enable_banner_bgcolor', 0 );
		}

		// Banner background color opacity.
		$paddle_banner_content_bg_opacity = get_theme_mod( 'banner_content_bg_opacity' );
		if ( '' === $paddle_banner_content_bg_opacity ) {
			set_theme_mod( 'paddle_banner_content_bg_opacity', 0 );
		}

		// Banner text content border radius.
		$paddle_banner_border_radius = get_theme_mod( 'paddle_banner_border_radius' );
		if ( '' === $paddle_banner_border_radius ) {
			set_theme_mod( 'paddle_banner_border_radius', 1 );
		}

		// Toggle banner title style - uppercase and bgcolor.
		$paddle_toggle_banner_header_style = get_theme_mod( 'paddle_toggle_banner_header_style' );
		if ( '' === $paddle_toggle_banner_header_style ) {
			set_theme_mod( 'paddle_toggle_banner_header_style', 0 );
		}

		// Set default header layout to logo on the left.
		$paddle_header_layout_style = get_theme_mod( 'paddle_header_layout_style' );
		if ( '' === $paddle_header_layout_style ) {
			set_theme_mod( 'paddle_header_layout_style', 'logo-left' );
		}
	}
}


/**
 * Dynamic CSS
 */
if ( ! function_exists( 'paddle_static_header_css' ) ) {

	/**
	 * Styles the header.
	 */
	function paddle_static_header_css() {
		$paddle_menu_bgcolor_check               = sanitize_hex_color( get_theme_mod( 'paddle_menu_bgcolor', '#ffffff' ) );
		$paddle_navlink_text_color_check         = sanitize_hex_color( get_theme_mod( 'paddle_navlink_text_color', '#5b6770' ) );
		$paddle_h1bg_color_check                 = sanitize_hex_color( get_theme_mod( 'paddle_h1bg_color', PADDLE_PRIMARY_COLOR ) );
		$paddle_center_align_menu_check          = absint( get_theme_mod( 'paddle_center_align_menu' ) );
		$paddle_menu_uppercase                   = absint( get_theme_mod( 'paddle_menu_text_to_uppercase' ) );
		$primary_color                           = sanitize_hex_color( get_theme_mod( 'paddle_primary_color', PADDLE_PRIMARY_COLOR ) );
		$paddle_banner_header_color              = sanitize_hex_color( get_theme_mod( 'paddle_banner_header_color', '#ffffff' ) );
		$paddle_banner_header_bgcolor            = sanitize_hex_color( get_theme_mod( 'paddle_banner_header_bg_color', '#3e3c3c' ) );
		$paddle_enable_banner_bgcolor            = absint( get_theme_mod( 'paddle_enable_banner_bgcolor' ) );
		$banner_content_bg_opacity               = absint( get_theme_mod( 'banner_content_bg_opacity' ) );
		$paddle_banner_border_radius             = absint( get_theme_mod( 'paddle_banner_border_radius' ) );
		$paddle_toggle_banner_header_style       = absint( get_theme_mod( 'paddle_toggle_banner_header_style' ) );
		$paddle_title_headings_solid_lines_check = absint( get_theme_mod( 'paddle_title_headings_solid_lines' ) );
		$paddle_remove_woo_single_sidebar_check  = absint( get_theme_mod( 'paddle_remove_woo_single_sidebar' ) );

		$css = '';

		if ( 1 === $paddle_center_align_menu_check ) {
			$css .= '.site-header .nav-menu ul {width:unset; }';
		}

		if ( 1 === $paddle_menu_uppercase ) {
			$css .= '.site-header .nav-menu .menu-item a {text-transform: uppercase; }';
		}

	
		if ( 1 === $paddle_remove_woo_single_sidebar_check ) {
			$css .= 'body.single.single-product #primary.content-area {max-width:100%; flex: 0 0 100%!important; }';
		}

		// Primary Color.
		if ( PADDLE_PRIMARY_COLOR !== $primary_color ) {
			$css .= '
            .site-header .nav-menu .menu-item:hover > a, .site-header .nav-menu .menu-item.current-menu-item > a, .site-header .nav-menu .menu-item.current-menu-ancestor > a {
                color: ' . $primary_color . ';
            }
            #page a:not([class*="wp-block-"]):hover, #page a:focus {
                color: ' . $primary_color . '!important;
            }
            .btn-primary {
                background-color: ' . $primary_color . ';
                border-color: ' . $primary_color . ';
            }
            .btn-primary:hover {
                background-color: ' . $primary_color . ';
                border-color: ' . $primary_color . ';
            }
			.site-header .woo-header-utilities span.woo-my-item:hover {background: ' . $primary_color . ';}
			.site-header .woo-header-utilities .woo-basket a:hover span.woo-my-item {background: ' . $primary_color . ';}
            .site-header .nav-menu .menu-item span svg {
                fill: ' . $primary_color . ';
              }
              .site-header .nav-menu .menu-item:hover > span svg {
                fill: ' . $primary_color . ';
              }
            .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
                background-color: ' . $primary_color . ';
                border-color: ' . $primary_color . ';
            }
            .btn-primary:focus, .btn-primary.focus {
                background-color: ' . $primary_color . ';
                border-color:' . $primary_color . ';
                box-shadow: unset;
            }
            h1:not(.noline-title):before, h2:not(.noline-title):before, .headline.heading-line:before, .home-banner .home-banner-content .board {
                background: ' . $primary_color . ';
			}
			header.entry-header.has-post-thumbnail.slim-full-width .page__title-wrap{
				background-color: ' . $primary_color . ';
				color: #fff;
			}
			header.entry-header.has-post-thumbnail.slim-full-width .page__title-wrap h1:before{
				background: #ffffff;
			}

			#commentform input#submit {
				color: ' . $primary_color . ';
			}
			#commentform input#submit:hover {
				color: #fff;
				background-color: ' . $primary_color . ';
			}

			section[id*="recent-comments-"] ul li a:after , section[id*="recent-posts-"] ul li:before{
				background-color: ' . $primary_color . ';
			}

			.read-more:before {
				background-color: ' . $primary_color . ';
			}
			
			.article-more-link:hover .read-more:after {
				border: 2px solid ' . $primary_color . ';
				border-top-width: 0;
  				border-left-width: 0;
			}
			.comment-body .reply a {
				background: ' . $primary_color . ';
				border: 1px solid ' . $primary_color . ';
			}
			.comment-body .reply a:hover {
				border: 1px solid ' . $primary_color . ';
				background: white;
				color: ' . $primary_color . ';
			}
			article.sticky .thumbnail-container::after {
				box-shadow: -25px 20px 0 ' . $primary_color . ';
				background: ' . $primary_color . ';
			} 
			.offcanvas-nav-menu .menu-item:hover>span svg,  .offcanvas-nav-menu .submenu-expand.active svg {
				fill: ' . $primary_color . ';
			}
            @media (min-width: 768px){
            .site-header .nav-primary .current-menu-item .submenu-expand svg, .site-header .nav-primary .current-menu-ancestor .submenu-expand svg {
                fill: ' . $primary_color . ';
			} }

            ';
		}

		// Nav Menu background color.
		if ( '#ffffff' !== $paddle_menu_bgcolor_check ) {
			$css .= ' @media (min-width: 768px) { header .nav-primary { background-color: ' . $paddle_menu_bgcolor_check . '; border-bottom: none; }} ';
		}
		// Headings H1 background.
		if ( '#000000' !== $paddle_h1bg_color_check ) {
			$css .= 'body.boxed-header header:not(.no-bgcolor)>h1 { background-color: ' . $paddle_h1bg_color_check . '; } ';
		}

		// Nav Memu foreground color.
		if ( '#5b6770' !== $paddle_navlink_text_color_check ) {
			$css .= ' @media (min-width: 768px) {#masthead.site-header .nav-primary .menu>.menu-item>a { color: ' . $paddle_navlink_text_color_check . '; }} ';
		}

		// Banner Header Background Color.
		if ( 0 === $paddle_enable_banner_bgcolor ) {
			$css .= '.home-banner .home-banner-content .board, #paddle-slider .light-box-shadow  { background: transparent!important } ';
		} else {
			$css .= '.home-banner .home-banner-content .board, #paddle-slider .light-box-shadow  { background: ' . $paddle_banner_header_bgcolor . ' } ';
		}

		// Set the background color opacity.
		if ( 0 !== $banner_content_bg_opacity ) {
			$css .= '.home-banner .home-banner-content .board  { background: ' . paddle_rgba( $paddle_banner_header_bgcolor, $banner_content_bg_opacity ) . ' } ';
			$css .= '#paddle-slider .light-box-shadow  { background: ' . paddle_rgba( $paddle_banner_header_bgcolor, $banner_content_bg_opacity ) . ' } ';
			$css .= '#paddle-slider .light-box-shadow  { box-shadow: 0 0 10px 1px ' . $paddle_banner_header_bgcolor . '; } ';
		}

		// Banner Text Color
		if ( '#ffffff' !== $paddle_banner_header_color ) {
			$css .= ' .home-banner .home-banner-content .board { color: ' . $paddle_banner_header_color . '; } ';
		}

		// Set banner text content border radius;
		if ( 1 === $paddle_banner_border_radius ) {
			$css .= '.home-banner .home-banner-content .board  { border-radius: 15px } ';
		}

		// Banner Title style toggle.
		if ( 1 === $paddle_toggle_banner_header_style ) {
			$css .= '.home-banner h1  { 
				background-color: ' . $primary_color . ';
				color: #fff;
				padding: 18px;
				letter-spacing: 5px;
				float: right;
				text-transform: uppercase;
			} ';
		}

		// Headings solid lines
		if ( 0 === $paddle_title_headings_solid_lines_check ) {
			$css .= ' h1:before, h2:before {background: none!important} ';
		}

		return paddle_minimize_css( $css );
	}
}




/**
 * Display Dynamic CSS in the document header.
 */
function paddle_output_header_css() {
	if ( ! empty( paddle_static_header_css() ) ) : ?>
<style type="text/css" id="paddle-dynamic-css">
		<?php
		/* Static html */
			echo paddle_static_header_css();
		?>
</style>
		<?php
	endif;
}
add_action( 'wp_head', 'paddle_output_header_css' );
