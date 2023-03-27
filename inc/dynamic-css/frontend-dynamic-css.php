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
	$primary_color                     = sanitize_hex_color(get_theme_mod('paddle_primary_color', PADDLE_PRIMARY_COLOR));
	$paddle_theme_color_accent         = '' === paddle_theme_get_color('paddle_primary_color') ? paddle_theme_get_color('paddle_theme_color_buttons') : paddle_theme_get_color('paddle_primary_color');
	$paddle_theme_color_headings       = paddle_theme_get_color('paddle_theme_color_headings');
	$paddle_theme_color_body_text      = paddle_theme_get_color('paddle_theme_color_body_text');
	$paddle_theme_color_headings_hover = paddle_theme_get_color('paddle_theme_color_headings_hover');
	$paddle_theme_color_buttons        = paddle_theme_get_color('paddle_theme_color_buttons');
	$paddle_theme_color_buttons_hover  = paddle_theme_get_color('paddle_theme_color_buttons_hover');
	$paddle_theme_color_links          = paddle_theme_get_color('paddle_theme_color_links');
	$paddle_theme_color_links_hover    = paddle_theme_get_color('paddle_theme_color_links_hover');
	$paddle_theme_color_border         = paddle_theme_get_color('paddle_theme_color_border');

	$paddle_navlink_text_color_hover = paddle_theme_get_color('paddle_navlink_text_color_hover');

	$paddle_navlink_text_color_check = sanitize_hex_color(get_theme_mod('paddle_navlink_text_color', PADDLE_DEFAULT_OPTION['paddle_navlink_text_color']));
	$paddle_remove_woo_single_sidebar_check  = absint(get_theme_mod('paddle_remove_woo_single_sidebar', PADDLE_DEFAULT_OPTION['paddle_remove_woo_single_sidebar']));


	// Time / Date
	$hide_time_post_updated     = absint(get_theme_mod('paddle_enable_blog_updated_date', PADDLE_DEFAULT_OPTION['paddle_enable_blog_updated_date']));
	$hide_time_post_published   = absint(get_theme_mod('paddle_enable_blog_published_date', PADDLE_DEFAULT_OPTION['paddle_enable_blog_published_date']));
	$published_placeholder_text = get_theme_mod('placeholder_text_posted_on', PADDLE_DEFAULT_OPTION['placeholder_text_posted_on']);
	$updated_placeholder_text   = get_theme_mod('placeholder_text_updated_on', PADDLE_DEFAULT_OPTION['placeholder_text_updated_on']);

	$paddle_header_content_max_width   = absint( get_theme_mod( 'header_custom_container_width', PADDLE_DEFAULT_OPTION['header_custom_container_width'] ) );

	// Transparent Header
	$paddle_header_transparent_home_only   = absint(get_theme_mod('paddle_header_transparent_home_only', PADDLE_DEFAULT_OPTION['paddle_header_transparent_home_only']));
	$paddle_header_transparent_global   = absint(get_theme_mod('paddle_header_transparent_global', PADDLE_DEFAULT_OPTION['paddle_header_transparent_global']));
	$paddle_header_transparent_arc   = absint(get_theme_mod('paddle_header_transparent_arc', PADDLE_DEFAULT_OPTION['paddle_header_transparent_arc']));
	$paddle_header_transparent_post   = absint(get_theme_mod('paddle_header_transparent_post', PADDLE_DEFAULT_OPTION['paddle_header_transparent_post']));
	$paddle_header_transparent_page   = absint(get_theme_mod('paddle_header_transparent_page', PADDLE_DEFAULT_OPTION['paddle_header_transparent_page']));
	$paddle_header_transparent_visible   = get_theme_mod('paddle_header_transparent_visible', PADDLE_DEFAULT_OPTION['paddle_header_transparent_visible']);

	$transparent_header_css = '';
	$open_site_header_css_tag = '.site-header {';
	$close_site_header_css_tag = '}';

	// Global Transparent Header.
	if (1 ===  $paddle_header_transparent_global ) {
		//Open tag
		$transparent_header_css .= $open_site_header_css_tag;
		$transparent_header_css .= '
		position: absolute;
		left: 0;
		right: 0;
		';
		// Close Tag
		$transparent_header_css .= $close_site_header_css_tag;
	}
	
	$css = '';
	$css .= $transparent_header_css; 

	if (paddle_content_witdth_is_full_width($paddle_header_content_max_width)) {
		$css .='
		@media (min-width:992px) {
			.paddle-full-width-page {
				padding-left: 35px;
				padding-right: 35px;
			}
			#main-header-navigation>.container {
				max-width: unset;
			}
		}
		';
	}

	$css .=
	'
	#content.site-content {
		background-color: var(--paddle-color-body-bg);
	}
	#primary.content-area, aside#secondary {
		padding-top: 2em;
	}
	@media (min-width:992px) {
		#primary.content-area, aside#secondary {
			padding-top: 3em;
		}
	}
	#secondary li {
		margin-bottom: 0.75em;
	}
	';



	if (0 === $hide_time_post_updated) {
		$css .= 'body.single-post.hide-time-upd time.updated {display: none} 
		.single article .entry-meta time:not(:last-child):after{content: none!important}';
	}
	if (0 === $hide_time_post_published) {
		$css .= 'body.single-post.hide-time-pub time.published {display: none}';
	}

	if (0 === $hide_time_post_updated && 0 === $hide_time_post_published) {
		$css .= 'body.single-post .entry-meta .posted-on {display: none}';
	}


	// Check for when post have never been updated
	if (1 === $hide_time_post_updated && 0 === $hide_time_post_published) {
		$css .= 'body.single-post .post-not-modified time.published {display: inline-block!important}';
	}

	// published.updated
	if (0 === $hide_time_post_updated && 1 === $hide_time_post_published) {
		$css .= 'body.single-post .post-not-modified time.published.updated {display: inline-block!important}';
	}

	//$css .= 'time.entry-date.published::before { content: "' . $published_placeholder_text . '"}';
	//$css .= 'time.updated::before { content: "' . $updated_placeholder_text . '"}';

	$css .= '.container.paddle-body-container { max-width: var(--paddle-page-width)}';


	// Colors
	$css .= 'h1>a,h2>a,h3>a,h4>a { color: ' . $paddle_theme_color_headings . ' }';
	$css .= 'h1>a:hover,h2>a:hover,h3>a:hover,h4>a:hover { color: ' . $paddle_theme_color_headings_hover . ' }';
	//$css .= 'a:focus-visible, button:focus-visible {outline: 2px solid  ' . $paddle_theme_color_accent !== $paddle_theme_color_buttons ? $paddle_theme_color_accent : esc_attr( $paddle_theme_color_buttons ) . '}';

	$btn_bg_color_1 = esc_attr($paddle_theme_color_accent) !== esc_attr($paddle_theme_color_buttons) ? esc_attr($paddle_theme_color_accent) : esc_attr($paddle_theme_color_buttons);
	$css .= '
	button:not(.btn),
	button:not(.btn-close),
	input[type="button"]:not(.btn),
	input[type="reset"]:not(.btn),
	input[type="submit"]:not(.btn),
	.btn-primary {
	background-color: '.$btn_bg_color_1.';
	}

	button:not(.btn):active,
	button:not(.btn-close):active,
	input[type="button"]:not(.btn):active,
	input[type="reset"]:not(.btn):active,
	input[type="submit"]:not(.btn):hover,
	.btn-primary:active {
	border-color: '.paddle_rgba($paddle_theme_color_border, 6).'; 
	}

	input[type="search"]:active,input[type="search"]:focus, textarea:focus {
		border-color: '.paddle_rgba($paddle_theme_color_buttons, 4).'; 
	}
	
	';

	// Site header
	$css .= '.custom-logo-link {display: inline-block;}';


	// CTA BUTTON


	// WOOCORMMERCE
	if (0 === $paddle_remove_woo_single_sidebar_check) {
		$css .= 'body.single.single-product #primary.content-area {max-width:100%; flex: 0 0 100%; }';
	}

	// Modal search
	$css .= '#searchModal .search-form-container .close:focus {
			filter: unset;
		}
		#searchModal .search-form-container .close:focus + span { background-color: white; }
		#searchModal .search-form-container .close:focus {transform: rotate(25deg);}
		';

	// OFFCANVAS
	$css .= '
	[data-menu=offcanvas]  {z-index:-1}
	.overflow-hidden [data-menu=offcanvas] {z-index:1}
	
		[data-menu=offcanvas] .offcanvas-header button.btn-close.text-reset {border-color: ' . paddle_rgba($primary_color, 4) . ';}
		';


	// Blockquote

	$css .= 'blockquote {border-left: 4px solid ' . $primary_color . '; border-color: ' . $primary_color . ' }';

	//*
	$css .= paddle_home_page_banner_css();
	$css .= paddle_header_css_for_search_input();
	$css .= paddle_header_css_for_toggler();
	$css .= paddle_header_css_for_cta();
	$css .= paddle_archive_css();
	$css .= paddle_aside_search();
	$css .= paddle_aside_widget_block();
	$css .= paddle_singular_post_css();
	$css .= paddle_blog_style_1();
	$css .= paddle_fig_caption_css();
	$css .= paddle_singular_header_css();
	$css .=paddle_sticky_post_css();
	$css .= paddle_header_css_for_woocommerce();
	//*/

	// Topbar
	if (1 === absint(get_theme_mod('enable_top_bar', PADDLE_DEFAULT_OPTION['enable_top_bar']))) {
		$css .= paddle_top_bar_css();
	}


	// Footer
	$css .= paddle_footer_css();
	$css .= paddle_footer_social_icons();
	// Retrun all css

	return paddle_minimize_css($css);
}

