<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package paddle
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param  array $classes Classes for the body element.
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
	if ( 1 === get_theme_mod( 'hide_archive_meta' ) ) {
		$classes[] = 'category-grid-layout';
	}
	// Add a class of main Heading H1.
	if ( 'boxed' === get_theme_mod( 'paddle_heading_h1_style' ) ) {
		$classes[] = 'boxed-header';
	}

	// Add header layout option
	if ( 'logo-left' === get_theme_mod( 'paddle_header_layout_style' ) ) {
		$classes[] = 'logo-left';
	}
	if ( 'logo-right' === get_theme_mod( 'paddle_header_layout_style' ) ) {
		$classes[] = 'logo-right';
	}
	if ( 'logo-center' === get_theme_mod( 'paddle_header_layout_style' ) ) {
		$classes[] = 'logo-center';
	}
	if ( 'logo-with-search' === get_theme_mod( 'paddle_header_layout_style' ) ) {
		$classes[] = 'logo-with-search';
	}

	// Add sidebar classes.
	if ( 'left-sidebar' === get_theme_mod( 'paddle_sidebar_position' ) && 1 === get_theme_mod( 'paddle_page_layout_sidebar' ) ) {
		$classes[] = 'left-sidebar';
	}
	if ( 'left-sidebar-woocommerce' === get_theme_mod( 'paddle_sidebar_position' ) && 1 === get_theme_mod( 'paddle_page_layout_sidebar' ) ) {
		if ( class_exists( 'woocommerce' ) ) {
			if ( is_woocommerce() ) {
				$classes[] = 'left-sidebar-woocommerce';
			}
		}
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
 * @param  string $output Nav menu item start element.
 * @param  object $item   Nav menu item.
 * @param  int    $depth  Depth.
 * @param  object $args   Nav menu args.
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function paddle_nav_add_dropdown_icons( $output, $item, $depth, $args ) {
	// Only add class to 'top level' items on the 'primary' menu.
	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $output;
	}

	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		ob_start(); ?>
<button class="toggle submenu-expand" data-toggle-target="sub-menu" aria-expanded="false">
<span class="screen-reader-text">Show sub menu</span>
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
		<path fill-rule="evenodd"
			d="M11.9932649,19.500812 C11.3580307,19.501631 10.7532316,19.2174209 10.3334249,18.720812 L0.91486487,7.56881201 C0.295732764,6.80022105 0.378869031,5.6573388 1.10211237,4.99470263 C1.82535571,4.33206645 2.92415989,4.39205385 3.57694487,5.12981201 L11.8127849,14.881812 C11.8583553,14.9359668 11.9241311,14.9670212 11.9932649,14.9670212 C12.0623986,14.9670212 12.1281745,14.9359668 12.1737449,14.881812 L20.4095849,5.12981201 C20.8230992,4.61647509 21.4710943,4.37671194 22.1028228,4.50330101 C22.7345513,4.62989008 23.2509019,5.10297096 23.4520682,5.73948081 C23.6532345,6.37599067 23.5076557,7.07606812 23.0716649,7.56881201 L13.6559849,18.716812 C13.2354593,19.214623 12.6298404,19.5001823 11.9932649,19.500812 Z" />
	</svg>
</button>
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
 * @param  string $form Form HTML.
 * @return string Modified form HTML.
 */
function paddle_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform d-inline-flex w-100" action="' . home_url( '/' ) . '" >
    <div class="d-flex w-100 align-items-center"><label class="screen-reader-text" for="s">' . esc_attr__( 'Search for:', 'paddle' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search for:', 'paddle' ) . '" />
	<button type="submit" class="btn" title="' . esc_attr__( 'Search', 'paddle' ) . '" id="searchsubmit">
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
 * paddle_layout_container
 *
 * @param  mixed $layout
 * @return void
 */
function paddle_layout_container( $layout = '' ) {
	$paddle_sidebar_layout_option = absint( get_theme_mod( 'paddle_page_layout_sidebar', 1 ) );

	$col_8 = 'col-lg-8';
	$col_4 = 'col-lg-4';
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_woocommerce() ) {
			$col_8 = 'col-lg-9';
		}
	}
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_woocommerce() ) {
			$col_4 = 'col-lg-3';
		}
	}

	if ( 'content' === $layout ) :
		$paddle_container = ( 0 === $paddle_sidebar_layout_option ) ? 'col-lg-12' : ( ( 1 === $paddle_sidebar_layout_option ) ? $col_8 : '' );
	else :
		$paddle_container = ( 0 === $paddle_sidebar_layout_option ) ? 'col-lg-12' : ( ( 1 === $paddle_sidebar_layout_option ) ? $col_4 : '' );
	endif;

	return $paddle_container;
}

/**
 * paddle_layout_width
 *
 * @return void
 */
