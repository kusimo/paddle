<?php

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';


/**
 * Enqueue scripts for our Customizer preview
 *
 * @return void
 */
if ( ! function_exists( 'paddle_customizer_preview_scripts' ) ) {
	function paddle_customizer_preview_scripts() {
		wp_enqueue_script( 'paddle-customizer-preview', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
	}
}
add_action( 'customize_preview_init', 'paddle_customizer_preview_scripts' );

/**
 * Enqueue css for our Customizer preview
 *
 * @return void
 */
if ( ! function_exists( 'paddle_customizer_preview_style' ) ) {
	function paddle_customizer_preview_style() {

		wp_enqueue_style( 'paddle-customizer-custom-css', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/css/customizer-previews.css', array(), '1.1.0', 'all' );

	}
}

add_action( 'customize_preview_init', 'paddle_customizer_preview_style' );

/**
 * Check if WooCommerce is active
 * Use in the active_callback when adding the WooCommerce Section to test if WooCommerce is activated
 *
 * @return boolean
 */
function paddle_is_woocommerce_active() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;
}


/**
 * Append a search icon to the primary menu
 * This is a sample function to show how to append an icon to the menu based on the customizer search option
 * The search icon wont actually do anything
 */
if ( ! function_exists( 'paddle_add_search_menu_item' ) ) {
	function paddle_add_search_menu_item( $items, $args ) {
		$defaults = paddle_generate_defaults();

		if ( get_theme_mod( 'search_menu_icon', $defaults['search_menu_icon'] ) ) {
			if ( $args->theme_location == 'primary' ) {
				$items .= '<li class="menu-item menu-item-search"><a href="#" class="nav-search"><i class="fa fa-search"></i></a></li>';
			}
		}
		return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'paddle_add_search_menu_item', 10, 2 );

/**
 * Set secondary color
 * @return  string
 */

if ( ! function_exists( 'paddle_convert_rgba_to_hex' ) ) {
	function paddle_convert_rgba_to_hex( $opacity ) {
		$color              = get_theme_mod( 'paddle_primary_color' ); //#70b9b020
		$color_with_opacity = $color . strval( $opacity );

		if ( preg_match( '|^#([A-Fa-f0-9]{4}){1,2}$|', $color_with_opacity ) ) {
			return strval( $color_with_opacity );
		}

	}
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
			'paddle_header_layout_style'    => 'logo-right',
			'paddle_header_search_button'   => 1,
			'paddle_header_cta'             => 0,
			'header_logo_size'              => 150,
			'header_logo_padding'           => 16,
			'paddle_menu_text_to_uppercase' => 0,
			'paddle_menu_bgcolor'           => '#ffffff',
			'paddle_navlink_text_color'     => '#3c434a',
			'paddle_menu_items_alignment'   => 'centered',
			'enable_top_bar'                => 0,
			'enable_top_bar_on_mobile'      => 0,
			'paddle_contact_phone'          => '',
			'topbar_select'                 => 'button',
			'enable_icon_bg'                => 0,
			'banner_content_bg_opacity'     => get_theme_mod('banner_content_bg_opacity', 3),
			'paddle_primary_color'          => PADDLE_PRIMARY_COLOR,
			'paddle_secondary_color'        => paddle_convert_rgba_to_hex( '08' ),
			'enable_secondary_color'        => 0,
			'opacity_slider_control'        => 2,
		);

		return apply_filters( 'paddle_customizer_defaults', $customizer_defaults );
	}
}

/**
* Load all our Customizer options
*/
require_once trailingslashit( dirname( __FILE__ ) ) . 'inc/customizer.php';