function paddle_header_css_for_woocommerce()
{
	$paddle_header_search_button_type        = get_theme_mod('paddle_header_search_button_type', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type']);
	$paddle_header_search_button_type_mobile = get_theme_mod('paddle_header_search_button_type_mobile', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type_mobile']);
	$paddle_theme_color_search_icon          = paddle_theme_get_color('paddle_header_search_icon_color');
	$paddle_theme_color_buttons              = paddle_theme_get_color('paddle_theme_color_buttons');

	if ('input' === $paddle_header_search_button_type_mobile) {
		$icon_color_mobile = $paddle_theme_color_search_icon === $paddle_theme_color_buttons ? '#FFFFFF' : $paddle_theme_color_search_icon;
	}
	if ('input' === $paddle_header_search_button_type) {
		$icon_color_desktop = $paddle_theme_color_search_icon === $paddle_theme_color_buttons ? '#FFFFFF' : $paddle_theme_color_search_icon;
	}

	$css = '';
	// WooCommerce
	if (class_exists('WooCommerce')) :
		$css         .= '.site-header .woo-header-utilities>ul{margin: 0}
			.site-header .woo-header-utilities>ul.site-header-login { display:none}
			.site-header .woo-header-utilities>ul>li  {margin: 0 ; min-width: 44px;}
			@media screen and (min-width:992px) {  .site-header .woo-header-utilities>ul>li  {margin: 0 22px;} 
			.site-header .woo-header-utilities>ul.site-header-login { display:block}
		  }
			.site-header .woo-header-utilities>ul a.nav-link, .site-header .woo-header-utilities>ul>li span {width: 32px;height: 32px;display: block;position: relative;}
			.site-header .woo-header-utilities span.woo-my-item {width: 22px; height: 22px; left: 22px; z-index: 2}
			.site-header .woo-header-utilities span.woo-my-account {
			  display: none;
		  }';
		$account_icon = "data:image/svg+xml,%3Csvg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-person' fill='" . paddle_svg_color() . "' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' d='M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z'%3E%3C/path%3E%3C/svg%3E";

		$user_icon = "data:image/svg+xml,%3Csvg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-cart' fill='" . paddle_svg_color() . "' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill-rule='evenodd' d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z'%3E%3C/path%3E%3C/svg%3E";

		$css .= '.site-header .woo-header-utilities .woo-icon-user::before {
			content: "";
			width: 32px;
			height: 32px;
			background-image: url("' . $account_icon . '");
		}
		.woo-cart-icon::before {
		  width: 32px;
		  height: 32px;
		  background-image: url("' . $user_icon . '");
		}
		';
	endif;

	return $css;
}

function paddle_header_css_for_search_input()
{
	$site_has_search                         = absint(get_theme_mod('paddle_header_search_button', PADDLE_DEFAULT_OPTION['paddle_header_search_button']));
	$paddle_header_search_button_type        = get_theme_mod('paddle_header_search_button_type', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type']);
	$paddle_header_search_button_type_mobile = get_theme_mod('paddle_header_search_button_type_mobile', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type_mobile']);
	$paddle_theme_color_search_icon          = paddle_theme_get_color('paddle_header_search_icon_color');
	$paddle_theme_color_buttons          = paddle_theme_get_color('paddle_theme_color_buttons');
	$icon_color_mobile                   = $paddle_theme_color_search_icon;
	$icon_color_desktop                  = $paddle_theme_color_search_icon;

	if ('input' === $paddle_header_search_button_type_mobile) {
		$icon_color_mobile = $paddle_theme_color_search_icon === $paddle_theme_color_buttons ? '#FFFFFF' : $paddle_theme_color_search_icon;
	}
	if ('input' === $paddle_header_search_button_type) {
		$icon_color_desktop = $paddle_theme_color_search_icon === $paddle_theme_color_buttons ? '#FFFFFF' : $paddle_theme_color_search_icon;
	}
	$css = '';
	// Search Icon
	if ($site_has_search) :

		$css .= '.toggler, div#search-glass {
					display: -webkit-box;
					display: -ms-flexbox;
					display: flex;
					-webkit-box-align: center;
					-ms-flex-align: center;
					align-items: center;
				}
				div#search-glass>button {position: relative;}
				 .site-header .button-search {
					display: block;
					width: 40px;
					height: 40px;
					padding: 0;
					position: relative;
					background: unset;
					border: unset;
					cursor: pointer;
				}
				.site-header .button-search:focus {
				  border: 1px solid var(--paddle-color-4);
				}
				.site-header .button-search:hover { background: unset;}
				';
	endif;

	// Seach Modal
	if ($site_has_search) :
		$css .= '
				body.logged-in #searchModal {
				margin-top: 40px; }
	
				#searchModal {
				  padding-right: 0 !important;
				  padding-left: 0; 
				  position: fixed;
				  top: 0;
				  left: 0;
				  z-index: 1060;
				  display: none;
				  width: 100%;
				  height: 100%;
				  overflow-x: hidden;
				  overflow-y: auto;
				  outline: 0;
				  background-color: rgba(0,0,0,.4);
				}
				#searchModal.active {display: block;}
				.modal.fade .modal-dialog {
				  transition: transform .3s ease-out;
				  transform: translate(0,-50px);
				}
				.modal.active .modal-dialog {
				  transform: none;
				}
				#searchModal .modal-title {
					display: none; }
				#searchModal .modal-body {
					padding: 0; }
				#searchModal .modal-content {
					background: #ffffff;
					border-radius: 0; }
				#searchModal .modal-header {
					padding: 0;
					color: #ccc;
					border: unset; }
				.full-width-search-container.icon-with-input {
					  /*border: 1px solid var(--paddle-color-4);*/
					  height: fit-content;
					  width: 100%;
					  padding: 15px 0;
				  }
				.full-width-search-container .search-form-container {
					position: relative; }
					.full-width-search-container .search-form-container form {
					position: relative;
					-webkit-transition: all 0.3s ease;
					transition: all 0.3s ease;
					border: none; }
					.full-width-search-container .search-form-container form svg {
						fill: #757575; }
						button.searchsubmit { position: relative;}
						.full-width-search-container button.searchsubmit {
						background-size: 22px;
						background-repeat: no-repeat;
						background-position: center;
						opacity: .6;
						margin-left: 0;
						border-radius: 0;
						min-width: 50px;
						height: 4.4rem;
						width: 4.4rem;
						background-color: transparent;
						cursor: pointer;
					}
					.full-width-search-container button.searchsubmit:active, .full-width-search-container button.searchsubmit:focus {
					  border-color: var(--paddle-color-1);
					  opacity: 1;
					}
					.full-width-search-container.icon-with-input button.searchsubmit {
					  background-color: var(--paddle-color-1);
					  opacity: 1;
					  max-width: 2.2rem;
					}
				  
					.full-width-search-container.icon-with-input form>div  {
					  filter: drop-shadow(0px 4px 8px rgba(8, 35, 48, 0.14));
					  background: white;
				  }
					.full-width-search-container.icon-with-input button.searchsubmit,
					.full-width-search-container.icon-with-input .search-form-container input {
					  height: 2.8rem;
					}
					.full-width-search-container.icon-with-input .search-form-container input {
					  padding-left: 15px;
					}
					button.searchsubmit::before, .btn.button-search::before {
						content: "";
						width: 4px;
						position: absolute;
						height: 10px;
						transform: rotate(131deg);
						background-color: black;
						left: calc(50% + 4px);
						top: 50%;
					}
					button.searchsubmit::after, .btn.button-search::after {
						content: "";
						width: 17px;
						height: 17px;
						border: 3px solid black;
						position: absolute;
						border-radius: 50%;
						transform: translate(-50%, 0);
						left: calc(50% - 3px);
						top: calc(50% - 3px);
						transform: translate(-50%,-50%);
					}
					.site-header button.searchsubmit::after,.btn.button-search::after {
					  border-color: var(--paddle-color-1);
					}
					.site-header button.searchsubmit::before, .btn.button-search::before {
					  background-color: var(--paddle-color-1);
					}
					button.searchsubmit::before, .btn.button-search::before {
					  width:2px;
					}
					button.searchsubmit::after, .btn.button-search::after {
					  border-width: 2px;
					}
					.btn-close {
						box-sizing: content-box;
						width: 1em;
						height: 1em;
						padding: .25em .25em;
						color: #000;
						border: 0;
						border-radius: .25rem;
						opacity: .5;
					}
					button.btn.close::before,button.btn-close::after {
						position: absolute;
						width: 40px;
						height: 40px;
						left: 0;
						top: 0;
					} 
					button.btn.close::before {
						content: "";
						padding: 14px;
					}
					button.btn-close::after {
						font-family: sans-serif;
						display: inline-block;
						content: "\00d7";
						font-size: 32px;
						color: var(--paddle-color-2);
					}
					button.btn-close:focus-visible {
						outline: 2px solid var(--paddle-color-2);
					}
					.full-width-search-container .search-form-container input {
					background-color: transparent;
					border-radius: 0;
					color: inherit;
					letter-spacing: -0.0277em;
					height: 4.4rem;
					margin: 0;
					width: 100%;
					padding: 0 0 0 2rem;
					-webkit-transition: all 0.3s ease;
					transition: all 0.3s ease;
					-webkit-box-shadow: none;
							box-shadow: none;
					border: 1px solid transparent;
					font-size: 1rem;
					color: #707070; }
					.full-width-search-container .search-form-container .close {
					cursor: pointer;
					position: absolute;
					bottom: -60px;
					width: 40px;
					height: 40px;
					padding: 0;
					text-shadow: unset;
					opacity: unset;
					font-size: 20px;
					right: 7px;
					z-index: 2;
					border-radius: 50%;
					-webkit-transition: .2s;
					transition: .2s; }
					.full-width-search-container .search-form-container .close:hover {
						-webkit-transform: rotate(25deg);
								transform: rotate(25deg); }
					.full-width-search-container .search-form-container .close:hover + span {
						opacity: .5; }
					.full-width-search-container .search-form-container .bg-close-cirle {
					position: absolute;
					border-radius: 50%;
					padding: 0;
					width: 40px;
					height: 40px;
					right: 7px;
					bottom: -60px;
					background-color: white;
					z-index: 1; }
	
				#searchModal .modal-dialog {
				max-width: unset;
				min-height: 160px;
				margin: 0;
				background: rgba(215, 215, 215, 0.4);
				padding: 10px; }
	
				input[type="search"]:focus {
				outline: thin dotted;
				outline-offset: -4px; }
	
				.full-width-search-container .search-form-container input:active, .full-width-search-container .search-form-container input:focus {
				border: 1px solid var(--paddle-color-1);
				color: #acacac; }';
		if ('input' === $paddle_header_search_button_type) {
			$css .= '.site-header button.searchsubmit::after,.btn.button-search::after {
					border-color: ' . $icon_color_desktop . ';
				  }
				  .site-header button.searchsubmit::before, .btn.button-search::before {
					background-color:' . $icon_color_desktop . ';
				  }';
		}
		// Media Query.
		$css     .= '@media screen and (max-width:992px) {';
		$css .= ' 
					.site-header button.searchsubmit::after,.btn.button-search::after {
					  border-color: ' . $icon_color_mobile . ';
					}
					.site-header button.searchsubmit::before, .btn.button-search::before {
					  background-color:' . $icon_color_mobile . ';
					}
					';
		$css   .= '}'; // End media query.
	endif;

	return $css;
}

function paddle_header_css_for_toggler()
{
	$css  = '';
	$css .= '
	@media (min-width: 992px) {
		.site-header .toggler {
		  display: none; }
		.navbar-offcanvas {
		  display: none !important; }
		.site-branding .brand-wrap {
		  -webkit-box-align: center;
			  -ms-flex-align: center;
				  align-items: center; } }
	  
	  .toggler button.navbar-toggler {
		position: relative;
		padding: 0.7em 1em;
		border: none;
		border-radius: 0;
		min-height: 30px;
		z-index: 2;
		background: unset; }
		.toggler button.navbar-toggler:focus, .toggler button.navbar-toggler:active {
		  border: none !important;
		  outline: 0;
		  -webkit-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
				  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); }
		.toggler button.navbar-toggler span {
		  display: block;
		  background: var(--paddle-color-1);
		  height: 2px;
		  width: 25px;
		  margin-top: 4px;
		  margin-bottom: 4px;
		  -webkit-transform: rotate(0deg);
				  transform: rotate(0deg);
		  position: relative;
		  right: 0;
		  opacity: 1; }
		  .toggler button.navbar-toggler span:nth-child(1), .toggler button.navbar-toggler span:nth-child(3) {
			-webkit-transition: -webkit-transform 0.35s ease-in-out;
			transition: -webkit-transform 0.35s ease-in-out;
			transition: transform 0.35s ease-in-out;
			transition: transform 0.35s ease-in-out, -webkit-transform 0.35s ease-in-out; }
		.toggler button.navbar-toggler.is-open span:nth-child(1) {
		  position: absolute;
		  right: 12px;
		  top: 10px;
		  -webkit-transform: rotate(-135deg);
				  transform: rotate(-135deg);
		  opacity: 0.9; }
		.toggler button.navbar-toggler.is-open span:nth-child(2) {
		  height: 3px;
		  visibility: hidden;
		  background-color: transparent; }
		.toggler button.navbar-toggler.is-open span:nth-child(3) {
		  position: absolute;
		  right: 12px;
		  top: 10px;
		  -webkit-transform: rotate(135deg);
				  transform: rotate(135deg);
		  opacity: 0.9; }
	';

	$css .= '@media (min-width: 992px) {.site-header .toggler {
		display: none;
	}}';

	return $css;
}