function paddle_layout_width() {
	$paddle_full_page_width   = absint( get_theme_mod( 'paddle_page_layout_width', 1 ) );
	$paddle_page_width_option = ( 0 === $paddle_full_page_width ) ? '' : ( ( 1 === $paddle_full_page_width ) ? 'full-width-content' : '' );
	return $paddle_page_width_option;
}

/**
 * paddle_add_cta_menu
 * Add extra list item to menu items
 *
 * @param  mixed $items
 * @param  mixed $args
 * @return void
 */
function paddle_add_cta_menu( $items, $args ) {
	if ( 'primary' === $args->theme_location && 1 === absint( get_theme_mod( 'paddle_header_cta', 0 ) ) ) {
		$option_url  = get_theme_mod( 'paddle_header_cta_url', home_url() );
		$option_text = get_theme_mod( 'paddle_header_cta_text', ' CTA TEXT ' );
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

if ( ! function_exists( 'paddle_social_menu ' ) ) :
	/**
	 * paddle_social_menu
	 * Social Menu Navigation
	 *
	 * @return void
	 */
	function paddle_social_menu() {
		if ( has_nav_menu( 'social' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'social',
					'container'       => 'div',
					'container_id'    => 'menu-social',
					'container_class' => 'menu-social',
					'menu_id'         => 'menu-social-items',
					'menu_class'      => 'menu-items',
					'depth'           => 1,
					'link_before'     => '<span class="screen-reader-text">',
					'link_after'      => '</span>',
					'fallback_cb'     => '',
				)
			);
		}
	}
endif;


if ( ! function_exists( ' paddle_banner_align ' ) ) {
	/**
	 * paddle_banner_align
	 * Get banner align option
	 *
	 * @return void
	 */
	function paddle_banner_align() {
		$paddle_banner_align_postion = get_theme_mod( 'banner_align_position', 'left' );
		return $paddle_banner_align_postion;
	}
}


if ( ! function_exists( 'paddle_banner_opacity' ) ) {
	/**
	 * paddle_banner_opacity
	 * Get banner image overlay opacity
	 *
	 * @return void
	 */
	function paddle_banner_opacity() {
		$paddle_banner_opacity = get_theme_mod( 'banner_overlay_opacity', 2 );
		return $paddle_banner_opacity;
	}
}

if ( ! function_exists( 'paddle_search_modal' ) ) {
	/**
	 * paddle_search_modal
	 * Search Modal
	 *
	 * @return void
	 */
	function paddle_search_modal() {
		?>
		<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="searchModalLabel">
						<?php
						echo __( 'Search', 'paddle' );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output 
						?>
						</h5>
					</div>
					<div class="modal-body">
						<div class="search-form-container">
							<?php get_search_form(); ?>
							<button type="button" class="btn close btn-close text-reset" data-bs-dismiss="modal" aria-label="<?php esc_html_e( 'Close', 'paddle' ); ?>">
								<span class="sr-only screen-reader-text">
									<?php
									echo __( 'Close', 'paddle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output 
									?>
								</span>
						</button>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .modal.fade -->

		<?php
	}
}
add_action( 'paddle_action_search_modal', 'paddle_search_modal' );

if ( ! function_exists( 'paddle_footer_copyrights' ) ) :
	/**
	 * paddle_footer_copyrights
	 * Footer
	 *
	 * @return void
	 */
	function paddle_footer_copyrights() {
		?>
<div class="row">
	<div class="footer-copyrights">

		<?php

		if ( '' !== esc_html( get_theme_mod( 'paddle_footer_copyright_text' ) ) ) :
			echo esc_html( get_theme_mod( 'paddle_footer_copyright_text' ) );
			paddle_social_menu();
			paddle_theme_credit();

		else :
			?>

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
			paddle_social_menu();
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
if ( ! function_exists( 'paddle_theme_credit' ) ) {
	function paddle_theme_credit() {
		if ( get_theme_mod( 'paddle_theme_credit', 1 ) ) :
			?>
		<span class="theme-credit"><?php esc_html_e( 'Powered by ', 'paddle' ); ?><?php esc_html_e( 'WordPress. Designed by A. Kusimo', 'paddle' ); ?></span>
			<?php
		endif;
	}
}

if ( ! function_exists( 'paddle_drawer_nav_close' ) ) :
	function paddle_drawer_nav_close() {
		?>
	<div class="drawer__header d-flex justify-content-end mt-2">
		<div class="drawer__close">
		<button type="button" class="off-canvas-button-close close mb-2" aria-label="<?php esc_html_e( 'Close', 'paddle' ); ?>">
			<span aria-hidden="true">×</span>
			<span class="sr-only"><?php echo esc_html__( 'Close', 'paddle' ); ?></span>
		</button>
		</div>
	</div>
		<?php
	}
endif;

if ( ! function_exists( 'paddle_rgba' ) ) :
	function paddle_rgba( $color, $opacity_number ) {
		list( $r, $g, $b ) = sscanf( $color, '#%02x%02x%02x' );
		return 'rgba(' . $r . ',' . $g . ',' . $b . ',.' . $opacity_number . ')';
	}
endif;
