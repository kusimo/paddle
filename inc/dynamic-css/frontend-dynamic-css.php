<?php

/**
 * Frontend - Dynamic CSS
 *
 * @since 1.2.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

add_filter('paddle_dynamic_theme_css', 'paddle_frontend_css', 1);

/**
 * Comment Dynamic CSS
 * 
 * @param string
 * @return String
 */

function paddle_frontend_css($dynamic_css)
{
	// Color
	$paddle_theme_color_accent = paddle_theme_get_color('paddle_primary_color');
	$paddle_theme_color_headings = paddle_theme_get_color('paddle_theme_color_headings');
	$paddle_theme_color_body_text = paddle_theme_get_color('paddle_theme_color_body_text');
	$paddle_theme_color_headings_hover = paddle_theme_get_color('paddle_theme_color_headings_hover');
	$paddle_theme_color_buttons = paddle_theme_get_color('paddle_theme_color_buttons');
	$paddle_theme_color_buttons_hover = paddle_theme_get_color('paddle_theme_color_buttons_hover');
	$paddle_theme_color_links = paddle_theme_get_color('paddle_theme_color_links');
	$paddle_theme_color_links_hover = paddle_theme_get_color('paddle_theme_color_links_hover');
	$paddle_theme_color_border = paddle_theme_get_color('paddle_theme_color_border');
	$primary_color = sanitize_hex_color(get_theme_mod('paddle_primary_color', PADDLE_PRIMARY_COLOR));

	// OTHERS
	$paddle_header_logo_size				 = absint(get_theme_mod('header_logo_size', PADDLE_DEFAULT_OPTION['header_logo_size']));
	$paddle_header_logo_align                = get_theme_mod('paddle_header_logo_align', PADDLE_DEFAULT_OPTION['paddle_header_logo_align']);
	$paddle_header_menu_padding				 = absint(get_theme_mod('header_menu_padding', PADDLE_DEFAULT_OPTION['header_menu_padding']));
	$paddle_header_logo_padding				 = absint(get_theme_mod('header_logo_padding', PADDLE_DEFAULT_OPTION['header_logo_padding']));
	$paddle_menu_bgcolor_check               = sanitize_hex_color(get_theme_mod('paddle_menu_bgcolor', PADDLE_DEFAULT_OPTION['paddle_menu_bgcolor']));
	$paddle_navlink_text_color_check         = sanitize_hex_color(get_theme_mod('paddle_navlink_text_color', PADDLE_DEFAULT_OPTION['paddle_navlink_text_color']));
	$paddle_h1bg_color_check                 = sanitize_hex_color(get_theme_mod('paddle_h1bg_color', PADDLE_DEFAULT_OPTION['paddle_h1bg_color']));
	$paddle_menu_items_alignment             = get_theme_mod('paddle_menu_items_alignment', PADDLE_DEFAULT_OPTION['paddle_menu_items_alignment']);
	$paddle_menu_uppercase                   = absint(get_theme_mod('paddle_menu_text_to_uppercase', PADDLE_DEFAULT_OPTION['paddle_menu_text_to_uppercase']));
	//Header Banner
	$header_media_height                     = absint(get_theme_mod('header_media_height', PADDLE_DEFAULT_OPTION['header_media_height']));
	$paddle_banner_header_color              = sanitize_hex_color(get_theme_mod('paddle_banner_header_color', PADDLE_DEFAULT_OPTION['paddle_banner_header_color']));
	$paddle_banner_header_bgcolor            = sanitize_hex_color(get_theme_mod('paddle_banner_header_bg_color',  PADDLE_DEFAULT_OPTION['paddle_banner_header_bg_color']));
	$paddle_enable_banner_bgcolor            = absint(get_theme_mod('paddle_enable_banner_bgcolor',  PADDLE_DEFAULT_OPTION['paddle_enable_banner_bgcolor']));
	$paddle_enable_icon_bg                   = absint(get_theme_mod('enable_icon_bg', PADDLE_DEFAULT_OPTION['enable_icon_bg']));
	$banner_content_bg_opacity               = absint(get_theme_mod('banner_content_bg_opacity', PADDLE_DEFAULT_OPTION['banner_content_bg_opacity']));
	$paddle_banner_border_radius             = absint(get_theme_mod('paddle_banner_border_radius', PADDLE_DEFAULT_OPTION['paddle_banner_border_radius']));
	$paddle_title_headings_solid_lines_check = absint(get_theme_mod('paddle_title_headings_solid_lines', PADDLE_DEFAULT_OPTION['paddle_title_headings_solid_lines']));
	$paddle_remove_woo_single_sidebar_check  = absint(get_theme_mod('paddle_remove_woo_single_sidebar', PADDLE_DEFAULT_OPTION['paddle_remove_woo_single_sidebar']));
	$paddle_cta_position  					 = absint(get_theme_mod('paddle_header_cta_position', PADDLE_DEFAULT_OPTION['paddle_header_cta_position']));
	$paddle_cta_padding_left  				 = absint(get_theme_mod('header_cta_padding_left', PADDLE_DEFAULT_OPTION['header_cta_padding_left']));
	$menu_item_margin  					     = absint(get_theme_mod('menu_item_margin', PADDLE_DEFAULT_OPTION['menu_item_margin']));
	$paddle_menu_border_top					 = absint(get_theme_mod('menu_border_top', PADDLE_DEFAULT_OPTION['menu_border_top']));
	$banner_content_align                    = get_theme_mod('banner_content_align', PADDLE_DEFAULT_OPTION['banner_content_align']);
	$content_over_banner_position            = absint(get_theme_mod('content_over_banner_position', PADDLE_DEFAULT_OPTION['content_over_banner_position']));
	$site_title_font_size					 = absint(get_theme_mod('site_title_font_size', PADDLE_DEFAULT_OPTION['site_title_font_size']));
	$enable_image_before_site_title			 = absint(get_theme_mod('enable_image_before_site_title', PADDLE_DEFAULT_OPTION['enable_image_before_site_title']));
	$enable_same_height_image				 = absint(get_theme_mod('enable_same_height_image', PADDLE_DEFAULT_OPTION['enable_same_height_image']));
	$paddle_expand_grid_image				 = absint(get_theme_mod('paddle_expand_grid_image', PADDLE_DEFAULT_OPTION['paddle_expand_grid_image']));
	$banner_button_align                     = get_theme_mod('banner_button_align', PADDLE_DEFAULT_OPTION['banner_button_align']);
	$banner_button_transform                 = get_theme_mod('banner_button_transform', PADDLE_DEFAULT_OPTION['banner_button_transform']);
	$paddle_caption_width 					 = get_theme_mod('paddle_caption_width', PADDLE_DEFAULT_OPTION['paddle_caption_width']);
	$paddle_thumbnail_alignment				 = get_theme_mod('paddle_thumbnail_alignment', PADDLE_DEFAULT_OPTION['paddle_thumbnail_alignment']);
	$paddle_header_style                     = get_theme_mod('paddle_header_layout_style', PADDLE_DEFAULT_OPTION['paddle_header_layout_style'], 'logo-left-style-2');

	$css = '';

	// Colors 
	$css .= 'h1>a,h2>a,h3>a,h4>a { color: ' . $paddle_theme_color_headings . ' }';
	$css .= 'h1>a:hover,h2>a:hover,h3>a:hover,h4>a:hover { color: ' . $paddle_theme_color_headings_hover . ' }';
	$css .= 'a:focus-visible, button:focus-visible {outline: 2px solid  ' . $paddle_theme_color_accent !== $paddle_theme_color_buttons ? $paddle_theme_color_accent : esc_attr($paddle_theme_color_buttons) . '}';
	//*
	// Buttons
	ob_start(); ?>
	button:not(.btn),
	button:not(.btn-close),
	input[type='button']:not(.btn),
	input[type='reset']:not(.btn),
	input[type='submit']:not(.btn),
	.btn-primary {
	background-color: <?php echo $paddle_theme_color_accent !== $paddle_theme_color_buttons ? $paddle_theme_color_accent : esc_attr($paddle_theme_color_buttons); ?>
	}
	button:not(.btn):hover,
	button:not(.btn-close):hover,
	input[type='button']:not(.btn):hover,
	input[type='reset']:not(.btn):hover,
	input[type='submit']:not(.btn):hover,
	.btn-primary:hover {
	background-color: <?php echo esc_attr($paddle_theme_color_buttons_hover); ?>
	}
	button:not(.btn):active,
	button:not(.btn-close):active,
	input[type='button']:not(.btn):active,
	input[type='reset']:not(.btn):active,
	input[type='submit']:not(.btn):hover,
	.btn-primary:active {
	border-color: <?php echo esc_attr(paddle_rgba($paddle_theme_color_border, 6)); ?>
	}
	button:not(.btn):focus,
	button:not(.btn-close):focus,
	input[type='button']:not(.btn):focus,
	input[type='reset']:not(.btn):focus,
	input[type='submit']:not(.btn):focus,
	.btn-primary:focus {
	border-color: <?php echo esc_attr($paddle_theme_color_border); ?>
	}
	<?php // Inputs 
	?>

	input[type='search']:active,input[type='search']:focus, textarea:focus {
	border-color: <?php echo esc_attr(paddle_rgba($paddle_theme_color_buttons, 4)); ?>
	}


<?php


	$css .= ob_get_contents();
	ob_end_clean();
	//*/

	// Site header 3

	if ('logo-left-style-3' === $paddle_header_style) {
		$css .= '#header-style-3 .NavHeader__menu {
				flex-grow: 1;
			}';
		$css .= '#header-style-3 #main-header-navigation {
				display: flex; align-items: center; flex-grow: 1;
			}';
		$css .= '#header-style-3>div {
				height: 60px;
			}';
		$css .= '#header-style-3 #primary-menu {
				margin-bottom: 0; display: flex; list-style: none; align-items: center;
			}';
		$css .= '#header-style-3 .menu>.menu-item>a{
				text-decoration: none;
			}';
	}

	// HEADER
	$css .= '.site-header .site-title {font-size: ' . $site_title_font_size . 'px; margin: 0;}';


	// Logo
	$css .= '
		.custom-logo-link {
			align-self: ' . $paddle_header_logo_align . ';
		}
		@media screen and (min-width:992px) {
			.site-header .site-logo img {max-height: ' . $paddle_header_logo_size . 'px}
		  }
		  @media screen and (max-width:500px) {
			.site-header .site-logo img {max-height:60px}
		  }
		  
		  body .site-branding .site-logo {
			padding-top: ' . $paddle_header_logo_padding . 'px; 
			padding-bottom: ' . $paddle_header_logo_padding . 'px; 
		  }
		';

	// Social icon background color
	if (0 === $paddle_enable_icon_bg) {
		$css .= '
			#topbar ul.social-items li .bg-transform {
				background-color: transparent!important;
			}
			';
	}

	// CTA BUTTON

	$css .= '@media screen and (min-width:992px) {
			#header-btn-cta { padding-left: ' . $paddle_cta_padding_left . '%}
			}
		';
	$css .= '#header-btn-cta a {background: wheat; border: 2px solid; font-size: .875rem; padding: 0.375rem 0.75rem;}';
	$css .= '#header-btn-cta a:hover {background: white; color: black}';


	// WOOCORMMERCE
	if (0 === $paddle_remove_woo_single_sidebar_check) {
		$css .= 'body.single.single-product #primary.content-area {max-width:100%; flex: 0 0 100%; }';
	}

	// Menu item margin
	$css .= '#masthead ul li {margin-right: ' . $menu_item_margin . 'px}';


	// Modal search
	$css .= '#searchModal .search-form-container .close:focus {
			filter: unset;
		}
		#searchModal .search-form-container .close:focus + span { background-color: white; }
		#searchModal .search-form-container .close:focus {transform: rotate(25deg);}
		';

	// OFFCANVAS
	$css .= '
		[data-menu=offcanvas] .offcanvas-header button.btn-close.text-reset {border-color: ' . paddle_rgba($primary_color, 8) . ';}
		';

	// MENU ITEM
	$css .= '
		#main-header-navigation .menu>.menu-item>a { color: ' . $paddle_navlink_text_color_check . '; } 
		#main-header-navigation ul .sub-menu .menu-item>a { color: ' . $paddle_navlink_text_color_check . '; } 
		';

	// Blockquote

	$css .= 'blockquote {border-left: 4px solid ' . $primary_color . '; border-color: ' . $primary_color . ' }';


	//*

	// Colors
	$css .= '#main-header-navigation .menu-item span svg {
                fill: ' . $primary_color . ';
        }';

	$css .= 'article.sticky .thumbnail-container::after {
			box-shadow: -25px 20px 0 ' . $primary_color . ';
			background: ' . $primary_color . ';
		}';


	// Nav Menu background color.
	if ('#ffffff' !== $paddle_menu_bgcolor_check) {
		$css .= '#main-header-navigation, #main-header-navigation .sub-menu { background-color: ' . $paddle_menu_bgcolor_check . '; border-bottom: none; } ';
		$css .= '.header-style-2 #main-header-navigation {border-radius: 60px;}';
		$css .= '#main-header-navigation .submenu-expand svg {fill: ' . $paddle_navlink_text_color_check . '}';
	}
	// Headings H1 background.
	if ('#000000' !== $paddle_h1bg_color_check) {
		$css .= 'body.boxed-header header:not(.no-bgcolor)>h1 { background-color: ' . $paddle_h1bg_color_check . '; } ';
	}

	// Post thumbnail
	$css .= 'figure.thumbnail-post-single .thumbnail-container {text-align: ' . $paddle_thumbnail_alignment . ' ;}';

	// Home and Category page Card
	if (1 === $enable_image_before_site_title) {
		$css .= '.archive-grid article .post-thumbnail, .archive.category .thumbnail-container {
				order: -1;
				width: 100%;
				display: block;
			}';
		$css .= '.has-post-thumbnail h2.entry-title, .has-placeholder-image h2.entry-title {
				margin-top: 18px;
			}';
		$css .= ' .archive-grid.row h2.entry-title {margin-bottom: 24px;}';
	}


	if (1 === $enable_same_height_image) {
		$css .= '.category-grid-layout .thumbnail-container {
				display: block;
				clear: both;
				position: relative;
				margin: 0 auto 15px 0;
				min-height: 1px;
				width: 100%;
				height: 100%;
				padding-top: 0!important;
				padding-bottom: 66.4815%;
				overflow: hidden;
			}
			
			.category-grid-layout .thumbnail-container img {
				height: auto;
				max-width: 100%;
				width: 100%;
				max-width: unset!important;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				position: absolute;
				-o-object-fit: cover;
				object-fit: cover;
			}
			.home.blog .thumbnail-container, .archive.category .thumbnail-container {
				margin-right: 0; margin-left:0;
				position: relative;
				width: 100%;
			}
			';
	}

	if (1 === $paddle_expand_grid_image) {
		$css .= '.archive-grid.row article {padding: 0; padding-bottom: 50px;}
			.archive-grid.row .entry-content, .archive-grid.row h2.entry-title, .archive-grid.row article .entry-meta, .archive-grid.row article .entry-footer {padding: 0 22px;}
			.archive-grid.row article .thumbnail-container a.post-thumbnail, .archive-grid.row article .thumbnail-container .svg-holder {
				clear: both;
				position: relative;
				margin: 0 auto 0px 0;
				min-height: 1px;
				width: 100%;
				height: 100%;
				padding-top: 0!important;
				padding-bottom: 66.4815%!important;
				overflow: hidden;
			}
			.archive-grid.row article img.wp-post-image, .archive-grid.row article .thumbnail-container .svg-holder svg.fallback-svg {
				width: 100%;
				object-fit: cover;
				max-width: unset!important;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				position: absolute;
				-o-object-fit: cover;
				object-fit: cover;
			}
			.archive-grid.row article .entry-footer.grid-category-list {padding-right: 0; padding-left: 0; padding-bottom:22px; padding-top:5px }
			';
	}

	// Banner Height. @todo check if banner enable before adding CSS
	if (60 !== $header_media_height) {
		$css .= '.home-banner  { height : ' . $header_media_height . 'vh } ';
	}

	// Banner Overlay
	$css .= '
		.home-banner .home-banner-overlay {
			background: rgba(0, 0, 0, 0.' . absint(paddle_banner_opacity()) . ');
		}
		';
	// Grundge image.
	$css .= '.paddle-front-page-slider .slideshow-content:before {opacity: .' . absint(paddle_banner_opacity()) . ' ; }';


	// Banner Image
	if ('' !== paddle_get_header_image_url() && !empty(paddle_get_header_image_url())) {
		$css .= '#home-header-image .home-banner-image {
				background-image: url(' . esc_url(paddle_get_header_image_url()) . ')!important; 
				z-index: 1;
			}
			.home-banner .home-banner-overlay {z-index: 2;}
			';
	}



	// Banner Header Background Color.
	if (0 === $paddle_enable_banner_bgcolor) {
		$css .= '.home-banner .home-banner-content .board  { background: transparent!important } ';
	} else {
		$css .= '.home-banner .home-banner-content .board  { background: ' . $paddle_banner_header_bgcolor . ' } ';
	}

	// Set the background color opacity.
	if (10 !== $banner_content_bg_opacity) {
		$css .= '.home-banner .home-banner-content .board  { background: ' . paddle_rgba($paddle_banner_header_bgcolor, $banner_content_bg_opacity) . ' } ';
		$css .= '#paddle-slider .light-box-shadow  { background: ' . paddle_rgba($paddle_banner_header_bgcolor, $banner_content_bg_opacity) . ' } ';
	}

	// Banner button align
	$css .= '.home-banner .home-banner-content .board .home-banner-cta-button-container {justify-content: ' . $banner_button_align . '}';

	$css .= '.home-banner .home-banner-content .board .home-banner-cta-button-container>a {text-transform: ' . $banner_button_transform . '}';

	// Hide show arrow icon in button
	if (1 !== get_theme_mod('banner_arrow_button', PADDLE_DEFAULT_OPTION['banner_arrow_button'])) {
		$css .= '.home-banner-cta-button-container>a:before {display:none;}
			';
	}

	if (0 !== get_theme_mod('paddle_banner_box_shadow', PADDLE_DEFAULT_OPTION['paddle_banner_box_shadow'])) {
		$css .= '#paddle-slider .light-box-shadow, #hero .board  { box-shadow: 0 0 10px 1px ' . $paddle_banner_header_bgcolor . '; } ';
	}

	if (0 === get_theme_mod('paddle_banner_box_shadow', PADDLE_DEFAULT_OPTION['paddle_banner_box_shadow'])) {
		$css .= ' #paddle-slider .light-box-shadow, #hero .board  { box-shadow: none; } ';
	}



	// Banner Text Color
	//if ( '#ffffff' !== $paddle_banner_header_color ) {
	$css .= ' .home-banner .home-banner-content .board { color: ' . $paddle_banner_header_color . '; } ';
	$css .= ' .home-banner .home-banner-content .board p { color: ' . $paddle_banner_header_color . '; } ';

	//}


	// Set banner text content border radius;
	if (1 === $paddle_banner_border_radius) {
		$css .= '.home-banner .home-banner-content .board  { border-radius: 15px } ';
	}

	// Shift home .row up
	if (paddle_content_over_banner()) {
		$css .= '
			@media screen and (min-width: 992px) {
				.row.main-row {
					position: relative;
					margin-top: -' . $content_over_banner_position . 'px;
					background: #fff;
					z-index: 2;
					padding-top: 3.2rem;
					padding-left: 2rem;
					padding-right: 2rem;
				}
			  }
			';
	}

	if ('center' === get_theme_mod('paddle_h1_alignment', PADDLE_DEFAULT_OPTION['paddle_h1_alignment'])) {
		$css .= '.single article h1.entry-title, header.entry-header, .archive h1.page-title, .page-header .archive-description, 
			header .term-description, article .by-author,article .entry-meta, nav.woocommerce-breadcrumb {
				text-align: center;
			}
			header .term-description p, .page-header .archive-description p  {
				width:100%;
			}
			';
	}

	// Headings solid lines H1 and H2 . @todo Remove this feature.
	if (1 === $paddle_title_headings_solid_lines_check) {
		$css .= '
			.row.main-row h1:not(.noline-title):before, .row.main-row h2:not(.noline-title):before, .headline.heading-line:before {
				background: $color__primary;
				content: "\020";
				display: block;
				height: 3px;
				margin: 1rem 0;
				width: 1em;
			  }
			  .row.main-row h2:not(.noline-title):before {
				width: 0.67em;
			  }
			  .entry-content h1:before, .entry-content h2:before, .woo-page h1:before, .woo-page h2:before {
				content: unset;
			  }
			';
	} // End Function.

	// The CSS below should be in main CSS style file. @Todo move to main file. This shows in CATEGORY/Achive and Home Page.
	$css .= '@media screen and (min-width: 768px) {
				article .entry-footer span.cat-links + span.tags-links {
					margin-left: 50px;
				}
			}
			.thumbnail-post-single figcaption {width: ' . $paddle_caption_width . '; margin: 0.8075em 0;}

			 @media (min-width: 992px) {
				.category-classic a.post-thumbnail, .home.blog a.post-thumbnail {
					width: 100%!important;
				}
			 }
			
			';
	//*/
	// Retrun all css

	return paddle_minimize_css($css);
}