function paddle_header_css_for_navigation()
{
	$menu_wrap              = get_theme_mod('paddle_menu_spacing', PADDLE_DEFAULT_OPTION['paddle_menu_spacing']); // paddle_menu_spacing
	$menu_padding           = absint(get_theme_mod('header_menu_padding', PADDLE_DEFAULT_OPTION['header_menu_padding']));
	$menu_item_margin_right = absint(get_theme_mod('menu_item_margin', PADDLE_DEFAULT_OPTION['menu_item_margin'])); // menu_item_margin
	$paddle_menu_align      = get_theme_mod('paddle_menu_items_alignment', PADDLE_DEFAULT_OPTION['paddle_menu_items_alignment']);
	$menu_align             = 'justify' === $paddle_menu_align ? 'space-between' : $paddle_menu_align;

	$css  = '';
	$css .= '
	#main-header-navigation {
		display: none; }
		#main-header-navigation a {
		  text-decoration: none; }
	  
	  @media (min-width: 992px) {
		#main-header-navigation {
		  display: block; } }';

	$css .= '#main-header-navigation {
		width: auto;
		line-height: 0;
		 }
		#main-header-navigation div#primary-menu,
		#main-header-navigation .container {
		  text-align: center; }
		  #main-header-navigation div#primary-menu ul:first-child,
		  #main-header-navigation .container ul:first-child {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
				-ms-flex-align: center;
					align-items: center;
			-webkit-box-pack: center;
				-ms-flex-pack: center;
					justify-content: center;
			min-height: 50px; }
			/*#main-header-navigation div#primary-menu ul:first-child > li,*/
			#main-header-navigation .container ul:first-child > li {
			  margin-right: ' . $menu_item_margin_right . 'px; }
			  #main-header-navigation div#primary-menu ul:first-child > li:last-child,
			  #main-header-navigation .container ul:first-child > li:last-child {
				margin-right: 0; }
		#main-header-navigation div#primary-menu {
		  padding-right: 2rem;
		  padding-left: 2rem; }
		#main-header-navigation ul#primary-menu {
		  display: -webkit-box;
		  display: -ms-flexbox;
		  display: flex; 
		  justify-content: space-between;
		  justify-content: ' . $menu_align . ';
		  align-items: center;
		  -ms-flex-wrap: ' . $menu_wrap . ';
		  flex-wrap: ' . $menu_wrap . ';
		  padding-top:' . $menu_padding . 'px;
		  padding-bottom: ' . $menu_padding . 'px;
		}
		#main-header-navigation ul {
		  display: inline-block;
		  clear: both;
		  line-height: 1;
		  margin: 0;
		  width: 100%;
		  padding: 0; 
		  
		}
		  #main-header-navigation ul ul.sub-menu ul,
		  #main-header-navigation ul ul.children ul {
			margin-left: 0; }
		  #main-header-navigation ul li.menu-item-has-children.focus > ul,
		  #main-header-navigation ul li.page_item_has_children.focus > ul {
			left: auto;
			opacity: 1;
			-webkit-transition: opacity 0.15s linear, -webkit-transform 0.15s linear;
			transition: opacity 0.15s linear, -webkit-transform 0.15s linear;
			transition: opacity 0.15s linear, transform 0.15s linear;
			transition: opacity 0.15s linear, transform 0.15s linear, -webkit-transform 0.15s linear; }
		  #main-header-navigation ul li.menu-item-has-children li.focus > ul,
		  #main-header-navigation ul li.page_item_has_children li.focus > ul {
			left: -100%; }
		  #main-header-navigation ul li,
		  #main-header-navigation ul li {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			margin-right: 16px; }
			#main-header-navigation ul li:hover ul li > ul,
			#main-header-navigation ul li:hover ul li > ul {
			  -webkit-animation: move-right 400ms ease both;
					  animation: move-right 400ms ease both; }
			#main-header-navigation ul li ul li > ul,
			#main-header-navigation ul li ul li > ul {
			  -webkit-transition-delay: .15s;
					  transition-delay: .15s; }
		  #main-header-navigation ul > li > a {
			padding: 0.9em 0.5em;
			line-height: 22px;
			text-decoration: none; }

		  #main-header-navigation ul > li:hover > a,
		  #main-header-navigation ul > li:hover > a:hover
		  { 
			color: var(--paddle-header-menu-hover)  
			}
			#main-header-navigation ul > li:hover > .submenu-expand
			{ 
				transform: rotate(180deg);
			  }

		  #main-header-navigation ul > li.current-menu-item > a,
		  #main-header-navigation ul > li.current-menu-ancestor > a 
		  { color: var(--paddle-header-menu-active); }


		  #main-header-navigation ul li:hover ul.sub-menu,
		  #main-header-navigation ul li:hover ul.children {
			-webkit-animation: move-right 400ms ease both;
					animation: move-right 400ms ease both; }
		#main-header-navigation li {
		  float: left;
		  list-style: none;
		  position: relative; }
		  #main-header-navigation li li.menu-item-has-children ul.sub-menu,
		  #main-header-navigation li li.page_item_has_children ul.children {
			margin-left: 0px;
			/*left: auto;*/
			top: 0; }
		  #main-header-navigation li .menu-item-has-children > a,
		  #main-header-navigation li .page_item_has_children > a {
			padding-right: 26px; }
		  #main-header-navigation li ul li span.submenu-expand {
			-webkit-transform: rotate(-90deg) !important;
					transform: rotate(-90deg) !important; }
		  #main-header-navigation li:hover ul li span.submenu-expand {
			-webkit-transform: none;
					transform: none; }
		  #main-header-navigation li:hover > a {
			color:var(--paddle-header-menu-hover); 
		}
		  #main-header-navigation li:hover > .sub-menu,
		  #main-header-navigation li:hover > .children {
			left: auto;
			opacity: 1;
			padding: 0; }
		#main-header-navigation ul .sub-menu .menu-item>a {width: 100%}
		  #main-header-navigation li.menu-item-has-children > a,
		  #main-header-navigation li.menu_item_has_children > a {
			padding-right: 26px; }
		  #main-header-navigation li a:not(.btn) {
			border: none;
			color: var(--paddle-header-menu-color);
			display: block;
			font-size: 1rem;
			font-weight: 500;
			line-height: 18px;
			position: relative;
			text-decoration: none;
			text-align: left; 
			text-transform: var(--paddle-header-menu-case);
		}
		  #main-header-navigation li:hover span.submenu-expand {
			-webkit-transform: rotate(180deg);
					transform: rotate(180deg); }
		  #main-header-navigation li.menu-item-has-children:hover ul,
		  #main-header-navigation li.page_item_has_children:hover ul {
			-webkit-animation: move-right 400ms ease both;
					animation: move-right 400ms ease both; }
			#main-header-navigation li.menu-item-has-children li:hover button + ul.sub-menu,
			#main-header-navigation li.page_item_has_children li:hover > button + ul.sub-menu {
			  left: -100%; }
		#main-header-navigation .sub-menu,
		#main-header-navigation .children {
		  left: -9999px;
		  opacity: 0;
		  padding: 7px;
		  position: absolute;
		  width: 180px;
		  z-index: 99;
		  margin: 0;
		  background-color: var(--paddle-header-menu-bg-color);
		  min-width: 15rem;
		  -webkit-transition: all 0.5s ease;
		  transition: all 0.5s ease;
		  top: calc(100% - 1px); }
		  #main-header-navigation li.menu-item-has-children li button + ul.sub-menu { left: -150%;}
		  #main-header-navigation .sub-menu li,
		  #main-header-navigation .children li {
			float: none;
			margin-right: 0;
			margin-left: 0; }
			#main-header-navigation .sub-menu li a,
			#main-header-navigation .children li a {
			  padding-right: .9rem;
			  padding-left: .9rem; }
		#main-header-navigation .submenu-expand {
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
		  #main-header-navigation .submenu-expand svg {
			width: 10px;
			height: 10px; 
			fill: var(--paddle-header-menu-color);
			-webkit-transition: .2s ease-out;
    		transition: .2s ease-out;
		}
		#main-header-navigation.active .menu-item.menu-item-has-children,
		#main-header-navigation.active .page_item.menu_item_has_children {
		  position: relative; }
		#main-header-navigation.active .menu > li + li {
		  border-top: 1px solid #eee; }
		#main-header-navigation.active .submenu-expand {
		  position: absolute;
		  right: 0;
		  top: 0;
		  width: 32px;
		  height: 56px;
		  text-align: center;
		  line-height: 0;
		  cursor: pointer;
		  outline: none; }
		  #main-header-navigation.active .submenu-expand.expanded {
			-webkit-transform: rotate(180deg);
					transform: rotate(180deg); }
			#main-header-navigation.active .submenu-expand.expanded + .sub-menu,
			#main-header-navigation.active .submenu-expand.expanded + .children {
			  display: block; }
		  #main-header-navigation.active .submenu-expand:hover svg,
		  #main-header-navigation.active .submenu-expand.expanded svg {
			fill: transparent; }
		#main-header-navigation ul ul .menu-item-has-children > .submenu-expand > svg,
		#main-header-navigation ul ul .page_item_has_children > .submenu-expand > svg {
		  margin-top: -7px;
		  left: auto;
		  position: absolute;
		  right: 9px;
		  top: 50%;
		  margin-top: unset;
		  -webkit-transform: rotate(-270deg);
				  transform: rotate(-270deg); }
		#main-header-navigation button.toggle.submenu-expand {
		  background-color: transparent !important; }';

	return $css;
}

function paddle_header_css_for_cta()
{
	$paddle_cta_enable       = absint(get_theme_mod('paddle_header_cta', PADDLE_DEFAULT_OPTION['paddle_header_cta']));
	$paddle_cta_padding_left = absint(get_theme_mod('header_cta_padding_left', PADDLE_DEFAULT_OPTION['header_cta_padding_left']));
	$menu_cta_bgcolor          = paddle_theme_get_color('menu_cta_bgcolor');
	$menu_cta_link_color          = paddle_theme_get_color('menu_cta_link_color');
	$menu_cta_link_hover_color          = paddle_theme_get_color('menu_cta_link_hover_color');
	$menu_cta_link_border_color          = paddle_theme_get_color('menu_cta_link_border_color');
	$menu_cta_bgcolor_opacity          = absint(get_theme_mod('menu_cta_bg_opacity', PADDLE_DEFAULT_OPTION['menu_cta_bg_opacity']));
	$menu_cta_padding = explode(',',get_theme_mod('menu_cta_padding', PADDLE_DEFAULT_OPTION['menu_cta_padding'])); 
	$btn_padding_top = !empty($menu_cta_padding[0]) ? $menu_cta_padding[0] : '0';
	$btn_padding_right = !empty($menu_cta_padding[1]) ? $menu_cta_padding[1] : '0';
	$btn_padding_bottom = !empty($menu_cta_padding[2]) ? $menu_cta_padding[2] : '0';
	$btn_padding_left = !empty($menu_cta_padding[3]) ? $menu_cta_padding[3] : '0';

	$css                     = '';
	if ($paddle_cta_enable) {
		$css .= '#masthead #header-btn-cta a.cta-button-link {
			padding-top: '.$btn_padding_top.'px;
			padding-bottom: '.$btn_padding_bottom.'px;
			padding-right: '.$btn_padding_right.'px;
			padding-left: '.$btn_padding_left.'px;
			color: '.$menu_cta_link_color.';
			border-color: '.$menu_cta_link_border_color.'; 
		}';
		if ( 10 !== $menu_cta_bgcolor_opacity && '' !== $menu_cta_bgcolor ) {
            $css .= '#header-btn-cta a  { 
                background-color: ' . paddle_rgba( $menu_cta_bgcolor, $menu_cta_bgcolor_opacity ) . ';
            }';
        }
		$css.= '
		#header-btn-cta a:hover {
			background-color: '.$menu_cta_link_hover_color.';
		}
		';

		
	

		$css   .= '.sep-header-cta {
			  display: grid;
			  grid-template: "a b";
		  }
		  #main-header-navigation .has-cta {
			display: grid;
				grid-template: "a b";
			}              
		  ';
		$css .= '@media screen and (min-width:992px) {
			  #header-btn-cta { padding-left: ' . $paddle_cta_padding_left . '%}
			  }
		  ';
	}
	return $css;
}

