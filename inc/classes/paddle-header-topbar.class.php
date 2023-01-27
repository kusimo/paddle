<?php
class Paddle_Header_TopBar {
	private $contactNumber;
	public $contactUrl;
	public static $contactText;
	public static $active;
	public static $enable_on_mobile;
	public static $contact_email;
	public static $topbar_select;

	public function __construct() {
		$this->contactNumber    = get_theme_mod( 'paddle_contact_phone', '' );
        self::$contact_email    = get_theme_mod( 'paddle_top_email', '' );
        $this->contactUrl       = get_theme_mod( 'topbar_header_button_url', '' );
		self::$contactText   = get_theme_mod( 'topbar_header_button_text', PADDLE_DEFAULT_OPTION['topbar_header_button_text'] );
		self::$active           = absint( get_theme_mod( 'enable_top_bar', PADDLE_DEFAULT_OPTION['enable_top_bar'] ) );
		self::$enable_on_mobile = absint( get_theme_mod( 'enable_top_bar_on_mobile', PADDLE_DEFAULT_OPTION['enable_top_bar_on_mobile'] ) );

		self::$topbar_select    = get_theme_mod( 'topbar_select', PADDLE_DEFAULT_OPTION['topbar_select'] );

	}

	public function get_contact_number() {
		if ( '' !== $this->contactNumber && isset( $this->contactNumber ) ) {
			return $this->contactNumber;
		}
		return '';
	}

	public function get_contact_email() {
		if ( '' !== self::$contact_email && isset( self::$contact_email ) ) {
			return self::$contact_email;
		}
		return '';
	}

	public function is_left_panel_active() {
		if ( $this->get_contact_email() || $this->get_contact_number() ) {
			return true;
		}
		return false;
	}

}
