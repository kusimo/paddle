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

if( ! function_exists( 'paddle_get_default_footer_copyright' ) ) :
	/**
	 * Prints footer copyright
	*/
	function paddle_get_default_footer_copyright() { ?>
		<span class="site-copyright">&copy; 
			<?php
			echo date_i18n(
				/* translators: Copyright date format, see https://secure.php.net/date */
				_x( 'Y', 'copyright date format', 'paddle' )
			);
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</span><!-- .site-copy-right -->
 	<?php }

endif;


/**
* Load all our Customizer options
*/
require_once trailingslashit( dirname( __FILE__ ) ) . 'inc/customizer.php';