function paddle_footer_css()
{
	$footer_bg_color = paddle_theme_get_color('footer_bgcolor');
	$overlay_color = paddle_theme_get_color('footer_bg_image_overlay');
	$link_color = paddle_theme_get_color('footer_navlink_text_color');
	$text_color = paddle_theme_get_color('footer_text_color');
	$hover_color = paddle_theme_get_color('footer_navlink_text_color_hover');
	$footer_bottom_bgcolor = '' !== paddle_theme_get_color('footer_bottom_bgcolor') ? paddle_theme_get_color('footer_bottom_bgcolor') : 'transparent';
	$footer_bottom_border_top  = 1 === absint(get_theme_mod('footer_bottom_border_top', PADDLE_DEFAULT_OPTION['footer_bottom_border_top'])) ? '1px solid var(--paddle-color-4)' : '1px solid transparent';
	$footer_bg_image = '' !== get_theme_mod('footer_bg_image', PADDLE_DEFAULT_OPTION['footer_bg_image']) ?  esc_url_raw(get_theme_mod('footer_bg_image')) : '';
	$bg_attachment  = get_theme_mod('footer_bg_image_attachment', PADDLE_DEFAULT_OPTION['footer_bg_image_attachment']);
	$overlay_opacity  = absint(get_theme_mod('footer_bg_overlay_opacity', PADDLE_DEFAULT_OPTION['footer_bg_overlay_opacity']));
	$logo_width  = absint(get_theme_mod('footer_image_width', PADDLE_DEFAULT_OPTION['footer_image_width']));
	$paddle_payment_badge_image_height = absint(get_theme_mod('payment_badge_image_h', PADDLE_DEFAULT_OPTION['payment_badge_image_h']));
	$paddle_payment_badge_color = get_theme_mod('payment_badge_color', PADDLE_DEFAULT_OPTION['payment_badge_color']);
	$paddle_payment_badge_column = get_theme_mod('footer_payment_badge_column', PADDLE_DEFAULT_OPTION['footer_payment_badge_column']);

	$opacity = 0 === $overlay_opacity ? 0 : '0.' . $overlay_opacity;
	if (100 === $overlay_opacity) {
		$opacity = 1;
	}
	$footer_bottom_layout  = get_theme_mod('footer_bottom_layout', PADDLE_DEFAULT_OPTION['footer_bottom_layout']);



	$css = '';
	if ('' !== $footer_bg_image) {
		$bg_image = '
		background-image: url("' . $footer_bg_image . '");
		background-repeat: no-repeat;
		background-size: cover;
		background-attachment: ' . $bg_attachment . ';
		background-position: center center;
		';
	} else {
		$bg_image = '';
	}

	$css .= '.site-footer {
		position: relative;
		padding: 0 0;
		color: ' . $text_color . ';
		background-color: ' . $footer_bg_color . ';
	}';
	$css .= '.footer-wrap {
		position: relative;
		' . $bg_image . '
	}
	.footer-main #menu-social-items {justify-content: left!important; max-width: 256px;}
	.footer-main.container {
		flex-direction: column;
		padding-top: 2.5rem;
	}
	@media (min-width:992px) {		
		.footer-main.container {
			flex-direction: row;
			padding: 2.5rem 0;
		}
	}
	';

	if (0 !== $opacity) :
		$css .= '.footer-wrap:after {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			pointer-events: none;
			background-color: ' . $overlay_color . ';
			opacity: ' . $opacity . ';
		}';
	endif;

	// @todo Check if logo is enabled
	$css .= '#footer-logo>a, #footer-logo>img {
		display: inline-block;
		max-width: ' . $logo_width . 'px;
		width: ' . $logo_width . 'px;
	}';

	// @todo Check if footer about enabled.
	$css .= '.site-footer .footer-tagline {
		max-width: 256px;
		margin: 20px 0;
	}';


	$css .= '
	.site-footer a {color: ' . $link_color . ';}
	.site-footer a:hover {color: ' . $hover_color . ';}
		.site-footer p:last-child {
		  margin-bottom: 0; 
		}
		.site-footer .theme-credit {
		  font-size: .99rem; 
		}
		  .site-footer .theme-credit a {
			color: ' . $text_color . ';
			text-decoration: underline; 
		}
		@media (min-width:992px) {
			.site-footer .theme-credit a {
				float: right;
				padding-right: 15px;
			}
		}
			.site-footer .site-info {
				position: relative;
				z-index: 1;
				color: ' . $text_color . ';
				border-top: ' . $footer_bottom_border_top . ';
    			background-color: ' . $footer_bottom_bgcolor . ';
				padding-top: 20px;
    			padding-bottom: 20px;
			}
			.site-footer .site-info a, .site-footer .site-info {
				font-size: 15px;
			}
			.footer-link-content {display: flex; flex-wrap: wrap; justify-content: center;}
			.footer-link-content a {padding: 9px 0; }
			.footer-link-content a:first-of-type {padding-left: 0px;}
			.footer-link-content {
				margin-bottom: 9px;
			}
			@media (min-width:992px) {
				.footer-link-content {justify-content: left; margin-bottom: 0}
				.footer-link-content a:first-of-type {
					padding-left: 15px;
				}
			}
			.footer-link-content>a {padding-left: 15px;}

			.site-footer .site-info a:hover {
				color: ' . $hover_color . ';
			}
			
		/*
		.site-footer .site-info {
		  border-top: 1px solid transparent;
		  background-color:' . $footer_bg_color . ';
		}
		*/
		  .site-footer .site-info > .container {
			display: flex;
			width: 100%;
			justify-content: space-between;
			flex-direction: column;
			align-items: center; 
		}
		@media (min-width: 992px) {
			  .site-footer .site-info > .container {
				flex-direction: row; } 
			}
			.site-footer .site-info > .container > div {
			  flex-grow: 1; 
			}
		  .site-footer .site-info .footer-copyrights {
			font-size: 100%; order: 3 
		}
		@media (min-width: 992px) {
			.site-footer .site-info .footer-copyrights {
			text-align: left; order: 0 } 
		}
		.site-footer .site-info .footer-copyrights a {
			text-decoration: none !important;
			color: currentColor; 
		}';

	$payment_svg_width = 'color' === $paddle_payment_badge_color ? 'width : ' . $paddle_payment_badge_image_height . 'px;' : 'fill: #303030;';
	$payment_svg_fill = 'color' === $paddle_payment_badge_color ? 'var(--paddle-color-4)' : '#3f3f3f';

	$css .= '
		.bt_payment_trust {
			text-align: center;
		}
		 .payment-badge-wrap { display:inline-block }
		 .payment-badge-wrap svg {
			height: ' . $paddle_payment_badge_image_height . 'px;
			' . $payment_svg_width . '
			padding: 2.5px;
			fill: ' . $payment_svg_fill . ';
		}';
	if ('bottom' === $paddle_payment_badge_column) {
		$css .= '	@media (min-width: 992px) {
				.site-footer .site-info > .container { flex-wrap: wrap;}
				.payment-badge-wrap { text-align: right; }
			}';
	}

	if ('center' === $footer_bottom_layout) {
		$css .= '
			@media (min-width: 992px) {
				.site-footer .site-info>.container {
				  flex-direction: column; 
				  padding-bottom:0!important;
				} 
				.site-footer .bt_payment_trust {text-align: center;}
				.site-footer .site-info .footer-copyrights { order: 4}
				
			  }
			';
	}

	// @todo Check site footer has widget
	$css .= ' 
			  .widget-container  {
				position: relative;
				width: 100%;
				z-index: 1;
			}
			.footer-branding {position: relative; z-index: 1}
			  .footer-widgets .container, .footer-widgets .container-fluid {
				padding-top: 20px;
				padding-bottom: 50px; 
			}
				@media (min-width: 992px) {
				  .footer-widgets .container, .footer-widgets .container-fluid, .footer-branding {
					padding: 20px 0px 50px 0; } 
			}
			  
			
			section.widget>h2, section.widget>h3, section.widget>h4 {
				margin-top: 0;
				margin-bottom: 16px;
				font-size: 18px;
			}
			  
			  .footer-widgets ul {
				list-style: none;
				margin: 0;
				padding-left: 0; }
				.footer-widgets ul li {
				  margin-bottom: 12px;
				  font-size: 16px;
				  letter-spacing: 1px;
				  line-height: 20px; }
				  .footer-widgets ul li > a {
					color: ' . $link_color . '; }
			  
			  .footer-widgets .col-content {
				position: relative;
				padding-bottom: 2.5rem;
				padding-right: 0;
				 }
				
				 @media (min-width:992px) {
					.site-footer .footer-widgets .col-content:first-child {
						padding-left: 30px;
					}
				 }
				
			  
			  @media screen and (max-width: 992px) {
				.footer-widgets .col-content:not(:last-child)::after {
				  border-bottom: 1px dashed var(--paddle-color-4); 
				  content: "";
				  width: calc(100% - 30px);
				  position: absolute;
				  margin-top: 15px;
					} 
				}
			  
			  .footer-widgets #footer-logo {
				padding-bottom: 0;
				padding-left: 0; }
				.footer-widgets #footer-logo .custom-logo-link {
				  max-width: 200px; }';



	return $css;
}

function paddle_footer_social_icons()
{
	//@todo Check social media is enabled
	$link_color = paddle_theme_get_color('footer_navlink_text_color');
	$text_color = paddle_theme_get_color('footer_text_color');
	$hover_color = paddle_theme_get_color('footer_navlink_text_color_hover');
	$icon_width = absint(get_theme_mod('social_icon_width', PADDLE_DEFAULT_OPTION['social_icon_width'])); //social_icon_width

	$css = '';
	ob_start();
	?>
	.footer-widgets #menu-social-items {justify-content: left!important}
	#menu-social-items {margin: 0;}
	@media screen and (max-width: 992px) {
	#menu-social-items {
	margin-top: 10px;
	margin-bottom: 20px; } }

	#menu-social-items li,
	.social-items.topbar-social li {
	min-width: 40px;
	min-height: 40px;
	overflow: hidden;
	display: contents; }

	#menu-social-items li a,
	#menu-social-items li .icon,
	.social-items.topbar-social li a,
	.social-items.topbar-social li .icon {
	position: relative;
	display: flex;
	justify-content: center;
	align-items: center;
	min-width: 40px;
	height: 40px;
	margin-right: 5px;
	border-radius: 5px;
	background-color: transparent;
	}
	#menu-social-items li a { height: unset;}

	a.bottom-social>svg {width: <?php echo esc_attr($icon_width); ?>px; fill: <?php echo esc_attr($text_color) ?>; }

	#menu-social-items li a:hover svg {fill: <?php echo esc_attr($hover_color) ?>; transition: .1s}

<?php

	$css .= ob_get_clean();

	$footer_urls_position = get_theme_mod('footer_urls_position', PADDLE_DEFAULT_OPTION['footer_urls_position']);
	if ('left' === $footer_urls_position) {
		$css .= '@media (min-width: 992px) {
				.site-footer .site-info .footer-copyrights {flex-grow: unset!important; margin-right: 15px}
			}';
	} elseif ('right' === $footer_urls_position) {
		$css .= '@media (min-width: 992px) {
				.site-footer .site-info .footer-copyrights {flex-grow: unset!important; margin-right: 15px}
				.footer-link-content {
					justify-content: right;
					padding-right: 15px;
				}
			}';
	}

	return $css;
}

