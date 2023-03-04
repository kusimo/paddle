<?php

/**
 * Paddle functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package paddle
 */

use ParagonIE\Sodium\Core\Util;

if ( ! defined( 'PADDLE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'PADDLE_VERSION', '1.2.1' );
}

if ( ! defined( 'PADDLE_DEV_VERSION' ) ) {
	$paddle_version = paddle_theme_version() . '.' . filemtime( get_template_directory() . '/css/theme.css' );
	define( 'PADDLE_DEV_VERSION', $paddle_version );
}

/**
 * Get the theme version
 *
 * @return void
 */
function paddle_theme_version() {
	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	return $theme_version;
}

/**
 * Default theme option settings.
 */
require get_template_directory() . '/inc/default-theme-settings.php';



if ( ! function_exists( 'paddle_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function paddle_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on paddle, use a find and replace
		 * to change 'paddle' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'paddle', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Register a new image size.
		add_image_size( 'paddle-large-image', 1320, 990, true );
		add_image_size( 'paddle-featured-image', 1410, 600, true );
		add_image_size( 'paddle-with-sidebar-image', 1020, 600, true );
		add_image_size( 'paddle-medium-image', 800, 600, true );
		add_image_size( 'paddle-square-image', 600, 600, true );
		add_image_size( 'paddle-small-thumb', 480, 360, true );
		add_image_size( 'paddle-horizontal-image', 760, 400, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'paddle' ),
				'social'  => esc_html__( 'Social Menu', 'paddle' ),
			)
		);

		// Gutenberg Compatible
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'paddle_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}

	// Filters the oEmbed process to run the responsive_embed() function
    add_filter('embed_oembed_html', 'paddle_responsive_embed', 10, 3);

endif;

add_action( 'after_setup_theme', 'paddle_setup' );

function paddle_responsive_embed($html, $url, $attr) {
	$add_paddle_oembed_wrapper = apply_filters( 'paddle_responsive_oembed_wrapper_enable', true );

			$allowed_providers = apply_filters(
				'paddle_allowed_fullwidth_oembed_providers',
				array(
					'vimeo.com',
					'youtube.com',
					'youtu.be',
					'wistia.com',
					'wistia.net',
				)
			);

			if ( paddle_strposa( $url, $allowed_providers ) ) {
				if ( $add_paddle_oembed_wrapper ) {
					$html = ( '' !== $html ) ? '<div class="paddle-oembed-container">' . $html . '</div>' : '';
				}
			}
			return $html;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function paddle_content_width() {
	$content_width = paddle_get_content_width();

	/**
	 * Filter Paddle content width of the theme.
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'paddle_content_width', $content_width );
}
add_action( 'after_setup_theme', 'paddle_content_width', 0 );

function paddle_get_content_width() {

	$content_width = 1200;

	$padle_content_width = get_theme_mod( 'container_width', get_theme_mod( 'paddle_theme_content_width', PADDLE_DEFAULT_OPTION['paddle_theme_content_width'] ) );
	$custom_width        = get_theme_mod( 'custom_container', PADDLE_DEFAULT_OPTION['custom_container'] );

	if ( is_home() || is_post_type_archive( 'post' ) ) {
		$content_width = 1200;
		if ( 'custom' === $custom_width ) {
			$content_width = apply_filters( 'paddle_content_width', $padle_content_width );
		}
	} elseif ( is_page() || is_single() ) {
		// @todo Create customiser option for page and single post custom width. For now use blog archive and home width.
		$content_width = 1200;
		if ( 'custom' === $custom_width ) {
			$content_width = apply_filters( 'paddle_content_width', $padle_content_width );
		}
	} else {
		$content_width = $padle_content_width;
	}

	return $content_width;
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function paddle_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'paddle' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'This widget displays the sidebar.', 'paddle' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	if ( class_exists( 'WooCommerce' ) ) :
		register_sidebar(
			array(
				'name'          => esc_html__( 'After Single Product Page', 'paddle' ),
				'id'            => 'after-single-product',
				'description'   => esc_html__( 'This widget is displayed on product page after single product.', 'paddle' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'After Product Meta', 'paddle' ),
				'id'            => 'after-product-meta',
				'description'   => esc_html__( 'This widget is displayed on the product page after meta data, e.g. SKU.', 'paddle' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h5 class="after_product_meta-title">',
				'after_title'   => '</h5>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Product Area Collapse', 'paddle' ),
				'id'            => 'product-area-collapse',
				'description'   => esc_html__( 'This widget is displayed inside single product page as a dropdown option. The widget title will be used as the dropdown label', 'paddle' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h5 class="product-area-collapse-title d-none">',
				'after_title'   => '</h5>',
			)
		);
	endif;

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'paddle' ),
			'id'            => 'footer-1',
			'description'   => __( 'This widget appears in your footer.', 'paddle' ),
			'before_widget' => '<section id="%1$s" class="widget if-logo-footer %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'paddle' ),
			'id'            => 'footer-2',
			'description'   => __( 'This widget appears in your footer.', 'paddle' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'paddle' ),
			'id'            => 'footer-3',
			'description'   => __( 'This widget appears in your footer.', 'paddle' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 4', 'paddle' ),
			'id'            => 'footer-4',
			'description'   => __( 'This widget appears in your footer.', 'paddle' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 5', 'paddle' ),
			'id'            => 'footer-5',
			'description'   => __( 'This widget appears in your footer.', 'paddle' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'paddle_widgets_init' );

/**
 * Register custom fonts.
 */
if ( ! function_exists( 'paddle_theme_fonts_url' ) ) {
	function paddle_theme_fonts_url() {
		 $fonts_url     = '';
		$font_type      = get_theme_mod( 'paddle_typography_preset', PADDLE_DEFAULT_OPTION['paddle_typography_preset'] );
		$h1_font_weight = get_theme_mod( 'h1_font_weight', PADDLE_DEFAULT_OPTION['h1_font_weight'] );
		$h2_font_weight = get_theme_mod( 'h2_font_weight', PADDLE_DEFAULT_OPTION['h2_font_weight'] );

		/*
		 Translators: If there are characters in your language that are not
		* supported by Roboto, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$roboto = _x( 'on', 'Roboto font: on or off', 'paddle' );

		/*
		 Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x( 'on', 'Open Sans font: on or off', 'paddle' );

		/*
		 Translators: If there are characters in your language that are not
		* supported by Lato, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$lato = _x( 'on', 'Lato font: on or off', 'paddle' );

		/*
		 Translators: If there are characters in your language that are not
		* supported by Montserrat, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$montserrat = _x( 'on', 'Montserrat font: on or off', 'paddle' );

		/*
		 Translators: If there are characters in your language that are not
		* supported by Raleway, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$raleway = _x( 'on', 'Raleway font: on or off', 'paddle' );

		/*
		 Translators: If there are characters in your language that are not
		* supported by Source Sans Pro, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'paddle' );

		/*
		 Translators: If there are characters in your language that are not
		* supported by Poppins, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$poppins = _x( 'on', 'Poppins font: on or off', 'paddle' );

		if ( 'off' !== $roboto || 'off' !== $open_sans ) {
			$font_families = array();

			switch ( $font_type ) {
				case 'roboto':
					if ( 'off' !== $roboto ) {
						$font_families[] = 'Roboto:' . $h1_font_weight . ',' . $h2_font_weight . ',200,300,400';
					}
					break;

				case 'open-sans':
					if ( 'off' !== $open_sans ) {
						$font_families[] = 'Open Sans:' . $h1_font_weight . ',' . $h2_font_weight . ',200,300,400';
					}
					break;

				case 'lato':
					if ( 'off' !== $lato ) {
						$font_families[] = 'Lato:' . $h1_font_weight . ',' . $h2_font_weight . ',200,300,400';
					}
					break;

				case 'montserrat':
					if ( 'off' !== $montserrat ) {
						$font_families[] = 'Montserrat:' . $h1_font_weight . ',' . $h2_font_weight . ',200,300,400';
					}
					break;

				case 'raleway':
					if ( 'off' !== $raleway ) {
						$font_families[] = 'Raleway:' . $h1_font_weight . ',' . $h2_font_weight . ',200,300,400';
					}
					break;

				case 'source-sans-pro':
					if ( 'off' !== $source_sans_pro ) {
						$font_families[] = 'Source Sans Pro:' . $h1_font_weight . ',' . $h2_font_weight . ',200,300,400';
					}
					break;

				case 'poppins':
					if ( 'off' !== $poppins ) {
						$font_families[] = 'Poppins:' . $h1_font_weight . ',' . $h2_font_weight . ',200,300,400';
					}
					break;
			}

			$query_args = array(
				'family'  => urlencode( implode( '|', $font_families ) ),
				'subset'  => urlencode( 'latin,latin-ext' ),
				'display' => urlencode( 'swap' ),
			);

			$protocol = is_ssl() ? 'https' : 'http';

			$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
		}

		if ( 'system-font' === $font_type ) {
			return '';
		}

		return esc_url_raw( $fonts_url );
	}
}

function paddle_theme_editor_styles() {
	 add_editor_style( array( 'assets/css/bootstrap-basic.css', 'assets/css/editor-style.css', paddle_theme_fonts_url() ) ); // @todo Add editor-styles.css in the array of style to load
}
add_action( 'after_setup_theme', 'paddle_theme_editor_styles' );


/**
 * Get color by passing the option name.
 */
function paddle_theme_get_color( $option_name ) {
	if ( '' !== $option_name ) {
		return sanitize_hex_color( get_theme_mod( $option_name, PADDLE_DEFAULT_OPTION[ $option_name ] ) );
	}
}
/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function paddle_resource_hints( $urls, $relation_type ) {
	$font_type = get_theme_mod( 'paddle_typography_preset', PADDLE_DEFAULT_OPTION['paddle_typography_preset'] );
	if ( wp_style_is( 'paddle-fonts', 'queue' ) && 'preconnect' === $relation_type && 'system-font' !== $font_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'paddle_resource_hints', 10, 2 );

/**
 * Check if post is using gallery before adding gallery CSS
 */
function paddle_load_ondemand_css( $post_id = false, $search_string = '' ) {
	if ( ! $post_id ) {
		global $post;
	} else {
		$post = get_post( $post_id );
	}
	if ( '' === $search_string ) {
		return false;
	}
	return ( strpos( $post->post_content, $search_string ) !== false );
}

/**
 * Get header style
 */

function paddle_get_default_header_number( $default_header ) {
	$style         = explode( '-', $default_header );
	$header_number = is_array( $style ) ? end( $style ) : 1;
	if ( in_array( $header_number, array( '1', '2', '3', '4' ) ) ) {
		return '1-4';
	}
	if ( in_array( $header_number, array( '5' ) ) ) {
		return '5-6';
	}
	if ( in_array( $header_number, array( '6' ) ) ) {
		return '6';
	}
	return '';
}

/*
* Include our Customizer settings.
*/
require get_template_directory() . '/inc/customizer/customizer-functions.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom classes for the theme
 */
foreach ( glob( get_template_directory() . '/inc/classes/*.php' ) as $file ) {
	require_once $file;
}

/**
 * Helpers.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Global/Dynamic CSS
 */
require get_template_directory() . '/inc/dynamic-css/frontend-dynamic-css.php';
require get_template_directory() . '/inc/dynamic-css/paddle-header-1-4.php';
require get_template_directory() . '/inc/dynamic-css/paddle-header-5-6.php';
require get_template_directory() . '/inc/dynamic-css/paddle-header-6.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Only load styles for used blocks
 * WordPress 5.8
 *
 * @Todo check if not using using Classid editor as the block styles are moved to footer if using classic editor.
 */

add_filter( 'should_load_separate_core_block_assets', '__return_true' );
