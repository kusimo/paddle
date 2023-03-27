<?php

/**
 * Customizer Setup and Custom Controls
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class paddle_initialise_customizer_settings
{

	// Get our default values
	private $defaults;

	public function __construct()
	{
		// Get our Customizer defaults
		$this->defaults = paddle_generate_defaults();

		// Register Theme panel
		add_action('customize_register', array($this, 'paddle_add_theme_panels'));

		// Register Theme sections
		add_action('customize_register', array($this, 'paddle_add_theme_sections'));

		// Register our Theme Custom Control controls
		add_action('customize_register', array($this, 'paddle_register_theme_custom_controls'));

		// Register our sample default controls
		add_action('customize_register', array($this, 'paddle_register_theme_default_controls'));
	}


	/**
	 * Register the theme panel
	 */
	public function paddle_add_theme_panels($wp_customize)
	{
		/**
		 * Add our Header & Navigation Panel
		 */
		$wp_customize->add_panel(
			'paddle_theme_option_panel',
			array(
				'priority' => 50,
				'title'    => __('General', 'paddle'),
			)
		);

		$wp_customize->add_panel(
			'paddle_theme_global_option',
			array(
				'priority' => 18,
				'title'    => __('Global', 'paddle'),
			)
		);

		$wp_customize->add_panel(
			'paddle_theme_header_option',
			array(
				'priority' => 18,
				'title'    => __('Header', 'paddle'),
			)
		);

		$wp_customize->add_panel(
			'paddle_theme_blog_option',
			array(
				'priority' => 19,
				'title'    => __('Blog', 'paddle'),
			)
		);

		$wp_customize->add_panel(
			'paddle_theme_page_option',
			array(
				'priority' => 20,
				'title'    => __('Page', 'paddle'),
			)
		);

		$wp_customize->add_panel(
			'paddle_theme_footer_option',
			array(
				'priority' => 20,
				'title'    => __('Footer', 'paddle'),
			)
		);

		$wp_customize->add_panel(
			'paddle_theme_front_page_option',
			array(
				'priority' => 20,
				'title'    => __('Front Page', 'paddle'),
			)
		);
	}



	/**
	 * Register the theme section
	 */
	public function paddle_add_theme_sections($wp_customize)
	{

		/**
		 * Container Panel/Section
		 */
		$wp_customize->add_section(
			'paddle_theme_site_layout',
			array(
				'name'               => 'section-site-layout',
				'type'               => 'section',
				'title'              => __('Site Layout', 'paddle'),
				'priority'           => 14,
				'description_hidden' => true,
				'panel'              => 'paddle_theme_global_option',
			)
		);


		/**
		 * Typography Panel/Section
		 */
		$wp_customize->add_section(
			'paddle_theme_typography_section',
			array(
				'name'               => 'section-typography',
				'type'               => 'section',
				'title'              => __('Typography', 'paddle'),
				'priority'           => 15,
				'description_hidden' => true,
				'panel'              => 'paddle_theme_global_option',
				'description'        => 'Use this section to change font style.',
			)
		);

		/**
		 * Typography Panel/Section
		 */
		$wp_customize->add_section(
			'paddle_theme_color_section',
			array(
				'name'               => 'section-color',
				'type'               => 'section',
				'title'              => __('Colors', 'paddle'),
				'priority'           => 16,
				'description_hidden' => true,
				'panel'              => 'paddle_theme_global_option',
			)
		);

		/**
		 * Container Panel/Section
		 */
		$wp_customize->add_section(
			'paddle_theme_container_section',
			array(
				'name'               => 'section-container',
				'type'               => 'section',
				'title'              => __('Container', 'paddle'),
				'priority'           => 17,
				'description_hidden' => true,
				'panel'              => 'paddle_theme_global_option',
			)
		);

		/**
		 * Buttons Panel/Section
		 */
		$wp_customize->add_section(
			'paddle_theme_button_section',
			array(
				'name'               => 'section-button',
				'type'               => 'section',
				'title'              => __('Buttons', 'paddle'),
				'priority'           => 17,
				'description_hidden' => true,
				'panel'              => 'paddle_theme_global_option',
			)
		);

		/**
		 * Navigation Panel/Section
		 */
		$wp_customize->add_section(
			'paddle_theme_navigation_section',
			array(
				'name'               => 'section-navigation',
				'type'               => 'section',
				'title'              => __('Archive Navigation', 'paddle'),
				'priority'           => 17,
				'description_hidden' => true,
				'panel'              => 'paddle_theme_global_option',
			)
		);


		/**
		 * Add Header Layout Section
		 */
		$wp_customize->add_section(
			'paddle_theme_header_options',
			array(
				'title' => __('Desktop / Mobile', 'paddle'),
				'panel' => 'paddle_theme_header_option',
			)
		);

		/**
		 * Add Transparent Header Section
		 */
		$wp_customize->add_section(
			'paddle_theme_header_transparent_options',
			array(
				'title'       => __('Transparent Header', 'paddle'),
				'panel'       => 'paddle_theme_header_option',
			)
		);

		/**
		 * Add Header Buttons
		 */
		$wp_customize->add_section(
			'paddle_theme_header_logo_options',
			array(
				'title'       => __('Header Logo Size', 'paddle'),
				'description' => esc_html__('Header Logo Size and Padding. To add a logo image, navigate to the Site Identity section.', 'paddle'),
				'panel'       => 'paddle_theme_header_option',
			)
		);

		/**
		 * Add Header Menu Section.
		 */
		$wp_customize->add_section(
			'paddle_header_menu',
			array(
				'title'       => __('Header Menu', 'paddle'),
				'description' => esc_html__('Header Menu & Colours', 'paddle'),
				'panel'       => 'paddle_theme_header_option',
			)
		);

		// Add Header Top Bar Section.
		$wp_customize->add_section(
			'paddle_header_top_bar',
			array(
				'title'       => __('Top Bar', 'paddle'),
				'panel'       => 'paddle_theme_header_option',
			)
		);

		// Add Hero and slider.
		$wp_customize->add_section(
			'paddle_hero_and_slider',
			array(
				'title'       => __('Hero & Slider', 'paddle'),
				'panel'       => 'paddle_theme_front_page_option',
			)
		);

		/**
		 * Add Footer Sections 
		 */

		$wp_customize->add_section(
			'paddle_footer_top',
			array(
				'title'       => esc_html__('Footer Top', 'paddle'),
				'panel'       => 'paddle_theme_footer_option',
			)
		);

		$wp_customize->add_section(
			'paddle_footer_1_premium',
			array(
				'title'       => esc_html__('Footer 1', 'paddle'),
				'panel'       => 'paddle_theme_footer_option',
			)
		);

		$wp_customize->add_section(
			'paddle_footer_2_premium',
			array(
				'title'       => esc_html__('Footer 2', 'paddle'),
				'panel'       => 'paddle_theme_footer_option',
			)
		);

		$wp_customize->add_section(
			'paddle_footer_3_premium',
			array(
				'title'       => esc_html__('Footer 3', 'paddle'),
				'panel'       => 'paddle_theme_footer_option',
			)
		);

		$wp_customize->add_section(
			'paddle_footer_4_premium',
			array(
				'title'       => esc_html__('Footer 4', 'paddle'),
				'panel'       => 'paddle_theme_footer_option',
			)
		);

		$wp_customize->add_section(
			'paddle_footer_widget',
			array(
				'title'       => esc_html__('Footer Widget', 'paddle'),
				'panel'       => 'paddle_theme_footer_option',
			)
		);

		$wp_customize->add_section(
			'paddle_footer_settings',
			array(
				'title'       => esc_html__('Footer Bottom', 'paddle'),
				'panel'       => 'paddle_theme_footer_option',
			)
		);



		/**
		 * Theme Featured image section
		 */
		$wp_customize->add_section(
			'paddle_featured_image_options',
			array(
				'title'      => __('Featured Image', 'paddle'),
				'capability' => 'edit_theme_options',
				'panel'      => 'paddle_theme_option_panel',
			)
		);

		/**
		 * Category and achieve option
		 */
		$wp_customize->add_section(
			'paddle_blog_post',
			array(
				'title'      => __('Blog / Archive', 'paddle'),
				'capability' => 'edit_theme_options',
				'panel'      => 'paddle_theme_blog_option',
			)
		);

		/**
		 * Single Post
		 */
		$wp_customize->add_section(
			'paddle_post_single',
			array(
				'title'      => __('Single Post', 'paddle'),
				'capability' => 'edit_theme_options',
				'panel'      => 'paddle_theme_blog_option',
			)
		);

		/**
		 * Page
		 */
		$wp_customize->add_section(
			'paddle_page',
			array(
				'title'      => __('Page', 'paddle'),
				'capability' => 'edit_theme_options',
				'priority' => 19,
			)
		);

		/**
		 * Placeholder text
		 */
		$wp_customize->add_section(
			'paddle_placeholder_text',
			array(
				'title'      => __('Placeholder / Text', 'paddle'),
				'capability' => 'edit_theme_options',
				'panel'      => 'paddle_theme_blog_option',
			)
		);

		/**
		 * Bootstrap - for pagespeed
		 */
		$wp_customize->add_section(
			'paddle_bootstrap',
			array(
				'title'      => __('Bootstrap Option', 'paddle'),
				'capability' => 'edit_theme_options',
				'panel'      => 'paddle_theme_option_panel',
			)
		);
	}

	/*
	---------------------------------------------------------------------------------------*/
	// Header settings.
	/**
	 * Header and Navigation controls
	 */
	public function paddle_register_theme_custom_controls($wp_customize)
	{
		/**
		 * Typography Preset
		 */
		$wp_customize->add_setting(
			'paddle_typography_preset',
			array(
				'default'           => $this->defaults['paddle_typography_preset'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_typography_preset',
				array(
					'label'   => __('Presets', 'paddle'),
					'section' => 'paddle_theme_typography_section',
					'choices' => array(
						'system-font'     => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-left.jpg',
							'name'  => __("'System Font', sans-serif", 'paddle'),
						),
						'roboto'          => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-center.jpg',
							'name'  => __("'Roboto', sans-serif", 'paddle'),
						),
						'open-sans'       => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-right.jpg',
							'name'  => __("'Open Sans', sans-serif", 'paddle'),
						),
						'lato'            => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-left-search.jpg',
							'name'  => __("'Lato', sans-serif", 'paddle'),
						),
						'montserrat'      => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-2.jpg',
							'name'  => __("'Montserrat', sans-serif", 'paddle'),
						),
						'raleway'         => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-2.jpg',
							'name'  => __("'Raleway', sans-serif", 'paddle'),
						),
						'source-sans-pro' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-right.jpg',
							'name'  => __("'Source Sans Pro', sans-serif", 'paddle'),
						),
						'poppins'         => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-right.jpg',
							'name'  => __("'Poppins', sans-serif", 'paddle'),
						),
					),
				)
			)
		);

		/**
		 * Body Font
		 * Add description to the first control, this is used as general title
		 */
		$wp_customize->add_setting(
			'base_font_size',
			array(
				'default'           => $this->defaults['base_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'base_font_size',
				array(
					'label'       => __('Font size', 'paddle'),
					'description' => __('Body font'),
					'section'     => 'paddle_theme_typography_section',
					'input_attrs' => array(
						'min'  => 14,
						'max'  => 80,
						'step' => 1,
					),
				)
			)
		);

		/**
		 * Heading Fonts
		 * Add description to the first control, this is used as general title
		 */
		$wp_customize->add_setting(
			'h1_font_size',
			array(
				'default'           => $this->defaults['h1_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'h1_font_size',
				array(
					'label'       => __('H1 font size', 'paddle'),
					'description' => __('Heading fonts'),
					'section'     => 'paddle_theme_typography_section',
					'input_attrs' => array(
						'min'  => 14,
						'max'  => 160,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'h1_font_weight',
			array(
				'default'           => $this->defaults['h1_font_weight'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'h1_font_weight',
				array(
					'label'   => __('H1 font weight', 'paddle'),
					'section' => 'paddle_theme_typography_section',
					'choices' => array(
						'100' => __('Thin 100', 'paddle'),
						'200' => __('Extra Light 200', 'paddle'),
						'300' => __('Light 300', 'paddle'),
						'400' => __('Regular 400', 'paddle'),
						'500' => __('Medium 500', 'paddle'),
						'600' => __('Semi-Bold 600', 'paddle'),
						'700' => __('Bold 700', 'paddle'),
						'800' => __('Extra-Bold 800', 'paddle'),
						'900' => __('Ultra-Bold 900', 'paddle'),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'h2_font_size',
			array(
				'default'           => $this->defaults['h2_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'h2_font_size',
				array(
					'label'       => __('H2 font size', 'paddle'),
					'section'     => 'paddle_theme_typography_section',
					'input_attrs' => array(
						'min'  => 14,
						'max'  => 160,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'h2_font_weight',
			array(
				'default'           => $this->defaults['h2_font_weight'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'h2_font_weight',
				array(
					'label'   => __('H2 font weight', 'paddle'),
					'section' => 'paddle_theme_typography_section',
					'choices' => array(
						'100' => __('Thin 100', 'paddle'),
						'200' => __('Extra Light 200', 'paddle'),
						'300' => __('Light 300', 'paddle'),
						'400' => __('Regular 400', 'paddle'),
						'500' => __('Medium 500', 'paddle'),
						'600' => __('Semi-Bold 600', 'paddle'),
						'700' => __('Bold 700', 'paddle'),
						'800' => __('Extra-Bold 800', 'paddle'),
						'900' => __('Ultra-Bold 900', 'paddle'),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'h3_font_size',
			array(
				'default'           => $this->defaults['h3_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'h3_font_size',
				array(
					'label'       => __('H3 font size', 'paddle'),
					'section'     => 'paddle_theme_typography_section',
					'input_attrs' => array(
						'min'  => 14,
						'max'  => 160,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'h4_font_size',
			array(
				'default'           => $this->defaults['h4_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'h4_font_size',
				array(
					'label'       => __('H4 font size', 'paddle'),
					'section'     => 'paddle_theme_typography_section',
					'input_attrs' => array(
						'min'  => 14,
						'max'  => 160,
						'step' => 1,
					),
				)
			)
		);
		$wp_customize->add_setting(
			'h5_font_size',
			array(
				'default'           => $this->defaults['h2_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'h5_font_size',
				array(
					'label'       => __('H5 font size', 'paddle'),
					'section'     => 'paddle_theme_typography_section',
					'input_attrs' => array(
						'min'  => 14,
						'max'  => 160,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'h6_font_size',
			array(
				'default'           => $this->defaults['h6_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'h6_font_size',
				array(
					'label'       => __('H6 font size', 'paddle'),
					'section'     => 'paddle_theme_typography_section',
					'input_attrs' => array(
						'min'  => 14,
						'max'  => 160,
						'step' => 1,
					),
				)
			)
		);

		/**
		 * Paragraph
		 */
		$wp_customize->add_setting(
			'paragraph_margin_bottom',
			array(
				'default'           => $this->defaults['paragraph_margin_bottom'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'paragraph_margin_bottom',
				array(
					'description' => __('Paragraph', 'paddle'),
					'label'       => __('Margin bottom', 'paddle'),
					'section'     => 'paddle_theme_typography_section',
					'input_attrs' => array(
						'min'  => 14,
						'max'  => 160,
						'step' => 1,
					),
				)
			)
		);

		// Header Layout (Tab)
		$wp_customize->add_setting(
			'title_options_header',
			array(
				'default'           => 'desktop',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Title_Control(
				$wp_customize,
				'title_options_header',
				array(
					'label'    => __('General', 'paddle'),
					'section'  => 'paddle_theme_header_options',
					'type'     => 'select',
					'priority' => 1,
					'choices'  => array(
						'desktop' => __('Desktop', 'paddle'),
						'mobile'  => __('Mobile', 'paddle'),
					),
				)
			)
		);
		// Header Image Radio Button Custom Control
		$wp_customize->add_setting(
			'paddle_header_layout_style',
			array(
				'default'           => $this->defaults['paddle_header_layout_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_header_layout_style',
				array(
					'label'           => __('Header Layout', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'input_attrs'     => array(
						'toggle'          => true,
						'visible_items'   => 3,
						'show_number'     => true,
						'toggle_label'    => 'More header',
						'fullwidth_label' => true,
					),
					'choices'         => array(
						'paddle-header-1' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-left.jpg',
							'name'  => __('Logo Left', 'paddle'),
						),
						'paddle-header-2' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-center.jpg',
							'name'  => __('Logo Center', 'paddle'),
						),
						'paddle-header-3' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-right.jpg',
							'name'  => __('Logo Right', 'paddle'),
						),
						'paddle-header-4' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-left-search.jpg',
							'name'  => __('Logo Left & Search Left', 'paddle'),
						),
						'paddle-header-5' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-2.jpg',
							'name'  => __('Logo Left & Menu Left', 'paddle'),
						),
						'paddle-header-6' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-2.jpg',
							'name'  => __('Logo Left & Menu Right', 'paddle'),
						),
					),
				)
			)
		); // End Header Image Control

		// Header Container width 
		$wp_customize->add_setting(
			'header_custom_container',
			array(
				'default'           => $this->defaults['header_custom_container'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		//'active_callback' => 'paddle_blog_general_archive_selected',
		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'header_custom_container',
				array(
					'label'           => __('Content Width', 'paddle'),
					'type'            => 'select',
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'choices'         => array(
						'default' => __('Default', 'paddle'),
						'custom'  => __('Custom', 'paddle'),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'header_custom_container_width',
			array(
				'default'           => $this->defaults['header_custom_container_width'],
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'header_custom_container_width',
				array(
					'label'           => __('Custom Width', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_custom_width',
					'input_attrs'     => array(
						'min'  => 1200,
						'max'  => 2500,
						'step' => 100,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_header_section_title_5',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_section_title_5',
				array(
					'label'           => __('Header 5', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_header_5',
				)
			)
		);
		// Header 5 info
		$wp_customize->add_setting(
			'header_5_info',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Simple_Notice_Custom_control(
				$wp_customize,
				'header_5_info',
				array(
					'label'           => __('Header 5.', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_header_5',
					'input_attrs'     => array(
						'show_label' => false,
						'show_desc'  => false,
						'infos'      => array(
							'info_1' => __('Use header 1 to 4 for large menu ', 'paddle'),
						),
					),
				)
			)
		);

		// Split Menu Header 6 - Title.
		$wp_customize->add_setting(
			'paddle_header_section_title_6',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_section_title_6',
				array(
					'label'           => __('Split Menu', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_header_6',
				)
			)
		);

		// Header 6 - Enable / Disable options
		$wp_customize->add_setting(
			'paddle_split_menu_options',
			array(
				'default'           => $this->defaults['paddle_split_menu_options'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Pill_Checkbox_Custom_Control(
				$wp_customize,
				'paddle_split_menu_options',
				array(
					'label'           => __('Show / Hide / Disable', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_header_6',
					'input_attrs'     => array(
						'sortable'  => false,
						'fullwidth' => true,
						'sample'    => '',
					),
					'choices'         => array(
						'cta'     => __('Show CTA', 'paddle'),
						'padding' => __('Disable CTA Margin', 'paddle'),
					),
				)
			)
		);

		// Add info for user
		$wp_customize->add_setting(
			'header_6_info',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Simple_Notice_Custom_control(
				$wp_customize,
				'header_6_info',
				array(
					'label'           => __('Header 6.', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_header_6',
					'input_attrs'     => array(
						'show_label' => false,
						'show_desc'  => false,
						'infos'      => array(
							'info_1'       => __('Sub menu is not supported ', 'paddle'),
							'info_2_alert' => __('Max of 6 menu items ', 'paddle'),
							'info_3'       => __('Use menu that are even ', 'paddle'),
							'info_4'       => __('Use header 1 to 4 for large menu ', 'paddle'),
						),
					),
				)
			)
		);

		// Header Border - Title.
		$wp_customize->add_setting(
			'paddle_header_section_title_bg',
			array(
				'default'           => $this->defaults['paddle_header_section_title_bg'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_section_title_bg',
				array(
					'label'           => __('Header Background', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);

		// Menu background colour.
		$wp_customize->add_setting(
			'paddle_menu_bgcolor',
			array(
				'default'           => $this->defaults['paddle_menu_bgcolor'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_menu_bgcolor',
				array(
					'label'           => __('Background', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'settings'        => 'paddle_menu_bgcolor',
				)
			)
		);

		// Header Border - Title.
		$wp_customize->add_setting(
			'paddle_header_section_title_3',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_section_title_3',
				array(
					'label'           => __('Border', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);

		// Header border top.
		$wp_customize->add_setting(
			'menu_border_top',
			array(
				'default'           => $this->defaults['menu_border_top'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'menu_border_top',
				array(
					'label'           => __('Border Top', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);

		// Header border bottom.
		$wp_customize->add_setting(
			'menu_border_bottom',
			array(
				'default'           => $this->defaults['menu_border_bottom'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'menu_border_bottom',
				array(
					'label'           => __('Border Bottom', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);

		// Menu background colour.
		$wp_customize->add_setting(
			'paddle_header_border_color',
			array(
				'default'           => $this->defaults['paddle_header_border_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_header_border_color',
				array(
					'label'           => __('Border Color', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'settings'        => 'paddle_header_border_color',
					'active_callback' => 'paddle_check_header_border_is_active',
				)
			)
		);

		// Header Logo - Title.
		$wp_customize->add_setting(
			'paddle_header_section_title_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_section_title_1',
				array(
					'label'           => __('Logo', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);

		// Add slider Control for adjusting logo size.
		$wp_customize->add_setting(
			'header_logo_size',
			array(
				'default'           => $this->defaults['header_logo_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'header_logo_size',
				array(
					'label'           => __('Adjust Logo Size', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'input_attrs'     => array(
						'min'  => 50,
						'max'  => 400,
						'step' => 10,
					),
				)
			)
		);

		// Add slider Control for adjusting logo padding.

		$wp_customize->add_setting(
			'header_logo_padding',
			array(
				'default'           => $this->defaults['header_logo_padding'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'header_logo_padding',
				array(
					'label'           => __('Logo Padding Top / Bottom', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'input_attrs'     => array(
						'min'  => 1,
						'max'  => 30,
						'step' => 1,
					),
				)
			)
		);

		// Logo alignment
		$wp_customize->add_setting(
			'paddle_header_logo_align',
			array(
				'default'           => $this->defaults['paddle_header_logo_align'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_header_logo_align',
				array(
					'label'           => __('Logo Align', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_header_6',
					'choices'         => array(
						'self-start' => __('Left', 'paddle'),
						'center'     => __('Center', 'paddle'),
						'end'        => __('Right', 'paddle'),
					),
				)
			)
		);

		// Header Menu - Title.
		$wp_customize->add_setting(
			'paddle_header_section_title_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_section_title_2',
				array(
					'label'           => __('Menu', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);

		// Header menu item spacing.
		$wp_customize->add_setting(
			'paddle_menu_spacing',
			array(
				'default'           => $this->defaults['paddle_menu_spacing'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_menu_spacing',
				array(
					'label'           => __('Spacing', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'choices'         => array(
						'wrap'   => __('Maximum', 'paddle'),
						'nowrap' => __('Minimum', 'paddle'),
					),
				)
			)
		);

		// Header menu padding.
		$wp_customize->add_setting(
			'header_menu_padding',
			array(
				'default'           => $this->defaults['header_menu_padding'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'header_menu_padding',
				array(
					'label'           => __('Padding Top/Bottom', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'input_attrs'     => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				)
			)
		);

		// Header menu item margin right.
		$wp_customize->add_setting(
			'menu_item_margin',
			array(
				'default'           => $this->defaults['menu_item_margin'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'menu_item_margin',
				array(
					'label'           => __('Item Margin Right', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'input_attrs'     => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				)
			)
		);

		// Menu items alignment.
		$wp_customize->add_setting(
			'paddle_menu_items_alignment',
			array(
				'default'           => $this->defaults['paddle_menu_items_alignment'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_menu_items_alignment',
				array(
					'label'           => __('Menu Items Position', 'paddle'),
					// 'description' => esc_html__( 'Align the menu items', 'paddle' ),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'choices'         => array(
						'left'    => __('Left', 'paddle'),
						'center'  => __('Centered', 'paddle'),
						'right'   => __('Right', 'paddle'),
						'justify' => __('Justify', 'paddle'),
					),
				)
			)
		);

		// Header menu in uppercase.
		$wp_customize->add_setting(
			'paddle_menu_capitalization',
			array(
				'default'           => $this->defaults['paddle_menu_capitalization'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_menu_capitalization',
				array(
					'label'           => __('Capitalization', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'choices'         => array(
						'none'       => __('None', 'paddle'),
						'capitalize' => __('Capitalize', 'paddle'),
						'uppercase'  => __('Uppercase', 'paddle'),
					),
				)
			)
		);



		// Menu foreground colour.
		$wp_customize->add_setting(
			'paddle_navlink_text_color',
			array(
				'default'           => $this->defaults['paddle_navlink_text_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_navlink_text_color',
				array(
					'label'           => __('Link', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'settings'        => 'paddle_navlink_text_color',
				)
			)
		);

		// Menu hover colour.
		$wp_customize->add_setting(
			'paddle_navlink_text_color_hover',
			array(
				'default'           => $this->defaults['paddle_navlink_text_color_hover'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_navlink_text_color_hover',
				array(
					'label'           => __('Hover', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'settings'        => 'paddle_navlink_text_color_hover',
				)
			)
		);

		// Menu Active.
		$wp_customize->add_setting(
			'paddle_navlink_text_color_active',
			array(
				'default'           => $this->defaults['paddle_navlink_text_color_active'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_navlink_text_color_active',
				array(
					'label'           => __('Active', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'settings'        => 'paddle_navlink_text_color_active',
				)
			)
		);

		// Menu Container Background color
		$wp_customize->add_setting(
			'menu_container_bg_color',
			array(
				'default'           => $this->defaults['menu_container_bg_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'menu_container_bg_color',
				array(
					'label'           => __('Container Background Color', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_using_header_1_4_desktop_selected',
					'settings'        => 'menu_container_bg_color',
				)
			)
		);

		// Notice setting and control for displaying a message about header style menu background colour
		$wp_customize->add_setting(
			'theme_using_header_two',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Simple_Notice_Custom_control(
				$wp_customize,
				'theme_using_header_two',
				array(
					'label'           => __('Menu background colour other than the default (#ffffff) is not recommended for Header Layout 5.', 'paddle'),
					'description'     => esc_html__('If your upper menu items are more than 6 and you are using the Header Layout 5,  menu items will not be on the same line on medium screen. Please consider switching back to the default background menu color or minimize your menu items. REASONS: Background not looking good with menu more then 6 on medium screen, e.g, Ipad pro.', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_check_theme_header_options',
				)
			)
		);

		// Header Menu - Title.
		$wp_customize->add_setting(
			'paddle_header_section_title_4',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_section_title_4',
				array(
					'label'           => __('Search', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);

		// Enable/Disable Search button.
		$wp_customize->add_setting(
			'paddle_header_search_button',
			array(
				'default'           => $this->defaults['paddle_header_search_button'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_header_search_button',
				array(
					'label'           => __('Enable Search', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);

		// Search Button Type.
		$wp_customize->add_setting(
			'paddle_header_search_button_type',
			array(
				'default'           => $this->defaults['paddle_header_search_button_type'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_header_search_button_type',
				array(
					'label'   => __('Search Type (Desktop)', 'paddle'),
					// 'description' => esc_html__( 'Align the menu items', 'paddle' ),
					'section' => 'paddle_theme_header_options',
					// 'active_callback' => 'paddle_using_header_1_4_5_desktop_selected',
					'choices' => array(
						'icon'  => __('Icon Only', 'paddle'),
						'input' => __('Input and Icon', 'paddle'),
					),
				)
			)
		);

		// Search icon colour.
		$wp_customize->add_setting(
			'paddle_header_search_icon_color',
			array(
				'default'           => $this->defaults['paddle_header_search_icon_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_header_search_icon_color',
				array(
					'label'           => __('Icon Color', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_search_enab',
					'settings'        => 'paddle_header_search_icon_color',
				)
			)
		);

		// ____________CTA_______________
		// Header Menu - Title.
		$wp_customize->add_setting(
			'paddle_header_section_title_7',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_section_title_7',
				array(
					'label'           => __('Menu CTA Button', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		);
		$wp_customize->add_setting(
			'paddle_header_cta',
			array(
				'default'           => $this->defaults['paddle_header_cta'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_header_cta',
				array(
					'label'           => __('CTA Button', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
				)
			)
		); // CTA Button

		$wp_customize->add_setting(
			'cta_separated',
			array(
				'default'           => $this->defaults['cta_separated'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'cta_separated',
				array(
					'label'           => __('Separated', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_using_header_1_4_desktop_selected',
				)
			)
		); // CTA Margin left

		// CTA margin.
		$wp_customize->add_setting(
			'header_cta_padding_left',
			array(
				'default'           => $this->defaults['header_cta_padding_left'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'header_cta_padding_left',
				array(
					'label'           => __('Padding Left', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected_cta_enab',
					'input_attrs'     => array(
						'min'  => 0,
						'max'  => 25,
						'step' => 1,
					),
				)
			)
		);

		// CTA URL.
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
				'label'           => esc_html__('CTA URL', 'paddle'),
				'section'         => 'paddle_theme_header_options',
				'type'            => 'url',
				'input_attrs'     => array(
					'style'       => 'border: 2px solid #e6e6e6',
					'placeholder' => __('Enter URL Link...', 'paddle'),
				),
				'active_callback' => 'paddle_header_desktop_selected_cta_enab',
			)
		);

		// Setting CTA Text.
		$wp_customize->add_setting(
			'paddle_header_cta_text',
			array(
				'default'           => $this->defaults['paddle_header_cta_text'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'paddle_header_cta_text',
			array(
				'label'           => esc_html__('CTA Text', 'paddle'),
				'section'         => 'paddle_theme_header_options',
				'type'            => 'text',
				'input_attrs'     => array(
					'style'       => 'border: 2px solid #e6e6e6',
					'placeholder' => __('Enter Text...', 'paddle'),
				),
				'active_callback' => 'paddle_header_desktop_selected_cta_enab',
			)
		);

		$wp_customize->add_setting(
			'menu_cta_bgcolor',
			array(
				'default'           => $this->defaults['menu_cta_bgcolor'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'menu_cta_bgcolor',
			array(
				'label'   => __('Button Background', 'paddle'),
				'type'    => 'color',
				'settings' => 'menu_cta_bgcolor',
				'section'         => 'paddle_theme_header_options',
				'active_callback' => 'paddle_header_desktop_selected',
			)
		);

		//___ background opacity
		$wp_customize->add_setting(
			'menu_cta_bg_opacity',
			array(
				'default'           => $this->defaults['menu_cta_bg_opacity'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Opacity_Control(
				$wp_customize,
				'menu_cta_bg_opacity',
				array(
					'label'           => __('Background Opacity', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',						
					'input_attrs'     => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'menu_cta_link_color',
			array(
				'default'           => $this->defaults['menu_cta_link_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'menu_cta_link_color',
			array(
				'label'   => __('Button Text Color', 'paddle'),
				'type'    => 'color',
				'settings' => 'menu_cta_link_color',
				'section'         => 'paddle_theme_header_options',
				'active_callback' => 'paddle_header_desktop_selected',
			)
		);

		$wp_customize->add_setting(
			'menu_cta_link_hover_color',
			array(
				'default'           => $this->defaults['menu_cta_link_hover_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'menu_cta_link_hover_color',
			array(
				'label'   => __('Button Background Hover', 'paddle'),
				'type'    => 'color',
				'settings' => 'menu_cta_link_hover_color',
				'section'         => 'paddle_theme_header_options',
				'active_callback' => 'paddle_header_desktop_selected',
			)
		);

		$wp_customize->add_setting(
			'menu_cta_link_border_color',
			array(
				'default'           => $this->defaults['menu_cta_link_border_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'menu_cta_link_border_color',
			array(
				'label'   => __('Button Border', 'paddle'),
				'type'    => 'color',
				'settings' => 'menu_cta_link_border_color',
				'section'         => 'paddle_theme_header_options',
				'active_callback' => 'paddle_header_desktop_selected',
			)
		);

		// __ Button Padding
		$wp_customize->add_setting(
			'menu_cta_padding',
			array(
				'default' => $this->defaults['menu_cta_padding'],
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_MultipleInput_Custom_control(
				$wp_customize,
				'menu_cta_padding',
				array(
					'label'           => __('Button Padding', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_desktop_selected',
					'input_attrs' => array(
						'edges' => 'top,right,bottom,left',
						'max' => 4,
						'extra_class' => 'paddle-settings-has-border-top paddle-settings-has-border-bottom paddle-settings-has-margin-top paddle-settings-has-margin-bottom paddle-settings-has-title-has-margin-bottom',
					  ),
					
				)
			)
		);


		$wp_customize->selective_refresh->add_partial(
			'paddle_header_cta_text',
			array(
				'selector'            => '#header-btn-cta a.btn',
				'container_inclusive' => false,
				'render_callback'     => function () {
					return get_theme_mod('paddle_header_cta_text', $this->defaults['paddle_header_cta_text']);
				},
				'fallback_refresh'    => true,
			)
		);

		/****************************************************************
		 * Mobile Header Layout
		 */
		$wp_customize->add_setting(
			'paddle_header_mobile_layout',
			array(
				'default'           => $this->defaults['paddle_header_mobile_layout'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_header_mobile_layout',
				array(
					'label'           => __('Mobile Header Layout', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_mobile_selected',
					'priority'        => 3,
					'input_attrs'     => array(
						'toggle'          => false,
						'visible_items'   => 2,
						'show_number'     => true,
						'toggle_label'    => 'More header',
						'fullwidth_label' => true,
					),
					'choices'         => array(
						'mobile-header-1' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-left.jpg',
							'name'  => __('Logo Left', 'paddle'),
						),
						'mobile-header-2' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/header-layout-style-1-logo-center.jpg',
							'name'  => __('Logo Center', 'paddle'),
						),
					),
				)
			)
		); // End Mobile Header
		// Search Button Type.
		$wp_customize->add_setting(
			'paddle_header_search_button_type_mobile',
			array(
				'default'           => $this->defaults['paddle_header_search_button_type_mobile'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_header_search_button_type_mobile',
				array(
					'label'           => __('Search Type (Mobile)', 'paddle'),
					// 'description' => esc_html__( 'Align the menu items', 'paddle' ),
					'section'         => 'paddle_theme_header_options',
					'active_callback' => 'paddle_header_mobile_selected',
					'choices'         => array(
						'icon'  => __('Icon Only', 'paddle'),
						'input' => __('Input and Icon', 'paddle'),
					),
				)
			)
		);

		//______________Transparent Header Global________.

		// Tab Navigation
		$wp_customize->add_setting(
			'title_options_header_transparent',
			array(
				'default'           => 'general',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Title_Control(
				$wp_customize,
				'title_options_header_transparent',
				array(
					'label'    => __('General', 'paddle'),
					'section'  => 'paddle_theme_header_transparent_options',
					'type'     => 'select',
					'priority' => 1,
					'choices'  => array(
						'general' => __('General', 'paddle'),
						'design'  => __('Design', 'paddle'),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_header_transparent_home_only',
			array(
				'default'           => $this->defaults['paddle_header_transparent_home_only'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_header_transparent_home_only',
				array(
					'label'           => __('Enable on Home page Only', 'paddle'),
					'section'         => 'paddle_theme_header_transparent_options',
					'active_callback'   => 'paddle_transparent_header_general'
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_header_transparent_global',
			array(
				'default'           => $this->defaults['paddle_header_transparent_global'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_header_transparent_global',
				array(
					'label'           => __('Enable on Complete Site', 'paddle'),
					'section'         => 'paddle_theme_header_transparent_options',
					'active_callback'   => 'paddle_transparent_header_enabled_home_only'
				)
			)
		);
		
		$wp_customize->add_setting(
			'paddle_header_transparent_arc',
			array(
				'default'           => $this->defaults['paddle_header_transparent_arc'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_header_transparent_arc',
				array(
					'label'           => __('Enable on 404, Search & Archives', 'paddle'),
					'section'         => 'paddle_theme_header_transparent_options',
					'active_callback'   => 'paddle_transparent_header_enabled'
					//'description' => esc_html__( 'This setting is not recommended, but you can still enable it.', 'paddle' ),
				)
			)
		);
		
		$wp_customize->add_setting(
			'paddle_header_transparent_post',
			array(
				'default'           => $this->defaults['paddle_header_transparent_post'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_header_transparent_post',
				array(
					'label'           => __('Disable on Blog Posts', 'paddle'),
					'section'         => 'paddle_theme_header_transparent_options',
					'active_callback'   => 'paddle_transparent_header_enabled'
				)
			)
		);
		
		$wp_customize->add_setting(
			'paddle_header_transparent_page',
			array(
				'default'           => $this->defaults['paddle_header_transparent_page'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_header_transparent_page',
				array(
					'label'           => __('Disable on Pages', 'paddle'),
					'section'         => 'paddle_theme_header_transparent_options',
					'active_callback'   => 'paddle_transparent_header_enabled'
				)
			)
		);
		//____ Header (Visibility).
		$wp_customize->add_setting(
			'paddle_transparent_section_header_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_transparent_section_header_1',
				array(
					'label'   => __('Visibility', 'paddle'),
					'section' => 'paddle_theme_header_transparent_options',
					'active_callback'   => 'paddle_transparent_header_general',
				)
			)
		);

		
		//____ Desktop + Mobile Transparent.
		$wp_customize->add_setting(
			'paddle_header_transparent_visible',
			array(
				'default'           => $this->defaults['paddle_header_transparent_visible'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_header_transparent_visible',
				array(
					'label'   => __('Show On', 'paddle'),
					'section' => 'paddle_theme_header_transparent_options',
					'active_callback'   => 'paddle_transparent_header_general',
					'choices' => array(
						'desktop'  => __('Desktop', 'paddle'),
						'desktop_mobile' => __('Desktop + Mobile', 'paddle'),
					),
				)
			)
		);



			



		//______________________ TOPBAR_______________.

		// Select Title Options
		$wp_customize->add_setting(
			'top_bar_options_header',
			array(
				'default'           => 'settings',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Title_Control(
				$wp_customize,
				'top_bar_options_header',
				array(
					'label'    => __('General', 'paddle'),
					'section' => 'paddle_header_top_bar',
					'type'     => 'select',
					'priority' => 1,
					'choices'  => array(
						'settings' => __('Settings', 'paddle'),
						'contact' => __('Info', 'paddle'),
						'content'  => __('Content', 'paddle'),
					),
				)
			)
		);

		//_______ Header Top Bar Switch.
		$wp_customize->add_setting(
			'enable_top_bar',
			array(
				'default'           => $this->defaults['enable_top_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'enable_top_bar',
				array(
					'label'   => __('Top Bar', 'paddle'),
					'section' => 'paddle_header_top_bar',
				)
			)
		);

		// Height.
		$wp_customize->add_setting(
			'topbar_height',
			array(
				'default'           => $this->defaults['topbar_height'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'topbar_height',
				array(
					'label'           => __('Min Height', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_settings',
					'settings'        => 'topbar_height',
					'input_attrs'     => array(
						'min'  => 20,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		// Bottom border.
		$wp_customize->add_setting(
			'topbar_border_bottom',
			array(
				'default'           => $this->defaults['topbar_border_bottom'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'topbar_border_bottom',
				array(
					'label'   => __('Border Bottom', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_settings',
				)
			)
		);

		// Border colour.
		$wp_customize->add_setting(
			'topbar_border_color',
			array(
				'default'           => $this->defaults['topbar_border_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'topbar_border_color',
				array(
					'label'           => __('Border Bottom Color', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_topbar_border_bottom_active',
					'settings'        => 'topbar_border_color',
				)
			)
		);

		// Background colour.
		$wp_customize->add_setting(
			'topbar_bgcolor',
			array(
				'default'           => $this->defaults['topbar_bgcolor'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'topbar_bgcolor',
				array(
					'label'           => __('Background Color', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_settings',
					'settings'        => 'topbar_bgcolor',
				)
			)
		);

		// Text colour.
		$wp_customize->add_setting(
			'topbar_text_color',
			array(
				'default'           => $this->defaults['topbar_text_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'topbar_text_color',
				array(
					'label'           => __('Text Color', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_settings',
					'settings'        => 'topbar_text_color',
				)
			)
		);

		// Link colour.
		$wp_customize->add_setting(
			'topbar_link_color',
			array(
				'default'           => $this->defaults['topbar_link_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'topbar_link_color',
				array(
					'label'           => __('Link Color', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_settings',
					'settings'        => 'topbar_link_color',
				)
			)
		);

		// Link colour hover.
		$wp_customize->add_setting(
			'topbar_link_color_hover',
			array(
				'default'           => $this->defaults['topbar_link_color_hover'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'topbar_link_color_hover',
				array(
					'label'           => __('Link Hover', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_settings',
					'settings'        => 'topbar_link_color_hover',
				)
			)
		);

		// Font size.
		$wp_customize->add_setting(
			'topbar_font_size',
			array(
				'default'           => $this->defaults['topbar_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'topbar_font_size',
				array(
					'label'           => __('Font Size', 'paddle'),
					'section'         => 'paddle_theme_header_options',
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_settings',
					'input_attrs'     => array(
						'min'  => 12,
						'max'  => 15,
						'step' => 1,
					),
				)
			)
		);

		// Top bar item postion draggable pill
		$wp_customize->add_setting( 'top_bar_items_position',
			array(
				'default' => $this->defaults['top_bar_items_position'],
				'transport' => 'refresh',
				'sanitize_callback' => 'paddle_text_sanitization'
			)
		);
		$wp_customize->add_control( new Paddle_Pill_Checkbox_Custom_Control( $wp_customize, 'top_bar_items_position',
			array(
				'label' => __( 'Items Position', 'paddle' ),
				'description' => esc_html__( 'Arrange how the topbar items appear. Drag to change item position', 'paddle' ),
				'section'         => 'paddle_header_top_bar',
				'active_callback' => 'paddle_top_header_option_settings',
				'input_attrs' => array(
					'sortable' => true,
					'fullwidth' => true,
					'checkbox_disable' => true,
				),
				'choices' => array(
					'info' => __( 'Phone / Email', 'paddle' ),
					'content' => __( 'Menu / Content', 'paddle' ),
					'social' => __( 'Social Buttons', 'paddle'  ),
				)
			)
		) );

		// Title
		$wp_customize->add_setting(
			'paddle_header_top_bar_title_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_top_bar_title_1',
				array(
					'label'           => __('Info', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_contact',
				)
			)
		);


		// Header Top Bar Phone Number.
		$wp_customize->add_setting(
			'paddle_contact_phone',
			array(
				'default'           => $this->defaults['paddle_contact_phone'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);
		$wp_customize->add_control(
			'paddle_contact_phone',
			array(
				'label'           => __('Phone number', 'paddle'),
				'type'            => 'text',
				'section'         => 'paddle_header_top_bar',
				'active_callback' => 'paddle_top_header_option_contact',
			)
		);

		// Setting Email.
		$wp_customize->add_setting(
			'paddle_top_email',
			array(
				'sanitize_callback' => 'sanitize_email',
			)
		);

		$wp_customize->add_control(
			'paddle_top_email',
			array(
				'label'           => esc_html__('Email', 'paddle'),
				'section'         => 'paddle_header_top_bar',
				'type'            => 'email',
				'active_callback' => 'paddle_top_header_option_contact',
			)
		);


		// Info - Hide on mobile
		$wp_customize->add_setting(
			'hide_top_bar_info_mobile',
			array(
				'default'           => $this->defaults['hide_top_bar_info_mobile'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'hide_top_bar_info_mobile',
				array(
					'label'           => __('Hide on tablet, mobile?', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_contact',
				)
			)
		);

		//__ Align 
		$wp_customize->add_setting(
			'top_bar_info_align',
			array(
				'default'           => $this->defaults['top_bar_info_align'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'top_bar_info_align',
				array(
					'label'           => __('Position', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_contact',
					'choices'         => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
						'right' => __('Right', 'paddle'),
					),
				)
			)
		);

		// Title 2
		$wp_customize->add_setting(
			'paddle_header_top_bar_title_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_header_top_bar_title_2',
				array(
					'label'           => __('Socials', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_contact',
				)
			)
		);


		// Add our Sortable Repeater setting and Custom Control for Social media URLs
		$wp_customize->add_setting(
			'social_urls',
			array(
				'default'           => $this->defaults['social_urls'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_url_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Sortable_Repeater_Control(
				$wp_customize,
				'social_urls',
				array(
					'label'           => __('Social URLs', 'paddle'),
					'description'     => esc_html__('Add your social media links.', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'button_labels'   => array(
						'add' => __('Add Social Link', 'paddle'),
					),
					'active_callback' => 'paddle_top_header_option_contact',
				)
			)
		);

		// Social Hide on mobile
		$wp_customize->add_setting(
			'hide_top_bar_social_mobile',
			array(
				'default'           => $this->defaults['hide_top_bar_social_mobile'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'hide_top_bar_social_mobile',
				array(
					'label'           => __('Hide on tablet, mobile?', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_contact',
				)
			)
		);


		//__ Align 
		$wp_customize->add_setting(
			'top_bar_social_align',
			array(
				'default'           => $this->defaults['top_bar_social_align'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'top_bar_social_align',
				array(
					'label'           => __('Position', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_contact',
					'choices'         => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
						'right' => __('Right', 'paddle'),
					),
				)
			)
		);


		// Topbar Content section
		$wp_customize->add_setting(
			'topbar_content_select',
			array(
				'default'           => $this->defaults['topbar_content_select'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'topbar_content_select',
				array(
					'label'   => __('Content / Menu', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_content',
					'type'    => 'select',
					'choices' => array(
						'menu'   => __('Menu', 'paddle'),
						'content' => __('Content', 'paddle'),
					),
				)
			)
		);

		//___ HTML.
		$wp_customize->add_setting(
			'topbar_content',
			array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'topbar_content',
			array(
				'section'         => 'paddle_header_top_bar',
				'active_callback' => 'paddle_top_header_option_content_is_content',
				'type'        => 'textarea',
				'label'       => esc_html__('Content', 'paddle'),
				'description' => esc_html__('You can use HTML. Note not all HTML tags are allowed.', 'paddle'),
			)
		);

		// Topbar Menu
		$wp_customize->add_setting(
			'topbar_content_menu',
			array(
				'default' => $this->defaults['topbar_content_menu'],
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(new Paddle_Dropdown_Menu_Custom_Control(
			$wp_customize,
			'topbar_content_menu',
			array(
				'label' => __('Menu Slug', 'paddle'),
				'section'         => 'paddle_header_top_bar',
				'active_callback' => 'paddle_top_header_option_content_is_menu',
			)
		));

		// Content -Hide on mobile
		$wp_customize->add_setting(
			'hide_top_bar_content_mobile',
			array(
				'default'           => $this->defaults['hide_top_bar_content_mobile'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'hide_top_bar_content_mobile',
				array(
					'label'           => __('Hide on tablet, mobile?', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_content',
				)
			)
		);

		//__ Align 
		$wp_customize->add_setting(
			'top_bar_content_align',
			array(
				'default'           => $this->defaults['top_bar_content_align'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'top_bar_content_align',
				array(
					'label'           => __('Position', 'paddle'),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_option_content',
					'choices'         => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
						'right' => __('Right', 'paddle'),
					),
				)
			)
		);


		/*
		---------------------------------------------------------------------------------------*/
		// Footer settings.

		// ___Header Title.
		$wp_customize->add_setting(
			'paddle_footer_general_title_5',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_general_title_5',
				array(
					'label'           => __('Footer Branding', 'paddle'),
					'section'         => 'paddle_footer_top',
				)
			)
		);


		//______ Show Logo Enable.
		$wp_customize->add_setting(
			'paddle_footer_logo',
			array(
				'default'           => $this->defaults['paddle_footer_logo'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_footer_logo',
				array(
					'label'       => __('Logo', 'paddle'),
					'section'     => 'paddle_footer_top',
				)
			)
		);

		//_____ Cropped Image Control
		$wp_customize->add_setting(
			'footer_logo_image',
			array(
				'default' => $this->defaults['footer_logo_image'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'footer_logo_image',
			array(
				'label' => __('Footer Logo', 'paddle'),
				'section' => 'paddle_footer_top',
				'active_callback' => 'paddle_footer_logo_enab',
				'flex_width' => true,
				'flex_height' => true,
				'width' => 300,
				'height' => 300
			)
		));

		//_____ Logo width.
		$wp_customize->add_setting(
			'footer_image_width',
			array(
				'default'           => $this->defaults['footer_image_width'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'footer_image_width',
				array(
					'label'           => __('Custom logo width', 'paddle'),
					'section'         => 'paddle_footer_top',
					'active_callback' => 'paddle_footer_logo_enab',
					'input_attrs'     => array(
						'min'  => 50,
						'max'  => 300,
						'step' => 1,
					),
				)
			)
		);

		//______ Show About.
		$wp_customize->add_setting(
			'paddle_footer_about_enable',
			array(
				'default'           => $this->defaults['paddle_footer_about_enable'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_footer_about_enable',
				array(
					'label'       => __('About', 'paddle'),
					'section'     => 'paddle_footer_top',
				)
			)
		);

		//___ Footer About TinyMCE
		$wp_customize->add_setting(
			'paddle_footer_about',
			array(
				'default' => $this->defaults['paddle_footer_about'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_kses_post'
			)
		);
		$wp_customize->add_control(new Paddle_TinyMCE_Custom_control(
			$wp_customize,
			'paddle_footer_about',
			array(
				'label' => __('About', 'paddle'),
				'description' => __('Add short summary and link to the full about us page.'),
				'section' => 'paddle_footer_top',
				'active_callback' => 'paddle_footer_about_enab',
				'input_attrs' => array(
					'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'mediaButtons' => false,
				)
			)
		));



		// ___Header Title.
		$wp_customize->add_setting(
			'paddle_footer_general_title_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_general_title_1',
				array(
					'label'           => __('Color', 'paddle'),
					'section'         => 'paddle_footer_top',
				)
			)
		);

		// Footer background colour.
		$wp_customize->add_setting(
			'footer_bgcolor',
			array(
				'default'           => $this->defaults['footer_bgcolor'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_bgcolor',
				array(
					'label'           => __('Background', 'paddle'),
					'section'         => 'paddle_footer_top',
					'settings'        => 'footer_bgcolor',
				)
			)
		);

		// Footer foreground colour.
		$wp_customize->add_setting(
			'footer_text_color',
			array(
				'default'           => $this->defaults['footer_text_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_text_color',
				array(
					'label'           => __('Text Color', 'paddle'),
					'section'         => 'paddle_footer_top',
					'settings'        => 'footer_text_color',
				)
			)
		);


		// Footer link colour.
		$wp_customize->add_setting(
			'footer_navlink_text_color',
			array(
				'default'           => $this->defaults['footer_navlink_text_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_navlink_text_color',
				array(
					'label'           => __('Link', 'paddle'),
					'section'         => 'paddle_footer_top',
					'settings'        => 'footer_navlink_text_color',
				)
			)
		);

		// hover colour.
		$wp_customize->add_setting(
			'footer_navlink_text_color_hover',
			array(
				'default'           => $this->defaults['footer_navlink_text_color_hover'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_navlink_text_color_hover',
				array(
					'label'           => __('Link Hover', 'paddle'),
					'section'         => 'paddle_footer_top',
					'settings'        => 'footer_navlink_text_color_hover',
				)
			)
		);

		// ___Header Title.
		$wp_customize->add_setting(
			'paddle_footer_general_title_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_general_title_2',
				array(
					'label'           => __('Image', 'paddle'),
					'section'         => 'paddle_footer_top',
				)
			)
		);

		// Footer Bg Image.
		$wp_customize->add_setting(
			'footer_bg_image',
			array(
				'default' => $this->defaults['footer_bg_image'],
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control(new WP_Customize_Image_Control(
			$wp_customize,
			'footer_bg_image',
			array(
				'label' => __('Background Image', 'paddle'),
				'section' => 'paddle_footer_top',
				'button_labels' => array(
					'select' => __('Select Image', 'paddle'),
					'change' => __('Change Image', 'paddle'),
					'remove' => __('Remove', 'paddle'),
					'default' => __('Default', 'paddle'),
					'placeholder' => __('No image selected', 'paddle'),
					'frame_title' => __('Select Image', 'paddle'),
					'frame_button' => __('Choose Image', 'paddle'),
				)
			)
		));

		//__ Bg Attachment
		$wp_customize->add_setting(
			'footer_bg_image_attachment',
			array(
				'default'           => $this->defaults['footer_bg_image_attachment'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_bg_image_attachment',
				array(
					'label'           => __('Background Attachment', 'paddle'),
					'section'         => 'paddle_footer_top',
					'input_attrs'     => array(
						'fullwidth_label' => true,
					),
					'choices'         => array(
						'fixed'        => __('Fixed', 'paddle'),
						'scroll'      => __('Scroll', 'paddle'),
						'inherit'        => __('Inherit', 'paddle'),
					),
				)
			)
		);

		// Bg image overlay.
		$wp_customize->add_setting(
			'footer_bg_image_overlay',
			array(
				'default'           => $this->defaults['footer_bg_image_overlay'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_bg_image_overlay',
				array(
					'label'           => __('Background Overlay', 'paddle'),
					'section'         => 'paddle_footer_top',
					'settings'        => 'footer_bg_image_overlay',
				)
			)
		);

		//_____ Overlay Opacity.
		$wp_customize->add_setting(
			'footer_bg_overlay_opacity',
			array(
				'default'           => $this->defaults['footer_bg_overlay_opacity'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'footer_bg_overlay_opacity',
				array(
					'label'           => __('Overlay Opacity', 'paddle'),
					'section'         => 'paddle_footer_top',
					'input_attrs'     => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		// ___Header Title.
		$wp_customize->add_setting(
			'paddle_footer_general_title_3',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_general_title_3',
				array(
					'label'           => __('Widget', 'paddle'),
					'section'         => 'paddle_footer_top',
				)
			)
		);

		//___ Footer Widget Appearance
		$wp_customize->add_setting(
			'footer_widget_column',
			array(
				'default'           => $this->defaults['footer_widget_column'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_widget_column',
				array(
					'label'           => __('Column', 'paddle'),
					'section'         => 'paddle_footer_top',
					'description'	  => 'Select column where you want the block widget to appear.',
					'choices'         => array(
						'1' => __('Footer 1', 'paddle'),
						'2' => __('Footer 2', 'paddle'),
						'3' => __('Footer 3', 'paddle'),
						'4' => __('Footer 4', 'paddle'),
					),
				)
			)
		);

		//___ Footer Widget Appearance
		$wp_customize->add_setting(
			'footer_widget_position',
			array(
				'default'           => $this->defaults['footer_widget_position'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_widget_position',
				array(
					'label'           => __('Position', 'paddle'),
					'section'         => 'paddle_footer_top',
					'choices'         => array(
						'top' => __('Top', 'paddle'),
						'bottom' => __('Bottom', 'paddle'),
					),
				)
			)
		);

		//---
		// ___Header Title.
		$wp_customize->add_setting(
			'paddle_footer_general_title_4',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_general_title_4',
				array(
					'label'           => __('Social URLs', 'paddle'),
					'section'         => 'paddle_footer_top',
				)
			)
		);

		//___ Footer social URL.
		$wp_customize->add_setting(
			'paddle_footer_social',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_footer_social',
				array(
					'label'   => __('Enable', 'paddle'),
					'section' => 'paddle_footer_top',
				)
			)
		);

		// Footer Social media URLs
		$wp_customize->add_setting(
			'footer_social_urls',
			array(
				'default'           => $this->defaults['footer_social_urls'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_url_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Sortable_Repeater_Control(
				$wp_customize,
				'footer_social_urls',
				array(
					'label'           => __('Social URLs', 'paddle'),
					'description'     => esc_html__('Add your social media links.', 'paddle'),
					'section'         => 'paddle_footer_top',
					'button_labels'   => array(
						'add' => __('Add Social Link', 'paddle'),
					),
					'active_callback' => 'paddle_footer_select_social',
				)
			)
		);

		//_____ Social icons width.
		$wp_customize->add_setting(
			'social_icon_width',
			array(
				'default'           => $this->defaults['social_icon_width'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'social_icon_width',
				array(
					'label'           => __('Icon Width', 'paddle'),
					'section'         => 'paddle_footer_top',
					'active_callback' => 'paddle_footer_select_social',
					'input_attrs'     => array(
						'min'  => 15,
						'max'  => 30,
						'step' => 1,
					),
				)
			)
		);

		//___ Footer Social Appearance
		$wp_customize->add_setting(
			'footer_social_column',
			array(
				'default'           => $this->defaults['footer_social_column'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_social_column',
				array(
					'label'           => __('Column', 'paddle'),
					'section'         => 'paddle_footer_top',
					'active_callback' => 'paddle_footer_select_social',
					'description'	  => 'Select the column where you want the social icons to appear. Default is at the bottom of page. ',
					'choices'         => array(
						'with-logo' => __('Logo Area', 'paddle'),
						'1' => __('Footer 1', 'paddle'),
						'2' => __('Footer 2', 'paddle'),
						'3' => __('Footer 3', 'paddle'),
						'4' => __('Footer 4', 'paddle'),
						'none' => __('Default', 'paddle'),
					),
				)
			)
		);



		/*********************************************************************
		 * footer_1
		 */

		//___ Footer Header.
		$wp_customize->add_setting(
			'footer_1_header_1',
			array(
				'default'           => $this->defaults['footer_1_header_1'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'footer_header_1',
			array(
				'type'    => 'text',
				'section' => 'paddle_footer_1',
				'label'   => __('Header', 'paddle'),
			)
		);

		// Content - Header Title.
		$wp_customize->add_setting(
			'paddle_footer_1_header_title_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_1_header_title_1',
				array(
					'label'           => __('Content', 'paddle'),
					'section'         => 'paddle_footer_1',
				)
			)
		);

		//__ Type
		$wp_customize->add_setting(
			'footer_1_content_type',
			array(
				'default'           => $this->defaults['footer_1_content_type'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_1_content_type',
				array(
					'label'           => __('Type', 'paddle'),
					'section'         => 'paddle_footer_1',
					'input_attrs'     => array(
						'fullwidth_label' => true,
					),
					'choices'         => array(
						'menu'        => __('Menu', 'paddle'),
						'editor'      => __('Editor', 'paddle'),
						'html'        => __('HTML', 'paddle'),
					),
				)
			)
		);

		// Enable Footer Menu
		$wp_customize->add_setting(
			'footer_1_menu_enable',
			array(
				'default'           => $this->defaults['footer_1_menu_enable'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'footer_1_menu_enable',
				array(
					'label'           => __('Menu', 'paddle'),
					'section' => 'paddle_footer_1',
					'active_callback' => 'paddle_footer_1_content_type_menu'
				)
			)
		);

		// Footer (footer_1) Menu
		$wp_customize->add_setting(
			'footer_1_menu',
			array(
				'default' => $this->defaults['footer_1_menu'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(new Paddle_Dropdown_Menu_Custom_Control(
			$wp_customize,
			'footer_1_menu',
			array(
				'label' => __('Menu Slug', 'paddle'),
				'section' => 'paddle_footer_1',
				'active_callback' => 'paddle_footer_1_content_type_menu_enabled'
			)
		));

		//_____ Menu Column Count (footer_1).
		$wp_customize->add_setting(
			'footer_1_menu_count',
			array(
				'default'           => $this->defaults['footer_1_menu_count'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'footer_1_menu_count',
				array(
					'label'           => __('Column Count', 'paddle'),
					'section'         => 'paddle_footer_1',
					'active_callback' => 'paddle_footer_1_content_type_menu_enabled',
					'input_attrs'     => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				)
			)
		);

		//___ Footer (footer_1) TinyMCE control
		$wp_customize->add_setting(
			'footer_1_editor',
			array(
				'default' => $this->defaults['footer_1_editor'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_kses_post'
			)
		);
		$wp_customize->add_control(new Paddle_TinyMCE_Custom_control(
			$wp_customize,
			'footer_1_editor',
			array(
				'label' => __('Editor', 'paddle'),
				'section' => 'paddle_footer_1',
				'active_callback' => 'paddle_footer_1_content_type_editor',
				'input_attrs' => array(
					'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'mediaButtons' => false,
				)
			)
		));

		//___ Footer (footer_1) HTML.
		$wp_customize->add_setting(
			'footer_1_html',
			array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'footer_1_html',
			array(
				'section'     => 'paddle_footer_1',
				'type'        => 'textarea',
				'label'       => esc_html__('HTML', 'paddle'),
				'description' => esc_html__('See Allowed HTML tag lists.', 'paddle'),
				'active_callback' => 'paddle_footer_1_content_type_html'
			)
		);

		//__ Align Footer (footer_1)
		$wp_customize->add_setting(
			'footer_1_content_align',
			array(
				'default'           => $this->defaults['footer_1_content_align'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_1_content_align',
				array(
					'label'           => __('Align', 'paddle'),
					'section'         => 'paddle_footer_1',
					'choices'         => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
						'right' => __('Right', 'paddle'),
					),
				)
			)
		);

		//__ Container Width (footer_1) - Header Title.
		$wp_customize->add_setting(
			'paddle_footer_1_header_title_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_1_header_title_2',
				array(
					'label'           => __('Width Setting', 'paddle'),
					'section'         => 'paddle_footer_1',
				)
			)
		);


		//__ Column Width (footer_1)
		$wp_customize->add_setting(
			'footer_1_container_width',
			array(
				'default'           => $this->defaults['footer_1_container_width'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_1_container_width',
				array(
					'label'           => __('Container Width', 'paddle'),
					'section'         => 'paddle_footer_1',
					'choices'         => array(
						'100' => __('100%', 'paddle'),
						'66' => __('66%', 'paddle'),
						'50' => __('50%', 'paddle'),
						'33' => __('33%', 'paddle'),
						'25'   => __('25%', 'paddle'),
					),
				)
			)
		);

		/*********************************************************************
		 * footer_2
		 */

		//___ Footer Header.
		$wp_customize->add_setting(
			'footer_2_header_1',
			array(
				'default'           => $this->defaults['footer_2_header_1'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'footer_2_header_1',
			array(
				'type'    => 'text',
				'section' => 'paddle_footer_2',
				'label'   => __('Header', 'paddle'),
			)
		);

		// Content - Header Title.
		$wp_customize->add_setting(
			'paddle_footer_2_header_title_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_2_header_title_1',
				array(
					'label'           => __('Content', 'paddle'),
					'section'         => 'paddle_footer_2',
				)
			)
		);

		//__ Type
		$wp_customize->add_setting(
			'footer_2_content_type',
			array(
				'default'           => $this->defaults['footer_2_content_type'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_2_content_type',
				array(
					'label'           => __('Type', 'paddle'),
					'section'         => 'paddle_footer_2',
					'input_attrs'     => array(
						'fullwidth_label' => true,
					),
					'choices'         => array(
						'menu'        => __('Menu', 'paddle'),
						'editor'      => __('Editor', 'paddle'),
						'html'        => __('HTML', 'paddle'),
					),
				)
			)
		);

		// Enable Footer Menu
		$wp_customize->add_setting(
			'footer_2_menu_enable',
			array(
				'default'           => $this->defaults['footer_2_menu_enable'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'footer_2_menu_enable',
				array(
					'label'           => __('Menu', 'paddle'),
					'section' => 'paddle_footer_2',
					'active_callback' => 'paddle_footer_2_content_type_menu'
				)
			)
		);

		// Footer (footer_2) Menu
		$wp_customize->add_setting(
			'footer_2_menu',
			array(
				'default' => $this->defaults['footer_2_menu'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(new Paddle_Dropdown_Menu_Custom_Control(
			$wp_customize,
			'footer_2_menu',
			array(
				'label' => __('Menu Slug', 'paddle'),
				'section' => 'paddle_footer_2',
				'active_callback' => 'paddle_footer_2_content_type_menu_enabled'
			)
		));

		//_____ Menu Column Count (footer_2).
		$wp_customize->add_setting(
			'footer_2_menu_count',
			array(
				'default'           => $this->defaults['footer_2_menu_count'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'footer_2_menu_count',
				array(
					'label'           => __('Column Count', 'paddle'),
					'section'         => 'paddle_footer_2',
					'active_callback' => 'paddle_footer_2_content_type_menu_enabled',
					'input_attrs'     => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				)
			)
		);

		//___ Footer (footer_2) TinyMCE control
		$wp_customize->add_setting(
			'footer_2_editor',
			array(
				'default' => $this->defaults['footer_2_editor'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_kses_post'
			)
		);
		$wp_customize->add_control(new Paddle_TinyMCE_Custom_control(
			$wp_customize,
			'footer_2_editor',
			array(
				'label' => __('Editor', 'paddle'),
				'section' => 'paddle_footer_2',
				'active_callback' => 'paddle_footer_2_content_type_editor',
				'input_attrs' => array(
					'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'mediaButtons' => false,
				)
			)
		));

		//___ Footer (footer_2) HTML.
		$wp_customize->add_setting(
			'footer_2_html',
			array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'footer_2_html',
			array(
				'section'     => 'paddle_footer_2',
				'type'        => 'textarea',
				'label'       => esc_html__('HTML', 'paddle'),
				'description' => esc_html__('See Allowed HTML tag lists.', 'paddle'),
				'active_callback' => 'paddle_footer_2_content_type_html'
			)
		);

		//__ Align Footer (footer_2)
		$wp_customize->add_setting(
			'footer_2_content_align',
			array(
				'default'           => $this->defaults['footer_2_content_align'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_2_content_align',
				array(
					'label'           => __('Align', 'paddle'),
					'section'         => 'paddle_footer_2',
					'choices'         => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
						'right' => __('Right', 'paddle'),
					),
				)
			)
		);

		//__ Container Width (footer_2) - Header Title.
		$wp_customize->add_setting(
			'paddle_footer_2_header_title_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_2_header_title_2',
				array(
					'label'           => __('Width Setting', 'paddle'),
					'section'         => 'paddle_footer_2',
				)
			)
		);


		//__ Column Width (footer_2)
		$wp_customize->add_setting(
			'footer_2_container_width',
			array(
				'default'           => $this->defaults['footer_2_container_width'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_2_container_width',
				array(
					'label'           => __('Container Width', 'paddle'),
					'section'         => 'paddle_footer_2',
					'choices'         => array(
						'100' => __('100%', 'paddle'),
						'66' => __('66%', 'paddle'),
						'50' => __('50%', 'paddle'),
						'33' => __('33%', 'paddle'),
						'25'   => __('25%', 'paddle'),
					),
				)
			)
		);

		/*********************************************************************
		 * footer_3
		 */

		//___ Footer Header.
		$wp_customize->add_setting(
			'footer_3_header_1',
			array(
				'default'           => $this->defaults['footer_3_header_1'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'footer_3_header_1',
			array(
				'type'    => 'text',
				'section' => 'paddle_footer_3',
				'label'   => __('Header', 'paddle'),
			)
		);

		// Content - Header Title.
		$wp_customize->add_setting(
			'paddle_footer_3_header_title_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_3_header_title_1',
				array(
					'label'           => __('Content', 'paddle'),
					'section'         => 'paddle_footer_3',
				)
			)
		);

		//__ Type
		$wp_customize->add_setting(
			'footer_3_content_type',
			array(
				'default'           => $this->defaults['footer_3_content_type'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_3_content_type',
				array(
					'label'           => __('Type', 'paddle'),
					'section'         => 'paddle_footer_3',
					'input_attrs'     => array(
						'fullwidth_label' => true,
					),
					'choices'         => array(
						'menu'        => __('Menu', 'paddle'),
						'editor'      => __('Editor', 'paddle'),
						'html'        => __('HTML', 'paddle'),
					),
				)
			)
		);

		// Enable Footer Menu
		$wp_customize->add_setting(
			'footer_3_menu_enable',
			array(
				'default'           => $this->defaults['footer_3_menu_enable'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'footer_3_menu_enable',
				array(
					'label'           => __('Menu', 'paddle'),
					'section' => 'paddle_footer_3',
					'active_callback' => 'paddle_footer_3_content_type_menu'
				)
			)
		);

		// Footer (footer_3) Menu
		$wp_customize->add_setting(
			'footer_3_menu',
			array(
				'default' => $this->defaults['footer_3_menu'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(new Paddle_Dropdown_Menu_Custom_Control(
			$wp_customize,
			'footer_3_menu',
			array(
				'label' => __('Menu Slug', 'paddle'),
				'section' => 'paddle_footer_3',
				'active_callback' => 'paddle_footer_3_content_type_menu_enabled'
			)
		));

		//_____ Menu Column Count (footer_3).
		$wp_customize->add_setting(
			'footer_3_menu_count',
			array(
				'default'           => $this->defaults['footer_3_menu_count'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'footer_3_menu_count',
				array(
					'label'           => __('Column Count', 'paddle'),
					'section'         => 'paddle_footer_3',
					'active_callback' => 'paddle_footer_3_content_type_menu_enabled',
					'input_attrs'     => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				)
			)
		);

		//___ Footer (footer_3) TinyMCE control
		$wp_customize->add_setting(
			'footer_3_editor',
			array(
				'default' => $this->defaults['footer_3_editor'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_kses_post'
			)
		);
		$wp_customize->add_control(new Paddle_TinyMCE_Custom_control(
			$wp_customize,
			'footer_3_editor',
			array(
				'label' => __('Editor', 'paddle'),
				'section' => 'paddle_footer_3',
				'active_callback' => 'paddle_footer_3_content_type_editor',
				'input_attrs' => array(
					'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'mediaButtons' => false,
				)
			)
		));

		//___ Footer (footer_3) HTML.
		$wp_customize->add_setting(
			'footer_3_html',
			array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'footer_3_html',
			array(
				'section'     => 'paddle_footer_3',
				'type'        => 'textarea',
				'label'       => esc_html__('HTML', 'paddle'),
				'description' => esc_html__('See Allowed HTML tag lists.', 'paddle'),
				'active_callback' => 'paddle_footer_3_content_type_html'
			)
		);

		//__ Align Footer (footer_3)
		$wp_customize->add_setting(
			'footer_3_content_align',
			array(
				'default'           => $this->defaults['footer_3_content_align'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_3_content_align',
				array(
					'label'           => __('Align', 'paddle'),
					'section'         => 'paddle_footer_3',
					'choices'         => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
						'right' => __('Right', 'paddle'),
					),
				)
			)
		);

		//__ Container Width (footer_3) - Header Title.
		$wp_customize->add_setting(
			'paddle_footer_3_header_title_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_3_header_title_2',
				array(
					'label'           => __('Width Setting', 'paddle'),
					'section'         => 'paddle_footer_3',
				)
			)
		);


		//__ Column Width (footer_3)
		$wp_customize->add_setting(
			'footer_3_container_width',
			array(
				'default'           => $this->defaults['footer_3_container_width'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_3_container_width',
				array(
					'label'           => __('Container Width', 'paddle'),
					'section'         => 'paddle_footer_3',
					'choices'         => array(
						'100' => __('100%', 'paddle'),
						'66' => __('66%', 'paddle'),
						'50' => __('50%', 'paddle'),
						'33' => __('33%', 'paddle'),
						'25'   => __('25%', 'paddle'),
					),
				)
			)
		);

		/*********************************************************************
		 * footer_4
		 */

		//___ Footer Header.
		$wp_customize->add_setting(
			'footer_4_header_1',
			array(
				'default'           => $this->defaults['footer_4_header_1'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'footer_4_header_1',
			array(
				'type'    => 'text',
				'section' => 'paddle_footer_4',
				'label'   => __('Header', 'paddle'),
			)
		);

		// Content - Header Title.
		$wp_customize->add_setting(
			'paddle_footer_4_header_title_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_4_header_title_1',
				array(
					'label'           => __('Content', 'paddle'),
					'section'         => 'paddle_footer_4',
				)
			)
		);

		//__ Type
		$wp_customize->add_setting(
			'footer_4_content_type',
			array(
				'default'           => $this->defaults['footer_4_content_type'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_4_content_type',
				array(
					'label'           => __('Type', 'paddle'),
					'section'         => 'paddle_footer_4',
					'input_attrs'     => array(
						'fullwidth_label' => true,
					),
					'choices'         => array(
						'menu'        => __('Menu', 'paddle'),
						'editor'      => __('Editor', 'paddle'),
						'html'        => __('HTML', 'paddle'),
					),
				)
			)
		);

		// Enable Footer Menu
		$wp_customize->add_setting(
			'footer_4_menu_enable',
			array(
				'default'           => $this->defaults['footer_4_menu_enable'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'footer_4_menu_enable',
				array(
					'label'           => __('Menu', 'paddle'),
					'section' => 'paddle_footer_4',
					'active_callback' => 'paddle_footer_4_content_type_menu'
				)
			)
		);

		// Footer (footer_4) Menu
		$wp_customize->add_setting(
			'footer_4_menu',
			array(
				'default' => $this->defaults['footer_4_menu'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(new Paddle_Dropdown_Menu_Custom_Control(
			$wp_customize,
			'footer_4_menu',
			array(
				'label' => __('Menu Slug', 'paddle'),
				'section' => 'paddle_footer_4',
				'active_callback' => 'paddle_footer_4_content_type_menu_enabled'
			)
		));

		//_____ Menu Column Count (footer_4).
		$wp_customize->add_setting(
			'footer_4_menu_count',
			array(
				'default'           => $this->defaults['footer_4_menu_count'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'footer_4_menu_count',
				array(
					'label'           => __('Column Count', 'paddle'),
					'section'         => 'paddle_footer_4',
					'active_callback' => 'paddle_footer_4_content_type_menu_enabled',
					'input_attrs'     => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
				)
			)
		);

		//___ Footer (footer_4) TinyMCE control
		$wp_customize->add_setting(
			'footer_4_editor',
			array(
				'default' => $this->defaults['footer_4_editor'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_kses_post'
			)
		);
		$wp_customize->add_control(new Paddle_TinyMCE_Custom_control(
			$wp_customize,
			'footer_4_editor',
			array(
				'label' => __('Editor', 'paddle'),
				'section' => 'paddle_footer_4',
				'active_callback' => 'paddle_footer_4_content_type_editor',
				'input_attrs' => array(
					'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'mediaButtons' => false,
				)
			)
		));

		//___ Footer (footer_4) HTML.
		$wp_customize->add_setting(
			'footer_4_html',
			array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'footer_4_html',
			array(
				'section'     => 'paddle_footer_4',
				'type'        => 'textarea',
				'label'       => esc_html__('HTML', 'paddle'),
				'description' => esc_html__('See Allowed HTML tag lists.', 'paddle'),
				'active_callback' => 'paddle_footer_4_content_type_html'
			)
		);

		//__ Align Footer (footer_4)
		$wp_customize->add_setting(
			'footer_4_content_align',
			array(
				'default'           => $this->defaults['footer_4_content_align'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_4_content_align',
				array(
					'label'           => __('Align', 'paddle'),
					'section'         => 'paddle_footer_4',
					'choices'         => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
						'right' => __('Right', 'paddle'),
					),
				)
			)
		);

		//__ Container Width (footer_4) - Header Title.
		$wp_customize->add_setting(
			'paddle_footer_4_header_title_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_4_header_title_2',
				array(
					'label'           => __('Width Setting', 'paddle'),
					'section'         => 'paddle_footer_4',
				)
			)
		);


		//__ Column Width (footer_4)
		$wp_customize->add_setting(
			'footer_4_container_width',
			array(
				'default'           => $this->defaults['footer_4_container_width'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_4_container_width',
				array(
					'label'           => __('Container Width', 'paddle'),
					'section'         => 'paddle_footer_4',
					'choices'         => array(
						'100' => __('100%', 'paddle'),
						'66' => __('66%', 'paddle'),
						'50' => __('50%', 'paddle'),
						'33' => __('33%', 'paddle'),
						'25'   => __('25%', 'paddle'),
					),
				)
			)
		);

		/**
		 * Bottom Footer
		 ****************************************************/

		//__ Layout
		$wp_customize->add_setting(
			'footer_bottom_layout',
			array(
				'default'           => $this->defaults['footer_bottom_layout'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_bottom_layout',
				array(
					'label'           => __('Layout', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'choices'         => array(
						'column'   => __('Columns', 'paddle'),
						'center' => __('Centered', 'paddle'),
					),
				)
			)
		);

		// Privacy Policy.
		$wp_customize->add_setting(
			'paddle_privacy_policy',
			array(
				'default'           => $this->defaults['paddle_privacy_policy'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_privacy_policy',
				array(
					'label'       => __('Privacy Policy', 'paddle'),
					'section'     => 'paddle_footer_settings',
				)
			)
		);

		// Copyright text.
		$wp_customize->add_setting(
			'paddle_footer_copyright_text',
			array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'paddle_footer_copyright_text',
			array(
				'settings'    => 'paddle_footer_copyright_text',
				'section'     => 'paddle_footer_settings',
				'description' => __('<code>&#37;currentyear&#37;</code> to insert the current year (auto updates)<br /><code>&#37;copy&#37;</code> to insert the Copyright symbol<br /><code>&#37;reg&#37;</code> to insert the Registered symbol<br /><code>&#37;trade&#37;</code> to insert the Trademark symbol', 'paddle'),
				'type'        => 'textarea',
				'label'       => esc_html__('Copyright Text', 'paddle'),
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'footer_copyright_text',
			array(
				'selector'        => '.site-footer .site-info .footer-copyrights',
				'render_callback' => 'paddle_get_default_footer_copyright',
			)
		);

		// Footer bottom top border.
		$wp_customize->add_setting(
			'footer_bottom_border_top',
			array(
				'default'           => $this->defaults['footer_bottom_border_top'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'footer_bottom_border_top',
				array(
					'label'   => __('Border Top', 'paddle'),
					'section' => 'paddle_footer_settings',
				)
			)
		);

		// background colour.
		$wp_customize->add_setting(
			'footer_bottom_bgcolor',
			array(
				'default'           => $this->defaults['footer_bottom_bgcolor'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_bottom_bgcolor',
				array(
					'label'           => __('Background color', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'settings'        => 'footer_bottom_bgcolor',
				)
			)
		);

		// ___Footer Bottom Menu.
		$wp_customize->add_setting(
			'paddle_footer_bottom_title_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_bottom_title_1',
				array(
					'label'           => __('Menu', 'paddle'),
					'section'         => 'paddle_footer_settings',
				)
			)
		);

		//__Extra footer links
		$wp_customize->add_setting(
			'footer_urls',
			array(
				'default'           => $this->defaults['footer_urls'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Paddle_Sortable_Repeater_Control(
				$wp_customize,
				'footer_urls',
				array(
					'label'           => __('Footer Menu', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'button_labels'   => array(
						'add' => __('Add Link', 'paddle'),
					),
					'input_attrs'     => array(
						'multiple_input' => true,
					),
				)
			)
		);

		//__ Align Footer (footer_4)
		$wp_customize->add_setting(
			'footer_urls_position',
			array(
				'default'           => $this->defaults['footer_urls_position'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_urls_position',
				array(
					'label'           => __('Menu Position', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'choices'         => array(
						'left'   => __('Left', 'paddle'),
						'right' => __('Right', 'paddle'),
					),
				)
			)
		);


		// ___Footer Bottom Menu.
		$wp_customize->add_setting(
			'paddle_footer_bottom_title_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_footer_bottom_title_2',
				array(
					'label'           => __('Payment Badge', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'active_callback' => 'paddle_is_woocommerce_active',
				)
			)
		);

		//__ Enable Trust Image

		$wp_customize->add_setting(
			'enable_payment_badge',
			array(
				'default'           => $this->defaults['enable_payment_badge'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'enable_payment_badge',
				array(
					'label'   => __('Trust Image', 'paddle'),
					'section' => 'paddle_footer_settings',
					'active_callback' => 'paddle_is_woocommerce_active',
				)
			)
		);

		//__ Source Image 
		$wp_customize->add_setting(
			'payment_badge_source',
			array(
				'default'           => $this->defaults['payment_badge_source'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'payment_badge_source',
				array(
					'label'           => __('Source Image', 'paddle'),
					'section'         => 'paddle_footer_settings_premium',
					'active_callback' => 'paddle_is_woocommerce_active',
					'choices'         => array(
						'image'   => __('Image', 'paddle'),
						'svg' => __('SVG', 'paddle'),
					),
				)
			)
		);

		//_____ Cropped Image Control
		$wp_customize->add_setting(
			'payment_badge_image',
			array(
				'default' => $this->defaults['payment_badge_image'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'payment_badge_image',
			array(
				'label' => __('Trust Seal Image', 'paddle'),
				'section'         => 'paddle_footer_settings_premium',
				'active_callback' => 'paddle_is_woocommerce_active',
				'flex_width' => true,
				'flex_height' => true,
				'width' => 500,
				'height' => 100
			)
		));

		//___ Textarea field for SVG list
		$wp_customize->add_setting(
			'payment_badge_textarea',
			array(
				'default' => $this->defaults['payment_badge_textarea'],
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
		);
		$wp_customize->add_control(
			'payment_badge_textarea',
			array(
				'label' => __('Badge Icons', 'paddle'),
				'section'         => 'paddle_footer_settings',
				'active_callback' => 'paddle_is_woocommerce_active',
				'type' => 'textarea',
				'input_attrs' => array(
					'class' => 'list-custom-class',
					'placeholder' => __('master,paypal,visa', 'paddle'),
				),
			)
		);

		// More payment option info
		$wp_customize->add_setting(
			'payment_badge_info',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Simple_Notice_Custom_control(
				$wp_customize,
				'payment_badge_info',
				array(
					'label'           => __('Header 5.', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'active_callback' => 'paddle_is_woocommerce_active',
					'input_attrs'     => array(
						'show_label' => false,
						'show_desc'  => false,
						'infos'      => array(
							'info_1' => __('amazon_payments,american_express,apple_pay,bitcoin,dinners_club,discover,interac,google_pay,jcb,klarna,maestro,master,paypal,sofort,visa', 'paddle'),
						),
					),
				)
			)
		);

		//__ Source Image 
		$wp_customize->add_setting(
			'payment_badge_color',
			array(
				'default'           => $this->defaults['payment_badge_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'payment_badge_color',
				array(
					'label'           => __('Image Color', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'active_callback' => 'paddle_is_woocommerce_active',
					'choices'         => array(
						'gray'   => __('Gray', 'paddle'),
						'color' => __('Color', 'paddle'),
					),
				)
			)
		);


		//_____ Payment image height.
		$wp_customize->add_setting(
			'payment_badge_image_h',
			array(
				'default'           => $this->defaults['payment_badge_image_h'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'payment_badge_image_h',
				array(
					'label'           => __('Height', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'active_callback' => 'paddle_is_woocommerce_active',
					'input_attrs'     => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		//___ Payment Badge Appearance
		$wp_customize->add_setting(
			'footer_payment_badge_column',
			array(
				'default'           => $this->defaults['footer_payment_badge_column'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'footer_payment_badge_column',
				array(
					'label'           => __('Trust Icons Column', 'paddle'),
					'section'         => 'paddle_footer_settings',
					'active_callback' => 'paddle_is_woocommerce_active',
					'description'	  => 'Select the column where you want the payment icons to appear. Default is at the top. ',
					'choices'         => array(
						'top' => __('Top', 'paddle'),
						'bottom' => __('Bottom', 'paddle'),
					),
				)
			)
		);


		// @Todo: add JS partial refresh to copyright
		// Footer credit.
		$wp_customize->add_setting(
			'paddle_theme_credit',
			array(
				'default'           => $this->defaults['paddle_theme_credit'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_theme_credit',
				array(
					'label'   => __('Theme Credit', 'paddle'),
					'section' => 'paddle_footer_settings',
				)
			)
		);



		/*
		---------------------------------------------------------------------------------------*/
		//____ Hero & Banner.

		/* Header options betweens design and general */
		$wp_customize->add_setting(
			'title_options_hero',
			array(
				'default'           => 'general',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Title_Control(
				$wp_customize,
				'title_options_hero',
				array(
					'label'   => __('General', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'type'    => 'select',
					'choices' => array(
						'general' => __('General', 'paddle'),
						'design'  => __('Design', 'paddle'),
					),
				)
			)
		);

		// Menu items alignment.
		$wp_customize->add_setting(
			'header_media_select',
			array(
				'default'           => $this->defaults['header_media_select'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'header_media_select',
				array(
					'label'   => __('Hero / Slider', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_general_selected',
					'choices' => array(
						'hero'   => __('Hero', 'paddle'),
						'slider' => __('Slider', 'paddle'),
						'none'   => __('None', 'paddle'),
					),
				)
			)
		);

		// Container width Hero/Banner
		$wp_customize->add_setting(
			'hero_custom_container',
			array(
				'default'           => $this->defaults['hero_custom_container'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		//'active_callback' => 'paddle_blog_general_archive_selected',
		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'hero_custom_container',
				array(
					'label'           => __('Content Width', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'type'            => 'select',
					'active_callback' => 'paddle_hero_option_general_selected',
					'choices'         => array(
						'default' => __('Default', 'paddle'),
						'custom'  => __('Custom', 'paddle'),
					),
				)
			)
		);
		
		$wp_customize->add_setting(
			'hero_container_width',
			array(
				'default'           => $this->defaults['hero_container_width'],
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'hero_container_width',
				array(
					'section'         => 'paddle_hero_and_slider',
					'label'           => __('Custom Width', 'paddle'),
					'active_callback' => 'paddle_selected_hero_width',
					'input_attrs'     => array(
						'min'  => 300,
						'max'  => 1900,
						'step' => 100,
					),
				)
			)
		);

		// Use default image.
		$wp_customize->add_setting(
			'use_default_banner_image',
			array(
				'default'           => $this->defaults['use_default_banner_image'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'use_default_banner_image',
				array(
					'label'       => __('Use default banner image', 'paddle'),
					'section'     => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_general_selected',
				)
			)
		);

		// Banner Cropped Image Control
		$wp_customize->add_setting(
			'hero_image',
			array(
				'default'           => $this->defaults['hero_image'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'hero_image',
				array(
					'label'           => __('Upload Hero Image', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_hero',
					'flex_width'      => true,
					'flex_height'     => true,
					'width'           => 1920,
					'height'          => 822,
				)
			)
		);

		// Slider source
		$wp_customize->add_setting(
			'paddle_slider_source',
			array(
				'default'           => $this->defaults['paddle_slider_source'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_source',
			array(
				'type'            => 'radio',
				'section'         => 'paddle_hero_and_slider',
				'label'           => esc_html__('Slider source', 'paddle'),
				'description'     => esc_html('Select posts to display'),
				'active_callback' => 'header_media_selected_slider',
				'choices'         => array(
					'latest-post' => esc_html('Latest posts'),
					'post-ids'    => esc_html('Posts by Id'),
					'page'        => esc_html('Post from page'),
				),
			)
		);

		// Slider Source // Source post IDs.
		$wp_customize->add_setting(
			'paddle_slider_post_ids',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_post_ids',
			array(
				'label'           => __('Enter post IDs separated by commas', 'paddle'),
				'description'     => __('Enter 3 post ids, each post ID should be separated by commas.', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'text',
				'active_callback' => 'paddle_slider_pid_active',
			)
		);

		// Slider Source // Pages
		// Field 1 - Slider Page.
		$wp_customize->add_setting(
			'paddle_slider_page1',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_setting(
			'paddle_slider_page2',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_setting(
			'paddle_slider_page3',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_page1',
			array(
				'label'           => __('Set slider page 1', 'paddle'),
				'description'     => __('Select a page from the dropdown below.', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'dropdown-pages',
				'active_callback' => 'paddle_slider_source_from_page_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_page2',
			array(
				'label'           => __('Set slider page 2', 'paddle'),
				'description'     => __('Select a page from the dropdown below.', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'dropdown-pages',
				'active_callback' => 'paddle_slider_source_from_page_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_page3',
			array(
				'label'           => __('Set slider page 3', 'paddle'),
				'description'     => __('Select a page from the dropdown below.', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'dropdown-pages',
				'active_callback' => 'paddle_slider_source_from_page_active',
			)
		);

		// Slider, use custom link and button
		$wp_customize->add_setting(
			'paddle_slider_custom_url',
			array(
				'default'           => $this->defaults['paddle_slider_custom_url'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_slider_custom_url',
				array(
					'label'           => __('Use custom link and button', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_slider',
				)
			)
		);

		/* Custom Links and Buttons (3). */
		$wp_customize->add_setting(
			'paddle_slider_button_text1',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'paddle_slider_button_text2',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_setting(
			'paddle_slider_button_text3',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_text1',
			array(
				'label'           => __('Button 1', 'paddle'),
				'description'     => __('Enter text for the slide button 1', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'text',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_text2',
			array(
				'label'           => __('Button 2', 'paddle'),
				'description'     => __('Enter text for the slide button 2', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'text',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_text3',
			array(
				'label'           => __('Button 3', 'paddle'),
				'description'     => __('Enter text for the slide button 3', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'text',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		// Slider Button URL.
		$wp_customize->add_setting(
			'paddle_slider_button_url1',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_setting(
			'paddle_slider_button_url2',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_setting(
			'paddle_slider_button_url3',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_url1',
			array(
				'label'           => __('URL 1', 'paddle'),
				'description'     => __('Enter link for slide 1', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'url',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_url2',
			array(
				'label'           => __('URL 2', 'paddle'),
				'description'     => __('Enter link for slide 2', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'url',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_url3',
			array(
				'label'           => __('URL 3', 'paddle'),
				'description'     => __('Enter link for slide 3', 'paddle'),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'url',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		// Adjust height
		$wp_customize->add_setting(
			'header_media_height',
			array(
				'default'           => $this->defaults['header_media_height'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'header_media_height',
				array(
					'label'       => __('Banner Height', 'paddle'),
					'section'     => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_general_selected',
					'input_attrs' => array(
						'min'  => 20,
						'max'  => 100,
						'step' => 10,
					),
				)
			)
		);

	

		// Banner Padding Top
		$wp_customize->add_setting(
			'banner_padding_top',
			array(
				'default'           => $this->defaults['banner_padding_top'],
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'banner_padding_top',
				array(
					'label'       => __('Padding Top', 'paddle'),
					'section'     => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_general_selected',
					'input_attrs' => array(
						'min'  => 20,
						'max'  => 200,
						'step' => 1,
					),
				)
			)
		);
		
		// Banner Padding Top
		$wp_customize->add_setting(
			'banner_padding_bottom',
			array(
				'default'           => $this->defaults['banner_padding_bottom'],
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'banner_padding_bottom',
				array(
					'label'       => __('Padding Bottom', 'paddle'),
					'section'     => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_general_selected',
					'input_attrs' => array(
						'min'  => 20,
						'max'  => 200,
						'step' => 1,
					),
				)
			)
		);
		

		// ______ Header for Banner Image Style

		$wp_customize->add_setting(
			'paddle_hero_section_header_6',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_hero_section_header_6',
				array(
					'label'   => __('Banner Image', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			)
		);

			// ______ Banner Image Style Container.
			$wp_customize->add_setting(
				'banner_image_style',
				array(
					'default'           => $this->defaults['banner_image_style'],
					'type'              => 'theme_mod',
					'sanitize_callback' => 'paddle_radio_sanitization',
					'capability'        => 'edit_theme_options',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Text_Radio_Button_Custom_Control(
					$wp_customize,
					'banner_image_style',
					array(
						'label'   => __('Container', 'paddle'),
						'section' => 'paddle_hero_and_slider',
						'active_callback' => 'paddle_hero_option_design_selected',
						'choices' => array(
							'half'   => __('Half', 'paddle'),
							'full' => __('Full', 'paddle'),
						),
					)
				)
			);


		// Fit Image
		$wp_customize->add_setting(
			'banner_fit_image',
			array(
				'default'           => $this->defaults['banner_fit_image'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'banner_fit_image',
				array(
					'label'   => __('Fit Image', 'paddle'),
					'section'     => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_hero_half_image',
				)
			)
		);

		// Fit Image Full height
		$wp_customize->add_setting(
			'banner_fit_image_full_height',
			array(
				'default'           => $this->defaults['banner_fit_image_full_height'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'banner_fit_image_full_height',
				array(
					'label'   => __('Full Height', 'paddle'),
					'section'     => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_hero_half_image_full_height',
				)
			)
		);

			// Overlay Opacity for full banner image
			$wp_customize->add_setting(
				'banner_overlay_opacity',
				array(
					'default'           => $this->defaults['banner_overlay_opacity'],
					'type'              => 'theme_mod',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Slider_Custom_Control(
					$wp_customize,
					'banner_overlay_opacity',
					array(
						'label'       => __('Image Overlay', 'paddle'),
						'description' => __('Adjust the image overlay opacity', 'paddle'),
						'section'     => 'paddle_hero_and_slider',
						'active_callback' => 'paddle_hero_option_design_selected',
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 9,
							'step' => 1,
						),
					)
				)
			);

		// Full Image header transparent
		$wp_customize->add_setting(
			'banner_full_image_header_transparent',
			array(
				'default'           => $this->defaults['banner_full_image_header_transparent'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'banner_full_image_header_transparent',
				array(
					'label'   => __('Transparent Header', 'paddle'),
					'section'     => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			)
		);

		//____ Header for transparent header settings.
	
		$wp_customize->add_setting(
			'paddle_hero_section_header_7',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_hero_section_header_7',
				array(
					'label'   => __('Tranparent Header', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_hero_transparent_header_on',
				)
			)
		);

		//______ Transparent Header Menu foreground colour.
		$wp_customize->add_setting(
			'banner_navlink_text_color',
			array(
				'default'           => $this->defaults['banner_navlink_text_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'banner_navlink_text_color',
				array(
					'label'           => __('Link', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_hero_transparent_header_on',
					'settings'        => 'banner_navlink_text_color',
				)
			)
		);

		//______ Transparent Header  Menu hover colour.
		$wp_customize->add_setting(
			'banner_navlink_text_color_hover',
			array(
				'default'           => $this->defaults['banner_navlink_text_color_hover'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'banner_navlink_text_color_hover',
				array(
					'label'           => __('Hover', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_hero_transparent_header_on',
					'settings'        => 'banner_navlink_text_color_hover',
				)
			)
		);

		//______ Transparent Header  Menu Active.
		$wp_customize->add_setting(
			'banner_navlink_text_color_active',
			array(
				'default'           => $this->defaults['banner_navlink_text_color_active'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',

			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'banner_navlink_text_color_active',
				array(
					'label'           => __('Active', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_hero_transparent_header_on',
					'settings'        => 'banner_navlink_text_color_active',
				)
			)
		);

			//____ Header for content box.
		
			$wp_customize->add_setting(
				'paddle_hero_section_header_2',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'paddle_text_sanitization',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Simple_Header_Title_Control(
					$wp_customize,
					'paddle_hero_section_header_2',
					array(
						'label'   => __('Content Box', 'paddle'),
						'section'  => 'paddle_hero_and_slider',
						'active_callback' => 'paddle_hero_option_design_selected',
						'input_attrs'     => array(
							'has_dropdown' => false,
							'label_id' => 'paddle_hero_section_header_2'
						),
					)
				)
			);
	
			// Align banner content for full container.
			$wp_customize->add_setting(
				'banner_content_align',
				array(
					'default'           => $this->defaults['banner_content_align'],
					'type'              => 'theme_mod',
					'sanitize_callback' => 'paddle_radio_sanitization',
					'capability'        => 'edit_theme_options',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Text_Radio_Button_Custom_Control(
					$wp_customize,
					'banner_content_align',
					array(
						'label'   => __('Position', 'paddle'),
						'section' => 'paddle_hero_and_slider',
						'active_callback' => 'header_media_selected_hero_full_image_content_position',
						'choices' => array(
							'left'   => __('Left', 'paddle'),
							'center' => __('Center', 'paddle'),
							'right'  => __('Right', 'paddle'),
						),
					)
				)
			);

			// Align banner content for half container.
			$wp_customize->add_setting(
				'banner_content_align_2',
				array(
					'default'           => $this->defaults['banner_content_align_2'],
					'type'              => 'theme_mod',
					'sanitize_callback' => 'paddle_radio_sanitization',
					'capability'        => 'edit_theme_options',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Text_Radio_Button_Custom_Control(
					$wp_customize,
					'banner_content_align_2',
					array(
						'label'   => __('Position', 'paddle'),
						'section' => 'paddle_hero_and_slider',
						'active_callback' => 'header_media_selected_hero_half_image_content_position',
						'choices' => array(
							'left'   => __('Left', 'paddle'),
							'right'  => __('Right', 'paddle'),
						),
					)
				)
			);
	
			$wp_customize->add_setting(
				'banner_content_bgcolor',
				array(
					'default'           => $this->defaults['banner_content_bgcolor'],
					'transport'         => 'refresh',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);
			$wp_customize->add_control(
				'banner_content_bgcolor',
				array(
					'label'   => __('Background', 'paddle'),
					'type'    => 'color',
					'settings' => 'banner_content_bgcolor',
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			);
	
	
			// Slider background overlay
			$wp_customize->add_setting(
				'banner_content_bg_opacity',
				array(
					'default'           => $this->defaults['banner_content_bg_opacity'],
					'transport'         => 'refresh',
					'sanitize_callback' => 'absint',
				)
			);
			$wp_customize->add_control(
				new Paddle_Slider_Opacity_Control(
					$wp_customize,
					'banner_content_bg_opacity',
					array(
						'label'           => __('Background Opacity', 'paddle'),
						'section'         => 'paddle_hero_and_slider',
						'active_callback' => 'paddle_hero_option_design_selected_have_bg',
						'input_attrs'     => array(
							'min'  => 0,
							'max'  => 10,
							'step' => 1,
						),
					)
				)
			);
	
			// Banner border radius .
			$wp_customize->add_setting(
				'paddle_banner_border_radius',
				array(
					'default'           => $this->defaults['paddle_banner_border_radius'],
					'sanitize_callback' => 'paddle_switch_sanitization',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control(
					$wp_customize,
					'paddle_banner_border_radius',
					array(
						'label'           => __('Border Radius', 'paddle'),
						'section'         => 'paddle_hero_and_slider',
						'active_callback' => 'paddle_banner_bgcolor_active',
					)
				)
			);
	
			// Box Shadow
			$wp_customize->add_setting(
				'paddle_banner_box_shadow',
				array(
					'default'           => $this->defaults['paddle_banner_box_shadow'],
					'sanitize_callback' => 'paddle_switch_sanitization',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control(
					$wp_customize,
					'paddle_banner_box_shadow',
					array(
						'label'           => __('Box Shadow', 'paddle'),
						'section'         => 'paddle_hero_and_slider',
						'active_callback' => 'paddle_banner_bgcolor_active',
					)
				)
			);

		
		//____ Header.
		$wp_customize->add_setting(
			'paddle_hero_section_header_4',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_hero_section_header_4',
				array(
					'label'   => __('Content Fonts', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			)
		);

		// H1 H2 Tag.
		$wp_customize->add_setting(
			'banner_header_htmltag',
			array(
				'default'           => $this->defaults['banner_header_htmltag'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'banner_header_htmltag',
				array(
					'label'   => __('Header Tag', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
					'choices' => array(
						'h1'  => __('H1', 'paddle'),
						'h2' => __('H2', 'paddle'),
					),
				)
			)
		);

		//__ Font size
		$wp_customize->add_setting(
			'banner_header_font_size',
			array(
				'default'           => $this->defaults['banner_header_font_size'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'banner_header_font_size',
				array(
					'label'       => __('Header Font Size', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
					'input_attrs' => array(
						'min'  => 16,
						'max'  => 70,
						'step' => 1,
					),
				)
			)
		);

		//__ Font weight
		$wp_customize->add_setting(
			'banner_font_weight',
			array(
				'default'           => $this->defaults['banner_font_weight'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'banner_font_weight',
				array(
					'label'   => __('Font Weight', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
					'choices' => array(
						'100' => __('Thin 100', 'paddle'),
						'200' => __('Extra Light 200', 'paddle'),
						'300' => __('Light 300', 'paddle'),
						'400' => __('Regular 400', 'paddle'),
						'500' => __('Medium 500', 'paddle'),
						'600' => __('Semi-Bold 600', 'paddle'),
						'700' => __('Bold 700', 'paddle'),
						'800' => __('Extra-Bold 800', 'paddle'),
						'900' => __('Ultra-Bold 900', 'paddle'),
					),
				)
			)
		);

		//__ Colors
		$wp_customize->add_setting(
			'banner_title_color',
			array(
				'default'           => $this->defaults['banner_title_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'banner_title_color',
			array(
				'label'   => __('Title Color', 'paddle'),
				'type'    => 'color',
				'settings' => 'banner_title_color',
				'section'  => 'paddle_hero_and_slider',
				'active_callback' => 'paddle_hero_option_design_selected',
			)
		);

		// Hero Text color.
		$wp_customize->add_setting(
			'paddle_banner_desc_color',
			array(
				'default'           => $this->defaults['paddle_banner_desc_color'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_banner_desc_color',
				array(
					'label'    => __('Text Color', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'settings' => 'paddle_banner_desc_color',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			)
		);

		//__ Item Spacing
		$wp_customize->add_setting(
			'banner_header_content_spacing',
			array(
				'default'           => $this->defaults['banner_header_content_spacing'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'banner_header_content_spacing',
				array(
					'label'       => __('Item Spacing', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				)
			)
		);



		//____ Header.
		$wp_customize->add_setting(
			'paddle_hero_section_header_5',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_hero_section_header_5',
				array(
					'label'   => __('Content Button', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			)
		);

		$wp_customize->add_setting(
			'banner_button_bgcolor',
			array(
				'default'           => $this->defaults['banner_button_bgcolor'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'banner_button_bgcolor',
			array(
				'label'   => __('Button Background', 'paddle'),
				'type'    => 'color',
				'settings' => 'banner_button_bgcolor',
				'section'  => 'paddle_hero_and_slider',
				'active_callback' => 'paddle_hero_option_design_selected',
			)
		);


		$wp_customize->add_setting(
			'banner_link_color',
			array(
				'default'           => $this->defaults['banner_link_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'banner_link_color',
			array(
				'label'   => __('Button Text Color', 'paddle'),
				'type'    => 'color',
				'settings' => 'banner_link_color',
				'section'  => 'paddle_hero_and_slider',
				'active_callback' => 'paddle_hero_option_design_selected',
			)
		);

		$wp_customize->add_setting(
			'banner_link_hover_color',
			array(
				'default'           => $this->defaults['banner_link_hover_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'banner_link_hover_color',
			array(
				'label'   => __('Button Hover', 'paddle'),
				'type'    => 'color',
				'settings' => 'banner_link_hover_color',
				'section'  => 'paddle_hero_and_slider',
				'active_callback' => 'paddle_hero_option_design_selected',
			)
		);

		//__ Enable border
		$wp_customize->add_setting(
			'banner_button_border_enable',
			array(
				'default'           => $this->defaults['banner_button_border_enable'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'banner_button_border_enable',
				array(
					'label'           => __('Border', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			)
		);

		// __ Button Padding
		$wp_customize->add_setting(
			'banner_button_padding',
			array(
				'default' => $this->defaults['banner_button_padding'],
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_MultipleInput_Custom_control(
				$wp_customize,
				'banner_button_padding',
				array(
					'label'           => __('Padding', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
					'input_attrs' => array(
						'edges' => 'top,right,bottom,left',
						'max' => 4,
						'extra_class' => 'paddle-settings-has-border-top paddle-settings-has-border-bottom paddle-settings-has-margin-top paddle-settings-has-margin-bottom paddle-settings-has-title-has-margin-bottom',
					  ),
					
				)
			)
		);

		// Button alignment.
		$wp_customize->add_setting(
			'banner_button_align',
			array(
				'default'           => 'right',
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'banner_button_align',
				array(
					'label'   => __('Position', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
					'choices' => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
						'right'  => __('Right', 'paddle'),
					),
				)
			)
		);

		// Button text transform.
		$wp_customize->add_setting(
			'banner_button_transform',
			array(
				'default'           => 'uppercase',
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'banner_button_transform',
				array(
					'label'   => __('Text Case', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
					'choices' => array(
						'uppercase'  => __('Uppercase', 'paddle'),
						'capitalize' => __('Capitalize', 'paddle'),
						'none'       => __('None', 'paddle'),
					),
				)
			)
		);

		// Arrow Button
		$wp_customize->add_setting(
			'banner_arrow_button',
			array(
				'default'           => $this->defaults['banner_arrow_button'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'banner_arrow_button',
				array(
					'label'   => __('Use Arrow', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			)
		);

		//____ Header.
		$wp_customize->add_setting(
			'paddle_hero_section_header_3',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_hero_section_header_3',
				array(
					'label'   => __('Container', 'paddle'),
					'section'  => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_hero_option_design_selected',
				)
			)
		);


		// Banner background color.
		$wp_customize->add_setting(
			'paddle_banner_header_bg_color',
			array(
				'default'           => $this->defaults['paddle_banner_header_bg_color'],
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
					'label'           => __('Background Color', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'paddle_banner_header_bg_color',
					'active_callback' => 'paddle_banner_bgcolor_active',
				)
			)
		);

		//__ background gradient.
		$wp_customize->add_setting(
			'paddle_banner_bg_gradient',
			array(
				'default'           => $this->defaults['paddle_banner_bg_gradient'],
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_banner_bg_gradient',
				array(
					'label'           => __('Background Gradient', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'paddle_banner_bg_gradient',
					'active_callback' => 'paddle_banner_bgcolor_active',
				)
			)
		);

		// Banner title.
		$wp_customize->add_setting(
			'header_banner_title',
			array(
				'default'           => $this->defaults['header_banner_title'],
				'sanitize_callback' => 'sanitize_text_field',

			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_title',
				array(
					'label'           => __('Banner Title', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'header_banner_title',
					'type'            => 'text',
					'active_callback' => 'header_media_selected_hero',
				)
			)
		);

		// Banner description.
		$wp_customize->add_setting(
			'header_banner_description',
			array(
				'default'           => $this->defaults['header_banner_description'],
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_description',
				array(
					'label'           => __('Banner description', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'header_banner_description',
					'type'            => 'textarea',
					'active_callback' => 'header_media_selected_hero',
				)
			)
		);

		// Banner Button 1.
		$wp_customize->add_setting(
			'header_banner_button_1',
			array(
				'default'           => __('Learn More', 'paddle'),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_button_1',
				array(
					'label'           => __('Button 1 Label', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'header_banner_button_1',
					'type'            => 'text',
					'active_callback' => 'header_media_selected_hero',
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
					'label'           => __('Button 1 URL Link', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'header_banner_button_1_link',
					'type'            => 'url',
					'active_callback' => 'header_media_selected_hero',
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
					'label'           => __('Button 2 Label', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'header_banner_button_2',
					'type'            => 'text',
					'active_callback' => 'header_media_selected_hero',
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
					'label'           => __('Button 2 URL Link', 'paddle'),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'header_banner_button_2_link',
					'type'            => 'url',
					'active_callback' => 'header_media_selected_hero',
				)
			)
		);



		/* Site Layout
		---------------------------------------------------------------------------------------*/
		// Toggle between the Default content width and custom container
		$wp_customize->add_setting(
			'custom_container',
			array(
				'default'           => $this->defaults['custom_container'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		//'active_callback' => 'paddle_blog_general_archive_selected',
		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'custom_container',
				array(
					'label'           => __('Content Width', 'paddle'),
					'section'         => 'paddle_theme_site_layout',
					'type'            => 'select',
					'choices'         => array(
						'default' => __('Default', 'paddle'),
						'custom'  => __('Custom', 'paddle'),
					),
				)
			)
		);

		// Container width
		$wp_customize->add_setting(
			'paddle_theme_content_width',
			array(
				'default'           => $this->defaults['paddle_theme_content_width'],
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'paddle_theme_content_width',
				array(
					'section'         => 'paddle_theme_site_layout',
					'label'           => __('Custom Width', 'paddle'),
					'active_callback' => 'paddle_selected_custom_width',
					'input_attrs'     => array(
						'min'  => 300,
						'max'  => 1900,
						'step' => 100,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_sidebar_position_home',
			array(
				'default'           => $this->defaults['paddle_sidebar_position_home'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_sidebar_position_home',
				array(
					'label'           => __('Home', 'paddle'),
					'section'         => 'paddle_theme_site_layout',
					'choices'         => array(
						'no-sidebar'    => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/sidebar-none.png',
							'name'  => __('No Sidebar', 'paddle'),
						),
						'right-sidebar' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/sidebar-right.png',
							'name'  => __('Right Sidebar', 'paddle'),
						),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_sidebar_position_page',
			array(
				'default'           => $this->defaults['paddle_sidebar_position_page'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_sidebar_position_page',
				array(
					'label'           => __('Page', 'paddle'),
					'section'         => 'paddle_theme_site_layout',
					'choices'         => array(
						'no-sidebar'    => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/sidebar-none.png',
							'name'  => __('No Sidebar', 'paddle'),
						),
						'right-sidebar' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/sidebar-right.png',
							'name'  => __('Right Sidebar', 'paddle'),
						),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_sidebar_position',
			array(
				'default'           => $this->defaults['paddle_sidebar_position'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_sidebar_position',
				array(
					'label'           => __('Blog', 'paddle'),
					'section'         => 'paddle_theme_site_layout',
					'choices'         => array(
						'no-sidebar'    => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/sidebar-none.png',
							'name'  => __('No Sidebar', 'paddle'),
						),
						'right-sidebar' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/sidebar-right.png',
							'name'  => __('Right Sidebar', 'paddle'),
						),
					),
				)
			)
		);

		// Archive
		$wp_customize->add_setting(
			'paddle_sidebar_position_archive',
			array(
				'default'           => $this->defaults['paddle_sidebar_position_archive'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_sidebar_position_archive',
				array(
					'label'           => __('Archive', 'paddle'),
					'section'         => 'paddle_theme_site_layout',
					'choices'         => array(
						'no-sidebar'    => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/sidebar-none.png',
							'name'  => __('No Sidebar', 'paddle'),
						),
						'right-sidebar' => array(
							'image' => trailingslashit(get_template_directory_uri()) . 'inc/customizer/images/sidebar-right.png',
							'name'  => __('Right Sidebar', 'paddle'),
						),
					),
				)
			)
		);


		/*
		---------------------------------------------------------------------------------------*/

		// Blog Layout.

		/* Header options betweens design and general */
		$wp_customize->add_setting(
			'title_options_blog',
			array(
				'default'           => 'general',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Title_Control(
				$wp_customize,
				'title_options_blog',
				array(
					'label'   => __('General', 'paddle'),
					'section' => 'paddle_blog_post',
					'type'    => 'select',
					'choices' => array(
						'general' => __('General', 'paddle'),
						'design'  => __('Design', 'paddle'),
					),
				)
			)
		);




		// Header
		$wp_customize->add_setting(
			'paddle_blog_section_header_1',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_blog_section_header_1',
				array(
					'label'           => __('Post Structure', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		// Archive Thumbnail size.
		$wp_customize->add_setting(
			'paddle_archive_thumbnail_size',
			array(
				'default'           => $this->defaults['paddle_archive_thumbnail_size'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_archive_thumbnail_size',
				array(
					'label'   => __('Thumbnail Size', 'paddle'),
					'section' => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
					'type'    => 'select',
					'choices' => array(
						'paddle-small-thumb'        => __('480 x 360', 'paddle'),
						'paddle-square-image'       => __('600 x 600', 'paddle'),
						'paddle-horizontal-image'   => __('760 x 400', 'paddle'),
						'paddle-medium-image'       => __('800 x 600', 'paddle'),
						'paddle-with-sidebar-image' => __('1020 x 600', 'paddle'),
						'paddle-featured-image'     => __('1410 x 600', 'paddle'),
						'paddle-large-image'        => __('1320 x 990', 'paddle'),
					),
				)
			)
		);

		// Remove sidebar from single product page.
		$wp_customize->add_setting(
			'paddle_remove_woo_single_sidebar',
			array(
				'default'           => $this->defaults['paddle_remove_woo_single_sidebar'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		if (class_exists('WooCommerce')) {

			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control(
					$wp_customize,
					'paddle_remove_woo_single_sidebar',
					array(
						'label'   => __('WooCommerce Product Sidebar', 'paddle'),
						'section' => 'paddle_blog_post',
					)
				)
			);
		}

		// Featured Image
		$wp_customize->add_setting(
			'enable_archive_featured_image',
			array(
				'default'           => $this->defaults['enable_archive_featured_image'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'enable_archive_featured_image',
				array(
					'label'           => __('Featured Image', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		// Header for meta
		$wp_customize->add_setting(
			'paddle_blog_section_header_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control_2(
				$wp_customize,
				'paddle_blog_section_header_2',
				array(
					'label'           => __('Meta', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		// Enable the author link in archive.
		$wp_customize->add_setting(
			'paddle_enable_archive_author',
			array(
				'default'           => $this->defaults['paddle_enable_archive_author'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_archive_author',
				array(
					'label'           => __('Author', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_enable_archive_category',
			array(
				'default'           => $this->defaults['paddle_enable_archive_category'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_archive_category',
				array(
					'label'           => __('Category', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		// Enable comment archive post.
		$wp_customize->add_setting(
			'paddle_enable_archive_comment',
			array(
				'default'           => $this->defaults['paddle_enable_archive_comment'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_archive_comment',
				array(
					'label'           => __('Comment', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		// Enable published date archive post.
		$wp_customize->add_setting(
			'paddle_enable_archive_published_date',
			array(
				'default'           => $this->defaults['paddle_enable_archive_published_date'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_archive_published_date',
				array(
					'label'           => __('Publish Date', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		// Enable tag archive post.
		$wp_customize->add_setting(
			'paddle_enable_archive_tag',
			array(
				'default'           => $this->defaults['paddle_enable_archive_tag'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_archive_tag',
				array(
					'label'           => __('Tag', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		// Header for Post content
		$wp_customize->add_setting(
			'paddle_blog_section_header_3',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control_2(
				$wp_customize,
				'paddle_blog_section_header_3',
				array(
					'label'           => __('Post Content', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		/** Blog Excerpt */
		$wp_customize->add_setting(
			'enable_blog_excerpt',
			array(
				'default'           => $this->defaults['enable_blog_excerpt'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'enable_blog_excerpt',
				array(
					'section'         => 'paddle_blog_post',
					'label'           => __('Excerpt', 'paddle'),
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);

		// Excerpt Length.
		$wp_customize->add_setting(
			'excerpt_length',
			array(
				'default'           => $this->defaults['excerpt_length'],
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'excerpt_length',
				array(
					'section'         => 'paddle_blog_post',
					'label'           => __('Excerpt Length', 'paddle'),
					'active_callback' => 'paddle_blog_general_archive_selected_excerpt_enabled',
					'input_attrs'     => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 5,
					),
				)
			)
		);

		// Read More Text.
		$wp_customize->add_setting(
			'read_more_text',
			array(
				'default'           => __('Continue reading', 'paddle'),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'read_more_text',
			array(
				'type'            => 'text',
				'section'         => 'paddle_blog_post',
				'active_callback' => 'paddle_blog_general_archive_selected_excerpt_enabled',
				'label'           => __('Read More Text', 'paddle'),
			)
		);

		// Toggle layout.
		$wp_customize->add_setting(
			'post_archive_layout',
			array(
				'default'           => $this->defaults['post_archive_layout'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'post_archive_layout',
				array(
					'label'           => __('Archive Blog Layout', 'paddle'),
					'section'         => 'paddle_blog_post',
					'type'            => 'select',
					'active_callback' => 'paddle_blog_design_archive_selected',
					'choices'         => array(
						'grid' => __('Grid', 'paddle'),
						'list' => __('List', 'paddle'),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_grid_columns',
			array(
				'default'           => $this->defaults['paddle_grid_columns'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'paddle_grid_columns',
				array(
					'label'           => __('Archive Columns', 'paddle'),
					'section'         => 'paddle_blog_post',
					'type'            => 'select',
					'active_callback' => 'paddle_blog_design_archive_selected_grid_selected',
					'choices'         => array(
						'1-column' => __('1 Grid', 'paddle'),
						'2-columns' => __('2 Grids', 'paddle'),
						'3-columns' => __('3 Grids', 'paddle'),
					),
				)
			)
		);

		// Image before site title.
		$wp_customize->add_setting(
			'enable_image_before_site_title',
			array(
				'default'           => $this->defaults['enable_image_before_site_title'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'enable_image_before_site_title',
				array(
					'label'           => __('Image before title', 'paddle'),
					'section'         => 'paddle_blog_post',
					'active_callback' => 'paddle_blog_design_archive_selected',
				)
			)
		);

		// Single Blog Post
		// Enable the author bio.
		$wp_customize->add_setting(
			'paddle_enable_author_bio',
			array(
				'default'           => $this->defaults['paddle_enable_author_bio'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_author_bio',
				array(
					'label'           => __('Author', 'paddle'),
					'section'         => 'paddle_post_and_single',
					'active_callback' => 'paddle_blog_design_archive_selected',
				)
			)
		);


		// Blog Alignment
		$wp_customize->add_setting(
			'paddle_h1_alignment',
			array(
				'default'           => $this->defaults['paddle_h1_alignment'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'paddle_h1_alignment',
				array(
					'label'   => __('Content Align', 'paddle'),
					'section' => 'paddle_post_single',
					'type'    => 'select',
					'choices' => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
					),
				)
			)
		);

		// Blog Style
		$wp_customize->add_setting(
			'paddle_blog_section_header_6',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_blog_section_header_6',
				array(
					'label'   => __('Style', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		// Blog style.
		$wp_customize->add_setting(
			'paddle_blog_style',
			array(
				'default'           => $this->defaults['paddle_blog_style'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_blog_style',
				array(
					'label'   => __('Select Style', 'paddle'),
					'section' => 'paddle_post_single',
					'type'    => 'select',
					'choices' => array(
						'0'        => __('Default', 'paddle'),
						'1'       => __('Style 1', 'paddle'),
					),
				)
			)
		);

		// Header featured image
		$wp_customize->add_setting(
			'paddle_blog_section_header_3',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_blog_section_header_3',
				array(
					'label'   => __('Featured Image', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		// Thumbnail size.
		$wp_customize->add_setting(
			'paddle_thumbnail_size',
			array(
				'default'           => $this->defaults['paddle_thumbnail_size'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_thumbnail_size',
				array(
					'label'   => __('Featured Image Size', 'paddle'),
					'section' => 'paddle_post_single',
					'type'    => 'select',
					'choices' => array(
						'paddle-small-thumb'        => __('480 x 360', 'paddle'),
						'paddle-square-image'       => __('600 x 600', 'paddle'),
						'paddle-horizontal-image'   => __('760 x 400', 'paddle'),
						'paddle-medium-image'       => __('800 x 600', 'paddle'),
						'paddle-with-sidebar-image' => __('1020 x 600', 'paddle'),
						'paddle-featured-image'     => __('1410 x 600', 'paddle'),
						'paddle-large-image'        => __('1320 x 990', 'paddle'),
					),
				)
			)
		);

		// Post thumbnail position
		$wp_customize->add_setting(
			'paddle_thumbnail_alignment',
			array(
				'default'           => $this->defaults['paddle_thumbnail_alignment'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'paddle_thumbnail_alignment',
				array(
					'label'   => __('Featured Image Position', 'paddle'),
					'section' => 'paddle_post_single',
					'type'    => 'select',
					'choices' => array(
						'left'   => __('Left', 'paddle'),
						'center' => __('Center', 'paddle'),
					),
				)
			)
		);

		// Post caption alignment.
		$wp_customize->add_setting(
			'paddle_caption_width',
			array(
				'default'           => $this->defaults['paddle_caption_width'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'paddle_caption_width',
				array(
					'label'   => __('Image Caption', 'paddle'),
					'section' => 'paddle_post_single',
					'type'    => 'select',
					'choices' => array(
						'auto'     => __('Full'),
						'fit-content' => __('Fit'),
					),
				)
			)
		);

	
		$wp_customize->add_setting(
			'caption_over_image',
			array(
				'default'           => $this->defaults['caption_over_image'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'caption_over_image',
				array(
					'label'           => __('Caption Over Image', 'paddle'),
					'section'         => 'paddle_post_single',
				)
			)
		);

	

		/**
		 * Single Post
		 */
		// Header for meta
		$wp_customize->add_setting(
			'paddle_blog_section_header_4',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control_2(
				$wp_customize,
				'paddle_blog_section_header_4',
				array(
					'label'   => __('Meta', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		// Enable the author bio archive post.
		$wp_customize->add_setting(
			'paddle_enable_blog_author',
			array(
				'default'           => $this->defaults['paddle_enable_blog_author'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_blog_author',
				array(
					'label'   => __('Author', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		$wp_customize->add_setting(
			'paddle_enable_blog_category',
			array(
				'default'           => $this->defaults['paddle_enable_blog_category'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_blog_category',
				array(
					'label'   => __('Category', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		// Enable comment archive post.
		$wp_customize->add_setting(
			'paddle_enable_blog_comment',
			array(
				'default'           => $this->defaults['paddle_enable_blog_comment'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_blog_comment',
				array(
					'label'   => __('Comment', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		// Enable published date archive post.
		$wp_customize->add_setting(
			'paddle_enable_blog_published_date',
			array(
				'default'           => $this->defaults['paddle_enable_blog_published_date'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_blog_published_date',
				array(
					'label'   => __('Publish Date', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		// Enable published date archive post.
		$wp_customize->add_setting(
			'paddle_enable_blog_updated_date',
			array(
				'default'           => $this->defaults['paddle_enable_blog_updated_date'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_blog_updated_date',
				array(
					'label'   => __('Updated Date', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		// Enable tag archive post.
		$wp_customize->add_setting(
			'paddle_enable_blog_tag',
			array(
				'default'           => $this->defaults['paddle_enable_blog_tag'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_blog_tag',
				array(
					'label'   => __('Tag', 'paddle'),
					'section' => 'paddle_post_single',
				)
			)
		);

		// Post date position
		$wp_customize->add_setting(
			'paddle_blog_date_position',
			array(
				'default'           => $this->defaults['paddle_blog_date_position'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'paddle_blog_date_position',
				array(
					'label'   => __('Date', 'paddle'),
					'section' => 'paddle_post_single',
					'type'    => 'select',
					'choices' => array(
						'before' => __('Before Content'),
						'after'  => __('After Content'),
					),
				)
			)
		);

		// Author Link
		$wp_customize->add_setting(
			'paddle_author_link_position',
			array(
				'default'           => $this->defaults['paddle_author_link_position'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'paddle_author_link_position',
				array(
					'label'   => __('Author Link', 'paddle'),
					'section' => 'paddle_post_single',
					'type'    => 'select',
					'choices' => array(
						'before' => __('Before Content'),
						'after'  => __('After Content'),
					),
				)
			)
		);


		// Author Bio
		$wp_customize->add_setting(
			'paddle_enable_blog_author_bio',
			array(
				'default'           => $this->defaults['paddle_enable_blog_author_bio'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_enable_blog_author_bio',
				array(
					'label'   => __('Author Bio', 'paddle'),
					'section' => ('paddle_post_single'),
				)
			)
		);

		// ======================== END SINGLE POST ======================


		/******************************* Page ********************************/

		// Select Title Options
		$wp_customize->add_setting(
			'page_options_header',
			array(
				'default'           => 'general',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Title_Control(
				$wp_customize,
				'page_options_header',
				array(
					'label'    => __('General', 'paddle'),
					'section' => 'paddle_page',
					'type'     => 'select',
					'priority' => 1,
					'choices'  => array(
						'general' => __('General', 'paddle'),
						'meta'  => __('Meta', 'paddle'),
					),
				)
			)
		);

		// Header 2
		$wp_customize->add_setting(
			'paddle_page_section_header_2',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control(
				$wp_customize,
				'paddle_page_section_header_2',
				array(
					'label'   => __('Featured Image', 'paddle'),
					'section' => 'paddle_page',
					'active_callback' => 'paddle_page_general_selected',
				)
			)
		);

		// Page Thumbnail size.
		$wp_customize->add_setting(
			'paddle_thumbnail_size_page',
			array(
				'default'           => $this->defaults['paddle_thumbnail_size_page'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_thumbnail_size_page',
				array(
					'label'   => __('Featured Image Size', 'paddle'),
					'section' => 'paddle_page',
					'active_callback' => 'paddle_page_general_selected',
					'type'    => 'select',
					'choices' => array(
						'paddle-small-thumb'        => __('480 x 360', 'paddle'),
						'paddle-square-image'       => __('600 x 600', 'paddle'),
						'paddle-horizontal-image'   => __('760 x 400', 'paddle'),
						'paddle-medium-image'       => __('800 x 600', 'paddle'),
						'paddle-with-sidebar-image' => __('1020 x 600', 'paddle'),
						'paddle-featured-image'     => __('1410 x 600', 'paddle'),
						'paddle-large-image'        => __('1320 x 990', 'paddle'),
					),
				)
			)
		);

			//____ Header 1.
			$wp_customize->add_setting(
				'paddle_page_section_header_1',
				array(
					'transport'         => 'postMessage',
					'sanitize_callback' => 'paddle_text_sanitization',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Simple_Header_Title_Control(
					$wp_customize,
					'paddle_page_section_header_1',
					array(
						'label'   => __('Header Style', 'paddle'),
						'section' => 'paddle_page',
						'active_callback' => 'paddle_page_general_selected',
					)
				)
			);
	
			// Page style.
			$wp_customize->add_setting(
				'paddle_page_header_type',
				array(
					'default'           => $this->defaults['paddle_page_header_type'],
					'sanitize_callback' => 'paddle_radio_sanitization',
				)
			);
	
	
			$wp_customize->add_control(
				new Paddle_Option_Buttons_Control(
					$wp_customize,
					'paddle_page_header_type',
					array(
						'label'   => __('Select Style', 'paddle'),
						'section' => 'paddle_page',
						'active_callback' => 'paddle_page_general_selected',
						'type'    => 'select',
						'choices' => array(
							'0'        => __('Default', 'paddle'),
							'PageBanner'       => __('Banner', 'paddle'),
						),
					)
				)
			);

			//___ Page Banner  height
			$wp_customize->add_setting(
				'banner_height_page',
				array(
					'default'           => $this->defaults['banner_height_page'],
					'transport'         => 'refresh',
					'sanitize_callback' => 'paddle_range_sanitization',
				)
			);
			$wp_customize->add_control(
				new Paddle_Slider_Custom_Control(
					$wp_customize,
					'banner_height_page',
					array(
						'label'       => __('Banner Height (REM)', 'paddle'),
						'section'     => 'paddle_page',
						'active_callback' => 'paddle_page_header_is_banner',
						'input_attrs' => array(
							'min'  => 15,
							'max'  => 24.5,
							'step' => .5,
						),
					)
				)
			);

			// Image width
			$wp_customize->add_setting(
				'banner_image_width_page',
				array(
					'default'           => $this->defaults['banner_image_width_page'],
					'type'              => 'theme_mod',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				)
			);

			$wp_customize->add_control(
				new Paddle_Slider_Custom_Control(
					$wp_customize,
					'banner_image_width_page',
					array(
						'label'       => __('Image Width', 'paddle'),
						'section'     => 'paddle_page',
						'active_callback' => 'paddle_page_header_is_banner',
						'input_attrs' => array(
							'min'  => 50,
							'max'  => 100,
							'step' => 1,
						),
					)
				)
			);

	
			$wp_customize->add_setting(
				'paddle_banner_alignment_page',
				array(
					'default'           => $this->defaults['paddle_banner_alignment_page'],
					'sanitize_callback' => 'paddle_radio_sanitization',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Option_Buttons_Control(
					$wp_customize,
					'paddle_banner_alignment_page',
					array(
						'label'   => __('Banner Content Alignment', 'paddle'),
						'section' => 'paddle_page',
						'active_callback' => 'paddle_page_header_is_banner',
						'type'    => 'select',
						'choices' => array(
							'left'   => __('Left', 'paddle'),
							'center' => __('Center', 'paddle'),
							'right' => __('Right', 'paddle'),
						),
					)
				)
			);

			$wp_customize->add_setting(
				'paddle_banner_image_position_page',
				array(
					'default'           => $this->defaults['paddle_banner_image_position_page'],
					'sanitize_callback' => 'paddle_radio_sanitization',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Option_Buttons_Control(
					$wp_customize,
					'paddle_banner_image_position_page',
					array(
						'label'   => __('Banner Image Position', 'paddle'),
						'section' => 'paddle_page',
						'active_callback' => 'paddle_page_header_is_banner',
						'type'    => 'select',
						'choices' => array(
							'left'   => __('Left', 'paddle'),
							'center' => __('Center', 'paddle'),
							'right' => __('Right', 'paddle'),
						),
					)
				)
			);

			//___ Page parent
			$wp_customize->add_setting(
				'banner_parent_title_page',
				array(
					'default'           => $this->defaults['banner_parent_title_page'],
					'transport'         => 'refresh',
					'type'              => 'theme_mod',
					'sanitize_callback' => 'paddle_switch_sanitization',
				)
			);

			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control(
					$wp_customize,
					'banner_parent_title_page',
					array(
						'label'   => __('Show Parent Title', 'paddle'),
						'section' => 'paddle_page',
						'active_callback' => 'paddle_page_header_is_banner',
					)
				)
			);

			//___Default header
			// Element Spacing
			$wp_customize->add_setting(
				'default_page_header_spacing',
				array(
					'default'           => $this->defaults['default_page_header_spacing'],
					'type'              => 'theme_mod',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				)
			);

			$wp_customize->add_control(
				new Paddle_Slider_Custom_Control(
					$wp_customize,
					'default_page_header_spacing',
					array(
						'label'       => __('Element Spacing', 'paddle'),
						'section'     => 'paddle_page',
						'active_callback' => 'paddle_page_header_is_default',
						'input_attrs' => array(
							'min'  => 0,
							'max'  => 15,
							'step' => 1,
						),
					)
				)
			);

			$wp_customize->add_setting(
				'default_page_header_title_position',
				array(
					'default'           => $this->defaults['default_page_header_title_position'],
					'sanitize_callback' => 'paddle_radio_sanitization',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Option_Buttons_Control(
					$wp_customize,
					'default_page_header_title_position',
					array(
						'label'   => __('Title Position', 'paddle'),
						'section' => 'paddle_page',
						'active_callback' => 'paddle_page_header_is_default',
						'type'    => 'select',
						'choices' => array(
							'before'   => __('Before Image', 'paddle'),
							'after' => __('After Image', 'paddle'),
						),
					)
				)
			);
			
			$wp_customize->add_setting(
				'default_page_horizontal_align',
				array(
					'default'           => $this->defaults['default_page_horizontal_align'],
					'sanitize_callback' => 'paddle_radio_sanitization',
				)
			);
	
			$wp_customize->add_control(
				new Paddle_Option_Buttons_Control(
					$wp_customize,
					'default_page_horizontal_align',
					array(
						'label'   => __('Horizontal Alignment', 'paddle'),
						'section' => 'paddle_page',
						'active_callback' => 'paddle_page_header_is_default',
						'type'    => 'select',
						'choices' => array(
							'left'   => __('Left', 'paddle'),
							'center' => __('Center', 'paddle'),
							'right' => __('Right', 'paddle'),
						),
					)
				)
			);	
			
		
		
	
			//__ META
			$wp_customize->add_setting(
				'banner_author_page',
				array(
					'default'           => $this->defaults['banner_author_page'],
					'sanitize_callback' => 'paddle_switch_sanitization',
				)
			);

			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control_2(
					$wp_customize,
					'banner_author_page',
					array(
						'label'           => __('Author', 'paddle'),
						'section'         => 'paddle_page',
						'active_callback' => 'paddle_page_meta_selected',
					)
				)
			);

			$wp_customize->add_setting(
				'banner_published_date_page',
				array(
					'default'           => $this->defaults['banner_published_date_page'],
					'sanitize_callback' => 'paddle_switch_sanitization',
				)
			);

			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control_2(
					$wp_customize,
					'banner_published_date_page',
					array(
						'label'           => __('Published Date', 'paddle'),
						'section'         => 'paddle_page',
						'active_callback' => 'paddle_page_meta_selected',
					)
				)
			);

			$wp_customize->add_setting(
				'banner_excerpt_page',
				array(
					'default'           => $this->defaults['banner_excerpt_page'],
					'sanitize_callback' => 'paddle_switch_sanitization',
				)
			);

			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control_2(
					$wp_customize,
					'banner_excerpt_page',
					array(
						'label'           => __('Excerpt', 'paddle'),
						'section'         => 'paddle_page',
						'active_callback' => 'paddle_page_meta_selected',
					)
				)
			);
			

			/** END PAGE SETTINGS */
	

		// Header for placeholder
		$wp_customize->add_setting(
			'paddle_blog_section_header_5',
			array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Simple_Header_Title_Control_2(
				$wp_customize,
				'paddle_blog_section_header_5',
				array(
					'label'   => __('Blog Placeholder Text', 'paddle'),
					'section' => 'paddle_placeholder_text',
				)
			)
		);

		// Posted on.
		$wp_customize->add_setting(
			'placeholder_text_posted_on',
			array(
				'default'           => $this->defaults['placeholder_text_posted_on'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'placeholder_text_posted_on',
			array(
				'type'    => 'text',
				'section' => 'paddle_placeholder_text',
				'label'   => __('Posted on', 'paddle'),
			)
		);

		// Updated on
		$wp_customize->add_setting(
			'placeholder_text_updated_on',
			array(
				'default'           => $this->defaults['placeholder_text_updated_on'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'placeholder_text_updated_on',
			array(
				'type'    => 'text',
				'section' => 'paddle_placeholder_text',
				'label'   => __('Updated on', 'paddle'),
			)
		);

		// Site Title Font Size.
		$wp_customize->add_setting(
			'site_title_font_size',
			array(
				'default'           => $this->defaults['site_title_font_size'],
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'site_title_font_size',
				array(
					'section'     => 'title_tagline',
					'label'       => __('Site Title Font Size', 'paddle'),
					'description' => __('Change the font size of your site title.', 'paddle'),
					'priority'    => 65,
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		// Bootstrap CSS
		$wp_customize->add_setting(
			'use_full_bootstrap',
			array(
				'default'           => $this->defaults['use_full_bootstrap'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'use_full_bootstrap',
				array(
					'label'       => __('Use full boostrap CSS', 'paddle'),
					'section'     => 'paddle_bootstrap',
					'description' => __('By default only part of bootstrap CSS are loaded, enable this to load all CSS. This may affect performance.', 'paddle'),
				)
			)
		);

		// Bootstrap JS
		$wp_customize->add_setting(
			'use_bootstrap_js',
			array(
				'default'           => $this->defaults['use_bootstrap_js'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'use_bootstrap_js',
				array(
					'label'       => __('Load bootstrap JavaScript', 'paddle'),
					'section'     => 'paddle_bootstrap',
					'description' => __('By default boostrap JavaScript is not loaded. If you need this, you can enable it here.', 'paddle'),
				)
			)
		);
	}

	/**
	 * Register default controls
	 */
	public function paddle_register_theme_default_controls($wp_customize)
	{

		/**
		 * Theme color
		 */

		 //__ Palette
		 /**
		 * Typography Preset
		 */
		$wp_customize->add_setting(
			'paddle_color_palette',
			array(
				'default'           => $this->defaults['paddle_color_palette'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Image_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_color_palette',
				array(
					'label'   => __('Global Palette', 'paddle'),
					'section' => 'paddle_theme_color_section',
					'choices' => array(
						'style-1'          => array(
							'palette' => $this->defaults['paddle_color_palette_1'],
							'name'  => __('Style 1', 'paddle'),
						),
						'style-2'       => array(
							'palette' => $this->defaults['paddle_color_palette_2'],
							'name'  => __('Style 2', 'paddle'),
						),
						'style-3'       => array(
							'palette' => $this->defaults['paddle_color_palette_3'],
							'name'  => __('Style 3', 'paddle'),
						),
					),
				)
			)
		);

		// Color Palette colors
		$wp_customize->add_setting( 'paddle_color_palette_1',
			array(
				'default' => $this->defaults['paddle_color_palette_1'],
				'transport' => 'refresh',
				'sanitize_callback' => 'paddle_text_sanitization'
			)
		);
		$wp_customize->add_control( 'paddle_color_palette_1',
			array(
				'section' => 'paddle_theme_color_section',
				'type' => 'hidden'
			)
		);

		$wp_customize->add_setting( 'paddle_color_palette_2',
			array(
				'default' => $this->defaults['paddle_color_palette_2'],
				'transport' => 'refresh',
				'sanitize_callback' => 'paddle_text_sanitization'
			)
		);
		$wp_customize->add_control( 'paddle_color_palette_2',
			array(
				'section' => 'paddle_theme_color_section',
				'type' => 'hidden'
			)
		);

		$wp_customize->add_setting( 'paddle_color_palette_3',
			array(
				'default' => $this->defaults['paddle_color_palette_3'],
				'transport' => 'refresh',
				'sanitize_callback' => 'paddle_text_sanitization'
			)
		);
		$wp_customize->add_control( 'paddle_color_palette_3',
			array(
				'section' => 'paddle_theme_color_section',
				'type' => 'hidden'
			)
		);

		$wp_customize->add_setting(
			'paddle_primary_color',
			array(
				'default'           => $this->defaults['paddle_primary_color'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_primary_color',
			array(
				'label'   => __('Accent', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);

		$wp_customize->add_setting(
			'paddle_theme_color_links',
			array(
				'default'           => $this->defaults['paddle_theme_color_links'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_theme_color_links',
			array(
				'label'   => __('Links', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);

		// Hover state
		$wp_customize->add_setting(
			'paddle_theme_color_links_hover',
			array(
				'default'           => $this->defaults['paddle_theme_color_links_hover'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_theme_color_links_hover',
			array(
				'label'   => __('Links Hover', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);

		$wp_customize->add_setting(
			'paddle_theme_color_headings',
			array(
				'default'           => $this->defaults['paddle_theme_color_headings'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_theme_color_headings',
			array(
				'label'   => __('Headings (H1-H6)', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);

		// Hover state
		$wp_customize->add_setting(
			'paddle_theme_color_headings_hover',
			array(
				'default'           => $this->defaults['paddle_theme_color_headings_hover'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_theme_color_headings_hover',
			array(
				'label'   => __('Headings (H1-H6) Hover', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);

		$wp_customize->add_setting(
			'paddle_theme_color_body_text',
			array(
				'default'           => $this->defaults['paddle_theme_color_body_text'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_theme_color_body_text',
			array(
				'label'   => __('Body Text color', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);

		$wp_customize->add_setting(
			'paddle_theme_color_buttons',
			array(
				'default'           => $this->defaults['paddle_theme_color_buttons'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_theme_color_buttons',
			array(
				'label'   => __('Buttons', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);

		// Hover state
		$wp_customize->add_setting(
			'paddle_theme_color_buttons_hover',
			array(
				'default'           => $this->defaults['paddle_theme_color_buttons_hover'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_theme_color_buttons_hover',
			array(
				'label'   => __('Buttons Hover', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);


		$wp_customize->add_setting(
			'paddle_theme_color_body_bg',
			array(
				'default'           => $this->defaults['paddle_theme_color_body_bg'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_theme_color_body_bg',
			array(
				'label'   => __('Body Background color', 'paddle'),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
				'settings' => 'paddle_theme_color_body_bg'
			)
		);

		
		// Buttons Sections

		$wp_customize->add_setting(
			'paddle_theme_button_global',
			array(
				'default'           => $this->defaults['paddle_theme_button_global'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_text_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Pill_Checkbox_Custom_Control(
				$wp_customize,
				'paddle_theme_button_global',
				array(
					'label'       => __('Button Appearance', 'paddle'),
					'description' => esc_html__('This is a sample Pill Checkbox Control', 'paddle'),
					'section'     => 'paddle_theme_button_section',
					'input_attrs' => array(
						'sortable'  => false,
						'fullwidth' => false,
						'sample'    => '',
					),
					'choices'     => array(
						'bordered' => __('Bordered', 'paddle'),
						'outlined' => __('Outlined', 'paddle'),
						'rounded'  => __('Rounded', 'paddle'),
					),
				)
			)
		);

		// Navigation Type
		$wp_customize->add_setting(
			'paddle_navigation_type',
			array(
				'default'           => $this->defaults['paddle_navigation_type'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'paddle_navigation_type',
				array(
					'label'   => __('Type', 'paddle'),
					'section'     => 'paddle_theme_navigation_section',
					'type'    => 'select',
					'choices' => array(
						'number'  => __('Number and Text'),
						'text' => __('Text'),
					),
				)
			)
		);
	}
}


/**
 * Load all our Customizer Custom Controls
 */
require_once trailingslashit(dirname(__FILE__)) . 'custom-controls.php';

/**
 * Initialise our Customizer settings
 */
$paddle_settings = new paddle_initialise_customizer_settings();

/**
 * Initialise WooCommerce Customiser
 */
if (paddle_is_woocommerce_active()) {
	require_once trailingslashit(dirname(__FILE__)) . 'customizer-woocommerce.php';
}
