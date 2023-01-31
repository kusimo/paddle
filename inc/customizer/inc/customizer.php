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
				'priority' => 50,
				'title'    => __( 'Theme Options', 'paddle' ),
			)
		);

		$wp_customize->add_panel(
			'paddle_theme_global_option',
			array(
				'priority' => 20,
				'title'    => __( 'Global (Paddle)', 'paddle' ),
			)
		);

		$wp_customize->add_panel(
			'paddle_theme_blog_option',
			array(
				'priority' => 20,
				'title'    => __( 'Blog (Paddle)', 'paddle' ),
			)
		);
	}


	
	/**
	 * Register the theme section
	 */
	public function paddle_add_theme_sections( $wp_customize ) {

		/**
		 * Typography Panel/Section
		 */
		$wp_customize->add_section(
			'paddle_theme_typography_section',
			array(
				'name'               => 'section-typography',
				'type'               => 'section',
				'title'              => __( 'Typography', 'paddle' ),
				'priority'           => 15,
				'description_hidden' => true,
				'panel'              => 'paddle_theme_global_option',
				'description' 		 => 'Use this section to change font style.'
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
				'title'              => __( 'Colors', 'paddle' ),
				'priority'           => 16,
				'description_hidden' => true,
				'panel'              => 'paddle_theme_global_option'
			)
		);

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
			'paddle_post_and_pages',
			array(
				'title'      => __( 'Blog / Achieve', 'paddle' ),
				'capability' => 'edit_theme_options',
				'panel'      => 'paddle_theme_blog_option',
			)
		);

		$wp_customize->add_section(
			'paddle_bootstrap',
			array(
				'title'      => __( 'Bootstrap Option', 'paddle' ),
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
	public function paddle_register_theme_custom_controls( $wp_customize ) {
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
                    'label'       => __( 'Presets', 'paddle' ),
                    'section'     => 'paddle_theme_typography_section',
                    'choices'     => array(
                        'system-font'         => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-left.jpg',
                            'name'  => __( "'System Font', sans-serif", 'paddle' ),
                        ),
                        'roboto'       => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-center.jpg',
                            'name'  => __( "'Roboto', sans-serif", 'paddle' ),
                        ),
						'open-sans'        => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-right.jpg',
                            'name'  => __( "'Open Sans', sans-serif", 'paddle' ),
                        ),
                        'lato'  => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-left-search.jpg',
                            'name'  => __( "'Lato', sans-serif", 'paddle' ),
                        ),
                        'montserrat' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-2.jpg',
                            'name'  => __( "'Montserrat', sans-serif", 'paddle' ),
                        ),
                        'raleway' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-2.jpg',
                            'name'  => __( "'Raleway', sans-serif", 'paddle' ),
                        ),
						'source-sans-pro'  => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-right.jpg',
                            'name'  => __( "'Source Sans Pro', sans-serif", 'paddle' ),
                        ),
						'poppins'        => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-1-logo-right.jpg',
                            'name'  => __( "'Poppins', sans-serif", 'paddle' ),
                        ),
                    ),
                )
            )
        ); 

		/**
		 * Google Font
		 */
		$wp_customize->add_setting( 'paddle_font_message',
			array(
				'default' => $this->defaults['paddle_font_message'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization'
			)
		);
		$wp_customize->add_control( new Paddle_Simple_Notice_Custom_control( $wp_customize, 'paddle_font_message',
			array(
				'label' => __( 'Use your own google font', 'paddle' ),
				'description' => __( 'To use other Google Fonts, paste the font in the textarea below. See list of available Google fonts. <a href="https://fonts.google.com/" target="_blank">Google Fonts</a>.', 'paddle' ),
				'section' => 'paddle_theme_typography_section'
			)
		) );

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
                    'label'       => __( 'Font size', 'paddle' ),
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
                    'label'       => __( 'H1 font size', 'paddle' ),
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
					'label'   => __( 'H1 font weight', 'paddle' ),
					'section' => 'paddle_theme_typography_section',
					'choices' => array(
						'100'       => __( 'Thin 100', 'paddle' ),
						'200'       => __( 'Extra Light 200', 'paddle' ),
						'300'       => __( 'Light 300', 'paddle' ),
						'400'       => __( 'Regular 400', 'paddle' ),
						'500'       => __( 'Medium 500', 'paddle' ),
						'600'       => __( 'Semi-Bold 600', 'paddle' ),
						'700'       => __( 'Bold 700', 'paddle' ),
						'800'       => __( 'Extra-Bold 800', 'paddle' ),
						'900'       => __( 'Ultra-Bold 900', 'paddle' ),
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
                    'label'       => __( 'H2 font size', 'paddle' ),
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
					'label'   => __( 'H2 font weight', 'paddle' ),
					'section' => 'paddle_theme_typography_section',
					'choices' => array(
						'100'       => __( 'Thin 100', 'paddle' ),
						'200'       => __( 'Extra Light 200', 'paddle' ),
						'300'       => __( 'Light 300', 'paddle' ),
						'400'       => __( 'Regular 400', 'paddle' ),
						'500'       => __( 'Medium 500', 'paddle' ),
						'600'       => __( 'Semi-Bold 600', 'paddle' ),
						'700'       => __( 'Bold 700', 'paddle' ),
						'800'       => __( 'Extra-Bold 800', 'paddle' ),
						'900'       => __( 'Ultra-Bold 900', 'paddle' ),
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
                    'label'       => __( 'H3 font size', 'paddle' ),
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
                    'label'       => __( 'H4 font size', 'paddle' ),
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
                    'label'       => __( 'H5 font size', 'paddle' ),
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
                    'label'       => __( 'H6 font size', 'paddle' ),
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
                    'label'       => __( 'Margin bottom', 'paddle' ),
                    'section'     => 'paddle_theme_typography_section',
                    'input_attrs' => array(
                        'min'  => 14,
                        'max'  => 160,
                        'step' => 1,
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
						'logo-left-style-3' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/header-layout-style-2.jpg',
							'name'  => __( 'Logo Left & Menu Right', 'paddle' ),
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

		$wp_customize->add_setting(
			'paddle_header_cta_position',
			array(
				'default'           => $this->defaults['paddle_header_cta_position'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_header_cta_position',
				array(
					'label'    => __( 'Position (CTA) Right?', 'paddle' ),
					'priority' => 30,
					'section'  => 'paddle_theme_header_buttons_options',
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
					'label'       => __( 'Padding Left', 'paddle' ),
					'description' => __( 'CTA padding Left'),
					'section'     => 'paddle_theme_header_buttons_options',
					'priority' => 30,
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 50,
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
				'label'           => esc_html__( 'CTA URL', 'paddle' ),
				'section'         => 'paddle_theme_header_buttons_options',
				'type'            => 'url',
				'priority'        => 40,
				'input_attrs'     => array(
					'style'       => 'border: 2px solid #e6e6e6',
					'placeholder' => __( 'Enter URL Link...', 'paddle' ),
				),
				'active_callback' => 'paddle_check_active_control_paddle_header_cta',
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
				'label'           => esc_html__( 'CTA Text', 'paddle' ),
				'section'         => 'paddle_theme_header_buttons_options',
				'type'            => 'text',
				'priority'        => 50,
				'input_attrs'     => array(
					'style'       => 'border: 2px solid #e6e6e6',
					'placeholder' => __( 'Enter Text...', 'paddle' ),
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
					return get_theme_mod( 'paddle_header_cta_text', $this->defaults['paddle_header_cta_text'] );
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
					'description' => __( 'Size and Padding'),
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
					'label'   => __( 'Logo alignment', 'paddle' ),
					'section' => 'paddle_theme_header_logo_options',
					'choices' => array(
						'self-start'     => __( 'Left', 'paddle' ),
						'center' => __( 'Center', 'paddle' ),
						'end'    => __( 'Right', 'paddle' ),
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
					'label'       => __( 'Top and Bottom Padding', 'paddle' ),
					'section'     => 'paddle_header_menu',
					'input_attrs' => array(
						'min'  => 1,
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
					'label'       => __( 'Menu Item Margin', 'paddle' ),
					'section'     => 'paddle_header_menu',
					'input_attrs' => array(
						'min'  => 1,
						'max'  => 30,
						'step' => 1,
					),
				)
			)
		);

		// Header menu border top.
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
					'label'   => __( 'Border Top', 'paddle' ),
					'section' => 'paddle_header_menu',
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
				'default'           =>  $this->defaults['topbar_header_button_text'],
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
					'placeholder' => __( 'Enter Button Text...', 'paddle' ),
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
					'placeholder' => __( 'Enter Url e.g: http://example.com', 'paddle' ),
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
				'default'           => $this->defaults['paddle_footer_logo'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_footer_logo',
				array(
					'label'       => __( 'Footer Logo', 'paddle' ),
					'description' => __( 'Show your logo in footer. Logo appears before the footer widget area. MUST have at least 1 footer widget for this to show.', 'paddle' ),
					'section'     => 'paddle_footer_settings',
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
					'label'       => __( 'Privacy Policy', 'paddle' ),
					'description' => __( 'If the Privacy policy page is detected, the link will be added to the footer.', 'paddle' ),
					'section'     => 'paddle_footer_settings',
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
					'label'   => __( 'Footer Social URLs', 'paddle' ),
					'section' => 'paddle_footer_settings',
				)
			)
		);

		// Footer Social media URLs
		$wp_customize->add_setting(
			'footer_social_urls',
			array(
				'default'           =>  $this->defaults['footer_social_urls'],
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
				'sanitize_callback' => 'wp_kses_post'
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

		$wp_customize->selective_refresh->add_partial( 'footer_copyright_text', array(
			'selector' => '.site-footer .site-info .footer-copyrights',
			'render_callback' => 'paddle_get_default_footer_copyright',
		) );

		//@Todo: add JS partial refresh to copyright

		// Footer credit.
		$wp_customize->add_setting(
			'paddle_theme_credit',
			array(
				'default'           =>  $this->defaults['paddle_theme_credit'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_theme_credit',
				array(
					'label'   => __( 'Theme Credit', 'paddle' ),
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
				'default'           =>  $this->defaults['header_media_select'],
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
						'hero'   => __( 'Hero', 'paddle' ),
						'slider' => __( 'Slider', 'paddle' ),
						'none'   => __( 'None', 'paddle' ),
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
					'label'   => __( 'Use default banner image', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
					'description' => 'Use default background image if no image selected.'
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
					'label'           => __( 'Upload Hero Image', 'paddle' ),
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
				'default'           => $this->defaults['paddle_slider_custom_url'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_slider_custom_url',
				array(
					'label'           => __( 'Use custom link and button', 'paddle' ),
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
					'label'       => __( 'Banner Height', 'paddle' ),
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
					'label'       => __( 'Image Overlay', 'paddle' ),
					'description' => __( 'Adjust the image overlay opacity', 'paddle' ),
					'section'     => 'paddle_hero_and_slider',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 9,
						'step' => 1,
					),
				)
			)
		);

		// Align Media Header content container.
		$wp_customize->add_setting(
			'banner_align_position',
			array(
				'default'           => $this->defaults['banner_align_position'],
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
					'label'   => __( 'Content Container Align', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
					'choices' => array(
						'left'  => __( 'Left', 'paddle' ),
						'none'  => __( 'Center', 'paddle' ),
						'right' => __( 'Right', 'paddle' ),
					),
				)
			)
		);

		// Align Media Header content.
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
					'label'   => __( 'Content Align', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
					'choices' => array(
						'left'  => __( 'Left', 'paddle' ),
						'center'  => __( 'Center', 'paddle' ),
						'right' => __( 'Right', 'paddle' ),
					),
				)
			)
		);

		// Hero Text color.
		$wp_customize->add_setting(
			'paddle_banner_header_color',
			array(
				'default'           => $this->defaults['paddle_banner_header_color'],
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
				'default'           => $this->defaults['paddle_enable_banner_bgcolor'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_enable_banner_bgcolor',
				array(
					'label'   => __( 'Background Color', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
				)
			)
		);

		// Banner header background color.
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
					'label'           => __( 'Border Radius', 'paddle' ),
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
					'label'           => __( 'Border Box Shadow', 'paddle' ),
					'section'         => 'paddle_hero_and_slider',
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
					'label'           => __( 'Banner Title', 'paddle' ),
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
				'default'           => __( 'Let\'s improve the way you see business.', 'paddle' ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_banner_description',
				array(
					'label'           => __( 'Banner description', 'paddle' ),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'header_banner_description',
					'type'            => 'text',
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
					'label'           => __( 'Button 1 Label', 'paddle' ),
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
					'label'           => __( 'Button 1 URL Link', 'paddle' ),
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
					'label'           => __( 'Button 2 Label', 'paddle' ),
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
					'label'           => __( 'Button 2 URL Link', 'paddle' ),
					'section'         => 'paddle_hero_and_slider',
					'settings'        => 'header_banner_button_2_link',
					'type'            => 'url',
					'active_callback' => 'header_media_selected_hero',
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
					'label'   => __( 'Button Position', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
					'choices' => array(
						'left'   => __( 'Left', 'paddle' ),
						'center' => __( 'Center', 'paddle' ),
						'right'  => __( 'Right', 'paddle' ),
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
					'label'   => __( 'Text Transform', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
					'choices' => array(
						'uppercase'   => __( 'Uppercase', 'paddle' ),
						'capitalize' => __( 'Capitalize', 'paddle' ),
						'none'  => __( 'None', 'paddle' ),
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
					'label'   => __( 'Arrow Button', 'paddle' ),
					'section' => 'paddle_hero_and_slider',
				)
			)
		);

		// Enable content over banner image .
		$wp_customize->add_setting(
			'paddle_enable_content_over_banner',
			array(
				'default'           => $this->defaults['paddle_enable_content_over_banner'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_enable_content_over_banner',
				array(
					'description'     => __( 'This will move the content up close to the banner. It can be adjusted below.', 'paddle' ),
					'label'           => __( 'Shift Content Up', 'paddle' ),
					'section'         => 'paddle_hero_and_slider',
					'active_callback' => 'header_media_selected_hero',
				)
			)
		);

		// Adjust content over banner position
		$wp_customize->add_setting(
			'content_over_banner_position',
			array(
				'default'           => $this->defaults['content_over_banner_position'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'paddle_range_sanitization',
			)
		);
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control(
				$wp_customize,
				'content_over_banner_position',
				array(
					'description' => __( 'If the banner covers the button, try increase or decrease the position of the content for better result.', 'paddle' ),
					'label'       => __( 'Adjust content over banner position', 'paddle' ),
					'section'     => 'paddle_hero_and_slider',
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 200,
						'step' => 1,
					),
				)
			)
		);

		/*
		---------------------------------------------------------------------------------------*/

		// Page Layout.

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
					'label'       => __( 'General', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
					'type'        => 'select',
					'choices'     => array(
						'general' => __( 'General', 'paddle' ),
						'design' => __( 'Design', 'paddle' ),
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
					'label'   => __( 'Container Layout', 'paddle' ),
					'section' => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_general_archive_selected',
					'choices' => array(
						'left-sidebar'  => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/sidebar-left.png',
							'name'  => __( 'Left Sidebar', 'paddle' ),
						),
						'no-sidebar'    => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/sidebar-none.png',
							'name'  => __( 'No Sidebar', 'paddle' ),
						),
						'right-sidebar' => array(
							'image' => trailingslashit( get_template_directory_uri() ) . 'inc/customizer/images/sidebar-right.png',
							'name'  => __( 'Right Sidebar', 'paddle' ),
						),
					),
				)
			)
		);

		// Toggle between the Default content width and custom container
		$wp_customize->add_setting(
			'custom_container',
			array(
				'default'           => $this->defaults['custom_container'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Option_Buttons_Control(
				$wp_customize,
				'custom_container',
				array(
					'label'       => __( 'Content Width', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_general_archive_selected',
					'type'        => 'select',
					'choices'     => array(
						'default' => __( 'Default', 'paddle' ),
						'custom' => __( 'Custom', 'paddle' ),
					),
				)
			)
		);

		// Container width
		$wp_customize->add_setting( 
			'paddle_theme_content_width', 
			array(
				'default'           =>  $this->defaults['paddle_theme_content_width'],
				'sanitize_callback' => 'absint'
			) 
			);
			
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control( 
				$wp_customize,
				'paddle_theme_content_width',
				array(
					'section'	      => 'paddle_post_and_pages',
					'label'		      => __( 'Custom Width', 'paddle' ),
					'active_callback' => 'paddle_blog_general_archive_selected_custom_width_enabled',
					'input_attrs'	  => array(
						'min' 	=> 300,
						'max' 	=> 1900,
						'step'	=> 100,
					)                 
				)
			)
		);

		// Header
		$wp_customize->add_setting( 'paddle_blog_section_header_1',
			array(
				'transport' => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization'
			)
		);

		$wp_customize->add_control( new Paddle_Simple_Header_Title_Control( $wp_customize, 'paddle_blog_section_header_1',
			array(
				'label' => __( 'Post Structure', 'paddle' ),
				'section' => 'paddle_post_and_pages',
				'active_callback' => 'paddle_blog_general_archive_selected',
			)
		) );

			
		// Remove sidebar from single product page.
		$wp_customize->add_setting(
			'paddle_remove_woo_single_sidebar',
			array(
				'default'           => $this->defaults['paddle_remove_woo_single_sidebar'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		if ( class_exists( 'WooCommerce' ) ) {

			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control(
					$wp_customize,
					'paddle_remove_woo_single_sidebar',
					array(
						'label'   => __( 'WooCommerce Product Sidebar', 'paddle' ),
						'section' => 'paddle_post_and_pages',
					)
				)
			);
		}

		// Featured Image
		$wp_customize->add_setting(
			'enable_blog_featured_image',
			array(
				'default'           => $this->defaults['enable_blog_featured_image'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'enable_blog_featured_image',
				array(
					'label'       => __( 'Featured Image', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);


		// Header for meta
		$wp_customize->add_setting( 'paddle_blog_section_header_2',
			array(
				'transport' => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization'
			)
		);

		$wp_customize->add_control( new Paddle_Simple_Header_Title_Control_2( $wp_customize, 'paddle_blog_section_header_2',
			array(
				'label' => __( 'Meta', 'paddle' ),
				'section' => 'paddle_post_and_pages',
				'active_callback' => 'paddle_blog_general_archive_selected',
			)
		) );


		// Enable the author bio archive post.
		$wp_customize->add_setting(
			'paddle_enable_archive_author_bio',
			array(
				'default'           => $this->defaults['paddle_enable_archive_author_bio'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control_2(
				$wp_customize,
				'paddle_enable_archive_author_bio',
				array(
					'label'       => __( 'Author', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
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
					'label'       => __( 'Category', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
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
					'label'       => __( 'Comment', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
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
					'label'       => __( 'Publish Date', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
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
					'label'       => __( 'Tag', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_general_archive_selected',
				)
			)
		);


		// Header for meta
		$wp_customize->add_setting( 'paddle_blog_section_header_3',
			array(
				'transport' => 'postMessage',
				'sanitize_callback' => 'paddle_text_sanitization'
			)
		);

		$wp_customize->add_control( new Paddle_Simple_Header_Title_Control_2( $wp_customize, 'paddle_blog_section_header_3',
			array(
				'label' => __( 'Post Content', 'paddle' ),
				'section' => 'paddle_post_and_pages',
				'active_callback' => 'paddle_blog_general_archive_selected',
			)
		) );

			/** Blog Excerpt */
			$wp_customize->add_setting( 
				'enable_blog_excerpt', 
				array(
					'default'           =>  $this->defaults['enable_blog_excerpt'],
					'sanitize_callback' => 'paddle_switch_sanitization',
				) 
			);
			
			$wp_customize->add_control(
				new Paddle_Toggle_Switch_Custom_control_2( 
					$wp_customize,
					'enable_blog_excerpt',
					array(
						'section'     => 'paddle_post_and_pages',
						'label'	      => __( 'Excerpt', 'paddle' ),
						'active_callback' => 'paddle_blog_general_archive_selected',
					)
				)
			);
	
			// Excerpt Length.
			$wp_customize->add_setting( 
			'excerpt_length', 
			array(
				'default'           =>  $this->defaults['excerpt_length'],
				'sanitize_callback' => 'absint'
			) 
			);
			
			$wp_customize->add_control(
				new Paddle_Slider_Custom_Control( 
					$wp_customize,
					'excerpt_length',
					array(
						'section'	  => 'paddle_post_and_pages',
						'label'		  => __( 'Excerpt Length', 'paddle' ),
						'active_callback' => 'paddle_blog_general_archive_selected_excerpt_enabled',
						'input_attrs'	  => array(
							'min' 	=> 10,
							'max' 	=> 100,
							'step'	=> 5,
						)                 
					)
				)
			);
			
			// Read More Text.
			$wp_customize->add_setting(
				'read_more_text',
				array(
					'default'           => __( 'Continue reading', 'paddle' ),
					'sanitize_callback' => 'sanitize_text_field'
				)
			);
			
			$wp_customize->add_control(
				'read_more_text',
				array(
					'type'    => 'text',
					'section' => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_general_archive_selected_excerpt_enabled',
					'label'   => __( 'Read More Text', 'paddle' ),
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
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'post_archive_layout',
				array(
					'label'       => __( 'Blog Archive Layout', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
					'type'        => 'select',
					'active_callback' => 'paddle_blog_design_archive_selected',
					'description' => __( 'Toggle post layout for category page, achieve page, tag page. This layout also applies to homepage.', 'paddle' ),
					'choices'     => array(
						'grid' => __( 'Grid', 'paddle' ),
						'list' => __( 'List', 'paddle' ),
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
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_grid_columns',
				array(
					'label'           => __( 'Achieve Columns', 'paddle' ),
					'section'         => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected',
					'type'            => 'select',
					'active_callback' => 'paddle_blog_design_archive_selected_grid_selected',
					'choices'         => array(
						'2-columns' => __( '2 Columns', 'paddle' ),
						'3-columns' => __( '3 Columns', 'paddle' ),
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
					'label'           => __( 'Image before site title', 'paddle' ),
					'section'         => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected_grid_selected',
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
					'label'       => __( 'Author', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected',
				)
			)
		);

		// Image before site title.
		$wp_customize->add_setting(
			'enable_same_height_image',
			array(
				'default'           => $this->defaults['enable_same_height_image'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'enable_same_height_image',
				array(
					'label'           => __( 'Same Height Image (Grid)', 'paddle' ),
					'section'         => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected_grid_selected',
				)
			)
		);

		// Full width image .
		$wp_customize->add_setting(
			'paddle_expand_grid_image',
			array(
				'default'           => $this->defaults['paddle_expand_grid_image'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_expand_grid_image',
				array(
					'label'           => __( 'Expand Grid Image', 'paddle' ),
					'section'         => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected_grid_selected',
				)
			)
		);

		// Placeholder image.
		$wp_customize->add_setting(
			'paddle_placeholder_image',
			array(
				'default'           => $this->defaults['paddle_placeholder_image'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_placeholder_image',
				array(
					'label'           => __( 'Use placeholder image', 'paddle' ),
					'section'         => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected_grid_selected',
				)
			)
		);

		// Hide meta
		$wp_customize->add_setting(
			'hide_archive_meta',
			array(
				'default'           => $this->defaults['hide_archive_meta'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'hide_archive_meta',
				array(
					'label'       => __( 'Hide Footer Meta', 'paddle' ),
					'section'     => ( 'paddle_post_and_pages' ),
					'active_callback' => 'paddle_blog_design_archive_selected',
					'description' => __( 'Hide tag and category links on category page and achieve page.', 'paddle' ),
				)
			)
		);

		// Solid line before h1 and h2
		/* Removed function.
		$wp_customize->add_setting(
			'paddle_title_headings_solid_lines',
			array(
				'default'           => $this->defaults['paddle_title_headings_solid_lines'],
				'sanitize_callback' => 'paddle_switch_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Toggle_Switch_Custom_control(
				$wp_customize,
				'paddle_title_headings_solid_lines',
				array(
					'label'       => __( 'Solid Line Before Title', 'paddle' ),
					'description' => __( 'Add solid line before header 1 and header 2 (h1 and h2)', 'paddle' ),
					'section'     => 'paddle_post_and_pages',
				)
			)
		);
		*/

		// H1 Font Alignment
		$wp_customize->add_setting(
			'paddle_h1_alignment',
			array(
				'default'           => $this->defaults['paddle_h1_alignment'],
				'sanitize_callback' => 'paddle_radio_sanitization',
			)
		);

		$wp_customize->add_control(
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_h1_alignment',
				array(
					'label'   => __( 'Page / Post Title Header, Meta & Description', 'paddle' ),
					'section' => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected',
					'type'    => 'select',
					'choices' => array(
						'left'   => __( 'Left', 'paddle' ),
						'center' => __( 'Center', 'paddle' ),
					),
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
					'label'           => __( 'Post Featured Image Size', 'paddle' ),
					'section'         => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected',
					'type'            => 'select',
					'choices'         => array(
						'paddle-small-thumb' => __( '480 x 360', 'paddle' ),
						'paddle-square-image' => __( '600 x 600', 'paddle' ),
						'paddle-horizontal-image' => __( '760 x 400', 'paddle' ),
						'paddle-medium-image' => __( '800 x 600', 'paddle' ),
						'paddle-with-sidebar-image' => __( '1020 x 600', 'paddle' ),
						'paddle-featured-image' => __( '1410 x 600', 'paddle' ),
						'paddle-large-image' => __( '1320 x 990', 'paddle' ),
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
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_thumbnail_alignment',
				array(
					'label'   => __( 'Post thumbnail position', 'paddle' ),
					'section' => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected',
					'type'    => 'select',
					'choices' => array(
						'left'   => __( 'Left', 'paddle' ),
						'center' => __( 'Center', 'paddle' ),
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
			new Paddle_Text_Radio_Button_Custom_Control(
				$wp_customize,
				'paddle_caption_width',
				array(
					'label'           => __( 'Image caption width', 'paddle' ),
					'section'         => 'paddle_post_and_pages',
					'active_callback' => 'paddle_blog_design_archive_selected',
					'type'            => 'select',
					'choices'         => array(
						'inherit' => __( 'Full' ),
						'fit-content' => __( 'Fit' ),
					),
				)
			)
		);

		// Site Title Font Size.
		$wp_customize->add_setting( 
			'site_title_font_size', 
			array(
				'default'           => $this->defaults['site_title_font_size'],
				'sanitize_callback' => 'absint'
			) 
		);
		
		$wp_customize->add_control(
			new Paddle_Slider_Custom_Control( 
				$wp_customize,
				'site_title_font_size',
				array(
					'section'	  => 'title_tagline',
					'label'		  => __( 'Site Title Font Size', 'paddle' ),
					'description' => __( 'Change the font size of your site title.', 'paddle' ),
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
					'label'           => __( 'Use full boostrap CSS', 'paddle' ),
					'section'         => 'paddle_bootstrap',
					'description' 	  => __( 'By default only part of bootstrap CSS are loaded, enable this to load all CSS. This may affect performance.', 'paddle' ),
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
					'label'           => __( 'Load bootstrap JavaScript', 'paddle' ),
					'section'         => 'paddle_bootstrap',
					'description' 	  => __( 'By default boostrap JavaScript is not loaded. If you need this, you can enable it here.', 'paddle' ),
				)
			)
		);



	}

	/**
	 * Register default controls
	 */
	public function paddle_register_theme_default_controls( $wp_customize ) {

		/**
		 * Theme color
		 */

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
				'label'   => __( 'Accent', 'paddle' ),
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
				'label'   => __( 'Body Text color', 'paddle' ),
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
				'label'   => __( 'Headings (H1-H6)', 'paddle' ),
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
				'label'   => __( 'Headings (H1-H6) Hover', 'paddle' ),
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
				'label'   => __( 'Buttons', 'paddle' ),
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
				'label'   => __( 'Buttons Hover', 'paddle' ),
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
				'label'   => __( 'Links', 'paddle' ),
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
				'label'   => __( 'Links Hover', 'paddle' ),
				'section' => 'paddle_theme_color_section',
				'type'    => 'color',
			)
		);

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