function paddle_top_bar_css()
{


	$topbar_border_color = paddle_theme_get_color('topbar_border_color');
	$border_bottom = 1 === absint(get_theme_mod('topbar_border_bottom', PADDLE_DEFAULT_OPTION['topbar_border_bottom'])) ? '1px solid ' . $topbar_border_color . ';' : '1px solid transparent;';
	$min_height = absint(get_theme_mod('topbar_height', PADDLE_DEFAULT_OPTION['topbar_height']));
	$topbar_bg_color = !empty(paddle_theme_get_color('topbar_bgcolor')) ? paddle_theme_get_color('topbar_bgcolor') : 'transparent';
	$text_color = paddle_theme_get_color('topbar_text_color');
	$link_color = paddle_theme_get_color('topbar_link_color');
	$link_color_hover = paddle_theme_get_color('topbar_link_color_hover');
	$font_size = absint(get_theme_mod('topbar_font_size', PADDLE_DEFAULT_OPTION['topbar_font_size']));
	$top_bar_info_align = get_theme_mod('top_bar_info_align', PADDLE_DEFAULT_OPTION['top_bar_info_align']);
	$top_bar_content_align = get_theme_mod('top_bar_content_align', PADDLE_DEFAULT_OPTION['top_bar_content_align']);
	$top_bar_social_align = get_theme_mod('top_bar_social_align', PADDLE_DEFAULT_OPTION['top_bar_social_align']);

	$css = '';


	$css = '#top-bar-v1 {
        z-index: 1;
        background: transparent;
		min-height: ' . $min_height . 'px;
		border-bottom: ' . $border_bottom . ';
		background-color: ' . $topbar_bg_color . ';
		color : ' . $text_color . ';
		font-size: ' . $font_size . 'px;
		display: flex;
    	align-items: center;
    }

    #top-bar-v1 .top-bar--wrapper {
        display: flex;
		justify-content: space-between;
        margin: 0 auto;
        align-items: center;
    }
   
    #top-bar-v1 ul {
        display: flex;
        justify-content: center;
        margin:0;
        padding:0;
        gap: 32px;
        list-style: none;
    }
	#top-bar-v1 .ul-content {
		flex-wrap: wrap; gap:5px; padding: 5px;
	}
    #top-bar-v1 ul li {
        align-self: center;
		color : ' . $text_color . ';
    }
	#top-bar-v1 .has-icon {
		display: flex;
		align-items: center;
		gap: 9px;
	}
	#top-bar-v1 #menu-social-items {
		gap: 0;
		justify-items: end;
	}
   
    #top-bar-v1 ul li>a {
        text-decoration: none;
        color: ' . $link_color . ';
    }
	#top-bar-v1 a:hover {
		color: ' . $link_color_hover . ';
	}

	.topbar-par-content a {
		color: ' . $link_color . ';
	}
	#top-bar-v1 li.top-bar-has-icon a {
        display: flex;
        align-items: center;
		color: ' . $link_color . ';
        gap: 9px;
    }
    #top-bar-v1 a>svg {
        fill: ' . $link_color . ';
    }
	#top-bar-v1 a:hover>svg {
        fill: ' . $link_color_hover . '!important;
    }
	#top-bar-v1 .has-icon>svg { 
		width: ' . $font_size . 'px;
		padding-top: 1px;
	}
	#top-bar-v1 .has-icon>svg>path {
		fill: ' . $link_color . ';

	}
	#top-bar-v1 a:hover .has-icon>svg>path {
		fill: ' . $link_color_hover . '!important;
	}

	#top-bar-v1 ul li a[href^="mailto:"], #top-bar-v1 ul li a[href^="tel:"] {
		position: relative;
		word-break: break-all;
		text-decoration: none;
	}

	#top-bar-v1 .order-0 {order: 0;} 
	#top-bar-v1 .order-1 {order: 1;}
	#top-bar-v1 .order-2 {order: 2;}
	
	@media (max-width:500px) {
		.top-bar--wrapper-main-info>ul {
			flex-direction: column;
			gap: 6px!important;
			padding: 12px 0!important;
		}
	}
	[class^="top-bar--wrapper-"] {
		width: 100%;
	}
	.top-bar--wrapper .top-bar--wrapper-main-content>div {
		text-align: ' . $top_bar_content_align . ';
	}
    @media screen and (min-width: 992px) {
        [class^="top-bar--wrapper-"] {
            width: auto;
        }
		.top-bar--wrapper .top-bar--wrapper-main-info, .top-bar--wrapper .top-bar--wrapper-main-info ul {
            justify-content: ' . $top_bar_info_align . '!important;
			text-align: ' . $top_bar_info_align . '!important;
			width: 100%;
        }
		.top-bar--wrapper .top-bar--wrapper-main-social, .top-bar--wrapper .top-bar--wrapper-main-social ul {
            justify-content: ' . $top_bar_social_align . '!important;
			text-align: ' . $top_bar_social_align . '!important;
			width: 100%;
        }
		.top-bar--wrapper .top-bar--wrapper-main-content, 
		.top-bar--wrapper .top-bar--wrapper-main-content ul, .top-bar--wrapper .top-bar--wrapper-main-content>div {
            justify-content: ' . $top_bar_content_align . '!important;
			text-align: ' . $top_bar_content_align . '!important;
			width: 100%;
        }
	
      
    }';
	return $css;
}

function paddle_archive_css()
{
	$enable_image_before_site_title = get_theme_mod('enable_image_before_site_title', PADDLE_DEFAULT_OPTION['enable_image_before_site_title']);
	$paddle_archieve_layout =  get_theme_mod( 'post_archive_layout', PADDLE_DEFAULT_OPTION['post_archive_layout'] ) ;

	$css = '';
	$css .= '.archive-grid article .entry-meta, .list-card  .entry-meta {
		display: flex;
		flex-wrap: wrap;
		gap: 6px;
		padding: 9px 0;
		order: 0;
	}';
	// Grid.
   if ('grid' === $paddle_archieve_layout) : 
	$css .= '
		@media screen and (min-width: 768px) {
			.archive-grid.row>div:nth-child(1n+1) {
				border-right: 1px dashed var(--paddle-color-4);
				margin-bottom: 35px;
			}
		}
	
		.archive-grid article {
			display: flex;
			flex-direction: column;
			padding-bottom: 30px;
			margin-bottom: 30px;	
			border-bottom: 1px dashed var(--paddle-color-4);
		
		}
		.archive-grid article>h2, .archive-grid article>div:not(.post-thumbnail) {
			padding-right: 15px;
		}
		@media (min-width:992px) {
			.archive-grid article>h2, .archive-grid article>div:not(.post-thumbnail) {
				padding-right: 30px;
			}
		}
	
		.archive-grid article .post-thumbnail, 	.archive-grid article .thumbnail-container {
			order: -1;
		}
		
		
		@media (min-width:992px) {
			.archive-grid article .entry-meta {
				gap: 9px;
			}
		}
		
		.archive-grid article .entry-content {
			padding-top: 0;
			order: 2;
		}
		.archive-grid article .order-is-1 {
			order: 1;
		}
		';
		if (1 === absint($enable_image_before_site_title) ) {
			$css .= '
			.archive-grid article .entry-title {
				order: 1;
			}';
		} else {
			$css .= '
			.archive-grid article .entry-title {
				order: -1;
			}';
		}
	endif;

	if ('list' === $paddle_archieve_layout) : 
		$css .= '
		.list-card {
			transition: .3s ease-in-out;
			height: 100%;
			background: #fff;
			border-radius: 10px;
			overflow: hidden;
			position: relative;
			z-index: 1;
			box-shadow: 0 8px 14px 0 rgba(0, 0, 0, 0.04);
			margin-bottom: 30px;
			flex-direction: column;
		}

		.list-card .entry-meta a, .list-card .byline, .list-card .by-author {
			line-height: initial;
		}
		@media (min-width:992px) {
			.list-card .entry-meta a, .list-card .byline, .list-card .by-author {
				line-height: 1;
			}
		}

		@media (min-width:768px) {
			.list-card {
				flex-direction: row;
			}
			.thumbnail-container-list {
				flex-shrink: 0!important;
				width: 380px;
			}
		}
	
		.thumbnail-container-list img {
			max-width: 100%;
			height: auto;
			width: 100%;
		}
		
		.entry-content-wrap {
			padding: 20px;
			border-left: 1px solid #eee;
			flex:1;
		}
		@media (min-width:768px) {
			.entry-content-wrap {
				padding: 40px;
			}
		}
				
		';
		if (1 === absint($enable_image_before_site_title) ) {
			$css .= '
			@media (min-width:768px) {
			.list-card .thumbnail-container-list {
				order: 0;
			}}';
		} else {
			$css .= '
			@media (min-width:768px) {
			.list-card .thumbnail-container-list {
				order: 1;
			}}';
		}
	endif;


	// Entry Meta
	$css .= '
	.cat-links, .tags-links {
		display: flex;
		flex-wrap: wrap;
	}
	.cat-links a, .tags-links a {
		position: relative;
		padding: 0 5px;
		margin: 0 3px 0 0;
		display: inline-flex;
		text-decoration: none;
	}
	.cat-links a:first-child, .tags-links a:first-child {
		padding-left: 0px;
	}
	.cat-links a:first-child:before, .tags-links a:first-child:before {
		display: inline-flex;
    	align-items: center;
		content: "tags";
		margin-right: 5px;
		background: #fff;
		padding: 0 5px;
		color: var(--paddle-color-0);
		border: 1px dotted var(--paddle-color-4);
		text-transform: uppercase;
		font-size: 12px;
	}
	.cat-links a:first-child:before {
		content: "categories";
	}
	.cat-links a:not(:last-child):after, .tags-links a:not(:last-child):after {
		content: "/";
		position: absolute;
		right: -3px;
		font-family: "Segoe UI Symbol", EmptyFont2;
		transform: translateY(2px);
	}
	';

	// Featured Image grid
	$css .= '
		.archive-grid a.post-thumbnail {
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
			border-radius: 9px;
		}
		.archive-grid .wp-post-image {
			max-width: unset!important;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			position: absolute;
			-o-object-fit: cover;
			object-fit: cover;
		}
		';
		$icon_comment = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M22 3v13h-6.961l-3.039 3.798-3.039-3.798h-6.961v-13h20zm2-2h-24v17h8l4 5 4-5h8v-17z'/%3E%3C/svg%3E";
		$icon_user = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTIgMmMyLjc1NyAwIDUgMi4yNDMgNSA1LjAwMSAwIDIuNzU2LTIuMjQzIDUtNSA1cy01LTIuMjQ0LTUtNWMwLTIuNzU4IDIuMjQzLTUuMDAxIDUtNS4wMDF6bTAtMmMtMy44NjYgMC03IDMuMTM0LTcgNy4wMDEgMCAzLjg2NSAzLjEzNCA3IDcgN3M3LTMuMTM1IDctN2MwLTMuODY3LTMuMTM0LTcuMDAxLTctNy4wMDF6bTYuMzY5IDEzLjM1M2MtLjQ5Ny40OTgtMS4wNTcuOTMxLTEuNjU4IDEuMzAyIDIuODcyIDEuODc0IDQuMzc4IDUuMDgzIDQuOTcyIDcuMzQ2aC0xOS4zODdjLjU3Mi0yLjI5IDIuMDU4LTUuNTAzIDQuOTczLTcuMzU4LS42MDMtLjM3NC0xLjE2Mi0uODExLTEuNjU4LTEuMzEyLTQuMjU4IDMuMDcyLTUuNjExIDguNTA2LTUuNjExIDEwLjY2OWgyNGMwLTIuMTQyLTEuNDQtNy41NTctNS42MzEtMTAuNjQ3eiIvPjwvc3ZnPg==';
		$icon_calendar = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24'%3E%3Cpath d='M20 19h-4v-4h4v4zm-6-10h-4v4h4v-4zm6 0h-4v4h4v-4zm-12 6h-4v4h4v-4zm16-14v22h-24v-22h24zm-2 6h-20v14h20v-14zm-8 8h-4v4h4v-4zm-6-6h-4v4h4v-4z'/%3E%3C/svg%3E";
		$icon_calendar_2 = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='48' viewBox='0 96 960 960' width='48'%3E%3Cpath d='M180 976q-24 0-42-18t-18-42V296q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600V486H180v430Zm0-490h600V296H180v130Zm0 0V296v130Z'/%3E%3C/svg%3E";


		$css .= 'article .entry-meta a, article .byline, article .by-author,
		.list-card .entry-meta a, .list-card .byline, .list-card .by-author
		 {
			color: #525252;
			text-decoration: none;
			font-size: 15px;
			margin-top: 4px;
    		margin-bottom: 4px;
		}
		@media (min-width:768px) {
			article .entry-meta a, article .byline, article .by-author,
		.list-card .entry-meta a, .list-card .byline, .list-card .by-author {
			margin-top: 0;
			margin-bottom: 0;
		}
		}
		.by-author, .posted-on, .comments-link {
			position: relative;
			display: inline-flex;
			gap: 5px;
			align-items: center;
		}
		.by-author::before, .posted-on::before, .comments-link::before {
			content: "";
			max-width: 22px;
			background-image: url("'.$icon_calendar_2.'");
			width:18px;
			height:16px;
			background-size: 18px;
			background-repeat: no-repeat;
			opacity: .6;
		}
		@media (max-width:420px) {
			.by-author::before, .posted-on::before, .comments-link::before {
				width:32px;
			}
		}
		.by-author::before {
			background-image: url('.$icon_user.');
			background-size: 15px
		}
		.comments-link::before {
			background-image: url("'.$icon_comment.'");
			background-size: 15px;
			margin-top: 1px;
		}
		@media (min-width:768px) {
			.comments-link {
				flex: 1;
				justify-content: end;
			}
		}
		
		';
	

	// Read more
	$css .= '
		.article-more-link {
			position: relative;
			display: inline-block;
			margin: 0 0 15px 0;
			height: 40px; }
		  
		  .read-more {
			margin: 0;
			display: inline-block;
			font-size: 12px;
			font-weight: 600;
			line-height: 1;
			padding: 10px 16px 10px 0px;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			-ms-border-radius: 2px;
			border-radius: 2px;
			text-transform: uppercase;
			letter-spacing: 1px; }
		  
		  .read-more:before {
			display: block;
			content: "";
			height: 2px;
			width: 18px;
			background-color: var(--paddle-color-1);
			position: absolute;
			top: calc(20px - 5px);
			right: 4rem;
			opacity: 0;
			transition: all .3s ease-out 0s; }
		  
		  .read-more:after {
			display: block;
			content: "";
			height: 8px;
			width: 8px;
			border: 2px solid;
			border-top-width: 0;
			border-left-width: 0;
			position: absolute;
			top: calc(20px - 8px);
			right: 8px;
			transition: all .3s ease-out 0s;
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg); }
		  
		  .article-more-link:hover a {
			text-decoration: none; }
		  
		  .article-more-link:hover .read-more:before {
			right: -3px;
			opacity: 1; 
			background-color: var(--paddle-color-2);
		}

			.article-more-link:hover .read-more:after,
			.article-more-link:hover .read-more:before {
				color: var(--paddle-color-2);
			}
		  
		  .article-more-link:hover .read-more:after {
			right: -3px;
			border-top-width: 0;
			border-left-width: 0; }';
	

	if (!is_page()) {
		return $css;
	}
}

