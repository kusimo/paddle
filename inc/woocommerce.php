<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package paddle
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function paddle_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 300,
			'single_image_width'    => 600,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'paddle_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function paddle_woocommerce_scripts() {
	wp_enqueue_style( 'paddle-woocommerce-style', get_template_directory_uri() . '/css/woocommerce.min.css', array(), '1.1.4' );

	$font_path   = esc_url( WC()->plugin_url() . '/assets/fonts/' );
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'paddle-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'paddle_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function paddle_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'paddle_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param  array $args related products args.
 * @return array $args related products args.
 */
function paddle_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'paddle_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'paddle_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function paddle_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area col-sm-12  <?php echo esc_attr( paddle_layout_container( 'content' ) ); ?>">
			<main class="site-main <?php echo esc_attr( paddle_layout_width() ); ?>">
		<?php
	}
}
	add_action( 'woocommerce_before_main_content', 'paddle_woocommerce_wrapper_before' );

if ( ! function_exists( 'paddle_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function paddle_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</div>
		<!--#primary-->
		<?php
	}
}
	add_action( 'woocommerce_after_main_content', 'paddle_woocommerce_wrapper_after' );

if ( ! function_exists( 'paddle_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param  array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function paddle_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		paddle_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
	add_filter( 'woocommerce_add_to_cart_fragments', 'paddle_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'paddle_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function paddle_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'paddle' ); ?>">
		<?php
		$item_count_text = sprintf(
		/* translators: number of items in the mini cart. */
			_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'paddle' ),
			WC()->cart->get_cart_contents_count()
		);
		?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><span class="count-item"><?php echo esc_html( $item_count_text ); ?></span></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'paddle_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.WooCommerce Mini Cart.
	 *
	 * @return void
	 */
	function paddle_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart list-unstyled m-0">
			<li class="<?php echo esc_attr( $class ); ?>">
		<?php
		paddle_woocommerce_cart_link();
		?>
			</li>
			<li>
		<?php
		$instance = array(
			'title' => '',
		);

		the_widget( 'WC_Widget_Cart', $instance );
		?>
			</li>
		</ul>
		<?php
	}
}


if ( ! function_exists( 'paddle_woocommerce_user_account' ) ) :
	/**
	 * Header, display user account Signup Links
	 *
	 * @return void
	 */
	function paddle_woocommerce_user_account() {
		?>
		<ul class="site-header-login list-unstyled m-0">
		<?php
		$woo_user_page_id = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		if ( is_user_logged_in() ) :
			?>
				<li><a class="nav-link position-relative" href="<?php echo esc_url_raw( $woo_user_page_id ); ?>" title="<?php esc_attr_e( 'My Account', 'paddle' ); ?>"><span class="woo-icon-user"></span><span class="woo-my-account"><?php esc_html_e( 'My Account', 'paddle' ); ?></span></a></li>
			<?php
	else :
		?>
				<li><a class="nav-link position-relative" href="<?php echo esc_url_raw( $woo_user_page_id ); ?>" title="<?php esc_attr_e( 'Sign in', 'paddle' ); ?>"><span class="woo-icon-user"></span><span class="woo-my-account"><?php esc_html_e( 'Sign in', 'paddle' ); ?></span></a></li>
		<?php
endif;
	?>
		</ul>
		<?php
	}
endif;

if ( ! function_exists( 'paddle_get_total_cart_item' ) ) {
	/**
	 * Get total cart item. This is used on the page header.
	 */
	function paddle_get_total_cart_item() {
		if ( is_cart() ) {
			$class = 'nav-link position-relative current-menu-item';
		} else {
			$class = 'nav-link position-relative';
		}
		?>
		<ul class="list-unstyled m-0 woo-basket">

			<li>
				<a class="<?php echo esc_attr( $class ); ?>" title="Basket" href="<?php echo esc_url( wc_get_cart_url() ); ?>" data-qty="<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>"><span class="woo-cart-icon"></span><span class="woo-my-item"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span></a>
			</li>
		</ul>

		<?php
	}
}

	/**
	 * Remove Sidebar @ Single Product Page
	 */

	add_action( 'wp', 'paddle_remove_sidebar_product_pages' );

