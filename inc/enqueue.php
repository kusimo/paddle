<?php

/**
 * Paddle enqueue scripts
 *
 * @package Paddle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue (CSS and JS)
 */
add_action( 'wp_enqueue_scripts', 'paddle_theme_scripts' );

if ( ! function_exists( 'paddle_theme_scripts' ) ) :
	function paddle_theme_scripts() {
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap5/bootstrap.min.css', array(), '5.0' );
		wp_style_add_data( 'bootstrap-css', 'rtl', 'replace' );

		wp_enqueue_style( 'paddle-style', get_stylesheet_uri(), array(), PADDLE_VERSION );
		wp_style_add_data( 'paddle-style', 'rtl', 'replace' );

		wp_enqueue_style( 'paddle-theme-style', get_template_directory_uri() . '/css/theme.min.css', array(), PADDLE_DEV_VERSION );
		// Use this global variable for development PADDLE_DEV_VERSION.
		wp_style_add_data( 'paddle-theme-style', 'rtl', 'replace' );

		wp_enqueue_script( 'paddle-script', get_template_directory_uri() . '/js/theme.min.js', array(), filemtime( get_template_directory( __FILE__ ) . '/js/theme.min.js' ), true );

		wp_enqueue_script( 'paddle-bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap5/bootstrap.min.js', array(), '5.0', true );

		// Navigation JS
		wp_enqueue_script( 'paddle-navigation-scripts', get_template_directory_uri() . '/js/navigation.min.js', array(), '0.0.1', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;



/**
 * Enque footer for logo script
 */
add_action( 'wp_enqueue_scripts', 'paddle_footer_logo_script' );

if ( ! function_exists( 'paddle_footer_logo_script' ) ) :

	function paddle_footer_logo_script() {
		$footer_theme_option = get_theme_mod( 'paddle_footer_logo', 0 );
		$custom_logo_id      = get_theme_mod( 'custom_logo' );
		$image               = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( ! is_array( $image ) || empty( $image ) ) {
			return;
		}
		$logo_url = $image[0];

		if ( 1 === $footer_theme_option && '' !== $logo_url ) {
			wp_enqueue_script( 'paddle_footer_logo_script', get_template_directory_uri() . '/js/logo-script.min.js', array(), '0.0.1', true );

			wp_localize_script(
				'paddle_footer_logo_script',
				'frontend_ajax_object',
				array(
					'paddle_logo_url' => $logo_url,
					'alt'             => get_bloginfo( 'name' ),
				)
			);
		}
	}

endif;