function paddle_aside_search()
{
	$css = '';

	$css .= '
	aside form[role="search"] {
		position: relative;
		min-height: 46px;
	}
	aside form[role="search"]>div::before {
		pointer-events: none;
		content: "";
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		border: 1px solid transparent;
		transition: border .1s ease;
		z-index: 0;
		background: #FFFFFF;
		box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.0835598);
	}
	aside form[role="search"]>label {
		font-size: 0.87rem;
		left: calc(1px + 1rem);
		transform: translateY(calc(50% + 3px));
		margin-bottom: 0;
		pointer-events: none;
		position: absolute;
		transition: top .1s ease,font-size .1s ease;
		letter-spacing: .1rem;
		font-weight: normal!important;
		z-index: 1;
	}
	aside form[role="search"] input[type="search"] {
		min-height: 46px;
		margin-right: 48px;
    	border-radius: 0;
		transition: box-shadow .1s ease;
	}
	aside form[role="search"]:focus-within>label, aside form[role="search"]:focus>label {
		font-size: 10px!important;
		transform: translateY(calc(50% - 1px));
	}
	aside form[role="search"] input[type="search"]:required:valid {
		z-index:1
	}
	aside form[role="search"] button[type="submit"] {
		position: absolute;
		right: 0;
		height: 100%;
		background-size: 22px;
		background-repeat: no-repeat;
		background-position: center;
		margin-left: 0;
		border-radius: 0;
		background-color: transparent;
		cursor: pointer;
		text-indent: -9999px;
		white-space: nowrap;
		overflow: hidden;
		width: 44px;
	}
	aside form[role="search"] button[type="submit"]::before
	 {
		content: "";
		width: 2px;
		position: absolute;
		height: 10px;
		transform: rotate(131deg);
		background-color: var(--paddle-color-1);
		left: calc(50% + 4px);
		top: 50%;
	} 
	aside form[role="search"] button[type="submit"]::after {
		content: "";
		width: 17px;
		height: 17px;
		border: 2px solid var(--paddle-color-1);
		position: absolute;
		border-radius: 50%;
		transform: translate(-50%, 0);
		left: calc(50% - 3px);
		top: calc(50% - 3px);
		transform: translate(-50%,-50%);
	}
	';
	if ( ! is_active_sidebar( 'sidebar-1' ) 
	|| 'no-sidebar' === paddle_get_sidebar_option() ) {
		return '';
	}

	return $css;
}

function paddle_aside_widget_block()
{
	$css = '';

	$css .= '

	.widget_block:not(.widget_search) {
		box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.0835598);
		padding: 1.5rem 1.5rem;
		margin-bottom: 1.5rem;
		border-radius: 9px;
	}
	.widget_block.widget_search {
		margin-bottom: 1.5rem;
	}
	.site-footer .widget_block {
		padding: 0 15px;
		margin-bottom: 0;
		border-radius: 0;
		box-shadow: unset;
	}
	section[id*=recent-posts-],  section [class*=wp-block-latest-posts] {
		counter-reset: section; 
	}

	section[id*=recent-posts-] li, section [class*=wp-block-latest-posts] li {
		position: relative;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: baseline;
		-ms-flex-align: baseline;
		align-items: baseline;
		margin-left: 9px;
	}
	section[id*=recent-posts-] li:hover:after, section [class*=wp-block-latest-posts] li:hover:after {
		background: var(--paddle-color-2);
	}

	section[id*=recent-posts-] li:before, section [class*=wp-block-latest-posts] li:before {
		border-bottom: none;
		font-weight: 500;
		counter-increment: section;
		content: counter(section) " ";
		display: inline-table;
		text-align: center;
		font-size: 1.2rem;
		margin-right: 24px;
		z-index: 1;
		color: #FFF;
		padding-top: 3px;
		padding-bottom: 4px;
		font-size: 14px;
		font-weight: 700;
	}
	section[id*=recent-posts-] li:after, section [class*=wp-block-latest-posts] li:after {
		content: "";
		width: 28px;
		height: 28px;
		margin-left: -10px;
		display: inline-table;
		text-align: center;
		font-size: 1.2rem;
		background: var(--paddle-color-1);
		position: absolute;
	}
	section[id*=recent-posts-] li:first-of-type:before, section [class*=wp-block-latest-posts] li:first-of-type:before {
		padding-left: 2px;
	}
	.widget-area h2, .widget-area h3, .widget-area h4, aside .widget-area .widget-title {
		position: relative;
		margin-bottom: 2rem;
		padding-left: 15px;
		font-size: 19px;
		text-transform: uppercase;
	}
	.widget-area h2:before, .widget-area h3:before, .widget-area h4:before, aside .widget-area .widget-title:before {
		content: "•";
		padding-left: 6px;
		font-family: "Segoe UI Symbol", EmptyFont2;
		color: var(--paddle-color-1);
		left: 0;
		position: absolute;
		font-size: 22px;
		width: 6px;
		height: 6px;
		background: var(--paddle-color-3);
		border-radius: 6px;
		top: 14px;
		opacity: .5;
		transform: rotate(214deg);
	}
	a.wp-block-latest-comments__comment-link {
		background-color: rgb(255, 255, 255); 
		padding: 9px 15px;
		border-radius: 9px;
		margin-bottom: 9px;
		display: inline-block;
		font-weight: 500;
	}
	a.wp-block-latest-comments__comment-link:hover {
		background-color: rgba(109, 199, 236, .2); /* paddle rgba function */
	}
	';

	return $css;
}

function paddle_singular_post_css()
{
	$blog_style = get_theme_mod('paddle_blog_style', PADDLE_DEFAULT_OPTION['paddle_blog_style']);
	$published_placeholder_text = get_theme_mod('placeholder_text_posted_on', PADDLE_DEFAULT_OPTION['placeholder_text_posted_on']);
	$updated_placeholder_text   = get_theme_mod('placeholder_text_updated_on', PADDLE_DEFAULT_OPTION['placeholder_text_updated_on']);
	$image_position = 'center' === get_theme_mod('paddle_thumbnail_alignment', PADDLE_DEFAULT_OPTION['paddle_thumbnail_alignment']) ?
		'margin: 0 auto;' : '';

	$css = '';

	$css .= '
	.order-is-0 {order: 0;} .order-is-first {order: -1;}';

	if (is_single()) :
		$css .= '.single .site-main>article, .page .site-main>article  {
			display: flex;
			flex-direction: column;
			padding-bottom: 10px;
			margin-bottom: 0px;	
		}
		@media (min-width:768px) {
			.single .site-main>article, .page .site-main>article {
				padding-bottom: 30px;
				margin-bottom: 30px;	
			}
		}';
		if ('0' === $blog_style) {
			$css .='
			.single .site-main>article figure.thumbnail-post-single { 
				order: 0;
				margin-top:0;
				' . $image_position . '
			}
			';
		}
		

		$css .='
		.single .site-main>article .entry-meta {
			display: flex;
			flex-wrap: wrap;
			order: 1;
		}
		.single .site-main h1.entry-title {
			order: 2;
		}
		
		.single .site-main .entry-content {
			order: 3;
		}
		.single .site-main  article .entry-meta.order-is-2 {
			order: 2;
		}
		.single .site-main>article .entry-meta>span:not(:first-child), .single .site-main  article .entry-meta time:not(:first-child) {
			padding-left: 9px;
		}
		.single .site-main footer.entry-footer {
			order: 9;
			padding: 60px 0 15px;
		}
		.single .site-main footer.entry-footer .entry-meta {
			display: flex;
			flex-wrap: wrap;
		}
		.single .site-main .by-author {
			padding-left: 9px; padding-right: 6px;
		}
		
		
		footer.entry-footer .entry-meta .cat-links, footer.entry-footer .entry-meta .tags-links {
			margin-bottom: 50px;
		}
		
		@media (min-width:768px) {
			footer.entry-footer .entry-meta .cat-links, footer.entry-footer .entry-meta .tags-links {
				flex-basis: 50%;
			}
		}
		
		footer.entry-footer .entry-meta .cat-links a, footer.entry-footer .entry-meta .tags-links a {
			border: 1px solid #d8d8d8;
			background-color: #fff;
			padding:9px;
			display: inline-block;
			line-height: normal;
			height: fit-content;
    		margin-bottom: 5px;
		}
		footer.entry-footer .entry-meta .cat-links a:first-child:before, footer.entry-footer .entry-meta .tags-links a:first-child:before {
			position: absolute;
			top: -32px;
			left: 0;
			font-weight: 500;
		}
		footer.entry-footer .entry-meta .cat-links a:not(:last-child):after, footer.entry-footer .entry-meta .tags-links a:not(:last-child):after {
			content: "";
		}
		';
	endif;


	//$css .= 'time.entry-date.published::before { content: "' . $published_placeholder_text . '"}';
	$css .= '.single .site-main  article time.updated::before { content: "' . $updated_placeholder_text . ' "}';


	return $css;
}


function paddle_blog_style_1($width = '43.75', $header_height = '23')
{
	$blog_style = get_theme_mod('paddle_blog_style', PADDLE_DEFAULT_OPTION['paddle_blog_style']);
	$sidebar_layout = strtolower(get_theme_mod('paddle_sidebar_position', PADDLE_DEFAULT_OPTION['paddle_sidebar_position']));
	$percentage_left = 'no-sidebar' === $sidebar_layout ? '50%' : '75%';
	$height = 0;
	if(has_post_thumbnail()) {
		$height = 13;
	}

	$css = '';

	$css .= '
	 article.blog-style-1 {
		padding-top: '.$height.'rem;
	}
	.single article.blog-style-1::after {
		content: "";
		width: 100%;
		background: var(--paddle-color-body-bg);
		height: 30rem;
		position: absolute;
	}
	article.blog-style-1 h1.entry-title, article.blog-style-1 .entry-content, article.blog-style-1 .entry-meta 
	{
		max-width: ' . $width . 'rem;
		z-index: 1;
	}
	@media (min-width:768px) {
		article.blog-style-1 h1.entry-title, article.blog-style-1 .entry-content, article.blog-style-1 .entry-meta 
		{
			margin: 0 auto;
			min-width: 66.666667%;
		}
	}
	article.blog-style-1 .entry-meta {
		padding: 15px;
	}
	article.blog-style-1 h1.entry-title, article.blog-style-1 .entry-content, article.blog-style-1 .entry-meta {
		padding-right: 15px;
		padding-left: 15px;
	}
	
	@media (min-width:768px) {
		article.blog-style-1 h1.entry-title  {
			padding: 0px;
		}
		article.blog-style-1 .entry-content {
			padding-left: 0;
			padding-right: 0;
		}
	}
	article.blog-style-1 figure.thumbnail-post-single {
		left: -50vw;
		margin-left: ' . $percentage_left . ';
		max-width: none!important;
		position: absolute!important;
		top: 0;
		width: 100vw!important;
		z-index: 0;
		height: ' . $header_height . 'rem;
		margin-top: 0;
	}
	@media (max-width:992px) {
		article.blog-style-1 figure.thumbnail-post-single {
			margin-left: 50%;
		}
	}
	article.blog-style-1 figure .thumbnail-container>img {
		bottom: 0;
		height: 100%;
		left: 0;
		margin: 0;
		max-width: none;
		padding: 0;
		position: absolute;
		right: 0;
		top: 0;
		width: 100%;
		object-fit: cover;
	}
	article.blog-style-1 h1.entry-title {
		z-index: 2;
		
	}
	article.blog-style-1 .entry-meta {z-index: 2}
	';
	$css .= '
		.single aside .widget_block:not(.widget_search) {
			background: var(--paddle-color-5);
		}
		';

	if('1' === paddle_get_blog_style()) {
		$css .= '
		@media (min-width:992px) {
		aside.sidebar-offset-1 {
			margin-top: 23rem;
		}
	}';
	}
	if ('1' === $blog_style && is_single()) {
		return $css;
	}
	
		

}

