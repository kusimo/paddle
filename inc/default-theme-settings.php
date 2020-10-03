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
			set_theme_mod( 'paddle_page_layout_width', 0 );
		}
		$paddle_default_page_layout_sidebar = get_theme_mod( 'paddle_page_layout_sidebar' );
		if ( '' === $paddle_default_page_layout_sidebar ) {
			set_theme_mod( 'paddle_page_layout_sidebar', 0 );
		}
		// Color.
		$paddle_primary_color = get_theme_mod( 'paddle_primary_color' );
		if ( '' === $paddle_primary_color ) {
			set_theme_mod( 'paddle_primary_color', PADDLE_PRIMARY_COLOR );
		}
		// CTA.
		$paddle_header_cta = get_theme_mod( 'paddle_header_cta' );
		if ( '' === $paddle_header_cta ) {
			set_theme_mod( 'paddle_header_cta', 1 );
		}
		$paddle_header_cta_url = get_theme_mod( 'paddle_header_cta_url' );
		if ( '' === $paddle_header_cta_url ) {
			set_theme_mod( 'paddle_header_cta_url', get_bloginfo( 'url' ) );
		}
		$paddle_header_cta_text = get_theme_mod( 'paddle_header_cta_text' );
		if ( '' === $paddle_header_cta_text ) {
			set_theme_mod( 'paddle_header_cta_text', 'Call To Action' );
		}
		//paddle_enable_banner_bgcolor
		$paddle_enable_banner_bgcolor = get_theme_mod( 'paddle_enable_banner_bgcolor' );
		if ( '' === $paddle_enable_banner_bgcolor ) {
			set_theme_mod( 'paddle_enable_banner_bgcolor', 0 );
		}

	}
}


/**
 * Dynamic CSS
 */
if ( ! function_exists( 'paddle_header_css' ) ) {
	
		/**
		 * Styles the header.
		 */ 
	function paddle_header_css() {

		$paddle_menu_uppercase = absint( get_theme_mod( 'paddle_menu_text_to_uppercase' ) );
		$primary_color         = sanitize_hex_color( get_theme_mod( 'paddle_primary_color', PADDLE_PRIMARY_COLOR ) );
		$paddle_banner_header_color  = sanitize_hex_color( get_theme_mod( 'paddle_banner_header_color', '#ffffff' ) );
		$paddle_banner_header_bgcolor	= sanitize_hex_color( get_theme_mod( 'paddle_banner_header_bg_color', '#3e3c3c' ) );
		$paddle_enable_banner_bgcolor	= absint( get_theme_mod( 'paddle_enable_banner_bgcolor' ) ); 

		$css = '';

		   
		if ( 1 === $paddle_menu_uppercase ) {
			$css .= '.site-header .nav-menu .menu-item a {text-transform: uppercase; }';   
		}

		if ( 0 === $paddle_enable_banner_bgcolor ) {
			$css .= '.home-banner .home-banner-content .board  { background: transparent!important } ';
		}

		// Primary Color.
		if ( PADDLE_PRIMARY_COLOR !== $primary_color ) {
			$css .= '
            .site-header .nav-menu .menu-item:hover > a, .site-header .nav-menu .menu-item.current-menu-item > a, .site-header .nav-menu .menu-item.current-menu-ancestor > a {
                color: ' . $primary_color . ';
            }
            #page a:not([class*="wp-block-"]):hover, #page a:focus {
                color: ' . $primary_color . ';
            }
            .btn-primary {
                background-color: ' . $primary_color . ';
                border-color: ' . $primary_color . ';
            }
            .btn-primary:hover {
                background-color: ' . $primary_color . ';
                border-color: ' . $primary_color . ';
            }
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
			.home-banner .home-banner-content .board {
				color: ' . $paddle_banner_header_color . ';
			}
			.home-banner .home-banner-content .board {
				background: ' . $paddle_banner_header_bgcolor . ';
			}

			#commentform input#submit {
				color: ' . $primary_color . ';
			}
			#commentform input#submit:hover {
				color: #fff;
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
				fill: '. $primary_color . ';
			}
            @media (min-width: 768px){
            .site-header .nav-primary .current-menu-item .submenu-expand svg, .site-header .nav-primary .current-menu-ancestor .submenu-expand svg {
                fill: ' . $primary_color . ';
			} }

            ';

		}

		return paddle_minimize_css( $css );
	}
}

	


/**
 * Display Dynamic CSS in the document header.
 */
function paddle_output_header_css() {
   
	if ( ! empty( paddle_header_css() ) ) : ?>
		<style type="text/css" id="paddle-dynamic-css">
			<?php echo paddle_header_css(); ?> 
		</style>
		<?php 
	endif;
}
add_action( 'wp_head', 'paddle_output_header_css' );

