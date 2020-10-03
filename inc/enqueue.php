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
function paddle_scripts() {

	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css', array(), '1.5.0' );

	wp_enqueue_style( 'paddle-style', get_stylesheet_uri(), array(), PADDLE_VERSION );
	wp_style_add_data( 'paddle-style', 'rtl', 'replace' );


	wp_enqueue_style( 'paddle-theme-style', get_template_directory_uri() . '/css/theme.css', array(), PADDLE_DEV_VERSION );
	// Use this global variable for development PADDLE_DEV_VERSION.
	wp_style_add_data( 'paddle-theme-style', 'rtl', 'replace' );
	
	
	wp_enqueue_style( 'bootstrap-offcanvas-style', get_template_directory_uri() . '/css/bootstrap.offcanvas.css', array(), '1.0' );

	wp_enqueue_script( 'paddle-script', get_template_directory_uri() . '/js/theme.js', array(), '0.0.8', true );

	wp_enqueue_script( 'paddle-bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '4.5', true );

	wp_enqueue_script( 'paddle-bootstrap-offcanvas-scripts', get_template_directory_uri() . '/js/bootstrap.offcanvas.min.js', array(), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'paddle_scripts' );
