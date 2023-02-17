<?php

/**
 * Customizer Setup and Custom Controls For WooCommerce
 * WooCommerce Sections - 'woocommerce_store_notice', 'woocommerce_product_catalog', 'woocommerce_product_images', 'woocommerce_checkout'
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class paddle_initialise_customizer_settings_woo {

	// Get our default values
	private $defaults;

	public function __construct() {
		 // Get our Customizer defaults
		$this->defaults = paddle_generate_defaults();

        	// Register our sections
		add_action( 'customize_register', array( $this, 'paddle_woo_add_customizer_sections' ) );

        // Register our WooCommerce controls, only if WooCommerce is active
		if( paddle_is_woocommerce_active() ) {
			add_action( 'customize_register', array( $this, 'paddle_register_woocommerce_controls' ) );
		}

	}

    /**
	 * Register the Customizer sections
	 */
	public function paddle_woo_add_customizer_sections( $wp_customize ) {

		/**
		 * Add our WooCommerce Layout Section, only if WooCommerce is active
		 */
		$wp_customize->add_section( 'woocommerce_layout_section',
			array(
				'title' => __( 'WooCommerce Theme Options', 'paddle' ),
				'description' => esc_html__( 'Adjust the layout of your WooCommerce shop.', 'paddle' ),
				'active_callback' => 'paddle_is_woocommerce_active',
                'panel'    => 'woocommerce',
                'priority'           => 5,
				'description_hidden' => true,
				'description'        => 'This section added by the theme.',
			)
		);

	}

    	/**
	 * Register our WooCommerce Layout controls
	 */
	public function paddle_register_woocommerce_controls( $wp_customize ) {

		// Add our Checkbox switch setting and control for displaying a sidebar on the shop page
		$wp_customize->add_setting( 'woocommerce_shop_sidebar',
			array(
				'default' => $this->defaults['woocommerce_shop_sidebar'],
				'transport' => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Paddle_Toggle_Switch_Custom_control( $wp_customize, 'woocommerce_shop_sidebar',
			array(
				'label' => __( 'Shop page sidebar', 'paddle' ),
				'section' => 'woocommerce_layout_section'
			)
		) );

		// Add our Checkbox switch setting and control for displaying a sidebar on the single product page
		$wp_customize->add_setting( 'woocommerce_product_sidebar',
			array(
				'default' => $this->defaults['woocommerce_product_sidebar'],
				'transport' => 'refresh',
				'sanitize_callback' => 'paddle_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Paddle_Toggle_Switch_Custom_control( $wp_customize, 'woocommerce_product_sidebar',
			array(
				'label' => esc_html__( 'Single Product page sidebar', 'paddle' ),
				'section' => 'woocommerce_layout_section'
			)
		) );

	}
}

/**
 * Initialise our Customizer settings
 */
$paddle_woo_control_settings = new paddle_initialise_customizer_settings_woo();


