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
	if ( 1 === get_theme_mod( 'hide_archive_meta', PADDLE_DEFAULT_OPTION['hide_archive_meta'] ) ) {
		$classes[] = 'category-grid-layout';
	}

	// Add header layout option
	$paddle_current_header_style = get_theme_mod( 'paddle_header_layout_style', PADDLE_DEFAULT_OPTION['paddle_header_layout_style'] );
	$classes[]                   = $paddle_current_header_style;

	// Add sidebar classes.
	if ( 'left-sidebar' === get_theme_mod( 'paddle_sidebar_position', PADDLE_DEFAULT_OPTION['paddle_sidebar_position'] ) && 1 === get_theme_mod( 'paddle_page_layout_sidebar' ) ) {
		$classes[] = 'left-sidebar';
	}
	if ( 'left-sidebar-woocommerce' === get_theme_mod( 'paddle_sidebar_position', PADDLE_DEFAULT_OPTION['paddle_sidebar_position'] ) && 1 === get_theme_mod( 'paddle_page_layout_sidebar' ) ) {
		if ( class_exists( 'woocommerce' ) ) {
			if ( is_woocommerce() ) {
				$classes[] = 'left-sidebar-woocommerce';
			}
		}
	}

	// Date updated.
	if ( 0 === get_theme_mod( 'paddle_enable_blog_updated_date', PADDLE_DEFAULT_OPTION['paddle_enable_blog_updated_date'] ) ) {
		$classes[] = 'hide-time-upd';
	}
	if ( 0 === get_theme_mod( 'paddle_enable_blog_published_date', PADDLE_DEFAULT_OPTION['paddle_enable_blog_published_date'] ) ) {
		$classes[] = 'hide-time-pub';
	}

	return $classes;
}
add_filter( 'body_class', 'paddle_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param  array $classes Classes for the post element.
 * @return array
 */

function paddle_post_classes( $classes ) {
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$classes[] = 'post-modified';
	} else {
		$classes[] = 'post-not-modified';
	}
	return $classes;
}
 add_filter( 'post_class', 'paddle_post_classes' );

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
				<path fill-rule="evenodd" d="M11.9932649,19.500812 C11.3580307,19.501631 10.7532316,19.2174209 10.3334249,18.720812 L0.91486487,7.56881201 C0.295732764,6.80022105 0.378869031,5.6573388 1.10211237,4.99470263 C1.82535571,4.33206645 2.92415989,4.39205385 3.57694487,5.12981201 L11.8127849,14.881812 C11.8583553,14.9359668 11.9241311,14.9670212 11.9932649,14.9670212 C12.0623986,14.9670212 12.1281745,14.9359668 12.1737449,14.881812 L20.4095849,5.12981201 C20.8230992,4.61647509 21.4710943,4.37671194 22.1028228,4.50330101 C22.7345513,4.62989008 23.2509019,5.10297096 23.4520682,5.73948081 C23.6532345,6.37599067 23.5076557,7.07606812 23.0716649,7.56881201 L13.6559849,18.716812 C13.2354593,19.214623 12.6298404,19.5001823 11.9932649,19.500812 Z" />
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
 * paddle_add_additional_class_on_li
 * Add class to li menu
 *
 * @param  mixed $classes
 * @param  mixed $item
 * @param  mixed $args
 * @return void
 */
function paddle_add_additional_class_on_li( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'paddle_add_additional_class_on_li', 1, 3 );

/**
 * Generate custom search form
 *
 * @param  string $form Form HTML.
 * @return string Modified form HTML.
 */
