<?php

/**
 * Customizer Setup and Custom Controls
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class paddle_initialise_customizer_settings {

	// Get our default values
	private $defaults;

	public function __construct() {
		 // Get our Customizer defaults
		$this->defaults = paddle_generate_defaults();

		// Register Theme panel
		add_action( 'customize_register', array( $this, 'paddle_add_theme_panels' ) );

		// Register Theme sections
		add_action( 'customize_register', array( $this, 'paddle_add_theme_sections' ) );

		// Register our Theme Custom Control controls
		add_action( 'customize_register', array( $this, 'paddle_register_theme_custom_controls' ) );

		// Register our sample default controls
		add_action( 'customize_register', array( $this, 'paddle_register_theme_default_controls' ) );
	}

	/**
	 * Register the theme panel
	 */
	public function paddle_add_theme_panels( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		$wp_customize->add_panel(
			'paddle_theme_option_panel',
			array(
				'priority' => 10,
				'title'    => __( 'Theme Options', 'paddle' ),
			)
		);
	}

	/**
	 * Register the theme section
	 */
	public function paddle_add_theme_sections( $wp_customize ) {

		/**
		 * Add Header Layout Section
		 */
		$wp_customize->add_section(
			'paddle_theme_header_options',
			array(
				'title'       => __( 'Header Layout', 'paddle' ),
				'description' => esc_html__( 'Header Layout', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		/**
		 * Add Header Buttons
		 */
		$wp_customize->add_section(
			'paddle_theme_header_buttons_options',
			array(
				'title'       => __( 'Header Buttons', 'paddle' ),
				'description' => esc_html__( 'Header Buttons', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		/**
		 * Add Header Buttons
		 */
		$wp_customize->add_section(
			'paddle_theme_header_logo_options',
			array(
				'title'       => __( 'Header Logo Size', 'paddle' ),
				'description' => esc_html__( 'Header Logo Size and Padding. To add a logo image, navigate to the Site Identity section.', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		/**
		 * Add Header Menu Section.
		 */
		$wp_customize->add_section(
			'paddle_header_menu',
			array(
				'title'       => __( 'Header Menu', 'paddle' ),
				'description' => esc_html__( 'Header Menu & Colours', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		// Add Header Top Bar Section.
		$wp_customize->add_section(
			'paddle_header_top_bar',
			array(
				'title'       => __( 'Header Top Bar', 'paddle' ),
				'description' => esc_html__( 'Add header top bar.', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		// Add Hero and slider.
		$wp_customize->add_section(
			'paddle_hero_and_slider',
			array(
				'title'       => __( 'Hero & Slider', 'paddle' ),
				'description' => esc_html__( 'Add Hero or Slider.', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		/**
		 * Add Footer Section.
		 */
		$wp_customize->add_section(
			'paddle_footer_settings',
			array(
				'title'       => esc_html__( 'Footer', 'paddle' ),
				'description' => __( 'Footer settings', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		
		/**
		 * Add page layout Section.
		 */
		$wp_customize->add_section(
			'paddle_page_layout_options',
			array(
				'title'       => __( 'Page Layout', 'paddle' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Page Layout', 'paddle' ),
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		/** 
		* Theme Featured image section 
		*/
		$wp_customize->add_section(
			'paddle_featured_image_options',
			array(
				'title'      => __( 'Featured Image', 'paddle' ),
				'capability' => 'edit_theme_options',
				'panel'      => 'paddle_theme_option_panel',
			)
		);

		/**
		 * Category and achieve option
		 */
		$wp_customize->add_section(
			'paddle_category_options',
			array(
				'title'      => __( 'Post Layout', 'paddle' ),
				'capability' => 'edit_theme_options',
				'panel'      => 'paddle_theme_option_panel',
			)
		);

		/**
		 * Add our Upsell Section
		 */
		$wp_customize->add_section(
			new Paddle_Upsell_Section(
				$wp_customize,
				'upsell_section',
				array(
					'title'           => __( 'Documentation Available', 'paddle' ),
					'url'             => 'http://localhost/howto/',
					'backgroundcolor' => '#344860',
					'textcolor'       => '#fff',
					'priority'        => 0,
				)
			)
		);
		
	}


	/*
	---------------------------------------------------------------------------------------*/
	// Header settings.
	/**
	 * Header and Navigation controls
	 */
	public function paddle_register_theme_custom_controls( $wp_customize ) {
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
					'label'       => __( 'Header Layout', 'paddle' ),
					'description' => esc_html__( 'Layout for the header.', 'paddle' ),
					'section'     => 'paddle_theme_header_options',
					'choices'     => array(
						'logo-left'         => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-left.jpg',
							'name'  => __( 'Logo Left', 'paddle' ),
						),
						'logo-center'       => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-center.jpg',
							'name'  => __( 'Logo Center', 'paddle' ),
						),
						'logo-right'        => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-right.jpg',
							'name'  => __( 'Logo Right', 'paddle' ),
						),
						'logo-with-search'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-left-search.jpg',
							'name'  => __( 'Logo Left & Search Left', 'paddle' ),
						),
						'logo-left-style-2' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-2.jpg',
							'name'  => __( 'Logo Left & Menu Left', 'paddle' ),
						),
					),
				)
			)
		); // End Header Image Control

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
					'label'    => __( 'Search Button', 'paddle' ),
					'priority' => 20,
					'section'  => 'paddle_theme_header_buttons_options',
				)
			)
		); // Search Button

		// Call to action button.
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
					'label'    => __( 'CTA Button', 'paddle' ),
					'priority' => 30,
					'section'  => 'paddle_theme_header_buttons_options',
				)
			)
		); // CTA Button

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
				'label'           => esc_html__( 'CTA URL', 'paddle' ),
				'section'         => 'paddle_theme_header_buttons_options',
				'type'            => 'url',
				'priority'        => 40,
				'input_attrs'     => array(
					'style'       => 'border: 2px solid #e6e6e6',
					'placeholder' => __( 'Enter URL Link...' ),
				),
				'active_callback' => 'paddle_check_active_control_paddle_header_cta',
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
				'label'           => esc_html__( 'CTA Text', 'paddle' ),
				'section'         => 'paddle_theme_header_buttons_options',
				'type'            => 'text',
				'priority'        => 50,
				'input_attrs'     => array(
					'style'       => 'border: 2px solid #e6e6e6',
					'placeholder' => __( 'Enter Text...' ),
				),
				'active_callback' => 'paddle_check_active_control_paddle_header_cta',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'paddle_header_cta_text',
			array(
				'selector'            => '#header-btn-cta a.btn',
				'container_inclusive' => false,
				'render_callback'     => function () {
					return get_theme_mod( 'paddle_header_cta_text' );
				},
				'fallback_refresh'    => true,
			)
		);

		// Header Logo.
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
					'label'       => __( 'Adjust Logo Size', 'paddle' ),
					'section'     => 'paddle_theme_header_logo_options',
					'input_attrs' => array(
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
					'label'       => __( 'Adjust Logo Padding', 'paddle' ),
					'section'     => 'paddle_theme_header_logo_options',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 30,
						'step' => 1,
					),
				)
			)
		);

		// Header menu in uppercase.
		$wp_customize->add_setting(
			'paddle_menu_text_to_uppercase',
			array(
				'default'           => $this->defaults['paddle_menu_text_to_uppercase'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_menu_text_to_uppercase',
				array(
					'label'   => __( 'Uppercase Text', 'paddle' ),
					'section' => 'paddle_header_menu',
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
					'label'    => __( 'Menu Background Colour', 'paddle' ),
					'section'  => 'paddle_header_menu',
					'settings' => 'paddle_menu_bgcolor',
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
					'label'           => __( 'Menu background colour other than the default (#ffffff) is not recommended for Header Layout 5.', 'paddle' ),
					'description'     => esc_html__( 'If your upper menu items are more than 6 and you are using the Header Layout 5,  menu items will not be on the same line on medium screen. Please consider switching back to the default background menu color or minimize your menu items. REASONS: Background not looking good with menu more then 6 on medium screen, e.g, Ipad pro.', 'paddle' ),
					'section'         => 'paddle_header_menu',
					'active_callback' => 'paddle_check_theme_header_options',
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
					'label'    => __( 'Foreground Colour', 'paddle' ),
					'section'  => 'paddle_header_menu',
					'settings' => 'paddle_navlink_text_color',
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
					'label'   => __( 'Menu items alignment', 'paddle' ),
					//'description' => esc_html__( 'Align the menu items', 'paddle' ),
					'section' => 'paddle_header_menu',
					'choices' => array(
						'left'     => __( 'Left', 'paddle' ),
						'centered' => __( 'Centered', 'paddle' ),
						'right'    => __( 'Right', 'paddle' ),
						'justify'  => __( 'Justify', 'paddle' ),
					),
				)
			)
		);

		// Header Top Bar Switch.
		$wp_customize->add_setting(
			'enable_top_bar',
			array(
				'default'           => $this->defaults['enable_top_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'enable_top_bar',
				array(
					'label'   => __( 'Enable Top Bar', 'paddle' ),
					'section' => 'paddle_header_top_bar',
				)
			)
		);

		// Show / Hide topbar on mobile
		$wp_customize->add_setting(
			'enable_top_bar_on_mobile',
			array(
				'default'           => $this->defaults['enable_top_bar_on_mobile'],
				'transport'         => 'postMessage',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'enable_top_bar_on_mobile',
				array(
					'label'           => __( 'Show on Small Device', 'paddle' ),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_is_top_header_active',
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
				'label'           => __( 'Phone number', 'paddle' ),
				'type'            => 'text',
				'section'         => 'paddle_header_top_bar',
				'active_callback' => 'paddle_is_top_header_active',
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
				'label'           => esc_html__( 'Email', 'paddle' ),
				'section'         => 'paddle_header_top_bar',
				'type'            => 'email',
				'active_callback' => 'paddle_is_top_header_active',
			)
		);

		// Topbar select option Social or Button
		$wp_customize->add_setting(
			'topbar_select',
			array(
				'default'           => $this->defaults['topbar_select'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'topbar_select',
				array(
					'label'           => __( 'Right Item', 'paddle' ),
					'section'         => 'paddle_header_top_bar',
					'type'            => 'select',
					'choices'         => array(
						'button' => __( 'Button', 'paddle' ),
						'social' => __( 'Social Links', 'paddle' ),
					),
					'active_callback' => 'paddle_is_top_header_active',
				)
			)
		);

		// Topbar button.
		$wp_customize->add_setting(
			'topbar_header_button_text',
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'topbar_header_button_text',
			array(
				'label'           => esc_html__( 'Text', 'paddle' ),
				'section'         => 'paddle_header_top_bar',
				'type'            => 'text',
				'input_attrs'     => array(
					'placeholder' => __( 'Enter Button Text...' ),
				),
				'active_callback' => 'paddle_top_header_select_button',
			)
		);

		$wp_customize->add_setting(
			'topbar_header_button_url',
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'topbar_header_button_url',
			array(
				'label'           => esc_html__( 'URL', 'paddle' ),
				'section'         => 'paddle_header_top_bar',
				'type'            => 'url',
				'input_attrs'     => array(
					'placeholder' => __( 'Enter Url e.g: http://example.com' ),
				),
				'active_callback' => 'paddle_top_header_select_button',
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
					'label'           => __( 'Social URLs', 'paddle' ),
					'description'     => esc_html__( 'Add your social media links.', 'paddle' ),
					'section'         => 'paddle_header_top_bar',
					'button_labels'   => array(
						'add' => __( 'Add Social Link', 'paddle' ),
					),
					'active_callback' => 'paddle_top_header_select_social',
				)
			)
		);

		// Icon Background Bar Switch.
		$wp_customize->add_setting(
			'enable_icon_bg',
			array(
				'default'           => $this->defaults['enable_icon_bg'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'enable_icon_bg',
				array(
					'label'           => __( 'Social Icon Background', 'paddle' ),
					'section'         => 'paddle_header_top_bar',
					'active_callback' => 'paddle_top_header_select_social',
				)
			)
		);

		/*
		---------------------------------------------------------------------------------------*/
		// Footer settings.

		// Show Logo.
		$wp_customize->add_setting(
			'paddle_footer_logo',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_footer_logo',
				array(
					'label' => __('Footer Logo', 'paddle'),
					'description'   => __( 'Show your logo in footer. Logo appears before the footer widget area.', 'paddle' ),
					'section' => 'paddle_footer_settings',
				)
			)
		);

		// Privacy Policy.
		$wp_customize->add_setting(
			'paddle_privacy_policy',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_privacy_policy',
				array(
					'label' => __('Privacy Policy', 'paddle'),
					'description'   => __( 'If the Privacy policy page is detected, the link will be added to the footer.', 'paddle' ),
					'section' => 'paddle_footer_settings',
				)
			)
		);

		// Footer social URL switch.
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
					'label' => __('Footer Social URLs', 'paddle'),
					'section' => 'paddle_footer_settings',
				)
			)
		);

		// Footer Social media URLs
		$wp_customize->add_setting(
			'footer_social_urls',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_url_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Sortable_Repeater_Control(
				$wp_customize,
				'footer_social_urls',
				array(
					'label'           => __( 'Social URLs', 'paddle' ),
					'description'     => esc_html__( 'Add your social media links.', 'paddle' ),
					'section'         => 'paddle_footer_settings',
					'button_labels'   => array(
						'add' => __( 'Add Social Link', 'paddle' ),
					),
					'active_callback' => 'paddle_footer_select_social',
				)
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
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_theme_credit',
				array(
					'label' => __('Theme Credit', 'paddle'),
					'section' => 'paddle_footer_settings',
				)
			)
		);
		
		/*
		---------------------------------------------------------------------------------------*/
		// Hero & Banner.

		// Menu items alignment.
		$wp_customize->add_setting(
			'header_media_select',
			array(
				'default'           => 'hero',
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'header_media_select',
				array(
					'label'   => __( 'Hero / Slider', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
					'choices' => array(
						'hero'     => __( 'Hero', 'paddle' ),
						'slider'   => __( 'Slider', 'paddle' ),
						'none'     => __( 'None', 'paddle' ),
					)
				)
			)
		);

		// Banner Cropped Image Control
		$wp_customize->add_setting( 'hero_image',
			array(
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'hero_image',
			array(
				'label' => __( 'Upload Hero Image', 'paddle' ),
				'section' => 'paddle_hero_and_slider',
				'active_callback' => 'header_media_selected_hero',
				'flex_width' => true,
				'flex_height' => true,
				'width' => 1920,
				'height' => 822
			)
		) );

		// Slider source
		$wp_customize->add_setting(
			'paddle_slider_source',
			array(
				'default'           => 'latest-post',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_source',
			array(
				'type'            => 'radio',
				'section'         => 'paddle_hero_and_slider',
				'label'           => esc_html__( 'Slider source', 'paddle' ),
				'description'     => esc_html( 'Select posts to display' ),
				'active_callback' => 'header_media_selected_slider',
				'choices'         => array(
					'latest-post' => esc_html( 'Latest posts' ),
					'post-ids'    => esc_html( 'Posts by Id' ),
					'page'        => esc_html( 'Post from page' ),
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
				'label'           => __( 'Enter post IDs separated by commas', 'paddle' ),
				'description'     => __( 'Enter 3 post ids, each post ID should be separated by commas.', 'paddle' ),
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
				'label'           => __( 'Set slider page 1', 'paddle' ),
				'description'     => __( 'Select a page from the dropdown below.', 'paddle' ),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'dropdown-pages',
				'active_callback' => 'paddle_slider_source_from_page_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_page2',
			array(
				'label'           => __( 'Set slider page 2', 'paddle' ),
				'description'     => __( 'Select a page from the dropdown below.', 'paddle' ),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'dropdown-pages',
				'active_callback' => 'paddle_slider_source_from_page_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_page3',
			array(
				'label'           => __( 'Set slider page 3', 'paddle' ),
				'description'     => __( 'Select a page from the dropdown below.', 'paddle' ),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'dropdown-pages',
				'active_callback' => 'paddle_slider_source_from_page_active',
			)
		);

		// Slider, use custom link and button
		$wp_customize->add_setting(
			'paddle_slider_custom_url',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_slider_custom_url',
				array(
					'label' => __('Use custom link and button', 'paddle'),
					'section' => 'paddle_hero_and_slider',
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
				'label'           => __( 'Button 1', 'paddle' ),
				'description'     => __( 'Enter text for the slide button 1', 'paddle' ),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'text',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_text2',
			array(
				'label'           => __( 'Button 2', 'paddle' ),
				'description'     => __( 'Enter text for the slide button 2', 'paddle' ),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'text',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_text3',
			array(
				'label'           => __( 'Button 3', 'paddle' ),
				'description'     => __( 'Enter text for the slide button 3', 'paddle' ),
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
				'label'           => __( 'URL 1', 'paddle' ),
				'description'     => __( 'Enter link for slide 1', 'paddle' ),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'url',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_url2',
			array(
				'label'           => __( 'URL 2', 'paddle' ),
				'description'     => __( 'Enter link for slide 2', 'paddle' ),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'url',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);

		$wp_customize->add_control(
			'paddle_slider_button_url3',
			array(
				'label'           => __( 'URL 3', 'paddle' ),
				'description'     => __( 'Enter link for slide 3', 'paddle' ),
				'section'         => 'paddle_hero_and_slider',
				'type'            => 'url',
				'active_callback' => 'paddle_banner_custom_link_active',
			)
		);


		// Adjust height
		$wp_customize->add_setting(
			'header_media_height',
			array(
				'default'           => 60,
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'header_media_height',
				array(
					'label'       => __( 'Height', 'paddle' ),
					'section'     => 'paddle_hero_and_slider',
					'input_attrs' => array(
						'min'  => 20,
						'max'  => 100,
						'step' => 10,
					),
				)
			)
		);
		
		// Overlay Opacity
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
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'banner_overlay_opacity',
				array(
					'label'       => __( 'Image Overlay', 'paddle' ),
					'description' => __( 'Adjust the image overlay opacity', 'paddle'),
					'section'     => 'paddle_hero_and_slider',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 9,
						'step' => 1,
					),
				)
			)
		);

		// Align Media Header content.
		$wp_customize->add_setting(
			'banner_align_position',
			array(
				'default'           => 'left',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'paddle_radio_sanitization',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'banner_align_position',
				array(
					'label'   => __( 'Content Align', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
					'choices' => array(
						'left'   => __( 'Left', 'paddle' ),
						'none'   => __( 'Center', 'paddle' ),
						'right'     => __( 'Right', 'paddle' )
					)
				)
			)
		);

		// Hero Text color.
		$wp_customize->add_setting(
			'paddle_banner_header_color',
			array(
				'default'           => '#ffffff',
				'transport'         => 'refresh',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'paddle_banner_header_color',
				array(
					'label'    => __( 'Text Color', 'paddle' ),
					'section'  => 'paddle_hero_and_slider',
					'settings' => 'paddle_banner_header_color',
				)
			)
		);

		// Enable background banner color .
		$wp_customize->add_setting(
			'paddle_enable_banner_bgcolor',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_enable_banner_bgcolor',
				array(
					'label' => __('Background Color', 'paddle'),
					'section' => 'paddle_hero_and_slider',
				)
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
					'label'           => __( 'Select Background Color', 'paddle' ),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'paddle_banner_header_bg_color',
					'active_callback' => 'paddle_banner_bgcolor_active',
				)
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
					'label'           => __( 'Background Opacity', 'paddle' ),
					'section'         => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_banner_bgcolor_active',
					'input_attrs'     => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					)
				)
			)
		);
	

		// Banner border radius .
		$wp_customize->add_setting(
			'paddle_banner_border_radius',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_banner_border_radius',
				array(
					'label' => __('Border Radius', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_banner_bgcolor_active',
				)
			)
		);

		// Box Shadow
		$wp_customize->add_setting(
			'paddle_banner_box_shadow',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_banner_box_shadow',
				array(
					'label' => __('Border Box Shadow', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_banner_bgcolor_active',
				)
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
					'section'  => 'paddle_hero_and_slider',
					'settings' => 'header_banner_title',
					'type'     => 'text',
					'active_callback' => 'header_media_selected_hero',
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
					'section'  => 'paddle_hero_and_slider',
					'settings' => 'header_banner_description',
					'type'     => 'text',
					'active_callback' => 'header_media_selected_hero',
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
					'section'  => 'paddle_hero_and_slider',
					'settings' => 'header_banner_button_1',
					'type'     => 'text',
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
					'label'    => __( 'Button 1 URL Link', 'paddle' ),
					'section'  => 'paddle_hero_and_slider',
					'settings' => 'header_banner_button_1_link',
					'type'     => 'url',
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
					'label'    => __( 'Button 2 Label', 'paddle' ),
					'section'  => 'paddle_hero_and_slider',
					'settings' => 'header_banner_button_2',
					'type'     => 'text',
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
					'label'    => __( 'Button 2 URL Link', 'paddle' ),
					'section'  => 'paddle_hero_and_slider',
					'settings' => 'header_banner_button_2_link',
					'type'     => 'url',
					'active_callback' => 'header_media_selected_hero',
				)
			)
		);

		// Arrow Button
		$wp_customize->add_setting(
			'banner_arrow_button',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'banner_arrow_button',
				array(
					'label' => __('Arrow Button', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_banner_bgcolor_active',
				)
			)
		);
				
		// Enable content over banner image .
		$wp_customize->add_setting(
			'paddle_enable_content_over_banner',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);


		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_enable_content_over_banner',
				array(
					'description' => __( 'If the banner covers the button, try increase the height of the banner for better result.', 'paddle' ),
					'label' => __('Shift Content Up', 'paddle'),
					'section' => 'paddle_hero_and_slider',
					'active_callback' => 'paddle_banner_bgcolor_active',
				)
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
						'panel'       => 'paddle_theme_option_panel',
			)
		);

		// Page width.
		$wp_customize->add_setting(
			'paddle_page_layout_width',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_page_layout_width',
			array(
				'label'    => __( 'Full Width', 'paddle' ),
				'section'  => 'paddle_page_layout_options',
				'type'     => 'checkbox',

			)
		);

		// Sidebar option.
		$wp_customize->add_setting(
			'paddle_page_layout_sidebar',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_page_layout_sidebar',
			array(
				'label'           => __( 'Enable Sidebar', 'paddle' ),
				'section'         => 'paddle_page_layout_options',
				'type'            => 'checkbox',
				'active_callback' => 'paddle_is_fullwidth_active',

			)
		);

		// Select Sidebar option
		$wp_customize->add_setting(
			'paddle_sidebar_position',
			array(
				'default'           => 'right-sidebar',
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);
		$wp_customize->add_control(
			'paddle_sidebar_position',
			array(
				'label'           => esc_html__( 'Change the sidebar position', 'paddle' ),
				'description'     => __( 'The default sidebar postion is right. You can choose to show left sidebar only on Woocommerce pages.', 'paddle' ),
				'section'         => 'paddle_page_layout_options',
				'type'            => 'select',
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
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		if ( class_exists( 'WooCommerce' ) ) {
			$wp_customize->add_control(
				'paddle_remove_woo_single_sidebar',
				array(
					'label'    => __( 'Remove Sidebar on Woocommerce Single Product Pages', 'paddle' ),
					'section'  => 'paddle_page_layout_options',
					'type'     => 'checkbox',
				)
			);
		}
		


	}

	/**
	 * Register default controls
	 */
	public function paddle_register_theme_default_controls( $wp_customize ) {

		// Primary Color Control
		$wp_customize->add_setting(
			'paddle_primary_color',
			array(
				'default'           => $this->defaults['paddle_primary_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_primary_color',
			array(
				'label'   => __( 'Primary Color', 'paddle' ),
				'section' => 'colors',
				'type'    => 'color',
			)
		);


		/*
		---------------------------------------------------------------------------------------*/
		// Post and category layout section
		
		// Toggle layout.
		$wp_customize->add_setting(
			'archive_layout',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			'archive_layout',
			array(
				'label'       => __( 'Toggle Layout (Grid / List)', 'paddle' ),
				'section'     => ( 'paddle_category_options' ),
				'type'        => 'checkbox',
				'description' => __( 'Toggle post layout for category page, achieve page, tag page. This layout also applies to homepage.', 'paddle' ),
			)
		);

		// Hide meta
		$wp_customize->add_setting(
			'hide_archive_meta',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			'hide_archive_meta',
			array(
				'label'       => __( 'Hide Footer Meta', 'paddle' ),
				'section'     => ( 'paddle_category_options' ),
				'type'        => 'checkbox',
				'description' => __( 'Hide tag and category links on category page and achieve page.', 'paddle' ),
			)
		);

		// Enable the author bio.
		$wp_customize->add_setting(
			'paddle_enable_author_bio',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_enable_author_bio',
			array(
				'label'    => __( 'Enable author link info', 'paddle' ),
				'description' => __( 'Hide or show author link in single post after the title', 'paddle' ),
				'section'  => 'paddle_category_options',
				'type'     => 'checkbox',
			)
		);


	

		
		/* // Use for secondary color
		// Secondary Color Control
		$wp_customize->add_setting(
			'paddle_secondary_color',
			array(
				'default'           => $this->defaults['paddle_secondary_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			'paddle_secondary_color',
			array(
				'label'           => __( 'Secondary Color', 'paddle' ),
				'priority'        => 30,
				'section'         => 'colors',
				'type'            => 'color',
				'active_callback' => 'paddle_check_active_control_enable_secondary_color',
			)
		);
		*/
	}
}


/**
 * Load all our Customizer Custom Controls
 */
require_once trailingslashit( dirname( __FILE__ ) ) . 'custom-controls.php';

/**
 * Initialise our Customizer settings
 */
$paddle_settings = new paddle_initialise_customizer_settings();
