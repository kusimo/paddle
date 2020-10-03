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
		) );

		$wp_customize->add_control(
			'paddle_header_search_button', array(
				'type'		=> 'checkbox',
				'section'	=> 'paddle_theme_header_options',
				'label'		=> __('Show the header search button icon'),
				'priority'          => 0,
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
				'label'             => esc_html__( 'Display menu item in uppercase', 'paddle' ),
				'section'           => 'paddle_theme_header_options',
				'type'              => 'checkbox',
				'priority'          => 1,
			)
		);

		// Call to action button.
		$wp_customize->add_setting(
			'paddle_header_cta',
			array(
				'default'           => 1,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(
			'paddle_header_cta',
			array(
				'label'             => esc_html__( 'Enable CTA button in the header', 'paddle' ),
				'section'           => 'paddle_theme_header_options',
				'type'              => 'checkbox',
				'priority'          => 2,
			)
		);

		// Setting CTA URL.
		$wp_customize->add_setting(
			'paddle_header_cta_url',
			array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'paddle_header_cta_url',
			array(
				'label'           => esc_html__( 'CTA Link URL', 'paddle' ),
				'section'         => 'paddle_theme_header_options',
				'type'            => 'url',
				'priority'        => 3,
				'active_callback' => function() {
					return get_theme_mod( 'paddle_header_cta', 1 );
				},
			)
		);

		// Setting CTA Text.
		$wp_customize->add_setting(
			'paddle_header_cta_text',
			array(

				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'paddle_header_cta_text',
			array(
				'label'           => esc_html__( 'CTA button text', 'paddle' ),
				'section'         => 'paddle_theme_header_options',
				'type'            => 'text',
				'priority'        => 4,
				'active_callback' => function() {
					return get_theme_mod( 'paddle_header_cta', 1 );
				},
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'paddle_header_cta_text',
			array(
				'selector'        => '#header-btn-cta a.btn',
				'render_callback' => function() {
					return get_theme_mod( 'paddle_header_cta_text' );
				},
			) 
		);


		/* Theme page layout section */
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
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);
		
		$wp_customize->add_control(
			'paddle_page_layout_width', 
			array(
				'label'             => __( 'Full Width', 'paddle' ),
				'section'           => 'paddle_page_layout_options',
				'type'              => 'checkbox',
				'priority'          => 1,
			
			)
		);

        //Sidebar option.
		$wp_customize->add_setting(
			'paddle_page_layout_sidebar',
			array(
				'default'           => 0,
				'sanitize_callback' => 'paddle_checkbox_sanitization',
			)
		);
		
		$wp_customize->add_control(
			'paddle_page_layout_sidebar', 
			array(
				'label'             => __( 'Right Sidebar', 'paddle' ),
				'description'       => __( 'Show widget sidebar on the right. The default is bottom after post', 'paddle' ),
				'section'           => 'paddle_page_layout_options',
				'type'              => 'checkbox',
				'priority'          => 2,
				'active_callback'   => 'paddle_is_fullwidth_active',
			
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
					'label'     => __( 'Primary Color', 'paddle' ),
					'section'   => 'colors',
					'settings'  => 'paddle_primary_color',
				)
			)
        );

        /* Theme Featured image section */
		$wp_customize->add_section(
			'paddle_featured_image_options',
			array(
				'title'       => __( 'Featured Image', 'paddle' ),
				'capability'  => 'edit_theme_options',
				'priority'    => 20,
				'panel'       => 'paddle_theme_option_panel',
			)
		);
        
        // Featured Image.
        $wp_customize->add_setting(
			'paddle_featured_image_style',
			array(
				'default'           => 'slim-full-width',
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
					'label'       => __( 'Full Width Featured Image Style', 'paddle' ),
					'section'     => 'paddle_featured_image_options',
					'settings'    => 'paddle_featured_image_style',
					'type'        => 'select',
					'choices'     => array(
						'slim-full-width'       => __( 'Slim Full Width', 'paddle' ),
						'hero-full-width'       => __( 'Hero Full Width', 'paddle' ),
						'classic'				=> __( 'Classic', 'paddle'),
					),
                    'priority'    => '1',
                    'active_callback'   => 'paddle_is_sidebar_right_active',
				)
			)
		);
		
		// Category and achieve option
		$wp_customize->add_section(
			'paddle_category_options',
			array(
				'title'       => __( 'Category Page', 'paddle' ),
				'capability'  => 'edit_theme_options',
				'priority'    => 30,
				'panel'       => 'paddle_theme_option_panel',
			)
		);

		// Toggle layout.
		$wp_customize->add_setting( 
			'archive_layout',
			array(
				'default'				=> 1,
				'sanitize_callback'		=> 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(	
			'archive_layout',
			array(
				'label'			=>	__( 'Toggle Layout' ),
				'section'		=>	('paddle_category_options'),
				'type'			=> 	'checkbox',
				'description'			=> __( 'Toggle layout for category page, achieve page or tag page' ),
			)
		);

		// Hide meta
		$wp_customize->add_setting( 
			'hide_archive_meta',
			array(
				'default'				=> 0,
				'sanitize_callback'		=> 'paddle_checkbox_sanitization',
			)
		);

		$wp_customize->add_control(	
			'hide_archive_meta',
			array(
				'label'			=>	__( 'Hide Meta' ),
				'section'		=>	('paddle_category_options'),
				'type'			=> 	'checkbox',
				'description'			=> __( 'Hide tag and category links' ),
			)
		);
        
        //Enable the author bio.
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
				'label'             => __( 'Enable author link info', 'paddle' ),
				'section'           => 'paddle_featured_image_options',
				'type'              => 'checkbox',
				'priority'          => 2,
			
			)
		);

		/** Banner */

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
					'label'             => __( 'Select The Banner Image Opacity Overlay Level', 'paddle' ),
					'section'           => 'header_image',
					'settings'          => 'banner_overlay_opacity',
					'type'              => 'select',
					'choices'           => array(
						'9' => __( 9, 'paddle' ),
						'8'  => __( 8, 'paddle' ),						
						'7'  => __( 7, 'paddle' ),
						'6' => __( 6, 'paddle' ),
						'5'  => __( 5, 'paddle' ),						
						'4'  => __( 4, 'paddle' ),
						'3' => __( 3, 'paddle' ),
						'2'  => __( 2, 'paddle' ),						
						'1'  => __( 1, 'paddle' ),
						'0'  => __( 0, 'paddle' ),
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
							'label'             => __( 'Select Alignment', 'paddle' ),
							'section'           => 'header_image',
							'settings'          => 'banner_align_position',
							'type'              => 'select',
							'choices'           => array(
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
						'label'     => __( 'Banner Text Color', 'paddle' ),
						'section'   => 'header_image',
						'settings'  => 'paddle_banner_header_color',
					)
				)
			);
	
			// Enable background banner color .
			$wp_customize->add_setting(
				'paddle_enable_banner_bgcolor',
				array(
					'default'           => 0,
					'sanitize_callback' => 'paddle_checkbox_sanitization',
			) );
	
			$wp_customize->add_control(
				'paddle_enable_banner_bgcolor', array(
					'type'		=> 'checkbox',
					'section'	=> 'header_image',
					'label'		=> __('Enable background color for banner text area'),
				)
			);
	
			
			// Banner header background color.
			$wp_customize->add_setting(
				'paddle_banner_header_bg_color',
				array(
					'default'           =>  '#3e3c3c',
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
						'label'     => __( 'Banner Text Area Background Color', 'paddle' ),
						'section'   => 'header_image',
						'settings'  => 'paddle_banner_header_bg_color',
						'active_callback' => 'paddle_banner_bgcolor_active',
					)
				)
			);
				


		// Banner title.
		$wp_customize->add_setting( 'header_banner_title', array(
			'default' => __(	'Build Your Dream Website with Paddle', 'paddle'	),
			'sanitize_callback' => 'sanitize_text_field',

			) 
		);
		$wp_customize->add_control(	new WP_Customize_Control(	$wp_customize, 'header_banner_title', array(
			'label' => __('Banner Title', 'paddle'),
			'section' => 'header_image',
			'settings' => 'header_banner_title',
			'type' => 'text'

			)	)
		);

		// Banner description.
		$wp_customize->add_setting(	'header_banner_description', array(
			'default' => __( 'Let\'s improve the way you see business.', 'paddle' ),
			'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_banner_description', array(
			'label' => __( 'Banner description', 'paddle' ),
			'section' => 'header_image',
			'settings' => 'header_banner_description',
			'type' => 'text'
			))
		);

		// Banner Button 1.
		$wp_customize->add_setting(	'header_banner_button_1', array(
			'default' => __( 'Learn More', 'paddle' ),
			'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_banner_button_1', array(
			'label' => __( 'Button 1 Label', 'paddle' ),
			'section' => 'header_image',
			'settings' => 'header_banner_button_1',
			'type' => 'text'
			) )
		);

			// Banner Button 1 URL link.
			$wp_customize->add_setting( 'header_banner_button_1_link', array(
			'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_banner_button_1_link', array(
			'label' => __('Button 1 URL Link', 'paddle'),
			'section' => 'header_image',
			'settings' => 'header_banner_button_1_link',
			'type' => 'url'
			) )
		);

		// Banner Button 2.
		$wp_customize->add_setting(	'header_banner_button_2', array(
			'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_banner_button_2', array(
			'label' => __( 'Button 2 Label', 'paddle' ),
			'section' => 'header_image',
			'settings' => 'header_banner_button_2',
			'type' => 'text'
			) )
		);

		// Banner Button 2 URL link.
		$wp_customize->add_setting( 'header_banner_button_2_link', array(
		'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_banner_button_2_link', array(
			'label' => __('Button 2 URL Link', 'paddle'),
			'section' => 'header_image',
			'settings' => 'header_banner_button_2_link',
			'type' => 'url'
			) ) 
		);


	// Footer settings.
	$wp_customize->add_section(
        'paddle_footer_settings',
        array (
            'priority'      => 50,
            'capability'    => 'edit_theme_options',
			'title'         => esc_html__( 'Footer Settings', 'paddle' ),
			'panel'       => 'paddle_theme_option_panel',
		),
    );


	// Copyright text.
    $wp_customize->add_setting(
        'paddle_footer_copyright_text',
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'wp_filter_nohtml_kses'
        )
    );

    $wp_customize->add_control(
        'paddle_footer_copyright_text',
        array(
            'settings'      => 'paddle_footer_copyright_text',
            'section'       => 'paddle_footer_settings',
            'type'          => 'textarea',
            'label'         => esc_html__( 'Footer Copyright Text', 'paddle' ),
            'description'   => esc_html__( 'Copyright text to be displayed in the footer. No HTML allowed.', 'paddle' )
        )
	); 
	
	// Footer credit.
	$wp_customize->add_setting(
		'paddle_theme_credit',
		array(
			'default'           => 1,
			'sanitize_callback' => 'paddle_checkbox_sanitization',
	) );

	$wp_customize->add_control(
		'paddle_theme_credit', array(
			'type'		=> 'checkbox',
			'section'	=> 'paddle_footer_settings',
			'label'		=> __('Show the theme credit in footer'),
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
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
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

if(!function_exists('paddle_intval')) {
    function paddle_intval( $value ) {
        return (int) $value;
    }
}

/**
 * Sanitization: html
 */

function paddle_sanitize_html( $input ) {


	$allowed = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array(),
			        'target' => array(),
			        'class' => array()
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'p' => array(
			        'class' => array()
			    )
			);

	return wp_kses( $input, $allowed );

}
