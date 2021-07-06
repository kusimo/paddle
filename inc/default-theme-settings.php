<?php

/**
 * Check and setup theme's default settings
 *
 * @package paddle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Dynamic CSS
 */
if ( ! function_exists( 'paddle_static_header_css' ) ) {

	/**
	 * Styles the header.
	 */
	function paddle_static_header_css() {
		$primary_color                           = sanitize_hex_color( get_theme_mod( 'paddle_primary_color', PADDLE_PRIMARY_COLOR ) );
		$paddle_header_logo_size				 = absint( get_theme_mod( 'header_logo_size', 150 ) );
		$paddle_header_logo_padding				 = absint( get_theme_mod( 'header_logo_padding', 16 ) );
		$paddle_menu_bgcolor_check               = sanitize_hex_color( get_theme_mod( 'paddle_menu_bgcolor', '#ffffff' ) );
		$paddle_navlink_text_color_check         = sanitize_hex_color( get_theme_mod( 'paddle_navlink_text_color', $primary_color ) );
		$paddle_h1bg_color_check                 = sanitize_hex_color( get_theme_mod( 'paddle_h1bg_color', $primary_color ) );
		$paddle_center_align_menu_check          = absint( get_theme_mod( 'paddle_center_align_menu' ) );
		$paddle_menu_items_alignment             = get_theme_mod('paddle_menu_items_alignment', 'centered');
		$paddle_menu_uppercase                   = absint( get_theme_mod( 'paddle_menu_text_to_uppercase' ) );
		//Header Banner
		$header_media_height                     = absint( get_theme_mod( 'header_media_height', 60 ) );
		$paddle_banner_header_color              = sanitize_hex_color( get_theme_mod( 'paddle_banner_header_color', '#ffffff' ) );
		$paddle_banner_header_bgcolor            = sanitize_hex_color( get_theme_mod( 'paddle_banner_header_bg_color', '#3e3c3c' ) );
		$paddle_enable_banner_bgcolor            = absint( get_theme_mod( 'paddle_enable_banner_bgcolor', 1 ) );
		$paddle_enable_icon_bg                   = absint( get_theme_mod( 'enable_icon_bg', 0 ) );
		$banner_content_bg_opacity               = absint( get_theme_mod( 'banner_content_bg_opacity', 5 ) );
		$paddle_banner_border_radius             = absint( get_theme_mod( 'paddle_banner_border_radius', 1 ) );
		$paddle_title_headings_solid_lines_check = absint( get_theme_mod( 'paddle_title_headings_solid_lines' ) );
		$paddle_remove_woo_single_sidebar_check  = absint( get_theme_mod( 'paddle_remove_woo_single_sidebar' ) );
		

		$css = '';

		// Logo
		$css .= '
		@media screen and (min-width:992px) {
			.site-header .site-logo img {max-height: '.$paddle_header_logo_size.'px}
		  }
		  @media screen and (max-width:500px) {
			.site-header .site-logo img {max-height:60px}
		  }
		  body #masthead.site-header.header-style-2 #header-style-2 .site-branding-wrap {
			padding: '.$paddle_header_logo_padding.'px 0; 
		  }
		  body .site-branding .site-logo {
			padding-top: '.$paddle_header_logo_padding.'px; 
			padding-bottom: '.$paddle_header_logo_padding.'px; 
		  }
		';

		// Social icon background color
		if ( 0 === $paddle_enable_icon_bg ) {
			$css .= '
			#topbar ul.social-items li .bg-transform {
				background-color: transparent!important;
			}
			';
		}
	
		if ( 'centered' === $paddle_menu_items_alignment ) {
			$css .= '
			#masthead [data-header-style="1"] ul {justify-content: center;}
			#masthead [data-header-style="1"] ul #header-btn-cta {margin-left:unset; }
			';
		} else if( 'left' === $paddle_menu_items_alignment ) {
			$css .= '
			#masthead [data-header-style="1"] ul {justify-content: flex-start;}
			[data-header-style="1"] ul #header-btn-cta {margin-left:auto; }
			';
		} else if ( 'right' === $paddle_menu_items_alignment ) {
			$css .= '
			#masthead [data-header-style="1"] ul {justify-content: flex-end;}
			[data-header-style="1"] ul #header-btn-cta {margin-left:unset; }
			';
		} else if ('justify' === $paddle_menu_items_alignment ) {
			$css .= '
			#masthead [data-header-style="1"] ul {justify-content: space-between;}
			[data-header-style="1"] ul #header-btn-cta {margin-left:unset; }
			';
		} else {
			$css .= '
			#masthead [data-header-style="1"] ul {justify-content: center;}
			';
		}

		if ( 1 === $paddle_menu_uppercase ) {
			$css .= '[data-header-style="1"] .menu-item a {text-transform: uppercase; }';
		}

		if ( 1 === $paddle_remove_woo_single_sidebar_check ) {
			$css .= 'body.single.single-product #primary.content-area {max-width:100%; flex: 0 0 100%; }';
		}


		/* Primary Colory */
		
		$css .= 'a {color: '.$primary_color.'}';
		$css .= 'a:focus-visible, button:focus-visible {outline: 2px solid  '.$primary_color.'}';
		$css .= '
		#masthead [data-header-style="1"] ul li a:hover,
		#masthead [data-header-style="1"] ul li:hover > a,
		#masthead [data-header-style="1"] .current_page_item > a,
		#masthead [data-header-style="1"] .current-menu-item > a,
		#masthead [data-header-style="1"] .current_page_ancestor > a,
		#masthead [data-header-style="1"] .current-menu-ancestor > a,
		#masthead [data-header-style="1"] ul li a:focus, 
		#masthead [data-header-style="1"] ul li a:hover, 
		[data-header-style="1"] ul li:focus > a, 
		#primary main .entry-title a:hover,
		#primary main .entry-title a:focus, 
		.entry-title a:hover, 
		.entry-title a:focus, 
		#secondary .widget ul li a:hover,
		#secondary .widget ul li a:focus,
		.site-footer .widget ul li a:hover,
		.site-footer .widget ul li a:focus,
		.post-navigation .nav-links a:hover,
		.posts-navigation a:hover,
		.comments-area .comment-body .comment-metadata a:hover,
		.comments-area .comment-body .comment-metadata a:focus,
		.site-title a:hover, .site-title a:focus, 
		#secondary .widget ul li a:hover, #secondary .widget ul li a:focus, 
		.comments-area .comment-body .fn a:hover,
		.comments-area .comment-body .fn a:focus, 
		.widget_rss .widget-title a:hover,
		.widget_rss .widget-title a:focus, 
		.submenu-toggle:hover, 
		.submenu-toggle:focus{
			color: '.$primary_color.';
		}';
		 
		// buttons
		$css .= '
		button:not(.btn), 
		input[type=button]:not(.btn),
		input[type=reset]:not(.btn),
		input[type=submit]:not(.btn),
		btn-primary,
		#searchModal .search-form-container .bg-close-cirle,
		#topbar, #topbar .cta a::after
		{
		background-color: '.$primary_color.';
		}
		';
		$css .='
		button:not(.btn):hover, 
		input[type=button]:not(.btn):hover,
		input[type=reset]:not(.btn):hover,
		input[type=submit]:not(.btn):hover,
		btn-primary:hover
		{
			background-color: linear-gradient(217deg, '.paddle_rgba($primary_color, 8).', '.paddle_rgba($primary_color, 8).' 70.71%),
			linear-gradient(217deg, rgba(255,0,0,.8), rgba(255,0,0,0) 70.71%),
			linear-gradient(127deg, rgba(0,255,0,.8), rgba(0,255,0,0) 70.71%),
			linear-gradient(336deg, rgba(0,0,255,.8), rgba(0,0,255,0) 70.71%);
			background: '.$primary_color.'80;
			background-color: '.paddle_rgba($primary_color, 8).';
			color: currentColor;
		}
		button:not(.btn):active, button:not(.btn):focus, input[type=button]:not(.btn):active, 
		input[type=button]:not(.btn):focus, input[type=reset]:not(.btn):active, input[type=reset]:not(.btn):focus, 
		input[type=submit]:not(.btn):active, input[type=submit]:not(.btn):focus {
			border-color: '.$primary_color.';
		}
		#searchModal .search-form-container .close:focus {
			filter: unset;
		}
		#searchModal .search-form-container .close:focus + span { background-color: white; }
		#searchModal .search-form-container .close:focus {transform: rotate(25deg);}
		';
		
	
		$css .= '
		[data-menu=offcanvas] .offcanvas-header button.btn-close.text-reset {border-color: '.paddle_rgba($primary_color, 8).';}
		';
		if( '#000000' !== $paddle_navlink_text_color_check ) {
			$css .= '
			[data-header-style="1"] .menu>.menu-item>a { color: ' . $paddle_navlink_text_color_check . '; } 
			[data-header-style="1"] ul .sub-menu .menu-item>a { color: ' . $paddle_navlink_text_color_check . '; } 
			';
		} 

		$css .='blockquote {border-left: 4px solid '.$primary_color.'; border-color: '.$primary_color.' }';

	
		if ( '' !== $primary_color ) {
			$css .= '
           li.menu-item.current-menu-item>a, [data-header-style="1"] .menu-item.current-menu-ancestor > a {
                color: ' . $primary_color  . ';
            }
           
            .btn-primary {
                background-color: ' . $primary_color . ';
                border-color: ' . $primary_color . ';
            }
			.btn-primary:hover,.btn-primary:focus, a.btn.btn-primary:hover,
			a.btn.btn-primary:focus {
                border-color: ' . $primary_color . ';
				color: ' . $primary_color . ';
            }

            .btn-check:focus+.btn-primary, .btn-primary:focus, .btn-close:focus, 
			.btn-check:focus+.btn, .btn:focus,
			#searchform input[type=text]:focus,
			input:focus,
			.toggler button.navbar-toggler:active, .toggler button.navbar-toggler:focus {
				box-shadow: 0 0 0 0.25rem ' .paddle_rgba( $primary_color, 4 ) .'
			}
			
				
            [data-header-style="1"] .menu-item span svg {
                fill: ' . $primary_color . ';
              }
            
            .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
                background-color: ' . $primary_color . ';
                border-color: ' . $primary_color . ';
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
		

			section[id*="recent-comments-"] ul li a:after , section[id*="recent-posts-"] ul li:before{
				background-color: ' . $primary_color . ';
			}

			.read-more:before {
				background-color: ' . $primary_color . ';
			}
			
			
			.comment-body .reply a {
				background: ' . $primary_color . ';
				border: 1px solid ' . $primary_color . ';
			}
			
			article.sticky .thumbnail-container::after {
				box-shadow: -25px 20px 0 ' . $primary_color . ';
				background: ' . $primary_color . ';
			} 
			';
		}

		// Nav Menu background color.
		if ( '#ffffff' !== $paddle_menu_bgcolor_check ) {
			$css .= '[data-header-style="1"], [data-header-style="1"] .sub-menu { background-color: ' . $paddle_menu_bgcolor_check . '; border-bottom: none; } ';
			$css .= '.header-style-2 [data-header-style="1"] {border-radius: 60px;}';
			$css .= '[data-header-style="1"] .submenu-expand svg {fill: '.$paddle_navlink_text_color_check.'}';
		}
		// Headings H1 background.
		if ( '#000000' !== $paddle_h1bg_color_check ) {
			$css .= 'body.boxed-header header:not(.no-bgcolor)>h1 { background-color: ' . $paddle_h1bg_color_check . '; } ';
		}

		// Banner Height
		if ( 60 !== $header_media_height ) {
			$css .= '.home-banner  { height : '.$header_media_height.'vh } ';
		} 

		// Banner Overlay
		$css .='
		.home-banner .home-banner-overlay {
			background: rgba(0, 0, 0, 0.'.absint( paddle_banner_opacity() ).');
		}
		';
		// Grundge image.
		$css .= '.paddle-front-page-slider .slideshow-content:before {opacity: .' . absint( paddle_banner_opacity() ) . ' ; }';
		

		// Banner Image
		$css .= '#home-header-image .home-banner-image {
			background-image: url('.esc_url(paddle_get_header_image_url()).')!important; 
		}
		';
		

		// Banner Header Background Color.
		if ( 0 === $paddle_enable_banner_bgcolor ) {
			$css .= '.home-banner .home-banner-content .board  { background: transparent } ';
		} else {
			$css .= '.home-banner .home-banner-content .board  { background: ' . $paddle_banner_header_bgcolor . ' } ';
		}

		// Set the background color opacity.
		if ( 10 !== $banner_content_bg_opacity ) {
			$css .= '.home-banner .home-banner-content .board  { background: ' . paddle_rgba( $paddle_banner_header_bgcolor, $banner_content_bg_opacity ) . ' } ';
			$css .= '#paddle-slider .light-box-shadow  { background: ' . paddle_rgba( $paddle_banner_header_bgcolor, $banner_content_bg_opacity ) . ' } ';
		}

		// Hide show arrow icon in button
		if (1 !== get_theme_mod('banner_arrow_button', 1)) {
			$css .= '.home-banner-cta-button-container>a:before {display:none;}
			';
		}

		if ( 0 !== get_theme_mod('paddle_banner_box_shadow', 0) ) {
			$css .= '#paddle-slider .light-box-shadow, #hero .board  { box-shadow: 0 0 10px 1px ' . $paddle_banner_header_bgcolor . '; } ';
		}

		if ( 0 === get_theme_mod('paddle_banner_box_shadow', 0) ) {
			$css .= ' #paddle-slider .light-box-shadow, , #hero .board  { box-shadow: none; } ';
		}

	

		// Banner Text Color
		if ( '#ffffff' !== $paddle_banner_header_color ) {
			$css .= ' .home-banner .home-banner-content .board { color: ' . $paddle_banner_header_color . '; } ';
		}


		// Set banner text content border radius;
		if ( 1 === $paddle_banner_border_radius ) {
			$css .= '.home-banner .home-banner-content .board  { border-radius: 15px } ';
		}

		// Headings solid lines
		if ( 0 === $paddle_title_headings_solid_lines_check ) {
			$css .= ' h1:before, h2:before {background: none} ';
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

function paddle_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}