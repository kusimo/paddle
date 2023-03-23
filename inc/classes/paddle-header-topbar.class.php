<?php
class Paddle_Header_TopBar {
	private $contactNumber;
	public $contactUrl;
	public static $contactText;
	public static $active;
	public static $enable_on_mobile;
	public static $contact_email;
	public static $topbar_select;
	public static $menu;

	public function __construct() {
		$this->contactNumber    = get_theme_mod( 'paddle_contact_phone', '' );
		self::$contact_email    = get_theme_mod( 'paddle_top_email', '' );
		$this->contactUrl       = get_theme_mod( 'topbar_header_button_url', '' );
		self::$contactText      = get_theme_mod( 'topbar_header_button_text', PADDLE_DEFAULT_OPTION['topbar_header_button_text'] );
		self::$active           = absint( get_theme_mod( 'enable_top_bar', PADDLE_DEFAULT_OPTION['enable_top_bar'] ) );
		self::$enable_on_mobile = absint( get_theme_mod( 'enable_top_bar_on_mobile', PADDLE_DEFAULT_OPTION['enable_top_bar_on_mobile'] ) );

		self::$topbar_select = get_theme_mod( 'topbar_select', PADDLE_DEFAULT_OPTION['topbar_select'] );

	}

	public static function get_menu() {
		
		if(!empty(self::$menu) && is_array(self::$menu)) {  ?>
		<ul class="ul-content d-flex list-inline m-0">
			<?php 
				foreach(self::$menu as $item) {
					$link = wp_make_link_relative($item->url);
					if (empty($link)) {
						$link = '/';
					}
					?>
					 <li class="list-inline-item"><a href="<?= $link ?>"><?= $item->title ?></a></li>
					<?php 
				}
			?>
		</ul>	
		<?php }
	}

	public static function have_menu() {

		$selected_menu = get_theme_mod( 'topbar_content_menu', PADDLE_DEFAULT_OPTION['topbar_content_menu'] );

		if( !empty($selected_menu) && '' !== $selected_menu) {
			$menu_args = wp_get_nav_menu_object( esc_attr($selected_menu) );
		
			self::$menu = wp_get_nav_menu_items($menu_args->term_id);
		}

		if(!empty(self::$menu) && is_array(self::$menu)) {
			return true;
		}
		return false;
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
