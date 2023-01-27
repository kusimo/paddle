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
	$primary_color = get_theme_mod( 'paddle_primary_color') ? sanitize_hex_color( get_theme_mod( 'paddle_primary_color')) : '#000000';
	define( 'PADDLE_PRIMARY_COLOR', $primary_color );
}
/**
* Set our Customizer default options
*/
if ( ! function_exists( 'paddle_generate_defaults' ) ) {
	function paddle_generate_defaults() {
		$customizer_defaults = array(
			'social_newtab'                 => 0,
			'social_urls'                   => '',
			'social_alignment'              => 'alignright',
			'social_rss'                    => 0,
			'social_url_icons'              => '',
			'contact_phone'                 => '',
			'search_menu_icon'              => 0,
			'woocommerce_shop_sidebar'      => 1,
			'woocommerce_product_sidebar'   => 0,
			'paddle_header_layout_style'    => 'logo-left-style-2',
			'paddle_typography_preset'      => 'system-font',
			'paddle_header_search_button'   => 1,
			'paddle_header_cta'             => 0,
			'paddle_header_cta_position'	=> 0,
			'header_media_height'           => 60,
			'header_logo_size'              => 150,
			'base_font_size'                => 16,
			'h1_font_size'                  => 44,
			'h2_font_size'                  => 28,
			'h3_font_size'                  => 24,
			'h4_font_size'                  => 20,
			'h5_font_size'                  => 18,
			'h6_font_size'                  => 16,
			'paragraph_margin_bottom'		=> 24,
			'h1_font_weight'				=> '600',
			'h2_font_weight'				=> '500',
			'header_logo_padding'           => 16,
			'paddle_menu_text_to_uppercase' => 0,
			'paddle_menu_items_alignment'   => 'centered',
			'enable_top_bar'                => 0,
			'enable_top_bar_on_mobile'      => 0,
			'paddle_contact_phone'          => '',
			'topbar_select'                 => 'button',
			'enable_icon_bg'                => 0,
			'paddle_enable_banner_bgcolor'  => 1,
			'paddle_banner_border_radius'   => 1,
			'paddle_title_headings_solid_lines' => 0,
			'paddle_remove_woo_single_sidebar' => 0,
			'banner_arrow_button'			=> 0,
			'paddle_banner_box_shadow'      => 0,
			'banner_content_bg_opacity'     => get_theme_mod('banner_content_bg_opacity', 9),
			'paddle_menu_bgcolor'           => '#ffffff',
			'paddle_navlink_text_color'     => '#3c434a',
			'paddle_banner_header_color'    => '#ffffff',
			'paddle_banner_header_bg_color' => '#3e3c3c',
			'paddle_primary_color'          => PADDLE_PRIMARY_COLOR,
			'paddle_h1bg_color'			    => PADDLE_PRIMARY_COLOR,
			'paddle_theme_color_body_text'	=> '#2a3a51',
			'paddle_theme_color_headings'   => '#182230',
			'paddle_theme_color_headings_hover'   => '#0357ab',
			'paddle_theme_color_buttons'	=> '#016edb',
			'paddle_theme_color_buttons_hover'	=> '#0357ab',
			'paddle_theme_color_links'	    => '#016edb',
			'paddle_theme_color_links_hover' => '#0357ab',
			'paddle_theme_color_border'	    => '#e7e7e7',
			'paddle_secondary_color'        => paddle_convert_rgba_to_hex( '08', PADDLE_PRIMARY_COLOR ),
			'paddle_h1_alignment'           => 'left',
			'enable_secondary_color'        => 0,
			'opacity_slider_control'        => 2,
			'post_archive_layout'			=> 'grid',
			'paddle_footer_logo'			=> 0,
			'hide_archive_meta'				=> 0,
			'paddle_sidebar_position'		=> 'no-sidebar',
			'paddle_footer_social'			=> 1,
			'banner_align_position'			=> 'none',
			'banner_content_align'			=> 'left',
			'banner_overlay_opacity'		=> 2,
			'paddle_theme_credit'			=> 0,
			'paddle_slider_source'			=> 'latest-post',
			'header_media_select'			=> 'none',
			'paddle_expand_grid_image'		=> 1,
			'paddle_enable_content_over_banner'	=> 1,
			'content_over_banner_position'  => 0,
			'header_banner_button_1'			=> 'Learn more',
			'header_banner_button_2'			=> '',
			'paddle_header_cta_text'			=> 'CTA Button',
			'topbar_header_button_text'		=> '',
			'paddle_privacy_policy'			=> 0,
			'footer_social_urls'			=> '',
			'hero_image'					=> 0,
			'paddle_slider_custom_url'		=> 0,
			'header_banner_title'			=> 'Build Your Dream Website with Paddle',
			'header_banner_description'		=> 'Go Forward and Conquer',
			'paddle_grid_columns'			=> '2-columns',
			'paddle_enable_author_bio'		=> 1,
			'header_menu_padding'			=> 18,
			'menu_item_margin'			    => 16,
			'menu_border_top'				=> 1,
			'use_default_banner_image'      => 1,
			'paddle_thumbnail_size'			=> 'paddle-featured-image',
			'site_title_font_size'			=> 18,
			'excerpt_length'				=> 55,
			'read_more_text'				=> 'Continue reading',
			'enable_blog_excerpt'			=> 1,
			'enable_image_before_site_title' => 1,
			'enable_same_height_image'      => 1,
			'banner_button_align'			=> 'right',
			'banner_button_transform'		=> 'uppercase',
			'paddle_placeholder_image'      => 0,
			'paddle_header_logo_align'		=> 'self-start',
			'paddle_caption_width'			=> 'fit-content',
			'paddle_thumbnail_alignment'	=> 'left',
			'use_full_bootstrap'			=> 0,
			'use_bootstrap_js'				=> 0,
			'header_cta_padding_left'		=> 0,
			'container_width'				=> 1200,
			'custom_container'				=> 'default'
		);

		return apply_filters( 'paddle_customizer_defaults', $customizer_defaults );
	}
}