function paddle_search_form( $form ) {
	$form = '<form role="search" method="get" class="search--form d-inline-flex w-100" action="' . home_url( '/' ) . '" >
    <div class="d-flex w-100 align-items-center"><label class="screen-reader-text" for="s">' . esc_attr__( 'Search for:', 'paddle' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search for:', 'paddle' ) . '" />
	<button type="submit" class="btn searchsubmit" title="' . esc_attr__( 'Search', 'paddle' ) . '">
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
	$paddle_sidebar_position      = get_theme_mod( 'paddle_sidebar_position', PADDLE_DEFAULT_OPTION['paddle_sidebar_position'] );
	$paddle_sidebar_layout_option = 0;
	if ( 'no-sidebar' === $paddle_sidebar_position ) {
		$paddle_sidebar_layout_option = 0;
	} else {
		$paddle_sidebar_layout_option = 1;
	}

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
	$paddle_sidebar_position  = get_theme_mod( 'paddle_sidebar_position', PADDLE_DEFAULT_OPTION['paddle_sidebar_position'] );
	$paddle_page_width_option = '';
	if ( 'no-sidebar' === $paddle_sidebar_position ) {
		$paddle_page_width_option = 'full-width-content';
	}
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
	$has_header_cta       = absint( get_theme_mod( 'paddle_header_cta', PADDLE_DEFAULT_OPTION['paddle_header_cta'] ) );
	$header_cta_separated = absint( get_theme_mod( 'cta_separated', PADDLE_DEFAULT_OPTION['cta_separated'] ) );
	if ( 'primary' === $args->theme_location && 1 === $has_header_cta && 0 === $header_cta_separated ) {
		$option_url  = get_theme_mod( 'paddle_header_cta_url', home_url() );
		$option_text = get_theme_mod( 'paddle_header_cta_text', PADDLE_DEFAULT_OPTION['paddle_header_cta_text'] );
		$url         = esc_url( $option_url );
		if ( ! empty( $option_url ) && ! empty( $option_text ) ) {
			$items .= '<li id="header-btn-cta" class="menu-item d-flex justify-content-center align-items-center header-cta-menu">'
				. '<a href="' . $url . '" class="btn btn-primary cta-button-link">' . esc_attr( $option_text ) . '</a>'
				. '</li>';
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'paddle_add_cta_menu', 10, 2 );

/**
 * paddle_add_separated_cta_to_header
 */
function paddle_add_separated_cta_to_header( $menu_content, $args ) {
	$has_header_cta       = absint( get_theme_mod( 'paddle_header_cta', PADDLE_DEFAULT_OPTION['paddle_header_cta'] ) );
	$header_cta_separated = absint( get_theme_mod( 'cta_separated', PADDLE_DEFAULT_OPTION['cta_separated'] ) );

	if ( 'primary' === $args->theme_location && 1 === $has_header_cta && 1 === $header_cta_separated ) {

		$option_url  = get_theme_mod( 'paddle_header_cta_url', home_url() );
		$option_text = get_theme_mod( 'paddle_header_cta_text', PADDLE_DEFAULT_OPTION['paddle_header_cta_text'] );
		$url         = esc_url( $option_url );

		$cta_button_content = '<div id="header-btn-cta" class="d-flex justify-content-center align-items-center header-cta-menu">'
					. '<a href="' . $url . '" class="btn btn-primary cta-button-link">' . esc_attr( $option_text ) . '</a>'
					. '</div>';

		// Remove spaces from html element
		$menu_content = preg_replace(
			array(
				'/ {2,}/',
				'/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s',
			),
			array(
				' ',
				'',
			),
			$menu_content
		);
		// Split menu content to get the container element
		$content_to_split = explode( '</ul></div>', $menu_content );

		if ( count( $content_to_split ) > 0 ) {
			$menu_content  = '';
			$menu_content .= $content_to_split[0];
			$menu_content .= '</ul><!-- .menu-->';
			// Add CTA Button
			$menu_content .= $cta_button_content;
			$menu_content .= '</div><!-- .container-->';
		}
	}
	return $menu_content;
}
add_filter( 'wp_nav_menu', 'paddle_add_separated_cta_to_header', 10, 2 );


/**
 * Set Social Icons URLs.
 *
 * @return array Multidimensional array containing social media data
 */
if ( ! function_exists( 'paddle_generate_social_urls' ) ) {
	function paddle_generate_social_urls() {
		$social_icons = array(
			array(
				'url'   => 'behance.net',
				'icon'  => 'fab fa-behance',
				'title' => esc_html__( 'Follow me on Behance', 'paddle' ),
				'class' => 'behance',
			),
			array(
				'url'   => 'bitbucket.org',
				'icon'  => 'fab fa-bitbucket',
				'title' => esc_html__( 'Fork me on Bitbucket', 'paddle' ),
				'class' => 'bitbucket',
			),
			array(
				'url'   => 'codepen.io',
				'icon'  => 'fab fa-codepen',
				'title' => esc_html__( 'Follow me on CodePen', 'paddle' ),
				'class' => 'codepen',
			),
			array(
				'url'   => 'deviantart.com',
				'icon'  => 'fab fa-deviantart',
				'title' => esc_html__( 'Watch me on DeviantArt', 'paddle' ),
				'class' => 'deviantart',
			),
			array(
				'url'   => 'discord.gg',
				'icon'  => 'fab fa-discord',
				'title' => esc_html__( 'Join me on Discord', 'paddle' ),
				'class' => 'discord',
			),
			array(
				'url'   => 'dribbble.com',
				'icon'  => 'fab fa-dribbble',
				'title' => esc_html__( 'Follow me on Dribbble', 'paddle' ),
				'class' => 'dribbble',
			),
			array(
				'url'   => 'etsy.com',
				'icon'  => 'fab fa-etsy',
				'title' => esc_html__( 'favorite me on Etsy', 'paddle' ),
				'class' => 'etsy',
			),
			array(
				'url'   => 'facebook.com',
				'icon'  => 'fab fa-facebook-f',
				'title' => esc_html__( 'Like on Facebook', 'paddle' ),
				'class' => 'facebook',
			),
			array(
				'url'   => 'flickr.com',
				'icon'  => 'fab fa-flickr',
				'title' => esc_html__( 'Connect on Flickr', 'paddle' ),
				'class' => 'flickr',
			),
			array(
				'url'   => 'foursquare.com',
				'icon'  => 'fab fa-foursquare',
				'title' => esc_html__( 'Follow on Foursquare', 'paddle' ),
				'class' => 'foursquare',
			),
			array(
				'url'   => 'github.com',
				'icon'  => 'fab fa-github',
				'title' => esc_html__( 'Follow on GitHub', 'paddle' ),
				'class' => 'github',
			),
			array(
				'url'   => 'instagram.com',
				'icon'  => 'fab fa-instagram',
				'title' => esc_html__( 'Follow on Instagram', 'paddle' ),
				'class' => 'instagram',
			),
			array(
				'url'   => 'kickstarter.com',
				'icon'  => 'fab fa-kickstarter-k',
				'title' => esc_html__( 'Back on Kickstarter', 'paddle' ),
				'class' => 'kickstarter',
			),
			array(
				'url'   => 'last.fm',
				'icon'  => 'fab fa-lastfm',
				'title' => esc_html__( 'Follow me on Last.fm', 'paddle' ),
				'class' => 'lastfm',
			),
			array(
				'url'   => 'linkedin.com',
				'icon'  => 'fab fa-linkedin-in',
				'title' => esc_html__( 'Connect on LinkedIn', 'paddle' ),
				'class' => 'linkedin',
			),
			array(
				'url'   => 'medium.com',
				'icon'  => 'fab fa-medium-m',
				'title' => esc_html__( 'Follow on Medium', 'paddle' ),
				'class' => 'medium',
			),
			array(
				'url'   => 'patreon.com',
				'icon'  => 'fab fa-patreon',
				'title' => esc_html__( 'Support me on Patreon', 'paddle' ),
				'class' => 'patreon',
			),
			array(
				'url'   => 'pinterest.com',
				'icon'  => 'fab fa-pinterest-p',
				'title' => esc_html__( 'Follow on Pinterest', 'paddle' ),
				'class' => 'pinterest',
			),
			array(
				'url'   => 'plus.google.com',
				'icon'  => 'fab fa-google-plus-g',
				'title' => esc_html__( 'Connect with me on Google+', 'paddle' ),
				'class' => 'googleplus',
			),
			array(
				'url'   => 'reddit.com',
				'icon'  => 'fab fa-reddit-alien',
				'title' => esc_html__( 'Join me on Reddit', 'paddle' ),
				'class' => 'reddit',
			),
			array(
				'url'   => 'slack.com',
				'icon'  => 'fab fa-slack-hash',
				'title' => esc_html__( 'Join me on Slack', 'paddle' ),
				'class' => 'slack.',
			),
			array(
				'url'   => 'slideshare.net',
				'icon'  => 'fab fa-slideshare',
				'title' => esc_html__( 'Follow me on SlideShare', 'paddle' ),
				'class' => 'slideshare',
			),
			array(
				'url'   => 'snapchat.com',
				'icon'  => 'fab fa-snapchat-ghost',
				'title' => esc_html__( 'Add me on Snapchat', 'paddle' ),
				'class' => 'snapchat',
			),
			array(
				'url'   => 'soundcloud.com',
				'icon'  => 'fab fa-soundcloud',
				'title' => esc_html__( 'Follow me on SoundCloud', 'paddle' ),
				'class' => 'soundcloud',
			),
			array(
				'url'   => 'spotify.com',
				'icon'  => 'fab fa-spotify',
				'title' => esc_html__( 'Follow me on Spotify', 'paddle' ),
				'class' => 'spotify',
			),
			array(
				'url'   => 'stackoverflow.com',
				'icon'  => 'fab fa-stack-overflow',
				'title' => esc_html__( 'Join me on Stack Overflow', 'paddle' ),
				'class' => 'stackoverflow',
			),
			array(
				'url'   => 'tumblr.com',
				'icon'  => 'fab fa-tumblr',
				'title' => esc_html__( 'Follow me on Tumblr', 'paddle' ),
				'class' => 'tumblr',
			),
			array(
				'url'   => 'twitch.tv',
				'icon'  => 'fab fa-twitch',
				'title' => esc_html__( 'Follow me on Twitch', 'paddle' ),
				'class' => 'twitch',
			),
			array(
				'url'   => 'twitter.com',
				'icon'  => 'fab fa-twitter',
				'title' => esc_html__( 'Follow on Twitter', 'paddle' ),
				'class' => 'twitter',
			),
			array(
				'url'   => 'vimeo.com',
				'icon'  => 'fab fa-vimeo-v',
				'title' => esc_html__( 'Follow me on Vimeo', 'paddle' ),
				'class' => 'vimeo',
			),
			array(
				'url'   => 'weibo.com',
				'icon'  => 'fab fa-weibo',
				'title' => esc_html__( 'Follow me on weibo', 'paddle' ),
				'class' => 'weibo',
			),
			array(
				'url'   => 'youtube.com',
				'icon'  => 'fab fa-youtube',
				'title' => esc_html__( 'Subscribe on YouTube', 'paddle' ),
				'class' => 'youtube',
			),
		);

		return apply_filters( 'paddle_social_icons', $social_icons );
	}
}

if ( ! function_exists( 'paddle_social_menu ' ) ) :
	/**
	 * paddle_social_menu
	 * Social Menu Navigation
	 *
	 * @return void
	 */
	function paddle_social_menu() {
		$footer_has_social = get_theme_mod( 'paddle_footer_social', PADDLE_DEFAULT_OPTION['paddle_footer_social'] );
		$paddle_social_column = get_theme_mod( 'footer_social_column', PADDLE_DEFAULT_OPTION['footer_social_column'] );
		if ( 1 === $footer_has_social && 'none' === $paddle_social_column ) {
			get_template_part( 'template-parts/footer/social', 'items' );
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
		$paddle_banner_align_postion = get_theme_mod( 'banner_align_position', PADDLE_DEFAULT_OPTION['banner_align_position'] );
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
		$paddle_banner_opacity = get_theme_mod( 'banner_overlay_opacity', PADDLE_DEFAULT_OPTION['banner_overlay_opacity'] );
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
		<search-modal class="full-width-search-container modal" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
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
							<button type="button" class="btn close btn-close text-reset" data-bs-dismiss="modal" aria-label="<?php esc_attr_e( 'Close', 'paddle' ); ?>">
								<span class="sr-only screen-reader-text">
									<?php
									echo __( 'Close', 'paddle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output 
									?>
								</span>
							</button>
							<span class="bg-close-cirle"></span>
						</div>
					</div>
				</div>
			</div>
		</search-modal><!-- .modal.fade -->

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
			<div class="footer-copyrights">

				<?php
				$copyright = get_theme_mod( 'paddle_footer_copyright_text' );
				if ( $copyright && '' !== wp_kses_post( $copyright ) ) :
					echo wp_kses_post( paddle_filter_footer_copyright($copyright) );

				else :
					paddle_get_default_footer_copyright();

				endif;

				?>

			</div>
		<?php
	}
endif;
add_action( 'paddle_action_footer', 'paddle_footer_copyrights', 9 );
add_action( 'paddle_action_footer', 'paddle_footer_extra_links', 13);
add_action( 'paddle_action_footer', 'paddle_theme_credit', 15 );
add_action( 'paddle_action_footer', 'paddle_social_menu', 18 );


// Theme credit.
if ( ! function_exists( 'paddle_theme_credit' ) ) {
	function paddle_theme_credit() {
		if ( get_theme_mod( 'paddle_theme_credit', PADDLE_DEFAULT_OPTION['paddle_theme_credit'] ) ) :
			?>
			<div class="theme-credit">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/themes/paddle/', 'zara' ) ); ?>" rel="nofollow" target="_blank">
				<?php esc_html_e( 'Paddle ', 'paddle' ); ?><?php esc_html_e( 'with', 'paddle' ); ?> 
				<sup>&hearts;</sup>
			</a>
			</div>
			<?php
		endif;
	}
}


if (! function_exists('paddle_footer_extra_links')) {	
	/**
	 * This add extra links to the bottom footer, includes privacy policy.
	 * paddle_footer_extra_links
	 *
	 * @return void
	 */
	function paddle_footer_extra_links() {

		$policy = get_theme_mod( 'paddle_privacy_policy', PADDLE_DEFAULT_OPTION['paddle_privacy_policy'] );
		$show_privacy_link = function_exists( 'the_privacy_policy_link' ) && 1 === $policy;

		$footer_links = paddle_comma_string_to_obj(get_theme_mod( 'footer_urls', PADDLE_DEFAULT_OPTION['footer_urls'] ), 'title', 'url');

	    if($show_privacy_link || !empty($footer_links)) : ?>
			<div class="footer-link-content">
		<?php endif;

		if(!empty($footer_links)) { 
			for ($i = 0; $i < count($footer_links); $i++) {
				$title = $footer_links[$i]['title'];
				$url = $footer_links[$i]['url'];
				printf('<a class="footer-bottom-link" href="%s">%s</a>', esc_url($url) , esc_attr($title) );
			}
	    }

		// Add privacy policy link
		if($show_privacy_link) {
			the_privacy_policy_link();
		}

		if($show_privacy_link || !empty($footer_links)) : ?>
			</div>
		<?php endif;
		
	}
}

if ( ! function_exists( 'paddle_drawer_nav_close' ) ) :
	function paddle_drawer_nav_close() {
		?>
		<div class="drawer__header d-flex justify-content-end mt-2">
			<div class="drawer__close">
				<button type="button" class="off-canvas-button-close close mb-2" aria-label="<?php esc_attr_e( 'Close', 'paddle' ); ?>">
					<span aria-hidden="true">×</span>
					<span class="sr-only"><?php echo esc_html__( 'Close', 'paddle' ); ?></span>
				</button>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'paddle_rgba' ) ) :
	/**
	 * paddle_rgba
	 *
	 * @param  mixed $color
	 * @param  mixed $opacity_number
	 * @return string
	 */
	function paddle_rgba( $color, $opacity_number ) {
		if ( '' === $color ) {
			return '';
		}

		list($r, $g, $b) = sscanf( $color, '#%02x%02x%02x' );
		return 'rgba(' . $r . ',' . $g . ',' . $b . ',.' . $opacity_number . ')';
	}
endif;

if ( ! function_exists( 'paddle_get_slider_ids' ) ) :
	function paddle_get_slider_ids() {
		$paddle_source_page_ids = array();
		$post_ids               = array();
		$slide_total            = 0;
		$paddle_source          = get_theme_mod( 'paddle_slider_source', PADDLE_DEFAULT_OPTION['paddle_slider_source'] );
		$paddle_source_ids      = get_theme_mod( 'paddle_slider_post_ids' );

		if ( 'post-ids' === $paddle_source && '' !== $paddle_source_ids ) {
			$post_ids = explode( ',', $paddle_source_ids ); // 587,555,1170
		}
		if ( 'page' === $paddle_source ) {
			for ( $i = 1; $i < 4; $i++ ) :
				array_push( $paddle_source_page_ids, get_theme_mod( 'paddle_slider_page' . $i ) );
			endfor;
			$post_ids = $paddle_source_page_ids;
		}
		if ( 'latest-post' === $paddle_source ) {
			$recent_posts = wp_get_recent_posts(
				array(
					'numberposts' => 5, // Number of recent posts thumbnails to display
					'post_status' => 'publish', // Show only the published posts
				)
			);
			foreach ( $recent_posts as $post_item ) {
				array_push( $post_ids, $post_item['ID'] );
				$slide_total++;
			}
		}
		return $post_ids;
	}
endif;


/**
 * Actions to use for the theme
 */
add_action( 'paddle_header', 'paddle_header_top_bar', 10 );
add_action( 'paddle_header', 'paddle_header_main', 12 );
add_action( 'paddle_header', 'paddle_offcanvas_menu', 14 );
add_action( 'paddle_header', 'paddle_header_media', 16 );


if ( ! function_exists( ' paddle_header_main ' ) ) :
	/**
	 * paddle_header_main
	 *
	 * @param  mixed $header_search_enabled
	 * @param  mixed $has_woocommerce
	 * @return void
	 */
	function paddle_header_main() {
		$default_header = get_theme_mod( 'paddle_header_layout_style', PADDLE_DEFAULT_OPTION['paddle_header_layout_style'] );

		$style         = explode( '-', $default_header );
		$header_number = is_array( $style ) ? end( $style ) : 1;

		?>
		 <header id="masthead" class="site-header" data-header="<?php echo esc_attr( paddle_get_default_header_number( $default_header ) ); ?>" data-header-section="<?php echo esc_attr( $default_header ); ?>">
		<?php
		if ( in_array( $header_number, array( '1', '2', '3', '4' ) ) ) {
			get_template_part( 'template-parts/header/paddle-header', paddle_get_default_header_number( $default_header ) );
		} elseif ( in_array( $header_number, array( '5' ) ) ) {
			get_template_part( 'template-parts/header/paddle-header', paddle_get_default_header_number( $default_header ) );
		} elseif ( in_array( $header_number, array( '6' ) ) ) {
			get_template_part( 'template-parts/header/paddle-header', paddle_get_default_header_number( $default_header ) );
		} else {
			// Do nothing.
		}

		?>
		</header><!-- #masthead -->
		
		<?php

	}
endif;



if ( ! function_exists( ' paddle_offcanvas_menu ' ) ) :
	/**
	 * paddle_offcanvas_menu
	 *
	 * @return void
	 */
	function paddle_offcanvas_menu() {
		$paddle_header_style = get_theme_mod( 'paddle_header_layout_style', PADDLE_DEFAULT_OPTION['paddle_header_layout_style'], 'logo-left-style-2' );
		if ( 'logo-left-style-3' === $paddle_header_style ) {
			return;
		}
		?>
		<div id="offcanvas-content" data-menu="offcanvas">
			<div class="paddle-theme-dialog" role="dialog" aria-labelledby="dialog-title" aria-describedby="dialog-description" id="offcanvas-menu">
			<p id="dialog-title"  class="screen-reader-text"><?php esc_html_e( 'Site Navigation', 'paddle' ); ?></p>
			<p id="dialog-description" class="screen-reader-text"><?php esc_html_e( 'Menu', 'paddle' ); ?></p>
				<nav data-menu="offcanvas-menu">
				<div class="offcanvas-header navbar-toggler">
				<button type="button" class="close-dialog btn btn-close text-reset navbar-toggler"  aria-label="<?php esc_attr_e( 'Close', 'paddle' ); ?>">
					<span class="toggle-text"><?php esc_html_e( 'Close menu', 'paddle' ); ?></span>
				</button>
				</div>
					<ul id="offcanvas-menu-items"></ul>
				</nav>
			</div>
		</div>
		<?php
	}

endif;

if ( ! function_exists( 'paddle_header_top_bar' ) ) {
	/**
	 * Topbar
	 *
	 * @return void
	 */
	function paddle_header_top_bar() {
		$topbar = new Paddle_Header_TopBar();
		if ( ! $topbar::$active ) {
			return;
		}
		?>
		<div id="topbar" class="d-none d-lg-flex align-items-center">
			<div class="container d-flex align-items-center">
			<?php if ( $topbar->is_left_panel_active() ) : ?>
			<div class="topbar-left col-sm">
				<ul>
				<?php if ( '' !== $topbar->get_contact_number() ) : ?>
				<li><i class="icon-phone"></i>
				<a href="tel:<?php echo esc_attr( $topbar->get_contact_number() ); ?>">
					<?php echo esc_html( $topbar->get_contact_number() ); ?>
				</a>
				<span></span>
				</li>
				<?php endif; ?>
				<?php if ( '' !== $topbar->get_contact_email() ) : ?>
				<li><i class="icon-email"></i>
				<a href="mailto:<?php echo esc_attr( $topbar->get_contact_email() ); ?>">
					<?php echo esc_html( $topbar->get_contact_email() ); ?>
				</a>
				<span></span>
				</li>
				<?php endif; ?>
				</ul>
			</div><!-- .topbar-left -->
			<?php endif; // End is_left_panel_active. ?>

			<div class="topbar-right col-sm">
			<?php if ( '' !== $topbar::$contactText && 'button' === $topbar::$topbar_select ) : ?>				
				<div class="cta">
					<a href="<?php echo esc_url_raw( $topbar->contactUrl ); ?>" class="topbar-cta-btn">
					<?php echo esc_html( $topbar::$contactText ); ?>
					</a>
				</div>
			<?php endif; ?>
			<?php if ( 'social' === $topbar::$topbar_select ) : ?>	
				<?php get_template_part( 'template-parts/header/topbar', 'social' ); ?>
			<?php endif; ?>
			</div>

			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'paddle_header_media' ) ) {
	/**
	 * paddle_header_media
	 *
	 * @return void
	 */
	function paddle_header_media() {
		$media_type = get_theme_mod( 'header_media_select', PADDLE_DEFAULT_OPTION['header_media_select'] );
		if ( 'none' !== $media_type && is_front_page() || 'none' !== $media_type && is_home() ) :
			if ( 'hero' === $media_type ) {
				get_template_part( 'template-parts/header/site', 'branding' );
			} else {
				get_template_part( 'template-parts/header/site', 'slider' );
			}

		endif;
	}
}

if ( ! function_exists( 'paddle_get_header_image_url' ) ) {
	/**
	 * paddle_get_header_image_url
	 *
	 * @return string
	 */
	function paddle_get_header_image_url() {
		if ( get_theme_mod( 'hero_image', PADDLE_DEFAULT_OPTION['hero_image'] ) > 0 ) {

			return wp_get_attachment_url( get_theme_mod( 'hero_image' ) );

		} else {
			$media_type              = get_theme_mod( 'header_media_select', PADDLE_DEFAULT_OPTION['header_media_select'] );
			$default_bg_image_enable = get_theme_mod( 'use_default_banner_image', PADDLE_DEFAULT_OPTION['use_default_banner_image'] );

			if ( 0 === $default_bg_image_enable ) {
				return '';
			}

			if ( 'hero' === $media_type ) {
				return get_template_directory_uri() . '/assets/images/golden-ball.jpeg';
			} else {
				return get_template_directory_uri() . '/assets/images/white-swipe.png';
			}
		}
	}
}

if ( ! function_exists( 'paddle_get_font_type' ) ) {
	function paddle_get_font_type() {
		$font      = '';
		$font_type = get_theme_mod( 'paddle_typography_preset', PADDLE_DEFAULT_OPTION['paddle_typography_preset'] );

		if ( 'system-font' === $font_type ) {
			return '';
		}

		switch ( $font_type ) {
			case 'roboto':
				$font = "'Roboto', sans-serif";
				break;

			case 'open-sans':
				$font = "'Open Sans', sans-serif";
				break;

			case 'lato':
				$font = "'Lato', sans-serif";
				break;

			case 'montserrat':
				$font = "'Montserrat', sans-serif";
				break;

			case 'raleway':
				$font = "'Raleway', sans-serif";
				break;

			case 'source-sans-pro':
				$font = "'Source Sans Pro', sans-serif";
				break;

			case 'poppins':
				$font = "'Poppins', sans-serif";
				break;

		}

		return $font;
	}
}

if ( ! function_exists( 'paddle_svg_color' ) ) {
	function paddle_svg_color( $color = '' ) {
		if ( '' === $color ) {
			$color = paddle_theme_get_color( 'paddle_theme_color_links' );
		}
		return str_replace( '#', '%23', $color );
	}
}


if ( ! function_exists( 'paddle_search_layout' ) ) {
	function paddle_search_layout() {
		$paddle_menu = new PaddleMenu();
		// Check the desktop search and mobile search are the same layout
		if ( $paddle_menu->searchLayout( 'input' ) ) : // Header search button.
			?>
			<div class="full-width-search-container icon-with-input">
				<div class="search-form-container">
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php elseif ( $paddle_menu->searchLayout( 'icon' ) ) : ?>
			<div id="search-glass">
				<button class="btn button-search" data-bs-toggle="modal" data-bs-target="#searchModal"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'paddle' ); ?></span>
				</button>
			</div>
			<?php
		elseif ( $paddle_menu->searchLayout( 'both' ) ) :
			// Using different search layout for mobile and desktop. Hide one on desktop
			?>
			 <div id="search-glass" class="<?php echo 'icon' === esc_attr( $paddle_menu->searchType( 'mobile' ) ) ? 'd-block d-lg-none mobile' : 'd-none d-lg-flex desktop'; ?>">
				<button class="btn button-search" data-bs-toggle="modal" data-bs-target="#searchModal"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'paddle' ); ?></span>
				</button>
			</div>

			<div class="full-width-search-container icon-with-input <?php echo 'input' === esc_attr( $paddle_menu->searchType( 'desktop' ) ) ? 'd-none d-lg-flex desktop' : 'd-block d-lg-none mobile'; ?>">
				<div class="search-form-container">
					<?php get_search_form(); ?>
				</div>
			</div>
		   
			<?php
		endif;
	}
}

function paddle_get_registered_menu() {
	$list = array();

	$menus = wp_get_nav_menus();

	if( ! empty( $menus ) && count($menus) > 0 ) :
		foreach ( $menus as $menu ) {
			array_push($list, $menu->slug); // $menu->name
		}
	endif;

	return $list;
}

/**
 * Filter the Footer Credits to insert the Current Year and Copyright, Registered & Trademark symbols
 *
 * @since Paddle 1.0
 *
 * @return string Filtered footer credits string
 */
function paddle_filter_footer_copyright( $credits ) {
	$credits = str_ireplace ( '%currentyear%' , date( 'Y' ) , $credits );
	$credits = str_ireplace ( '%copy%' , '&copy;' , $credits );
	$credits = str_ireplace ( '%reg%' , '&reg;' , $credits );
	$credits = str_ireplace ( '%trade%' , '&trade;' , $credits );

	return $credits;
}



