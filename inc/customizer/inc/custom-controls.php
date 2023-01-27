<?php
/**
 * Paddle Customizer Custom Controls
 *
 */

use Paddle_Custom_Control as GlobalPaddle_Custom_Control;
use Paddle_Slider_Custom_Control as GlobalPaddle_Slider_Custom_Control;

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Custom Control Base Class
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Paddle_Custom_Control extends WP_Customize_Control {
		protected function get_paddle_resource_url() {
			return trailingslashit( get_template_directory_uri() );
		}
	}

	/**
	 * Custom Section Base Class
	 */
	class Paddle_Custom_Section extends WP_Customize_Section {
		protected function get_paddle_resource_url() {
			return trailingslashit( get_template_directory_uri() );
		}
	}

		/**
	 * Image Radio Button Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Paddle_Image_Radio_Button_Custom_Control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'image_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'inc/customizer/css/customizer.css', array(), '1.0.3', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="image_radio_button_control paddle-section-spacing">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="radio-button-label">
						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
					</label>
				<?php	} ?>
			</div>
			<?php
		}
	}

	/**
	 * Text Radio Button Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Paddle_Text_Radio_Button_Custom_Control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'text_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'inc/customizer/css/customizer.css', array(), '1.0.3', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="text_radio_button_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<div class="radio-buttons">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="radio-button-label">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<span><?php echo esc_html( $value ); ?></span>
						</label>
					<?php	} ?>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Option buttons Custom Control
	 */
	class Paddle_Option_Buttons_Control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'option_radio_button';

		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'inc/customizer/css/customizer.css', array(), '1.0.4', 'all' );
		}

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="text_radio_button_control option_radio_button_control">
				<label></label>
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<div class="input-wrapper paddle-control-wrapper option-radio-button">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="radio-button-label radio-button-option">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<span><?php echo esc_html( $value ); ?></span>
						</label>
					<?php	} ?>
				</div>

			</div>
			<?php
		}
	}


	/**
	 * Image Checkbox Custom Control
	 */
	class Paddle_Image_Checkbox_Custom_Control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'image_checkbox';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'inc/customizer/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="image_checkbox_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<?php	$chkboxValues = explode( ',', esc_attr( $this->value() ) ); ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-multi-image-checkbox" <?php $this->link(); ?> />
				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="checkbox-label">
						<input type="checkbox" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( in_array( esc_attr( $key ), $chkboxValues ), 1 ); ?> class="multi-image-checkbox"/>
						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
					</label>
				<?php	} ?>
			</div>
			<?php
		}
	}

	/**
	 * Slider Custom Control with Image
	 */
	class Paddle_Slider_Opacity_Control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'slider_control';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'paddle-custom-controls-js', $this->get_paddle_resource_url() . 'inc/customizer/js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.2.5', true );
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'inc/customizer/css/customizer.css', array(), '1.0.3', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<span class="opacity-image"></span>
				<input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
			</div>
			<?php
		}
	}


	/**
	 * Slider Custom Control
	 */
	class Paddle_Slider_Custom_Control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'slider_control';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'paddle-custom-controls-js', $this->get_paddle_resource_url() . 'inc/customizer/js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.2.3', true );
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'inc/customizer/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="slider-custom-control">
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="paddle-label customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
			</div>
			<?php
		}
	}

	/**
	 * Toggle Switch Custom Control
	 */
	class Paddle_Toggle_Switch_Custom_control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'toggle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'inc/customizer/css/customizer.css', array(), '1.1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" 
														  <?php
															$this->link();
															checked( $this->value() );
															?>
					>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}


	/**
	 * Simple Notice Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Paddle_Simple_Notice_Custom_Control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'simple_notice';
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			$allowed_html = array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'class' => array(),
					'target' => array(),
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				'i' => array(
					'class' => array()
				),
				'span' => array(
					'class' => array(),
				),
				'code' => array(),
			);
		?>
			<div class="simple-notice-custom-control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses( $this->description, $allowed_html ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}
	/**
	 * Upsell section
	 */
	class Paddle_Upsell_Section extends Paddle_Custom_Section {
		/**
		 * The type of control being rendered
		 */
		public $type = 'paddle-upsell';
		/**
		 * The Upsell URL
		 */
		public $url = '';
		/**
		 * The background color for the control
		 */
		public $backgroundcolor = '';
		/**
		 * The text color for the control
		 */
		public $textcolor = '';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'paddle-custom-controls-js', $this->get_paddle_resource_url() . 'inc/customizer/js/customizer.js', array( 'jquery' ), '1.2.1', true );
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'inc/customizer/css/customizer.css', array(), '1.0.3', 'all' );
		}
		/**
		 * Render the section, and the controls that have been added to it.
		 */
		protected function render() {
			$bkgrndcolor = ! empty( $this->backgroundcolor ) ? esc_attr( $this->backgroundcolor ) : '#fff';
			$color       = ! empty( $this->textcolor ) ? esc_attr( $this->textcolor ) : '#555d66';
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="paddle_upsell_section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="upsell-section-title" <?php echo ' style="color:' . esc_attr( $color ) . ';border-left-color:' . esc_attr( $bkgrndcolor ) . ';border-right-color:' . esc_attr( $bkgrndcolor ) . ';"'; ?>>
					<a href="<?php echo esc_url( $this->url ); ?>" target="_blank"<?php echo ' style="background-color:' . esc_attr( $bkgrndcolor ) . ';color:' . esc_attr( $color ) . ';"'; ?>><?php echo esc_html( $this->title ); ?></a>
				</h3>
			</li>
			<?php
		}
	}


		/**
	 * Sortable Repeater Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Paddle_Sortable_Repeater_Control extends Paddle_Custom_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'sortable_repeater';
		/**
		 * Button labels
		 */
		public $button_labels = array();
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Merge the passed button labels with our default labels
			$this->button_labels = wp_parse_args(
				$this->button_labels,
				array(
					'add' => __( 'Add', 'paddle' ),
				)
			);
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'paddle-custom-controls-js', $this->get_paddle_resource_url() . 'js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
			wp_enqueue_style( 'paddle-custom-controls-css', $this->get_paddle_resource_url() . 'css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
		  <div class="sortable_repeater_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-sortable-repeater" <?php $this->link(); ?> />
				<div class="sortable_repeater sortable">
					<div class="repeater">
						<input type="text" value="" class="repeater-input" placeholder="https://" /><span class="dashicons dashicons-sort"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a>
					</div>
				</div>
				<button class="button customize-control-sortable-repeater-add" type="button"><?php echo esc_html( $this->button_labels['add'] ); ?></button>
			</div>
			<?php
		}
	}
	/**
	 * URL sanitization
	 *
	 * @param  string   Input to be sanitized (either a string containing a single url or multiple, separated by commas)
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'paddle_url_sanitization' ) ) {
		function paddle_url_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false ) {
				$input = explode( ',', $input );
			}
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = esc_url_raw( $value );
				}
				$input = implode( ',', $input );
			} else {
				$input = esc_url_raw( $input );
			}
			return $input;
		}
	}

	/**
	 * Switch sanitization
	 *
	 * @param  string       Switch value
	 * @return integer  Sanitized value
	 */
	if ( ! function_exists( 'paddle_switch_sanitization' ) ) {
		function paddle_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	/**
	 * Radio Button and Select sanitization
	 *
	 * @param  string       Radio Button value
	 * @return integer  Sanitized value
	 */
	if ( ! function_exists( 'paddle_radio_sanitization' ) ) {
		function paddle_radio_sanitization( $input, $setting ) {
			//get the list of possible radio box or select options
			$choices = $setting->manager->get_control( $setting->id )->choices;

			if ( array_key_exists( $input, $choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}
	}

	/**
	 * Integer sanitization
	 *
	 * @param  string       Input value to check
	 * @return integer  Returned integer value
	 */
	if ( ! function_exists( 'paddle_sanitize_integer' ) ) {
		function paddle_sanitize_integer( $input ) {
			return (int) $input;
		}
	}

	/**
	 * Text sanitization
	 *
	 * @param  string   Input to be sanitized (either a string containing a single string or multiple, separated by commas)
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'paddle_text_sanitization' ) ) {
		function paddle_text_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false ) {
				$input = explode( ',', $input );
			}
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = sanitize_text_field( $value );
				}
				$input = implode( ',', $input );
			} else {
				$input = sanitize_text_field( $input );
			}
			return $input;
		}
	}

	/**
	 * Array sanitization
	 *
	 * @param  array    Input to be sanitized
	 * @return array    Sanitized input
	 */
	if ( ! function_exists( 'paddle_array_sanitization' ) ) {
		function paddle_array_sanitization( $input ) {
			if ( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[ $key ] = sanitize_text_field( $value );
				}
			} else {
				$input = '';
			}
			return $input;
		}
	}

	/**
	 * Only allow values between a certain minimum & maxmium range
	 *
	 * @param  number   Input to be sanitized
	 * @return number   Sanitized input
	 */
	if ( ! function_exists( 'paddle_in_range' ) ) {
		function paddle_in_range( $input, $min, $max ) {
			if ( $input < $min ) {
				$input = $min;
			}
			if ( $input > $max ) {
				$input = $max;
			}
			return $input;
		}
	}


	/**
	 * Slider sanitization
	 *
	 * @param  string   Slider value to be sanitized
	 * @return string   Sanitized input
	 */
	if ( ! function_exists( 'paddle_range_sanitization' ) ) {
		function paddle_range_sanitization( $input, $setting ) {
			$attrs = $setting->manager->get_control( $setting->id )->input_attrs;

			$min  = ( isset( $attrs['min'] ) ? $attrs['min'] : $input );
			$max  = ( isset( $attrs['max'] ) ? $attrs['max'] : $input );
			$step = ( isset( $attrs['step'] ) ? $attrs['step'] : 1 );

			$number = floor( $input / $attrs['step'] ) * $attrs['step'];

			return paddle_in_range( $number, $min, $max );
		}
	}

	if ( ! function_exists( 'paddle_check_active_control_enable_secondary_color' ) ) {

		/**
		 * Check if enable banner background color checkbox is active.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_check_active_control_enable_secondary_color( $control ) {

			if ( 1 === $control->manager->get_setting( 'enable_secondary_color' )->value() ) {
				return true;
			} else {
				return false;
			}
		}
	}

	if ( ! function_exists( 'paddle_check_active_control_paddle_header_cta' ) ) {

		/**
		 * Check if CTA button is active.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_check_active_control_paddle_header_cta( $control ) {

			if ( 1 === $control->manager->get_setting( 'paddle_header_cta' )->value() ) {
				return true;
			} else {
				return false;
			}
		}
	}

	if ( ! function_exists( 'paddle_check_theme_header_options' ) ) {

		/**
		 * Check the active header style.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_check_theme_header_options( $control ) {
			if ( 'logo-left-style-2' === $control->manager->get_setting( 'paddle_header_layout_style' )->value()
				&& '#ffffff' !== $control->manager->get_setting( 'paddle_menu_bgcolor' )->value()
				&& 1 === $control->manager->get_setting( 'paddle_header_cta' )->value()
				&& paddle_count_menu_items() > 5
				) {
				return true;
			} else {
				return false;
			}
		}
	}

	if ( ! function_exists( 'paddle_count_menu_items' ) ) {
		/**
		 * Count menu items
		 *
		 * @return Number
		 */
		function paddle_count_menu_items() {
			$theme_location  = 'primary';
			$theme_locations = get_nav_menu_locations();
			$counter         = 0;
			if ( is_array( $theme_locations ) ) {
				if ( isset( $theme_locations[ $theme_location ] ) ) {
					$menu_obj    = get_term( $theme_locations[ $theme_location ], 'nav_menu' );
					$dc_get_menu = wp_get_nav_menu_items( $menu_obj->name );

					if ( is_array( $dc_get_menu ) ) {
						foreach ( $dc_get_menu as $key => $menu_item ) {
							if ( $menu_item->menu_item_parent != 0 ) {
								continue;
							}
							$counter++;
						}
					}
				}
			}

			return $counter;
		}
	}

	if ( ! function_exists( 'paddle_is_top_header_active' ) ) :

		/**
		 * Check if featured slider is active.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_is_top_header_active( $control ) {

			if ( true == $control->manager->get_setting( 'enable_top_bar' )->value() ) {
				return true;
			} else {
				return false;
			}

		}

	endif;

	if ( ! function_exists( 'paddle_top_header_select_button' ) ) {
		/**
		 * Check the top header is active and button is selected
		 *
		 * @param  mixed $control
		 * @return void
		 */
		function paddle_top_header_select_button( $control ) {
			if ( true == $control->manager->get_setting( 'enable_top_bar' )->value()
			&& 'button' == $control->manager->get_setting( 'topbar_select' )->value()
			) {
				return true;
			} else {
				return false;
			}
		}
	}

	if ( ! function_exists( 'paddle_top_header_select_social' ) ) {
		/**
		 * Check the top header is active and social link is selected
		 *
		 * @param  mixed $control
		 * @return void
		 */
		function paddle_top_header_select_social( $control ) {
			if ( true == $control->manager->get_setting( 'enable_top_bar' )->value()
			&& 'social' == $control->manager->get_setting( 'topbar_select' )->value()
			) {
				return true;
			} else {
				return false;
			}
		}
	}

	if ( ! function_exists( 'paddle_footer_select_social' ) ) {
		/**
		 * Check the top header is active and social link is selected
		 *
		 * @param  mixed $control
		 * @return void
		 */
		function paddle_footer_select_social( $control ) {
			if ( true == $control->manager->get_setting( 'paddle_footer_social' )->value()
			) {
				return true;
			} else {
				return false;
			}
		}
	}

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

	if ( ! function_exists( 'header_media_selected_hero' ) ) :

		/**
		 * Check Hero is selected
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function header_media_selected_hero( $control ) {

			if ( 'hero' === $control->manager->get_setting( 'header_media_select' )->value() ) {
				return true;
			} else {
				return false;
			}
		}

	endif;

	if ( ! function_exists( 'header_media_selected_slider' ) ) :

		/**
		 * Check Slider is selected
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function header_media_selected_slider( $control ) {

			if ( 'slider' === $control->manager->get_setting( 'header_media_select' )->value() ) {
				return true;
			} else {
				return false;
			}
		}

	endif;

	if ( ! function_exists( 'paddle_slider_pid_active' ) ) :

		/**
		 * Check if user has selected source by ids.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_slider_pid_active( $control ) {

			if ( 'post-ids' === $control->manager->get_setting( 'paddle_slider_source' )->value()
				&& 'slider' === $control->manager->get_setting( 'header_media_select' )->value()
			) {
				return true;
			} else {
				return false;
			}
		}

	endif;

	if ( ! function_exists( 'paddle_slider_source_from_page_active' ) ) :

		/**
		 * Check if user has selected source from page for slider.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_slider_source_from_page_active( $control ) {

			if ( 'page' === $control->manager->get_setting( 'paddle_slider_source' )->value()
				&& 'slider' === $control->manager->get_setting( 'header_media_select' )->value()
				) {
				return true;
			} else {
				return false;
			}
		}

	endif;

	if ( ! function_exists( 'paddle_banner_custom_link_active' ) ) :

		/**
		 * Check if enable banner background color checkbox is active.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_banner_custom_link_active( $control ) {

			if ( 1 === $control->manager->get_setting( 'paddle_slider_custom_url' )->value()
			&& 'slider' === $control->manager->get_setting( 'header_media_select' )->value()
			) {
				return true;
			} else {
				return false;
			}
		}

	endif;

	if ( ! function_exists( 'paddle_is_fullwidth_active' ) ) :

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

	if ( ! function_exists( 'paddle_grid_selected' ) ) :

		/**
		 * Check grid layout is selected.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_grid_selected( $control ) {

			if ( 'grid' === $control->manager->get_setting( 'post_archive_layout' )->value() ) {
				return true;
			} else {
				return false;
			}
		}

	endif;

	if ( ! function_exists( 'paddle_custom_content_selected' ) ) :

		/**
		 * Check custom container is selected.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Control $control WP_Customize_Control instance.
		 *
		 * @return bool Whether the control is active to the current preview.
		 */
		function paddle_custom_content_selected( $control ) {

			if ( 'custom' === $control->manager->get_setting( 'custom_container' )->value() ) {
				return true;
			} else {
				return false;
			}
		}

	endif;

}