$defaults_options =  paddle_generate_defaults();
	define( 'PADDLE_DEFAULT_OPTION', $defaults_options );

if ( ! defined( 'PADDLE_DEFAULT_OPTION' ) ) {
	$defaults_options =  paddle_generate_defaults();
	define( 'PADDLE_DEFAULT_OPTION', $defaults_options );
}

if ( ! defined( 'PADDLE_PRIMARY_COLOR' ) ) {
	// Replace the version number of the theme on each release.
	$primary_color = get_theme_mod( 'paddle_primary_color', PADDLE_DEFAULT_OPTION['paddle_primary_color']) ? sanitize_hex_color( get_theme_mod( 'paddle_primary_color', PADDLE_DEFAULT_OPTION['paddle_primary_color'])) : '#000000';
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
		$paddle_theme_color_accent = paddle_theme_get_color('paddle_primary_color');
		$paddle_theme_color_headings = paddle_theme_get_color('paddle_theme_color_headings');
		$paddle_theme_color_body_text = paddle_theme_get_color('paddle_theme_color_body_text');
		$paddle_theme_color_headings_hover = paddle_theme_get_color('paddle_theme_color_headings_hover');
		$paddle_theme_color_buttons = paddle_theme_get_color('paddle_theme_color_buttons');
		$paddle_theme_color_buttons_hover = paddle_theme_get_color('paddle_theme_color_buttons_hover');
		$paddle_theme_color_links = paddle_theme_get_color('paddle_theme_color_links');
		$paddle_theme_color_links_hover = paddle_theme_get_color('paddle_theme_color_links_hover');
		$paddle_theme_color_border = paddle_theme_get_color('paddle_theme_color_border');
		$primary_color = sanitize_hex_color( get_theme_mod( 'paddle_primary_color', PADDLE_PRIMARY_COLOR ) );

		$body_font_size 						 = absint( get_theme_mod( 'base_font_size', PADDLE_DEFAULT_OPTION['base_font_size'] ) );
		$h1_font_size 						     = absint( get_theme_mod( 'h1_font_size', PADDLE_DEFAULT_OPTION['h1_font_size'] ) );
		$h2_font_size 						     = absint( get_theme_mod( 'h2_font_size', PADDLE_DEFAULT_OPTION['h2_font_size'] ) );
		$h3_font_size 						     = absint( get_theme_mod( 'h3_font_size', PADDLE_DEFAULT_OPTION['h3_font_size'] ) );
		$h4_font_size 						     = absint( get_theme_mod( 'h4_font_size', PADDLE_DEFAULT_OPTION['h4_font_size'] ) );
		$h5_font_size 						     = absint( get_theme_mod( 'h5_font_size', PADDLE_DEFAULT_OPTION['h5_font_size'] ) );
		$h6_font_size 						     = absint( get_theme_mod( 'h6_font_size', PADDLE_DEFAULT_OPTION['h6_font_size'] ) );
		$h1_font_weight                          = get_theme_mod( 'h1_font_weight', PADDLE_DEFAULT_OPTION['h1_font_weight'] );
		$h2_font_weight                          = get_theme_mod( 'h2_font_weight', PADDLE_DEFAULT_OPTION['h2_font_weight'] );
		$paragraph_margin_bottom 				 = absint( get_theme_mod( 'paragraph_margin_bottom', PADDLE_DEFAULT_OPTION['paragraph_margin_bottom'] ) );
		$font_type								 = get_theme_mod( 'paddle_typography_preset', PADDLE_DEFAULT_OPTION['paddle_typography_preset'] );
		$font_family 							 = '' !== paddle_get_font_type() ? paddle_get_font_type() : '-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji';

		$css = '';

		// Variables
		
		$css .= ':root {';
			$css .='
			--paddle-color-0: '.$paddle_theme_color_headings.';
			--paddle-color-1 : '.$paddle_theme_color_buttons.';
			--paddle-color-2 : '.$paddle_theme_color_links_hover.';
			--paddle-color-3 : '.$paddle_theme_color_body_text.';
			--paddle-color-4 : '.$paddle_theme_color_border.'; 
			--paddle-color-accent : '.$primary_color.'; 

			--paddle-font-body-family: '. $font_family .';
			--paddle-font-body-size: '. $body_font_size .'px;';

			$css .= '--paddle-font-h1-size: '. $h1_font_size .'px;';
			$css .= '--paddle-font-h2-size: '. $h2_font_size .'px;';
			$css .= '--paddle-font-h3-size: '. $h3_font_size .'px;';
			$css .= '--paddle-font-h4-size: '. $h4_font_size .'px;';
			$css .= '--paddle-font-h5-size: '. $h5_font_size .'px;';
			$css .= '--paddle-font-h6-size: '. $h6_font_size .'px;';

			$css .= '--paddle-font-h1-weight:'. $h1_font_weight.';';
			$css .= '--paddle-font-h2-weight:'. $h2_font_weight.';';
			$css .= '--paddle-paragraph-m-bottom:'. $paragraph_margin_bottom.'px;';

			$css .= '--paddle-page-width: 1200px';
			$css .= '--paddle-page-width-margin:0';
			
		$css .='}';
		

		// Retrun all css

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
add_action( 'wp_head', 'paddle_output_header_css', 5 );

function paddle_sanitize_hex_color( $color ){
	if ( '' === $color )
		return '';

    // 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
}