<?php

/**
 * Check and setup theme's default settings
 *
 * @package paddle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Set secondary color
 *
 * @return  string
 */

if ( ! function_exists( 'paddle_convert_rgba_to_hex' ) ) {
	function paddle_convert_rgba_to_hex( $opacity, $color ) {

		$color_with_opacity = $color . strval( $opacity );
		if ( preg_match( '|^#([A-Fa-f0-9]{4}){1,2}$|', $color_with_opacity ) ) {
			return strval( $color_with_opacity );
		}

	}
}

if ( ! defined( 'PADDLE_PRIMARY_COLOR' ) ) {
	$primary_color = get_theme_mod( 'paddle_primary_color' ) ? sanitize_hex_color( get_theme_mod( 'paddle_primary_color' ) ) : '#000000';
	define( 'PADDLE_PRIMARY_COLOR', $primary_color );
}
/**
* Set our Customizer default options
*/
if ( ! function_exists( 'paddle_generate_defaults' ) ) {
	function paddle_generate_defaults() {
		$customizer_defaults = array(
			'social_newtab'                           => 0,
			'social_urls'                             => '',
			'social_alignment'                        => 'alignright',
			'social_rss'                              => 0,
			'social_url_icons'                        => '',
			'contact_phone'                           => '',
			'search_menu_icon'                        => 0,
			'woocommerce_shop_sidebar'                => 1,
			'woocommerce_product_sidebar'             => 0,
			'paddle_remove_woo_single_sidebar'        => 0,
			'paddle_header_layout_style'              => 'paddle-header-1',
			'paddle_typography_preset'                => 'system-font',
			'paddle_header_search_button'             => 1,
			'paddle_header_search_button_type'        => 'icon',
			'paddle_header_search_button_type_mobile' => 'icon',
			'paddle_header_search_icon_color'         => get_theme_mod( 'paddle_theme_color_links', '#016edb' ),
			'paddle_header_cta'                       => 0,
			'paddle_header_cta_position'              => 0,
			'cta_separated'                           => 1,
			'header_logo_size'                        => 150,
			'base_font_size'                          => 16,
			'h1_font_size'                            => 44,
			'h2_font_size'                            => 28,
			'h3_font_size'                            => 24,
			'h4_font_size'                            => 20,
			'h5_font_size'                            => 18,
			'h6_font_size'                            => 16,
			'paragraph_margin_bottom'                 => 24,
			'h1_font_weight'                          => '600',
			'h2_font_weight'                          => '500',
			'header_logo_padding'                     => 16,
			'header_custom_container'				  => 'default',
			'header_custom_container_width'			  => 1200,

			'paddle_menu_spacing'                     => 'wrap',
			'paddle_menu_capitalization'              => 'none',
			'paddle_menu_items_alignment'             => 'centered',
			'paddle_menu_bgcolor'                     => '#FFFFFF',
			'paddle_banner_header_bg_color'           => '#FFFFFF',
			'paddle_navlink_text_color'               => get_theme_mod( 'paddle_theme_color_body_text', '#2a3a51' ),
			'paddle_navlink_text_color_hover'         => get_theme_mod( 'paddle_theme_color_links_hover', '#0357ab' ),
			'paddle_navlink_text_color_active'        => get_theme_mod( 'paddle_theme_color_links_active', '#2a3a51' ),

			'enable_top_bar'                          => 0,
			'enable_top_bar_on_mobile'                => 0,
			'topbar_border_bottom' 					  => 1,
			'topbar_bgcolor' 						  => '',
			'topbar_text_color'						  => get_theme_mod( 'paddle_theme_color_body_text', '#2a3a51' ),
			'topbar_link_color'						  => get_theme_mod( 'paddle_theme_color_links', '#2a3a51' ),
			'topbar_link_color_hover'			      => get_theme_mod( 'paddle_theme_color_links_hover', '#0357ab' ),
			'topbar_border_color'					  => get_theme_mod( 'paddle_theme_color_border', '#e7e7e7' ),
			'topbar_height'                           => 40,
			'topbar_font_size'						  => 14,
			'paddle_contact_phone'                    => '',
			'topbar_select'                           => 'button',
			'top_bar_info_align'					  => 'left',
			'top_bar_content_align'					  => 'center',
			'top_bar_social_align'					  => 'right',
			'hide_top_bar_info_mobile'				  => 0,
			'hide_top_bar_social_mobile'			  => 1,
			'hide_top_bar_menu_mobile'				  => 1,
			'hide_top_bar_content_mobile'			  => 1,
			'topbar_content_menu' 					  => '',
			'topbar_content_select'					  => 'content',
			'enable_icon_bg'                          => 0,
			'paddle_primary_color'                    => PADDLE_PRIMARY_COLOR,
			'paddle_h1bg_color'                       => PADDLE_PRIMARY_COLOR,
			'paddle_theme_color_body_bg'              => '#FFFFFF',
			'paddle_theme_color_body_text'            => '#2a3a51',
			'paddle_theme_color_headings'             => '#182230',
			'paddle_theme_color_headings_hover'       => '#0357ab',
			'paddle_theme_color_buttons'              => '#016edb',
			'paddle_theme_color_buttons_hover'        => '#0357ab',
			'paddle_theme_color_links'                => '#016edb',
			'paddle_theme_color_links_hover'          => '#0357ab',
			'paddle_theme_color_border'               => '#e7e7e7',
			'paddle_secondary_color'                  => paddle_convert_rgba_to_hex( '08', PADDLE_PRIMARY_COLOR ),
			'paddle_h1_alignment'                     => 'left',
			'enable_secondary_color'                  => 0,
			'opacity_slider_control'                  => 2,
			'post_archive_layout'                     => 'grid',
			'paddle_footer_logo'                      => 0,
			'paddle_footer_about_enable'			  => 0,
			'paddle_footer_about'					  => get_bloginfo("description"),
			'paddle_sidebar_position'                 => 'no-sidebar',
			'paddle_sidebar_position_page'            => 'no-sidebar',
			'paddle_sidebar_position_archive'         => 'no-sidebar',
			'paddle_sidebar_position_home'            => 'no-sidebar',
			'paddle_footer_social'                    => 1,
			'paddle_theme_credit'                     => 0,
			'footer_bottom_border_top' 				  => 0,
			'footer_bottom_bgcolor'					  => '',
			'paddle_slider_source'                    => 'latest-post',
			'header_media_select'                     => 'none',
			'paddle_expand_grid_image'                => 1,
			'header_banner_button_1'                  => 'Learn more',
			'header_banner_button_2'                  => '',
			'paddle_header_cta_text'                  => 'CTA Button',
			'topbar_header_button_text'               => '',
			'paddle_privacy_policy'                   => 0,
			'footer_social_urls'                      => '',
			'social_icon_width'						  => 20,
			'footer_urls'							  => '',
			'footer_urls_position'					  => 'left',
			'payment_badge_source'					  => 'svg',
			'payment_badge_image' 					  => '',
			'enable_payment_badge'					  => 1,
			'payment_badge_color'					  => 'gray',
			'paddle_grid_columns'                     => '2-columns',
			'paddle_enable_author_bio'                => 1,
			'paddle_enable_archive_author'            => 1,
			'paddle_enable_archive_category'          => 1,
			'paddle_enable_archive_comment'           => 0,
			'paddle_enable_archive_tag'               => 0,
			'paddle_enable_archive_published_date'    => 0,
			'header_menu_padding'                     => 15,
			'menu_item_margin'                        => 16,
			'paddle_enable_blog_author'               => 1,
			'paddle_enable_blog_author_bio'           => 0,
			'paddle_enable_blog_category'             => 1,
			'paddle_enable_blog_comment'              => 0,
			'paddle_enable_blog_tag'                  => 0,
			'paddle_enable_blog_published_date'       => 1,
			'paddle_enable_blog_updated_date'         => 1,
			'paddle_blog_date_position'               => 'before',
			'paddle_author_link_position'			  => 'before',
			'menu_border_top'                         => 1,
			'menu_border_bottom'                      => 1,
			'paddle_header_border_color'              => get_theme_mod( 'paddle_theme_color_border', '#e7e7e7' ),
			'paddle_header_mobile_layout'             => 'mobile-header-1',
			'use_default_banner_image'                => 1,
			'paddle_thumbnail_size'                   => 'paddle-featured-image',
			'paddle_thumbnail_size_page'              => 'paddle-featured-image',
			'paddle_archive_thumbnail_size'			  => 'paddle-small-thumb',
			'paddle_blog_style'						  => '0',
			'site_title_font_size'                    => 18,
			'excerpt_length'                          => 55,
			'read_more_text'                          => 'Continue reading',
			'enable_blog_excerpt'                     => 1,
			'enable_image_before_site_title'          => 1,
			'enable_archive_featured_image'           => 1,
			'paddle_header_logo_align'                => 'self-start',
			'paddle_caption_width'                    => 'fit-content',
			'caption_over_image'					  => 1,
			'paddle_thumbnail_alignment'              => 'left',
			'use_full_bootstrap'                      => 0,
			'use_bootstrap_js'                        => 0,
			'header_cta_padding_left'                 => 0,
			'paddle_theme_content_width'              => 1200,
			'custom_container'                        => 'default',
			'placeholder_text_posted_on'              => 'Posted on',
			'placeholder_text_updated_on'             => 'Updated on',
			'paddle_theme_button_global'              => 'bordered,rounded',
			'paddle_navigation_type'				  => 'number',
			'paddle_split_menu_options'               => 'padding',
			'footer_logo_image'                       => '',
			'footer_image_width'					  => 80,
			'footer_1_header_1'						  => 'Heading',
			'footer_1_content_type'					  => 'menu',
			'footer_1_menu'							  => '',
			'footer_1_editor'						  => '',
			'footer_1_container_width'				  => '25',
			'footer_1_menu_count'					  => 1,
			'footer_1_menu_enable'					  => 1,
			'footer_1_content_align'				  => 'left',

			'footer_2_header_1'						  => 'Heading',
			'footer_2_content_type'					  => 'menu',
			'footer_2_menu'							  => '',
			'footer_2_editor'						  => '',
			'footer_2_container_width'				  => '25',
			'footer_2_menu_count'					  => 1,
			'footer_2_menu_enable'					  => 1,
			'footer_2_content_align'				  => 'left',

			'footer_3_header_1'						  => 'Heading',
			'footer_3_content_type'					  => 'menu',
			'footer_3_menu'							  => '',
			'footer_3_editor'						  => '',
			'footer_3_container_width'				  => '25',
			'footer_3_menu_count'					  => 1,
			'footer_3_menu_enable'					  => 1,
			'footer_3_content_align'				  => 'left',

			'footer_4_header_1'						  => 'Heading',
			'footer_4_content_type'					  => 'menu',
			'footer_4_menu'							  => '',
			'footer_4_editor'						  => '',
			'footer_4_container_width'				  => '25',
			'footer_4_menu_count'					  => 1,
			'footer_4_menu_enable'					  => 1,
			'footer_4_content_align'				  => 'left',

			'footer_bgcolor'                     => '#ffffff',
			'footer_text_color' => get_theme_mod( 'paddle_theme_color_body_text', '#2a3a51' ),
			'footer_navlink_text_color'               => get_theme_mod( 'paddle_theme_color_body_text', '#2a3a51' ),
			'footer_navlink_text_color_hover'         => get_theme_mod( 'paddle_theme_color_links_hover', '#0357ab' ),
			'footer_bg_image' => '',
			'footer_bg_image_overlay' => '#000000',
			'footer_bg_overlay_opacity' => 0,
			'footer_bg_image_attachment' => 'inherit',
			'footer_widget_column' => '1',
			'footer_widget_position' => 'bottom',
			'footer_social_column' => 'none',
			'footer_social_position' => 'bottom',
			'footer_bottom_layout' => 'column',
			'payment_badge_textarea' => 'master,paypal,visa',
			'payment_badge_image_h' => 30,
			'footer_payment_badge_column' => 'top',

			'paddle_page_header_type'	=> 'PageBanner',
			'banner_height_page' => 22,
			'banner_parent_title_page' => 0,
			'banner_image_width_page' => 50,
			'paddle_banner_alignment_page'		=> 'left',
			'paddle_banner_image_position_page'			=> 'right',
			'banner_author_page'			=> 0,
			'banner_published_date_page' => 0,
			'banner_excerpt_page' => 0,
			'default_page_header_spacing' => 5,
			'default_page_horizontal_align' => 'left',
			'default_page_header_title_position' => 'before',

			'paddle_banner_border_radius'             => 1,
			'header_media_height'                     => 60,
			'banner_arrow_button'                     => 0,
			'paddle_banner_box_shadow'                => 0,
			'banner_content_bg_opacity'               => get_theme_mod( 'banner_content_bg_opacity', 10 ),
			'paddle_banner_desc_color'              => get_theme_mod( 'paddle_theme_color_body_text', '#2a3a51' ),
			'paddle_banner_header_bg_color'           => '#ffffff',
			'hero_image'                              => 0,
			'paddle_slider_custom_url'                => 0,
			'hero_custom_container'					 => 'default',
			'hero_container_width'					 => 1200,
			'title_options_hero' 					 => 'general',
			'header_banner_title'                     => 'Paddle - The WAY Forward',
			'header_banner_description'               => 'Go Forward and Conquer',
			'banner_title_color'					  => get_theme_mod( 'paddle_theme_color_headings', '#2a3a51' ),
			'banner_button_bgcolor'					  => '',
			'banner_link_color'					  	  => get_theme_mod( 'paddle_theme_color_links', '#016edb' ),
			'banner_link_hover_color'				  => get_theme_mod( 'paddle_theme_color_links_hover', '#0357ab' ),
			'banner_button_align'                     => 'right',
			'banner_button_transform'                 => 'uppercase',
			'paddle_banner_bg_gradient'               => '#ffffff',
			'banner_content_bgcolor'				  => '',
			'banner_header_htmltag'					  => 'h1',
			'banner_header_font_size'				  => get_theme_mod( 'h1_font_size', 44),
			'banner_font_weight'					  => get_theme_mod( 'h1_font_weight', '600'),
			'banner_fit_image'						  => 0,
			'banner_fit_image_full_height'					  => 1,
			'banner_padding_top'					  => 120,
			'banner_padding_bottom'					  => 120,
			'banner_image_style'					  => 'half',
			'banner_content_align'                    => 'left',
			'banner_content_align_2'                    => 'right',
			'banner_overlay_opacity'                  => 0,
			'banner_full_image_header_transparent'	  => 0,
			'banner_navlink_text_color'               => get_theme_mod( 'paddle_theme_color_body_text', '#2a3a51' ),
			'banner_navlink_text_color_hover'         => get_theme_mod( 'paddle_theme_color_links_hover', '#0357ab' ),
			'banner_navlink_text_color_active'        => get_theme_mod( 'paddle_theme_color_links_active', '#2a3a51' ),
			
		);

		return apply_filters( 'paddle_customizer_defaults', $customizer_defaults );
	}
}

