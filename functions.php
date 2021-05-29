<?php

/**
 * Paddle functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package paddle
 */

if ( ! defined( 'PADDLE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'PADDLE_VERSION', '1.0.0' );
}

if ( ! defined( 'PADDLE_DEV_VERSION' ) ) {
	$paddle_version = paddle_theme_version() . '.' . filemtime( get_template_directory() . '/css/theme.css' );
	define( 'PADDLE_DEV_VERSION', $paddle_version );
}

if ( ! defined( 'PADDLE_PRIMARY_COLOR' ) ) {
	// Replace the version number of the theme on each release.
	define( 'PADDLE_PRIMARY_COLOR', '#000000' );
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
		add_image_size( 'paddle-600x400-image', 600, 400, true );

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

	// Check and setup theme default settings.
	paddle_setup_theme_default_settings();

endif;

add_action( 'after_setup_theme', 'paddle_setup' );




/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function paddle_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'paddle_content_width', 640 );
}
add_action( 'after_setup_theme', 'paddle_content_width', 0 );

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
}

add_action( 'widgets_init', 'paddle_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

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
require get_template_directory() . '/inc/customizer/customizer.php';

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
