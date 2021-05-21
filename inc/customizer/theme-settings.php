<?php

/**
 * Theme Customizer
 *
 * @package paddle
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'paddle_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function paddle_theme_customize_register( $wp_customize ) {

		/* Add custom panel Theme Options */
		$wp_customize->add_panel(
			'paddle_theme_option_panel',
			array(
				'title'      => esc_html__( 'Theme Options', 'paddle' ),
				'priority'   => 90,
				'capability' => 'edit_theme_options',
			)
		);

		/* Theme header section. */
		$wp_customize->add_section(
			'paddle_theme_header_options',
			array(
				'title'       => __( 'Header Options', 'paddle' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Header options', 'paddle' ),
				'priority'    => 10,
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		// Header search.

		$wp_customize->add_setting(
			'paddle_header_search_button',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_header_search_button',
			array(
				'type'     => 'checkbox',
				'section'  => 'paddle_theme_header_options',
				'label'    => __( 'Show the header search button icon', 'paddle' ),
				'priority' => 0,
			)
		);

		// Header display option
		$wp_customize->add_setting(
			'paddle_header_layout_style',
			array(
				'default'           => 'logo-left',
				'sanitize_callback' => 'paddle_theme_sanitize_radio',
			)
		);

		$wp_customize->add_control(
			'paddle_header_layout_style',
			array(
				'type'        => 'radio',
				'section'     => 'paddle_theme_header_options',
				'label'       => esc_html__( 'Header layout', 'paddle' ),
				'description' => esc_html( 'Select where you want the logo to appear on the page' ),
				'priority'    => 0,
				'choices'     => array(
					'logo-left'        => esc_html( 'Logo on the left' ),
					'logo-right'       => esc_html( 'Logo on the right' ),
					'logo-center'      => esc_html( 'Logo at the center' ),
					'logo-with-search' => esc_html( 'Logo and search close together.' ),
				),
			)
		);

		// Setting for menu background color
		$wp_customize->add_setting(
			'paddle_menu_bgcolor',
			array(
				'default'           => '#ffffff',
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Control for menu background color.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_menu_bgcolor',
				array(
					'label'    => __( 'Menu background color', 'paddle' ),
					'section'  => 'paddle_theme_header_options',
					'settings' => 'paddle_menu_bgcolor',
					'priority' => 1,
				)
			)
		);

		// Header menu link text color
		$wp_customize->add_setting(
			'paddle_navlink_text_color',
			array(
				'default'           => '#5b6770',
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		// Add the controls
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_navlink_text_color',
				array(
					'label'    => __( 'Header link color', 'paddle' ),
					'section'  => 'paddle_theme_header_options',
					'settings' => 'paddle_navlink_text_color',
					'priority' => 2,
				)
			)
		);

		// Center aligned the menu
		$wp_customize->add_setting(
			'paddle_center_align_menu',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_center_align_menu',
			array(
				'label'    => esc_html__( 'Center align menu', 'paddle' ),
				'section'  => 'paddle_theme_header_options',
				'type'     => 'checkbox',
				'priority' => 3,
			)
		);

		// Theme header settings & controls.
		// Menu text to uppercase.
		$wp_customize->add_setting(
			'paddle_menu_text_to_uppercase',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_menu_text_to_uppercase',
			array(
				'label'    => esc_html__( 'Display menu item in uppercase', 'paddle' ),
				'section'  => 'paddle_theme_header_options',
				'type'     => 'checkbox',
				'priority' => 4,
			)
		);

		// Title Headings.
		$wp_customize->add_setting(
			'paddle_title_headings_solid_lines',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_title_headings_solid_lines',
			array(
				'label'    => esc_html__( 'Enable short solid line before headings titles in the page body (h1 and h2)', 'paddle' ),
				'section'  => 'paddle_theme_header_options',
				'type'     => 'checkbox',
				'priority' => 5,
			)
		);

		// Call to action button.
		$wp_customize->add_setting(
			'paddle_header_cta',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_header_cta',
			array(
				'label'    => esc_html__( 'Enable CTA button in the menu area.', 'paddle' ),
				'section'  => 'paddle_theme_header_options',
				'type'     => 'checkbox',
				'priority' => 6,
			)
		);

		// Setting CTA URL.
		$wp_customize->add_setting(
			'paddle_header_cta_url',
			array(
				'default'           => home_url(),
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'paddle_header_cta_url',
			array(
				'label'           => esc_html__( 'CTA Link URL', 'paddle' ),
				'section'         => 'paddle_theme_header_options',
				'type'            => 'url',
				'priority'        => 7,
				'active_callback' => function () {
					return get_theme_mod( 'paddle_header_cta', 1 );
				},
			)
		);

		// Setting CTA Text.
		$wp_customize->add_setting(
			'paddle_header_cta_text',
			array(
				'default'           => 'CTA Button',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'paddle_header_cta_text',
			array(
				'label'           => esc_html__( 'CTA button text', 'paddle' ),
				'section'         => 'paddle_theme_header_options',
				'type'            => 'text',
				'priority'        => 8,
				'active_callback' => function () {
					return get_theme_mod( 'paddle_header_cta', 1 );
				},
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'paddle_header_cta_text',
			array(
				'selector'        => '#header-btn-cta a.btn',
				'render_callback' => function () {
					return get_theme_mod( 'paddle_header_cta_text' );
				},
			)
		);

		// Select h1 style
		$wp_customize->add_setting(
			'paddle_heading_h1_style',
			array(
				'default'           => 'classic',
				'sanitize_callback' => 'paddle_select_option_sanitization',
			)
		);
		$wp_customize->add_control(
			'paddle_heading_h1_style',
			array(
				'label'       => esc_html__( 'Main heading H1 style', 'paddle' ),
				'description' => __( 'Toggle the style of the main headings style (Default is classic).', 'paddle' ),
				'section'     => 'paddle_theme_header_options',
				'type'        => 'select',
				'priority'    => 3,
				'choices'     => array(
					''        => esc_html__( 'Please select', 'paddle' ),
					'classic' => esc_html__( 'classic', 'paddle' ),
					'boxed'   => esc_html__( 'boxed', 'paddle' ),
				),
			)
		);
		// Main Heading H1 background color
		$wp_customize->add_setting(
			'paddle_h1bg_color',
			array(
				'default'           => '#000000',
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		// Add the controls
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_h1bg_color',
				array(
					'label'       => __( 'Main heading H1 background color', 'paddle' ),
					'description' => __( 'Select backgournd color for boxed style Heading. (the default background heading the theme primary color).', 'paddle' ),
					'section'     => 'paddle_theme_header_options',
					'settings'    => 'paddle_h1bg_color',
				)
			)
		);

		/*
		---------------------------------------------------------------------------------------*/
		// Slider Section

		$wp_customize->add_section(
			'paddle_slider_settings',
			array(
				'priority'    => 14,
				'title'       => __( 'Slider Settings', 'paddle' ),
				'description' => __( 'Slider Section - Use this on homepage. You need to disable the homepage header image for this to work. ', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		// Checkbox to enable slider.
		$wp_customize->add_setting(
			'paddle_enable_slider',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);
		$wp_customize->add_control(
			'paddle_enable_slider',
			array(
				'label'    => __( 'Check to enable the slider. Hide image in the Header Imge section for slider to work.', 'paddle' ),
				'section'  => 'paddle_slider_settings',
				'type'     => 'checkbox',
				'priority' => 1,

			)
		);

		// Field 1 - Slider Page Number 1
		$wp_customize->add_setting(
			'paddle_slider_page1',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_page1',
			array(
				'label'       => __( 'Set slider page 1', 'paddle' ),
				'description' => __( 'Select a page from the dropdown below.', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'dropdown-pages',
				'priority'    => 2,
			)
		);

		// Field 2 - Slider Button Text Number 1
		$wp_customize->add_setting(
			'paddle_slider_button_text1',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_text1',
			array(
				'label'       => __( 'Button Text for Page 1', 'paddle' ),
				'description' => __( 'Button Text for Page 1', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'text',
				'priority'    => 2,
			)
		);

		// Field 3 - Slider Button URL Number 1
		$wp_customize->add_setting(
			'paddle_slider_button_url1',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_url1',
			array(
				'label'       => __( 'URL for Page 1', 'paddle' ),
				'description' => __( 'URL for Page 1', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'url',
				'priority'    => 2,
			)
		);

		/*---------------------------------------------------------------------------------------*/

		// Field 4 - Slider Page Number 2
		$wp_customize->add_setting(
			'paddle_slider_page2',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_page2',
			array(
				'label'       => __( 'Set slider page 2', 'paddle' ),
				'description' => __( 'Select a page from the dropdown below.', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'dropdown-pages',
				'priority'    => 3,
			)
		);

		// Field 5 - Slider Button Text
		$wp_customize->add_setting(
			'paddle_slider_button_text2',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_text2',
			array(
				'label'       => __( 'Button Text for Page 2', 'paddle' ),
				'description' => __( 'Button Text for Page 2', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'text',
				'priority'    => 3,
			)
		);

		// Field 6 - Slider Button URL
		$wp_customize->add_setting(
			'paddle_slider_button_url2',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_url2',
			array(
				'label'       => __( 'URL for Page 2', 'paddle' ),
				'description' => __( 'URL for Page 2', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'url',
				'priority'    => 3,
			)
		);

		/*
		---------------------------------------------------------------------------------------*/
		// Field 7 - Slider Page Number 3

		$wp_customize->add_setting(
			'paddle_slider_page3',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_page3',
			array(
				'label'       => __( 'Set slider page 3', 'paddle' ),
				'description' => __( 'Select a page from the dropdown below.', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'dropdown-pages',
				'priority'    => 4,
			)
		);

		// Field 8 - Slider Button Text
		$wp_customize->add_setting(
			'paddle_slider_button_text3',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_text3',
			array(
				'label'       => __( 'Button Text for Page 3', 'paddle' ),
				'description' => __( 'Button Text for Page 3', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'text',
				'priority'    => 4,
			)
		);

		// Field 9 - Slider Button URL
		$wp_customize->add_setting(
			'paddle_slider_button_url3',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_url3',
			array(
				'label'       => __( 'URL for Page 3', 'paddle' ),
				'description' => __( 'URL for Page 3', 'paddle' ),
				'section'     => 'paddle_slider_settings',
				'type'        => 'url',
				'priority'    => 4,
			)
		);

		/*
		---------------------------------------------------------------------------------------*/
		// Theme page layout section
		$wp_customize->add_section(
			'paddle_page_layout_options',
			array(
				'title'       => __( 'Page Layout', 'paddle' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Page Layout', 'paddle' ),
				'priority'    => 15,
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		// Page width.
		$wp_customize->add_setting(
			'paddle_page_layout_width',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_page_layout_width',
			array(
				'label'    => __( 'Full Width', 'paddle' ),
				'section'  => 'paddle_page_layout_options',
				'type'     => 'checkbox',
				'priority' => 1,

			)
		);

		// Sidebar option.
		$wp_customize->add_setting(
			'paddle_page_layout_sidebar',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_page_layout_sidebar',
			array(
				'label'           => __( 'Enable Sidebar', 'paddle' ),
				'section'         => 'paddle_page_layout_options',
				'type'            => 'checkbox',
				'priority'        => 2,
				'active_callback' => 'paddle_is_fullwidth_active',

			)
		);

		// Select Sidebar option
		$wp_customize->add_setting(
			'paddle_sidebar_position',
			array(
				'default'           => 'right-sidebar',
				'sanitize_callback' => 'paddle_select_option_sanitization',
			)
		);
		$wp_customize->add_control(
			'paddle_sidebar_position',
			array(
				'label'           => esc_html__( 'Change the sidebar position', 'paddle' ),
				'description'     => __( 'The default sidebar postion is right. You can choose to show left sidebar only on Woocommerce pages.', 'paddle' ),
				'section'         => 'paddle_page_layout_options',
				'type'            => 'select',
				'priority'        => 3,
				'active_callback' => 'paddle_is_fullwidth_active',
				'choices'         => array(
					''                         => esc_html__( 'Please select', 'paddle' ),
					'right-sidebar'            => esc_html__( 'Right', 'paddle' ),
					'left-sidebar'             => esc_html__( 'Left', 'paddle' ),
					'left-sidebar-woocommerce' => esc_html__( 'Left (Only on Woocommerce Pages)', 'paddle' ),
				),
			)
		);

		// Remove sidebar from single product page.
		$wp_customize->add_setting(
			'paddle_remove_woo_single_sidebar',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_remove_woo_single_sidebar',
			array(
				'label'    => __( 'Remove Sidebar on Woocommerce Single Product Pages', 'paddle' ),
				'section'  => 'paddle_page_layout_options',
				'type'     => 'checkbox',
				'priority' => 4,

			)
		);

		// Setting for primary color.
		$wp_customize->add_setting(
			'paddle_primary_color',
			array(
				'default'           => PADDLE_PRIMARY_COLOR,
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Control for primary color.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_primary_color',
				array(
					'label'    => __( 'Primary Color', 'paddle' ),
					'section'  => 'colors',
					'settings' => 'paddle_primary_color',
				)
			)
		);

		/* Theme Featured image section */
		$wp_customize->add_section(
			'paddle_featured_image_options',
			array(
				'title'      => __( 'Featured Image', 'paddle' ),
				'capability' => 'edit_theme_options',
				'priority'   => 20,
				'panel'      => 'paddle_theme_option_panel',
			)
		);

		// Featured Image.
		$wp_customize->add_setting(
			'paddle_featured_image_style',
			array(
				'default'           => 'classic',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'paddle_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'paddle_featured_image_style',
				array(
					'label'           => __( 'Full Width Featured Image Style', 'paddle' ),
					'section'         => 'paddle_featured_image_options',
					'settings'        => 'paddle_featured_image_style',
					'type'            => 'select',
					'choices'         => array(
						'slim-full-width' => __( 'Slim Full Width', 'paddle' ),
						'hero-full-width' => __( 'Hero Full Width', 'paddle' ),
						'classic'         => __( 'Classic', 'paddle' ),
					),
					'priority'        => '1',
					'active_callback' => 'paddle_is_sidebar_right_active',
				)
			)
		);

		// Category and achieve option
		$wp_customize->add_section(
			'paddle_category_options',
			array(
				'title'      => __( 'Category Page', 'paddle' ),
				'capability' => 'edit_theme_options',
				'priority'   => 30,
				'panel'      => 'paddle_theme_option_panel',
			)
		);

		// Toggle layout.
		$wp_customize->add_setting(
			'archive_layout',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'archive_layout',
			array(
				'label'       => __( 'Toggle Layout', 'paddle' ),
				'section'     => ( 'paddle_category_options' ),
				'type'        => 'checkbox',
				'description' => __( 'Toggle layout for category page, achieve page or tag page', 'paddle' ),
			)
		);

		// Hide meta
		$wp_customize->add_setting(
			'hide_archive_meta',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'hide_archive_meta',
			array(
				'label'       => __( 'Hide Footer Meta', 'paddle' ),
				'section'     => ( 'paddle_category_options' ),
				'type'        => 'checkbox',
				'description' => __( 'Hide tag and category links on category page.', 'paddle' ),
			)
		);

		// Enable the author bio.
		$wp_customize->add_setting(
			'paddle_enable_author_bio',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_enable_author_bio',
			array(
				'label'    => __( 'Enable author link info', 'paddle' ),
				'section'  => 'paddle_featured_image_options',
				'type'     => 'checkbox',
				'priority' => 2,

			)
		);

		/**
	* Banner
*/

		// Banner Image overlay opacity.
		$wp_customize->add_setting(
			'banner_overlay_opacity',
			array(
				'default'           => 2,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'banner_overlay_opacity',
				array(
					'label'    => __( 'Select The Banner Image Opacity Overlay Level', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'banner_overlay_opacity',
					'type'     => 'select',
					'choices'  => array(
						'9' => __( '9', 'paddle' ),
						'8' => __( '8', 'paddle' ),
						'7' => __( '7', 'paddle' ),
						'6' => __( '6', 'paddle' ),
						'5' => __( '5', 'paddle' ),
						'4' => __( '4', 'paddle' ),
						'3' => __( '3', 'paddle' ),
						'2' => __( '2', 'paddle' ),
						'1' => __( '1', 'paddle' ),
						'0' => __( '0', 'paddle' ),
					),
				)
			)
		);

		// Banner text align postion.
		$wp_customize->add_setting(
			'banner_align_position',
			array(
				'default'           => 'left',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'banner_align_position',
				array(
					'label'    => __( 'Select Alignment', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'banner_align_position',
					'type'     => 'select',
					'choices'  => array(
						'right' => __( 'Right', 'paddle' ),
						'left'  => __( 'Left', 'paddle' ),
						'none'  => __( 'Center', 'paddle' ),
					),
				)
			)
		);

		// Banner header text color.
		$wp_customize->add_setting(
			'paddle_banner_header_color',
			array(
				'default'           => '#ffffff',
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Control for banner header text color.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_banner_header_color',
				array(
					'label'    => __( 'Banner Text Color', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'paddle_banner_header_color',
				)
			)
		);

		// Enable background banner color .
		$wp_customize->add_setting(
			'paddle_enable_banner_bgcolor',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_enable_banner_bgcolor',
			array(
				'type'    => 'checkbox',
				'section' => 'header_image',
				'label'   => __( 'Enable background color', 'paddle' ),
			)
		);

		// Banner header background color.
		$wp_customize->add_setting(
			'paddle_banner_header_bg_color',
			array(
				'default'           => '#3e3c3c',
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Control for banner header background color.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_banner_header_bg_color',
				array(
					'label'           => __( 'Set Banner Background Color', 'paddle' ),
					'section'         => 'header_image',
					'settings'        => 'paddle_banner_header_bg_color',
					'active_callback' => 'paddle_banner_bgcolor_active',
				)
			)
		);

		// Banner content background opacity.
		$wp_customize->add_setting(
			'banner_content_bg_opacity',
			array(
				'default'           => 5,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'banner_content_bg_opacity',
				array(
					'label'       => __( 'Set Opacity for Background Color', 'paddle' ),
					'section'     => 'header_image',
					'settings'    => 'banner_content_bg_opacity',
					'type'        => 'select',
					'description' => 'This adds opacity to the overall text container',
					'choices'     => array(
						'9' => __( '9', 'paddle' ),
						'8' => __( '8', 'paddle' ),
						'7' => __( '7', 'paddle' ),
						'6' => __( '6', 'paddle' ),
						'5' => __( '5', 'paddle' ),
						'4' => __( '4', 'paddle' ),
						'3' => __( '3', 'paddle' ),
						'2' => __( '2', 'paddle' ),
						'1' => __( '1', 'paddle' ),
						'0' => __( '0', 'paddle' ),
					),
				)
			)
		);

		// Banner border radius .
		$wp_customize->add_setting(
			'paddle_banner_border_radius',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_banner_border_radius',
			array(
				'description' => __( 'This adds border radius to the banner container', 'paddle' ),
				'type'        => 'checkbox',
				'section'     => 'header_image',
				'label'       => __( 'Add border radius to the Banner Text Area', 'paddle' ),
			)
		);

		// Toggle header title style.
		$wp_customize->add_setting(
			'paddle_toggle_banner_header_style',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_toggle_banner_header_style',
			array(
				'description' => __( 'Toggle the header style. This change the title text to uppercase and add background color.', 'paddle' ),
				'type'        => 'checkbox',
				'section'     => 'header_image',
				'label'       => __( 'Toggle Banner Title Style', 'paddle' ),
			)
		);

		// Banner title.
		$wp_customize->add_setting(
			'header_banner_title',
			array(
				'default'           => __( 'Build Your Dream Website with Paddle', 'paddle' ),
				'sanitize_callback' => 'sanitize_text_field',

			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_title',
				array(
					'label'    => __( 'Banner Title', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'header_banner_title',
					'type'     => 'text',

				)
			)
		);

		// Banner description.
		$wp_customize->add_setting(
			'header_banner_description',
			array(
				'default'           => __( 'Let\'s improve the way you see business.', 'paddle' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_description',
				array(
					'label'    => __( 'Banner description', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'header_banner_description',
					'type'     => 'text',
				)
			)
		);

		// Banner Button 1.
		$wp_customize->add_setting(
			'header_banner_button_1',
			array(
				'default'           => __( 'Learn More', 'paddle' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_button_1',
				array(
					'label'    => __( 'Button 1 Label', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'header_banner_button_1',
					'type'     => 'text',
				)
			)
		);

		// Banner Button 1 URL link.
		$wp_customize->add_setting(
			'header_banner_button_1_link',
			array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_button_1_link',
				array(
					'label'    => __( 'Button 1 URL Link', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'header_banner_button_1_link',
					'type'     => 'url',
				)
			)
		);

		// Banner Button 2.
		$wp_customize->add_setting(
			'header_banner_button_2',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_button_2',
				array(
					'label'    => __( 'Button 2 Label', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'header_banner_button_2',
					'type'     => 'text',
				)
			)
		);

		// Banner Button 2 URL link.
		$wp_customize->add_setting(
			'header_banner_button_2_link',
			array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_button_2_link',
				array(
					'label'    => __( 'Button 2 URL Link', 'paddle' ),
					'section'  => 'header_image',
					'settings' => 'header_banner_button_2_link',
					'type'     => 'url',
				)
			)
		);

		// Enable content over banner image .
		$wp_customize->add_setting(
			'paddle_enable_content_over_banner',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_enable_content_over_banner',
			array(
				'description' => __( 'This moves the home page content slightly over the homepage banner', 'paddle' ),
				'type'        => 'checkbox',
				'section'     => 'header_image',
				'label'       => __( 'Shift content up over banner', 'paddle' ),
			)
		);

		/*
		---------------------------------------------------------------------------------------*/
		// Footer settings.
		$wp_customize->add_section(
			'paddle_footer_settings',
			array(
				'title'       => esc_html__( 'Footer Settings', 'paddle' ),
				'description' => __( 'Footer settings', 'paddle' ),
			)
		);

			// Show Logo.
			$wp_customize->add_setting(
				'paddle_footer_logo',
				array(
					'default'           => 0,
					'sanitize_callback' => 'paddle_checkbox_sanitization',
				)
			);
			$wp_customize->add_control(
				'paddle_footer_logo',
				array(
					'type'    => 'checkbox',
					'section' => 'paddle_footer_settings',
					'label'   => __( 'Show your logo in footer. Logo appears before the first footer widget. You need to add a widget to the footer to make it work.', 'paddle' ),
				)
			);

		// Copyright text.
		$wp_customize->add_setting(
			'paddle_footer_copyright_text',
			array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);

		$wp_customize->add_control(
			'paddle_footer_copyright_text',
			array(
				'settings'    => 'paddle_footer_copyright_text',
				'section'     => 'paddle_footer_settings',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Footer Copyright Text', 'paddle' ),
				'description' => esc_html__( 'Copyright text to be displayed in the footer. No HTML allowed.', 'paddle' ),
			)
		);

		// Footer credit.
		$wp_customize->add_setting(
			'paddle_theme_credit',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_theme_credit',
			array(
				'type'    => 'checkbox',
				'section' => 'paddle_footer_settings',
				'label'   => __( 'Show the theme credit in footer', 'paddle' ),
			)
		);
	}
}

add_action( 'customize_register', 'paddle_theme_customize_register' );


/**
 * Sanitization for checkbox
 */
function paddle_checkbox_sanitization( $input ) {
	// Returns true if checkbox is checked.
	return ( 1 === absint( $input ) ) ? 1 : 0;
}

if ( ! function_exists( 'paddle_is_top_header_active' ) ) :

	/**
	 * Check if full with content is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function paddle_is_fullwidth_active( $control ) {

		if ( 1 === $control->manager->get_setting( 'paddle_page_layout_width' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;


if ( ! function_exists( 'paddle_is_sidebar_right_active' ) ) :

	/**
	 * Check if the sidebar right layout is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function paddle_is_sidebar_right_active( $control ) {

		if ( 0 === $control->manager->get_setting( 'paddle_page_layout_sidebar' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;


if ( ! function_exists( 'paddle_banner_bgcolor_active' ) ) :

	/**
	 * Check if enable banner background color checkbox is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function paddle_banner_bgcolor_active( $control ) {

		if ( 1 === $control->manager->get_setting( 'paddle_enable_banner_bgcolor' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;



/**
 * Select sanitization function
 *
 * @param  string               $input   Slug to sanitize.
 * @param  WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function paddle_sanitize_select( $input, $setting ) {
	// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
	$input = sanitize_key( $input );

	// Get the list of possible select options.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

if ( ! function_exists( 'paddle_intval' ) ) {
	function paddle_intval( $value ) {
		return (int) $value;
	}
}

/**
 * Sanitization: html
 */

function paddle_sanitize_html( $input ) {
	$allowed = array(
		'a'      => array(
			'href'   => array(),
			'title'  => array(),
			'target' => array(),
			'class'  => array(),
		),
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'p'      => array(
			'class' => array(),
		),
	);

	return wp_kses( $input, $allowed );
}

/**
 * Sanitize select input.
 */
function paddle_select_option_sanitization( $input, $setting ) {
	// input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	$input = sanitize_key( $input );

	// get the list of possible select options
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 *  Sanitize radio button
 */

function paddle_theme_sanitize_radio( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

// Checks if the selected product has a sale price. If not, displays a warning
function paddle_validate_sale_price( $validity, $product ) {
	$sale_validation = get_post_meta( $product, '_sale_price', true );
	if ( empty( $sale_validation ) ) :
		/* translators: 1: product ID number */
		$validity->add( 'sale_price_not_set', sprintf( __( 'Please Add Sale Price - Product ID: %1$s', 'paddle' ), $product ) );
	endif;
	return $validity;
}