function paddle_fig_caption_css()
{
	$paddle_caption_width = get_theme_mod('paddle_caption_width', PADDLE_DEFAULT_OPTION['paddle_caption_width']);
	$caption_over_image = 1 === absint(get_theme_mod('caption_over_image', PADDLE_DEFAULT_OPTION['caption_over_image'])) ? '-54' : '0';

	$css = '';
	if (is_single() || is_singular()) {

		$css .= '
		.single .site-main>article figure.thumbnail-post-single {
			width: fit-content;
	  		margin-bottom: 15px;
			  max-width:100%;
	  	}
		@media (min-width:768px) {
			.single .site-main>article figure.thumbnail-post-single {
				max-width:unset;
			  }
		}
		figcaption {
			margin: 0 auto;
			padding: 0;
			width: fit-content;
			clear: both;
			padding: 15px;
			background: var(--paddle-color-5);
			background: rgba(255,255,255,.8);
			z-index: 1;
			position: relative;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		figure.thumbnail-post-single figcaption {
			width: ' . $paddle_caption_width . ';
			margin-top: ' . $caption_over_image . 'px;
			height: 54px;	
		}
		';
	}
	return $css;
}

function paddle_singular_header_css() {
	$paddle_banner_style_2 = '';
	$paddle_banner_height = 6;
	$paddle_banner_height_mobile = 1;

	$paddle_page_header_type = get_theme_mod( 'paddle_page_header_type', PADDLE_DEFAULT_OPTION['paddle_page_header_type'] );
	$paddle_header_transparent_global   = absint(get_theme_mod('paddle_header_transparent_global', PADDLE_DEFAULT_OPTION['paddle_header_transparent_global']));
	$paddle_header_transparent_page   = absint(get_theme_mod('paddle_header_transparent_page', PADDLE_DEFAULT_OPTION['paddle_header_transparent_page']));
	$paddle_header_transparent_home_only   = absint(get_theme_mod('paddle_header_transparent_home_only', PADDLE_DEFAULT_OPTION['paddle_header_transparent_home_only']));

	if (is_page() && '0' !== esc_attr($paddle_page_header_type)) {
		
		if(has_post_thumbnail()) {
			$paddle_banner_height = get_theme_mod( 'banner_height_page', PADDLE_DEFAULT_OPTION['banner_height_page'] );
			$paddle_banner_height_mobile = '13.544';
		} else {
			if ( 1 === $paddle_header_transparent_global ) :
			$paddle_banner_height_mobile = '11.544';
			$paddle_banner_height =  '13.544';
			endif;
		}
		$paddle_banner_parent_title_page = get_theme_mod( 'banner_parent_title_page', PADDLE_DEFAULT_OPTION['banner_parent_title_page'] );
		$paddle_banner_image_width_page = get_theme_mod( 'banner_image_width_page', PADDLE_DEFAULT_OPTION['banner_image_width_page'] );
		$paddle_banner_alignment_page		= get_theme_mod( 'paddle_banner_alignment_page', PADDLE_DEFAULT_OPTION['paddle_banner_alignment_page'] );
		$image_position		= get_theme_mod( 'paddle_banner_image_position_page', PADDLE_DEFAULT_OPTION['paddle_banner_image_position_page'] );

		

		$paddle_banner_style_2 .= '
		.PageBanner a {text-decoration: none; font-size: 15px; color: #525252;}
		.PageBanner {
			display: flex;
			position: relative;
			flex-direction: column;
			overflow: hidden;
			justify-content: center;
			padding-top:'.$paddle_banner_height_mobile.'rem;
		}
		.PageBanner__wrap {
			text-align : '.$paddle_banner_alignment_page.';
		}
		
		.PageBanner__content {
			align-items: center;
			justify-content: center;
			display: flex;
			flex-direction: column;
			position: relative;
			width: 100%;
			z-index: 2;
			margin: 0 auto;
			justify-content : '.$paddle_banner_alignment_page.';
			align-items: flex-start;
			color: #2a3a51;
			gap: 15px;
			background: white;
			padding-left: 33px;
			padding-top: 15px;
			
		}
		.PageBanner__description .article-more-link, time.updated {
			display: none;
		}
		@media (min-width:992px) {
			.PageBanner { padding-top: '.$paddle_banner_height.'rem;}
			.PageBanner__content {
				margin-top: -5rem;
				padding-top: 30px;
			}
		}
		@media (max-width:540px) {
			.PageBanner__content {
				margin-left: -30px;
				padding-left: 60px;
			}	
		}
		
		.PageBanner__author__link {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 9px;
		}
		.PageBanner__author__avatar {
			border-radius: 50%;
			overflow: hidden;
		}
		.PageBanner__image {
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			overflow: hidden;
			display: block;
			height: 33.75rem;
			height: 100%;
		}
		.thumbnail-container {
			left: -50vw;
			margin-left: 50%;
			max-width: none;
			overflow: hidden;
			position: absolute;
			top: 0;
			width: 100vw;
			z-index: -1;
		}
		 .PageBanner__image img:after {
			content: "";
			position: absolute;
			top: 0;
			background: #ffffff;
			opacity: 0;
			z-index: 1;
			width: 100%;
			height: 100%;
		}
		.PageBanner__image img {
			object-fit: cover;
			object-position: center center;
			min-width:50%;
			 float: '.$image_position.';
		}';
		if ( 1 === $paddle_banner_parent_title_page) {
			$paddle_banner_style_2 .= '
			.PageBanner__post_parent {
				color: var(--paddle-color-1);
			}';
		}
		if ('center' === $image_position ) {
			$paddle_banner_style_2.='
				.thumbnail-container { text-align: center;}
			';
		}
		if ($paddle_banner_image_width_page > 50) {
			$paddle_banner_style_2.='.PageBanner__image img {
				width: '.$paddle_banner_image_width_page.'%;
				transform: translateY(-15%);
			}';
		}
		if('left' === $paddle_banner_alignment_page) {
			$paddle_banner_style_2.='.PageBanner__content-align-left {
				padding-right: 7%;
			}';
		}
		if('right' === $paddle_banner_alignment_page) {
			$paddle_banner_style_2.='.PageBanner__content-align-right {
				align-items: end;
				padding-right: 5%;
			}';
		}
		if('right' === $paddle_banner_alignment_page || 'center' === $paddle_banner_alignment_page) {
			$paddle_banner_style_2.='.PageBanner__author, .PageBanner__meta {
				width: 100%;
				display: flex;
				justify-content : '.$paddle_banner_alignment_page.';
			}';
		}
		
	} elseif (is_page() && '0' === esc_attr($paddle_page_header_type)) {
		/* 
		
			'default_page_header_title_position' => 'before'*/
			$element_spacing = get_theme_mod( 'default_page_header_spacing', PADDLE_DEFAULT_OPTION['default_page_header_spacing'] );
			$element_align = get_theme_mod( 'default_page_horizontal_align', PADDLE_DEFAULT_OPTION['default_page_horizontal_align'] );
			$title_position = get_theme_mod( 'default_page_header_title_position', PADDLE_DEFAULT_OPTION['default_page_header_title_position'] );
			$paddle_author_page		= absint(get_theme_mod( 'banner_author_page', PADDLE_DEFAULT_OPTION['banner_author_page'] ));
 			$paddle_published_date_page = absint(get_theme_mod( 'banner_published_date_page', PADDLE_DEFAULT_OPTION['banner_published_date_page'] ));
			$meta_margin = '0';

		$paddle_banner_style_2 .= '
		main>article {
			display: flex;
			flex-direction: column;
			gap: 9px;
		}
		main .entry-header, .page__entry-meta { text-align: '.$element_align.'}
		@media (min-width:992px) {
			main>article {
				gap: '.$element_spacing.'px;
			}
		}
		.thumbnail-container {
			text-align: '.$element_align.';
		}
		';
		if('after' === $title_position) : 
			$meta_margin = '-15';
			$paddle_banner_style_2 .='
			header + .post-thumbnail {
				order: -1;
			}
			';
		endif;

		if('before' === $title_position) {
			$meta_margin = '5';
		}
		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && 1 === absint($paddle_author_page) || 1 === absint($paddle_published_date_page) ) :

		$paddle_banner_style_2 .='
		.page__entry-meta {
			margin-top: '.$meta_margin.'px;
			padding: 15px 0;
		}
		.page__entry-meta a { text-decoration: none; font-size: 15px; color: #525252;}
		.page__description .article-more-link, .page__entry-meta .updated {
			display: none;
		}
		/*
		.page__entry-meta>span:not(.last-elem):not(:last-child)::after {
			content: "/";
			font-family: "Segoe UI Symbol", EmptyFont2;
			color: #525252;
			padding-left: 9px;
    		padding-right: 5px;
		}
		*/
		';
	endif;
		
	}

	return $paddle_banner_style_2;
}

function paddle_sticky_post_css() {
	$css  = '';
	if(!is_singular()) {
		$css .= '.sticky .thumbnail-container a::before,
		.sticky .thumbnail-container a::after {
			content: "";
			position: absolute;
			display: inline-block;
			left: 2rem;
			min-width: 46px;
			min-height: 40px;
			padding: 7px 11px;
			
		  }
		  article.sticky .thumbnail-container a::before {
			z-index: 2;
			background-repeat: no-repeat;
			background-size: 1.5rem;
			background-position: center;
			-webkit-filter: invert(1);
			filter: invert(1);
			background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTEgMTdoMnY1bC0yIDJ2LTd6bTMuNTcxLTEyYzAtMi45MDMgMi4zNi0zLjA4OSAyLjQyOS01aC0xMGMuMDY4IDEuOTExIDIuNDI5IDIuMDk3IDIuNDI5IDUgMCAzLjc3MS0zLjQyOSAzLjI5MS0zLjQyOSAxMGgxMmMwLTYuNzA5LTMuNDI5LTYuMjI5LTMuNDI5LTEweiIvPjwvc3ZnPg==);
		  }
		  article.sticky .thumbnail-container a::after {
			z-index: 1;
			background: var(--paddle-color-1);
		  }';
	}
	return $css;
}