$defaults_options = paddle_generate_defaults();
	define( 'PADDLE_DEFAULT_OPTION', $defaults_options );

if ( ! defined( 'PADDLE_DEFAULT_OPTION' ) ) {
	$defaults_options = paddle_generate_defaults();
	define( 'PADDLE_DEFAULT_OPTION', $defaults_options );
}

if ( ! defined( 'PADDLE_PRIMARY_COLOR' ) ) {
	// Replace the version number of the theme on each release.
	$primary_color = get_theme_mod( 'paddle_primary_color', PADDLE_DEFAULT_OPTION['paddle_primary_color'] ) ? sanitize_hex_color( get_theme_mod( 'paddle_primary_color', PADDLE_DEFAULT_OPTION['paddle_primary_color'] ) ) : '#000000';
	define( 'PADDLE_PRIMARY_COLOR', $primary_color );
}

/**
 * Dynamic CSS
 */
if ( ! function_exists( 'paddle_static_header_css' ) ) {

	/**
	 * Styles the header.
	 */
	function paddle_static_header_css() {
		$paddle_theme_color_accent         = paddle_theme_get_color( 'paddle_primary_color' );
		$paddle_theme_color_headings       = paddle_theme_get_color( 'paddle_theme_color_headings' );
		$paddle_theme_color_body_text      = paddle_theme_get_color( 'paddle_theme_color_body_text' );
		$paddle_theme_color_body_bg        = paddle_theme_get_color( 'paddle_theme_color_body_bg' );
		$paddle_theme_color_headings_hover = paddle_theme_get_color( 'paddle_theme_color_headings_hover' );
		$paddle_theme_color_buttons        = paddle_theme_get_color( 'paddle_theme_color_buttons' );

		$paddle_theme_color_buttons_hover  = paddle_theme_get_color( 'paddle_theme_color_buttons_hover' );
		$paddle_theme_color_links          = paddle_theme_get_color( 'paddle_theme_color_links' );
		$paddle_theme_color_links_hover    = paddle_theme_get_color( 'paddle_theme_color_links_hover' );
		$paddle_theme_color_search_icon    = paddle_theme_get_color( 'paddle_header_search_icon_color' );
		$paddle_theme_color_border         = paddle_theme_get_color( 'paddle_theme_color_border' );
		$primary_color                     = sanitize_hex_color( get_theme_mod( 'paddle_primary_color', PADDLE_PRIMARY_COLOR ) );

		$body_font_size          = absint( get_theme_mod( 'base_font_size', PADDLE_DEFAULT_OPTION['base_font_size'] ) );
		$h1_font_size            = absint( get_theme_mod( 'h1_font_size', PADDLE_DEFAULT_OPTION['h1_font_size'] ) );
		$h2_font_size            = absint( get_theme_mod( 'h2_font_size', PADDLE_DEFAULT_OPTION['h2_font_size'] ) );
		$h3_font_size            = absint( get_theme_mod( 'h3_font_size', PADDLE_DEFAULT_OPTION['h3_font_size'] ) );
		$h4_font_size            = absint( get_theme_mod( 'h4_font_size', PADDLE_DEFAULT_OPTION['h4_font_size'] ) );
		$h5_font_size            = absint( get_theme_mod( 'h5_font_size', PADDLE_DEFAULT_OPTION['h5_font_size'] ) );
		$h6_font_size            = absint( get_theme_mod( 'h6_font_size', PADDLE_DEFAULT_OPTION['h6_font_size'] ) );
		$h1_font_weight          = get_theme_mod( 'h1_font_weight', PADDLE_DEFAULT_OPTION['h1_font_weight'] );
		$h2_font_weight          = get_theme_mod( 'h2_font_weight', PADDLE_DEFAULT_OPTION['h2_font_weight'] );
		$paragraph_margin_bottom = absint( get_theme_mod( 'paragraph_margin_bottom', PADDLE_DEFAULT_OPTION['paragraph_margin_bottom'] ) );
		$font_type               = get_theme_mod( 'paddle_typography_preset', PADDLE_DEFAULT_OPTION['paddle_typography_preset'] );
		$font_family             = '' !== paddle_get_font_type() ? paddle_get_font_type() : '-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji';

		// icon color switch
		$paddle_header_search_button_type        = get_theme_mod( 'paddle_header_search_button_type', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type'] );
		$paddle_header_search_button_type_mobile = get_theme_mod( 'paddle_header_search_button_type_mobile', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type_mobile'] );

		// Menu
		$paddle_menu_capitalization = get_theme_mod('paddle_menu_capitalization', PADDLE_DEFAULT_OPTION['paddle_menu_capitalization'] );
		$paddle_menu_bgcolor = paddle_theme_get_color( 'paddle_menu_bgcolor' ) ? paddle_theme_get_color( 'paddle_menu_bgcolor' ) : 'transparent';
		$paddle_navlink_text_color = paddle_theme_get_color( 'paddle_navlink_text_color' );
		$paddle_navlink_text_color_hover = paddle_theme_get_color( 'paddle_navlink_text_color_hover' );
		$paddle_navlink_text_color_active = paddle_theme_get_color( 'paddle_navlink_text_color_active' );

		//--paddle-header-content-width
		$header_content_max_width   = absint( get_theme_mod( 'header_custom_container_width', PADDLE_DEFAULT_OPTION['header_custom_container_width'] ) );

		if($header_content_max_width > 2400 && 'custom' === get_theme_mod('header_custom_container', 'default') ) {
			$header_content_max_width = '100%';
		} else {
			if ('custom' === get_theme_mod('header_custom_container', 'default') ) {
				$header_content_max_width = absint( get_theme_mod( 'header_custom_container_width', PADDLE_DEFAULT_OPTION['header_custom_container_width'] ) ).'px';
			} else {
				$header_content_max_width = '1200px';
			}

			
		}


		$css = '';

		// Variables.

		$css.= ':root {';
			$css .= '
			--paddle-color-0: ' . $paddle_theme_color_headings . ';
			--paddle-color-1 : ' . $paddle_theme_color_buttons . ';
			--paddle-color-2 : ' . $paddle_theme_color_links_hover . ';
			--paddle-color-3 : ' . $paddle_theme_color_body_text . ';
			--paddle-color-4 : ' . $paddle_theme_color_border . ';  
			--paddle-color-accent : ' . $primary_color . '; 
			--paddle-color-5: #FFFFFF;
  			--paddle-color-6: #f1f1f1;
			--paddle-color-7: ' . $paddle_theme_color_search_icon . ';
			--paddle-color-body-bg: ' . $paddle_theme_color_body_bg . ';
			';
			$css .= '--paddle-header-menu-bg-color:' . $paddle_menu_bgcolor . ';';
			$css .= '--paddle-header-menu-color:' . $paddle_navlink_text_color . ';';
			$css .= '--paddle-header-menu-hover:' . $paddle_navlink_text_color_hover . ';';
			$css .= '--paddle-header-menu-active:' . $paddle_navlink_text_color_active . ';';
			$css .= '--paddle-active-bg-color:' . paddle_rgba($paddle_theme_color_buttons, 6) . ';';
			$css .='
			--paddle-font-body-family: ' . $font_family . ';
			--paddle-font-body-size: ' . $body_font_size . 'px;';

			$css .= '--paddle-font-h1-size: ' . $h1_font_size . 'px;';
			$css .= '--paddle-font-h2-size: ' . $h2_font_size . 'px;';
			$css .= '--paddle-font-h3-size: ' . $h3_font_size . 'px;';
			$css .= '--paddle-font-h4-size: ' . $h4_font_size . 'px;';
			$css .= '--paddle-font-h5-size: ' . $h5_font_size . 'px;';
			$css .= '--paddle-font-h6-size: ' . $h6_font_size . 'px;';

			$css .= '--paddle-font-h1-weight:' . $h1_font_weight . ';';
			$css .= '--paddle-font-h2-weight:' . $h2_font_weight . ';';
			$css .= '--paddle-paragraph-m-bottom:' . $paragraph_margin_bottom . 'px;';

			$css .= '--paddle-page-width: ' . paddle_get_content_width() . 'px;';
			$css .= '--paddle-page-width-margin:0;';

			//Menu
			$css .= '--paddle-header-menu-case:' . $paddle_menu_capitalization . ';';

			// Content Width
			$css .= '--paddle-header-content-width: ' . $header_content_max_width . ';';
			

		$css .= '}';

		// Retrun all css

		return paddle_minimize_css( $css );
	}
}




/**
 * Display Dynamic CSS in the document header.
 */
function paddle_output_header_css() {
	if ( ! empty( paddle_static_header_css() ) ) : ?>
<style type="text/css" id="paddle-dynamic-css"><?php /* Static html */ echo paddle_static_header_css();?> </style>
	<?php
	endif;
}
add_action( 'wp_head', 'paddle_output_header_css', 5 );

function paddle_sanitize_hex_color( $color ) {
	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}
}

