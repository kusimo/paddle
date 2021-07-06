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
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap5/bootstrap.min.css', array(), '5.1' );
		wp_style_add_data( 'bootstrap-css', 'rtl', 'replace' );


		wp_enqueue_style( 'paddle-theme-style', get_template_directory_uri() . '/css/theme.min.css', array(), PADDLE_DEV_VERSION );
		wp_style_add_data( 'paddle-theme-style', 'rtl', 'replace' );

		wp_enqueue_script( 'paddle-script', get_template_directory_uri() . '/js/theme.js', array(), filemtime( get_template_directory( __FILE__ ) . '/js/theme.min.js' ), true );

		wp_enqueue_script( 'paddle-bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap5/bootstrap.min.js', array(), '5.1', true );

		// Navigation JS
		//wp_enqueue_script( 'paddle-navigation-scripts', get_template_directory_uri() . '/js/navigation.min.js', array(), '0.0.2', true );

		// Offcanvas
		wp_enqueue_script( 'paddle-theme-navigation-scripts', get_template_directory_uri() . '/js/navigation.js',array(), filemtime( get_template_directory( __FILE__ ) . '/js/navigation.min.js' ), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;

