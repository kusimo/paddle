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
//add_action( 'wp_enqueue_scripts', 'paddle_theme_scripts' );
/*
if ( ! function_exists( 'paddle_theme_scripts' ) ) :
	function paddle_theme_scripts() {
		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap5/bootstrap.min.css', array(), '5.1' );
		wp_style_add_data( 'bootstrap-css', 'rtl', 'replace' );


		wp_enqueue_style( 'paddle-theme-style', get_template_directory_uri() . '/css/theme.min.css', array(), PADDLE_DEV_VERSION );
		wp_style_add_data( 'paddle-theme-style', 'rtl', 'replace' );

		wp_enqueue_script( 'paddle-script', get_template_directory_uri() . '/js/theme.min.js', array(), filemtime( get_template_directory( __FILE__ ) . '/js/theme.min.js' ), true );

		wp_enqueue_script( 'paddle-bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap5/bootstrap.min.js', array(), '5.1', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
*/
add_action( 'wp_enqueue_scripts', 'paddle_enqueue_scripts' );

if ( ! function_exists( 'paddle_enqueue_scripts' ) ) :
	function paddle_enqueue_scripts() {
		$bootstrap_css =  absint( get_theme_mod( 'use_full_bootstrap', PADDLE_DEFAULT_OPTION['use_full_bootstrap'] ) );
		$bootstrap_js  =  absint( get_theme_mod( 'use_bootstrap_js', PADDLE_DEFAULT_OPTION['use_bootstrap_js'] ) );

		// Load Google Font
		$fonts_url = paddle_theme_fonts_url();
		if ( !empty( $fonts_url && '' !== $fonts_url ) ) {
			wp_enqueue_style( 'paddle-fonts', esc_url_raw( $fonts_url ), array(), null );
		}

		// Load full boostrap CSS
		if ( 1 === $bootstrap_css ) {
			wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap5/bootstrap.min.css', array(), '5.1' );
			wp_style_add_data( 'bootstrap-css', 'rtl', 'replace' );

			// Load style with no bootstrap included
			wp_enqueue_style( 'paddle-exbs-theme-style', get_template_directory_uri() . '/css/theme-nbs.min.css', array(), PADDLE_DEV_VERSION );
			wp_style_add_data( 'paddle-exbs-theme-style', 'rtl', 'replace' );
		} else {
			// Load style with custom bootstrap included
			wp_enqueue_style( 'paddle-theme-style', get_template_directory_uri() . '/css/theme.css', array(), PADDLE_DEV_VERSION );
			wp_style_add_data( 'paddle-theme-style', 'rtl', 'replace' );

			$theme_css_data = apply_filters( 'paddle_dynamic_theme_css', '' );
			wp_add_inline_style( 'paddle-theme-style', $theme_css_data );
		}


		// Load bootstrap JS
		if ( 1 === $bootstrap_js ) {
			wp_enqueue_script( 'paddle-bootstrap-scripts', get_template_directory_uri() . '/js/bootstrap5/bootstrap.min.js', array(), '5.1', true );
		}


		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			//comment CSS
			wp_enqueue_style( 'paddle-theme-comments', get_template_directory_uri() . '/css/comments.css', array(), PADDLE_DEV_VERSION );
			wp_style_add_data( 'paddle-theme-comments', 'rtl', 'replace' );
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;

