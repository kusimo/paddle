<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package paddle
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function paddle_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Add a class of archive-grid when grid layout is enable.
	if ( 1 === get_theme_mod( 'hide_archive_meta') ) {
		$classes[] = 'category-grid-layout';
	}

	return $classes;
}
add_filter( 'body_class', 'paddle_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function paddle_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'paddle_pingback_header' );

/**
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function paddle_nav_add_dropdown_icons( $output, $item, $depth, $args ) {

	// Only add class to 'top level' items on the 'menu-1' menu.
	if ( ! isset( $args->theme_location ) || 'menu-1' !== $args->theme_location ) {
		return $output;
	}

	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		ob_start(); ?>
		<span class="submenu-expand" tabindex="-1">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path fill-rule="evenodd" d="M11.9932649,19.500812 C11.3580307,19.501631 10.7532316,19.2174209 10.3334249,18.720812 L0.91486487,7.56881201 C0.295732764,6.80022105 0.378869031,5.6573388 1.10211237,4.99470263 C1.82535571,4.33206645 2.92415989,4.39205385 3.57694487,5.12981201 L11.8127849,14.881812 C11.8583553,14.9359668 11.9241311,14.9670212 11.9932649,14.9670212 C12.0623986,14.9670212 12.1281745,14.9359668 12.1737449,14.881812 L20.4095849,5.12981201 C20.8230992,4.61647509 21.4710943,4.37671194 22.1028228,4.50330101 C22.7345513,4.62989008 23.2509019,5.10297096 23.4520682,5.73948081 C23.6532345,6.37599067 23.5076557,7.07606812 23.0716649,7.56881201 L13.6559849,18.716812 C13.2354593,19.214623 12.6298404,19.5001823 11.9932649,19.500812 Z" />
			</svg>
		</span>
		<?php
		$custom_sub_menu_html = ob_get_clean();

		// Append after <span> element of the menu item targeted.
		$output .= $custom_sub_menu_html;
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'paddle_nav_add_dropdown_icons', 10, 4 );

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function paddle_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform d-inline-flex w-100 my-2" action="' . home_url( '/' ) . '" >
    <div class="d-flex w-100"><label class="screen-reader-text" for="s">' . esc_attr__( 'Search for:', 'paddle' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search for:', 'paddle' ) . '" />
	<button type="submit" title="' . esc_attr__( 'Search', 'paddle' ) . '" id="searchsubmit">
	</button>
    </div>
    </form>';

	return $form;
}
add_filter( 'get_search_form', 'paddle_search_form' );



/**
 * @usage: For Minimizing dynamic CSS
 */
function paddle_minimize_css( $css ) {
	$css = preg_replace( '/\/\*((?!\*\/).)*\*\//', '', $css );
	$css = preg_replace( '/\s{2,}/', ' ', $css );
	$css = preg_replace( '/\s*([:;{}])\s*/', '$1', $css );
	$css = preg_replace( '/;}/', '}', $css );
	return $css;
}


/**
 * Output bootstrap layout column col-12 or col-8
 */
function paddle_layout_container( $layout = '' ) {
	$paddle_sidebar_layout_option = absint( get_theme_mod( 'paddle_page_layout_sidebar' ) );

	if ( 'content' === $layout ) :
		$paddle_container = ( 0 === $paddle_sidebar_layout_option ) ? 'col-lg-12' : ( ( 1 === $paddle_sidebar_layout_option ) ? 'col-lg-8' : '' );
	else :
		$paddle_container = ( 0 === $paddle_sidebar_layout_option ) ? 'col-lg-12' : ( ( 1 === $paddle_sidebar_layout_option ) ? 'col-lg-4' : '' );
	endif;

	return $paddle_container;
}

/**
 * Get width from theme option
 */
function paddle_layout_width() {
	$paddle_full_page_width   = absint( get_theme_mod( 'paddle_page_layout_width' ) );
	$paddle_page_width_option = ( 0 === $paddle_full_page_width ) ? '' : ( ( 1 === $paddle_full_page_width ) ? 'full-width-content' : '' );
	return $paddle_page_width_option;
}

/**
 * Add extra list item to menu items
 */
function paddle_add_cta_menu( $items, $args ) {
	if ( 'menu-1' === $args->theme_location && 1 === absint( get_theme_mod( 'paddle_header_cta' ) )) {
		$option_url  = get_theme_mod( 'paddle_header_cta_url' );
		$option_text = get_theme_mod( 'paddle_header_cta_text' );
		$url         = esc_url( $option_url );
		if ( ! empty( $option_url ) && ! empty( $option_text ) ) {
			$items .= '<li id="header-btn-cta" class="menu-item d-flex justify-content-center align-items-center">'
				. '<a href="' . $url . '" class="btn btn-primary btn-lg btn-rounded">' . esc_attr( $option_text ) . '</a>'
				. '</a>'
				. '</li>';
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'paddle_add_cta_menu', 10, 2 );

/**
 * Get banner align option
 */
if ( ! function_exists( ' paddle_banner_align ' ) ) {
	function paddle_banner_align() {
		$paddle_banner_align_postion = get_theme_mod( 'banner_align_position', 'left' );
		return $paddle_banner_align_postion;
	}
}

/**
 * Get banner image overlay opacity
 */
if( ! function_exists( 'paddle_banner_opacity' ) ) {
	function paddle_banner_opacity() {
		$paddle_banner_opacity = get_theme_mod( 'banner_overlay_opacity', 2 );
		return $paddle_banner_opacity;
	}
}

/**
 * Search Modal
 */
if( ! function_exists( 'paddle_search_modal' ) ) {
	function paddle_search_modal() {  
	?>
	<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="searchModalLabel"><?php echo __( 'Search', 'paddle' ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span><?php echo __( 'Close', 'paddle' ); ?></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="search-form-container">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- .modal.fade -->

	<?php 
	}
}
add_action( 'paddle_action_search_modal', 'paddle_search_modal' );	

/**
* Footer
*/
if ( ! function_exists( 'paddle_footer_copyrights' ) ) :
	function paddle_footer_copyrights() {
		?>
			<div class="row">
				<div class="footer-copyrights">
				
						<?php
	
							if( "" !== esc_html( get_theme_mod( 'paddle_footer_copyright_text' ) ) ) :
								echo esc_html( get_theme_mod( 'paddle_footer_copyright_text') ); 
								paddle_theme_credit();
							
							else : ?>

								<span class="site-copyright">&copy;
								<?php
								echo date_i18n(
									/* translators: Copyright date format, see https://secure.php.net/date */
									_x( 'Y', 'copyright date format', 'paddle' )
								);
								?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
								</span><!-- .site-copy-right -->

								
								<?php
								paddle_theme_credit();

							endif;

						?>
					
				</div>
			</div>
		<?php
	}
	endif;
add_action( 'paddle_action_footer', 'paddle_footer_copyrights' );	

// Theme credit.
if( ! function_exists( 'paddle_theme_credit' ) ) {
	function paddle_theme_credit() {
		if( get_theme_mod( 'paddle_theme_credit',1 ) ) :
			?><span class="theme-credit"><?php esc_html_e( 'Theme by ','paddle' ) ?><a href="<?php echo esc_url( 'https://paddledigital.com' ); ?>" target="_blank"><?php esc_html_e( 'Paddle Themes','paddle' ) ?></a></span>
			<?php   
		endif;
	}
}