if ( ! function_exists( 'paddle_remove_sidebar_product_pages' ) ) :
	function paddle_remove_sidebar_product_pages() {
		if ( is_product() && 0 === get_theme_mod( 'paddle_remove_woo_single_sidebar', PADDLE_DEFAULT_OPTION['paddle_remove_woo_single_sidebar'] ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}
	}
endif;

	/**
	 * Product gallery 1 page per row
	 */
	add_filter( 'woocommerce_product_thumbnails_columns', 'paddle_change_gallery_columns' );

function paddle_change_gallery_columns() {
	return 1;
}


	/**
	 * Remove additional information tab. The additional information will be displayed as dropdown.
	 */
	add_filter( 'woocommerce_product_tabs', 'paddle_remove_additional_information_tab', 100, 1 );

if ( ! function_exists( 'paddle_remove_additional_information_tab' ) ) :
	function paddle_remove_additional_information_tab( $tabs ) {
		unset( $tabs['additional_information'] );

		return $tabs;
	}
endif;

	/**
	 * Remove default excerpt placement on single product page. This will be show as dropdown.
	 */
	add_action( 'woocommerce_single_product_summary', 'paddle_single_product_summary_action', 1 );
if ( ! function_exists( 'paddle_single_product_summary_action' ) ) :
	function paddle_single_product_summary_action() {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		// Add our custom function replacement.
		add_action( 'woocommerce_single_product_summary', 'paddle_single_excerpt_custom_replacement', 30 );
	}
endif;


if ( ! function_exists( ' paddle_single_excerpt_custom_replacement' ) ) :
	/**
	 * Displays the excerpt as dropdown.
	 *
	 * @return void
	 */
	function paddle_single_excerpt_custom_replacement() {
		?>
		<div id="accordion" class="mb-5">
		<?php
		// check excerpt is not empty.
		if ( has_excerpt() ) :
			?>
				<div class="card">
					<div class="card-header p-0" id="headingOne">
						<h5 class="my-0">
							<button class="btn btn-light btn-toggle-icon" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<?php echo esc_html_e( 'Short Description', 'paddle' ); ?>
							</button>
						</h5>
					</div>

					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">
			<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
		<?php endif; ?>

		<?php
		// Check attribute not empty.
		global $product;
		if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) :
			?>
				<div class="card">
					<div class="card-header p-0" id="headingTwo">
						<h5 class="my-0">
							<button class="btn btn-light btn-toggle-icon collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<?php echo esc_html_e( 'Additional Information', 'paddle' ); ?>
							</button>
						</h5>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
						<div class="card-body">
			<?php wc_display_product_attributes( $product ); ?>
						</div>
					</div>
				</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'product-area-collapse' ) ) : ?>
				<div class="card">
					<div class="card-header p-0" id="headingThree">
						<h5 class="my-0">
							<button class="btn btn-light btn-toggle-icon collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			<?php
			// Get the widget title.
			$sidebar_id       = 'product-area-collapse';
			$sidebars_widgets = wp_get_sidebars_widgets();
			$widget_ids       = $sidebars_widgets[ $sidebar_id ];
			foreach ( $widget_ids as $id ) {
				$wdgtvar  = 'widget_' . _get_widget_id_base( $id );
				$idvar    = _get_widget_id_base( $id );
				$instance = get_option( $wdgtvar );
				$idbs     = str_replace( $idvar . '-', '', $id );
				echo esc_attr( $instance[ $idbs ]['title'] );
			}
			?>
							</button>
						</h5>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						<div class="card-body">
			<?php dynamic_sidebar( 'product-area-collapse' ); ?>
						</div>
					</div>
				</div>
		<?php endif; ?>
		</div>
		<?php
	}
endif;

	/**
	 * Display Sale Price, shows amount saved.
	 */
if ( ! function_exists( 'paddle_change_displayed_sale_price_html' ) ) :
	function paddle_change_displayed_sale_price_html( $price, $product ) {
		// Only on sale products on frontend and excluding min/max price on variable products
		if ( $product->is_on_sale() && ! is_admin() && ! $product->is_type( 'variable' ) ) :
			// Get product prices
			$regular_price = (float) $product->get_regular_price(); // Regular price
			$sale_price    = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)
			$amount_saved  = $regular_price - $sale_price;
			$output        = '';
			// "Saving Percentage" calculation and formatting
			if ( $regular_price > 0 ) {
				$saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), 1 ) . '%';
				// Append to the formated html price.
				$output .= sprintf(  /* translators: %1$s%2$0.2f: total savings amount, %3$s percentages  */
					__( 'You save %1$s%2$0.2f (%3$s)', 'paddle' ),
					get_woocommerce_currency_symbol(),
					$amount_saved,
					$saving_percentage
				);
				$price  .= '<p class="small-text green-color">';
				$price  .= $output;
				$price  .= '</p>';
			}

		endif;
		return $price;
	}
endif;
	add_filter( 'woocommerce_get_price_html', 'paddle_change_displayed_sale_price_html', 10, 2 );


	/**
	 * Add widget area after main content
	 */
function paddle_after_main_content() {
	if ( is_active_sidebar( 'after-single-product' ) ) :
		?>
		<div id="paddle-after-product-sidebar" class="paddle-widget-area after-single-product" role="complementary">
		<?php dynamic_sidebar( 'after-single-product' ); ?>
		</div><!-- #primary-sidebar -->
		<?php
	endif;
};

	add_action( 'woocommerce_after_single_product', 'paddle_after_main_content', 10, 2 );

	/**
	 * This widget is displayed after product meta. e.g. SKU.
	 */
function paddle_woocommerce_product_meta_end() {
	if ( is_active_sidebar( 'after-product-meta' ) ) :
		?>
		<div id="paddle-after-product-meta" class="paddle-widget-area after-product-meta" role="complementary">
		<?php dynamic_sidebar( 'after-product-meta' ); ?>
		</div><!-- #primary-sidebar -->
		<?php
	endif;
};

add_action( 'woocommerce_product_meta_end', 'paddle_woocommerce_product_meta_end', 10, 0 );

//* WooCommerce Assets Optimisation. @Todo uncomment add_action and test.
//add_action( 'wp_enqueue_scripts', 'paddle_optimise_disable_woocommerce_loading_css_js' );
function paddle_optimise_disable_woocommerce_loading_css_js() {
    // Check if WooCommerce plugin is active
    if( paddle_is_woocommerce_active() ){
        // Check if it's any of WooCommerce page
       if(! is_woocommerce() && ! is_cart() && ! is_checkout() ) {         
            
            ## Dequeue WooCommerce styles
            wp_dequeue_style('woocommerce-layout'); 
            wp_dequeue_style('woocommerce-general'); 
            wp_dequeue_style('woocommerce-smallscreen');  
		
            ## Dequeue Paddle WooCommerce styles 
            wp_dequeue_style('paddle-woocommerce-style');     
            ## Dequeue WooCommerce scripts
            wp_dequeue_script('wc-cart-fragments');
            wp_dequeue_script('woocommerce'); 
            wp_dequeue_script('wc-add-to-cart'); 
        
            wp_deregister_script( 'js-cookie' );
            wp_dequeue_script( 'js-cookie' );
            

        }
    }    
}