function paddle_home_page_banner_css() {
	$banner_css = '';
	$paddle_banner_height = 6;
	$paddle_banner_height_mobile = 1;

	$paddle_page_header_type = get_theme_mod( 'header_media_select', PADDLE_DEFAULT_OPTION['header_media_select'] );
	$banner_image_style = get_theme_mod( 'banner_image_style', PADDLE_DEFAULT_OPTION['banner_image_style'] );
	$half_banner = 'half' === $banner_image_style ? 1 : 0;
	$full_banner_image = 'full' === $banner_image_style ? 1 : 0;
	$box_shadow_value = '';
	

	if ('hero' === esc_attr($paddle_page_header_type)) {
		
		
		$paddle_banner_height = get_theme_mod( 'header_media_height', PADDLE_DEFAULT_OPTION['header_media_height'] );
		$paddle_banner_image_width_page = paddle_get_content_width();
		$bg_opacity		= get_theme_mod( 'banner_content_bg_opacity', PADDLE_DEFAULT_OPTION['banner_content_bg_opacity'] ); 
		$banner_alignment		= get_theme_mod( 'banner_content_align', PADDLE_DEFAULT_OPTION['banner_content_align'] );
		$banner_alignment_2		= get_theme_mod( 'banner_content_align_2', PADDLE_DEFAULT_OPTION['banner_content_align_2'] );
		$banner_bg_color = paddle_theme_get_color( 'paddle_banner_header_bg_color' );
		$banner_bg_gradient = paddle_theme_get_color('paddle_banner_bg_gradient');
		$text_color = paddle_theme_get_color( 'paddle_banner_desc_color' );
		$banner_title_color = paddle_theme_get_color( 'banner_title_color' );
		//$content_color = paddle_theme_get_color('paddle_banner_header_color');
		$banner_box_shadow = get_theme_mod( 'paddle_banner_box_shadow', PADDLE_DEFAULT_OPTION['paddle_banner_box_shadow'] );
		$button_bgcolor = paddle_theme_get_color('banner_button_bgcolor') ? paddle_theme_get_color('banner_button_bgcolor') : 'transparent';
		$link_color = paddle_theme_get_color('banner_link_color');
		$link_color_hover = paddle_theme_get_color('banner_link_hover_color');
		$button_border = get_theme_mod( 'banner_button_border_enable', PADDLE_DEFAULT_OPTION['banner_button_border_enable'] );
		$content_bgcolor = paddle_theme_get_color('banner_content_bgcolor') ? paddle_theme_get_color('banner_content_bgcolor') : ''; // empty
		$header_font_size = get_theme_mod( 'banner_header_font_size', PADDLE_DEFAULT_OPTION['banner_header_font_size'] );
		$header_font_weight = get_theme_mod( 'banner_font_weight', PADDLE_DEFAULT_OPTION['banner_font_weight'] );
		$button__text_transform = get_theme_mod( 'banner_button_transform', PADDLE_DEFAULT_OPTION['banner_button_transform'] );
		$banner_button_align = get_theme_mod( 'banner_button_align', PADDLE_DEFAULT_OPTION['banner_button_align'] );
		$padding_top = get_theme_mod( 'banner_padding_top', PADDLE_DEFAULT_OPTION['banner_padding_top'] );
		$padding_bottom = get_theme_mod( 'banner_padding_bottom', PADDLE_DEFAULT_OPTION['banner_padding_bottom'] );
		$fit_image = get_theme_mod( 'banner_fit_image', PADDLE_DEFAULT_OPTION['banner_fit_image'] );
		$fit_image_full_height = get_theme_mod( 'banner_fit_image_full_height', PADDLE_DEFAULT_OPTION['banner_fit_image_full_height'] );
		$image_order = 'left' === $banner_alignment_2 ? 'order: unset;' : '';
		$transparent_header = get_theme_mod( 'banner_full_image_header_transparent', PADDLE_DEFAULT_OPTION['banner_full_image_header_transparent'] );
		$banner_overlay_opacity = get_theme_mod( 'banner_overlay_opacity', PADDLE_DEFAULT_OPTION['banner_overlay_opacity'] );
		$banner_navlink_text_color = paddle_theme_get_color( 'banner_navlink_text_color' );
		$banner_navlink_text_color_hover = paddle_theme_get_color( 'banner_navlink_text_color_hover' );
		$banner_navlink_text_color_active = paddle_theme_get_color( 'banner_navlink_text_color_active' );
		$content_spacing = absint(get_theme_mod( 'banner_header_content_spacing', PADDLE_DEFAULT_OPTION['banner_header_content_spacing'] ));
		$paddle_banner_arrow_button = get_theme_mod( 'banner_arrow_button', PADDLE_DEFAULT_OPTION['banner_arrow_button'] );
		$cta_padding = explode(',',get_theme_mod('banner_button_padding', PADDLE_DEFAULT_OPTION['banner_button_padding'])); 
		$btn_padding_top = !empty($cta_padding[0]) ? $cta_padding[0] : '0';
		$btn_padding_right = !empty($cta_padding[1]) ? $cta_padding[1] : '0';
		$btn_padding_bottom = !empty($cta_padding[2]) ? $cta_padding[2] : '0';
		$btn_padding_left = !empty($cta_padding[3]) ? $cta_padding[3] : '0';

		if (1 === absint($banner_box_shadow)) {
			$box_shadow_value .= '
			box-shadow: 0 2px 18px 0 rgba(129, 162, 182,0.12);
			';
		}
		

		$banner_css .= '
		.Banner a {
			color: '.$text_color.';
			text-decoration: none;
		}
		.Banner {
			position: relative;
			display: flex;
			left: 0;
			margin-left: 0;
			width: 100%;
			min-height: '.$paddle_banner_height.'vh;
			/*margin: 0px 0px -101px 0;*/
		}
		@media (min-width:992px) {
			.Banner {
				min-width: '.$paddle_banner_image_width_page.'px;
			}
		}
			.Banner__hero {
			display: flex;
			margin: 0 auto;
			position: relative;
			width: 100%;
			background: linear-gradient(90.13deg, '.$banner_bg_color.' -3.85%, '.$banner_bg_gradient.' 92.37%);
			}
			.Banner__content {
				width: 100%;
				width: 100%;
				overflow: visible;
				position: relative;
				padding: 32px 0;
			}
			@media (min-width:992px) {
				.Banner__content {
					padding: '.$padding_top.'px 0px '.$padding_bottom.'px 0px;
				}
			}
			.Banner__media-layout {
			height: 100%;
			width: 100%;
			left: 0;
			overflow: hidden;
			position: absolute;
			top: 0;
		}
		.Banner__color-underlay {
			height: 100%;
			position: absolute;
			top: 0;
			width: 100%;
			color: '.$text_color.';
			background-image: none;
		}';


		$banner_css .='
		.Banner__media {
			width: 100%;
			height: 100%;
			left: 0px;
			top: 0px;
			will-change: transform;
			transform: translate3d(0px, 0px, 0px);
		}
		.Banner__image {
			height: 100%;
			position: absolute;
			top: 0;
			width: 100%;
		}
		.Banner__image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			object-position: 50% 50%;
		}
		
		@media (min-width: 576px) {
			.Banner__details-container:not(.banner-no-image) {
				max-width: 500px;
			}
		}
		@media (min-width: 768px) {
			.Banner__details-container:not(.banner-no-image) {
				max-width: 530px;
				padding-right: 2.5rem;
				padding-left: 2.5rem;
			}
		}

		.Banner__details {
			align-items: center;
			display: flex;
			justify-content: '.$banner_alignment.';
			height: 100%;
			width: 100%;
			max-width: '.$paddle_banner_image_width_page.'px;
			padding-left: 30px;
    		padding-right: 30px;
			margin: 0 auto; 
			position: relative;
			color: '.$text_color.';
			z-index: 1;
		}
		@media (min-width: '.$paddle_banner_image_width_page.'px) {
			padding-left: 0px;
    		padding-right: 0px
		}
		.Banner__details-container {
			position: static;
			height: auto;
			width: 100%;
			background-color: '. $content_bgcolor.';
			padding: 2rem;
			'.$box_shadow_value.';
			flex-direction: column;
			display: flex;
			gap: '.$content_spacing.'px;
		}

		.Banner__detail-heading {
			height: auto;
			position: relative;
		}
		.Banner__detail-heading h1, .Banner__detail-heading h2 {
			color: '.$banner_title_color.';
			font-size: '.$header_font_size.'px;
			font-weight: '.$header_font_weight.';
		}
		.Banner__buttons.banner__button {
			text-align: '.$banner_button_align.';
		}

		.Banner__buttons a.button {
			display:flex;
			gap: 9px;
    		align-items: center;
			width: fit-content;
			background-color: '.$button_bgcolor.';
			color: '.$link_color.';
			text-transform: '.$button__text_transform.';
			padding-top: '.$btn_padding_top.'px;
			padding-bottom: '.$btn_padding_bottom.'px;
			padding-right: '.$btn_padding_right.'px;
			padding-left: '.$btn_padding_left.'px;
		}
		.Banner__buttons a:hover {
			color: '.$link_color_hover.';
		}
		';
		if (0 === absint($button_border)) {
			$banner_css .= '
			.Banner__buttons a {
				border-color: transparent;
			}';
		}
		if (1 === absint($paddle_banner_arrow_button)) {
			$banner_css .= '
			.Banner__buttons svg {
				width: 1em;
				height: auto;
				fill: '.$link_color.';
			}
			.Banner__buttons a:hover svg {
				fill: '.$link_color_hover.';
			}
			';
		}
		if ( 10 !== $bg_opacity && '' !== $content_bgcolor ) {
			
			$banner_css .= '.Banner__details-container  { 
				background-color: ' . paddle_rgba( $content_bgcolor, $bg_opacity ) . ';
			} ';
		}
		
	
		if ($paddle_banner_image_width_page > 50) {
			$banner_css.='.PageBanner__image img {
				width: '.$paddle_banner_image_width_page.'%;
				transform: translateY(-15%);
			}';
		}

		if($half_banner) {
			$banner_css .='
			.Banner__media-layout {
				width: 50%;
				right: 0;
				left: unset;
			}
			
		
			
			';
		}
		if($half_banner && 0 === absint($fit_image) && 1 ===  absint($fit_image_full_height)) {
			$banner_css .= '
			.Banner__image img {
				object-fit: cover;
			}';
		} elseif($half_banner) {
			$banner_css .= '
			.Banner__image img {
				object-fit: contain;
			}';
		}


		if($half_banner && 'right' === $banner_button_align) {
			$banner_css .='
			.Banner__buttons.banner__button {
				position: absolute;
				right: 0;
				bottom:0;
			}
			';
		}

		if($half_banner && 'right' === $banner_alignment) {
			$banner_css .='
			.Banner__media-layout {
				width: 50%;
				right: unset; 
				left: 0;
			}
			';
		}
		//____ Same Content Split / Image

		if($half_banner && $fit_image) {
			$banner_css .= '
			.Banner__content {
				display: flex;
				flex-direction: column; /* mobile */
				max-width: 1200px;
				margin: 0 auto;
				padding: 0; /* mobile */

			}

			/*
			@media (min-width:922px) {
				.Banner__content {
					width: 1200px;
    				margin: 0 auto;
				}
			}
			*/
		
			@media (min-width:768px) {
				.Banner__content {
					padding: '.$padding_top.'px 0px '.$padding_bottom.'px 0px;
					flex-direction: row;
				}
			}
			/*
			.Banner__image img {
				object-fit: contain;
			} */
			
			.Banner__media-layout {
				position: unset; 
				flex-basis: unset; /* For full width image */
				order : -1; /* mobile */
			}
			@media (min-width:768px) {
				.Banner__media-layout {
					flex-basis: 50%; 
					'.$image_order.'
				}
			}
			
			.Banner__color-underlay {
			  position: unset; 
			 
			}
			
			.Banner__media-layout {
				 width: 100%; 
			   }
			   
			   .Banner__image {
				position: unset; 
			}
			
			.Banner__details {
					width: unset; 
					flex-basis: 50%;
				}
				
			';
		}

		//*
		//___ Overlay 
		if ( absint($banner_overlay_opacity)  > 0) {
		
		$banner_css .= '
		.Banner__content::after {
			background-color: transparent;
			background-image: linear-gradient(90.13deg, '.$banner_bg_color.' -3.85%, '.$banner_bg_gradient.' 92.37%);
			opacity: .'.absint($banner_overlay_opacity).';
			content: "";
			position: absolute;
			width: 100%;
			height: 100%;
			top: 0;
			bottom: 0;
			right: 0;
			left: 0;
		}
		';
		}
		//*/

	

	if($transparent_header) :
		//__ Transparent Header add css to site-header for overlay enable, then add banner css. Step 1
		$banner_css .= '
		.site-header {height: 0; }
		.Banner__content {
			padding-top: 200px;
		}
		';
		
		$banner_css .= '
		@media (max-width:380px) {
			.Banner__content {
				padding-top: 220px;
			}
		}
		';

		//___ step 2 add the css below to site-header>.container. Since the header height is 0, we can't add color to it.
		$banner_css .= '
		.site-header>.container::before, .site-header>.nav-primary::before, .site-header>.site-branding::before {
			background-color: rgba(0,0,0,0.07);
		}
		';

		//__ Menu
		$banner_css .= '
		@media (min-width:992px) {
			#main-header-navigation li a:not(.btn) {
				color: '.$banner_navlink_text_color.'!important;
			}
			#main-header-navigation li a:not(.btn):hover {
				color: '.$banner_navlink_text_color_hover.'!important;
			}
			#main-header-navigation li a:not(.btn):active {
				color: '.$banner_navlink_text_color_active.'!important;
			}
			#main-header-navigation .submenu-expand svg {
				fill: '.$banner_navlink_text_color.'!important;
			}
		}
		.toggler button.navbar-toggler span,
		.site-header button.searchsubmit::before, .btn.button-search::before
		 {
			background-color: '.$banner_navlink_text_color.'!important;
		}
		.site-header button.searchsubmit::after, .btn.button-search::after {
			border-color: '.$banner_navlink_text_color.'!important;
		}
		';

	endif;
	


		
		
	}

	if(is_home() || is_front_page()) {
		return $banner_css;
	}
}


