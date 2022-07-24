<?php
class PaddleMenu {

	public static $menu;
	public $logo;
	public $tag             = true;
	public $hasSearchButton = false;
	public $ctaButton;
	public $ctaButtonText;
	public $siteTitle;
	public static $siteDescription;
	public $secondaryMenu;

	public function __construct() {
		self::$siteDescription = get_bloginfo( 'description', 'display' );
	}

	public static function getMenu() {
        self::$menu            = wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_class'      => 'primary-menu menu',
				'menu_id'         => 'primary-menu',
				'container'       => 'div', 
				'container_class' => 'container', 
				'add_li_class'    => 'nav-item',  // custom li css
				'echo'            =>  true
			)
		);
		return self::$menu; 
	}

	public function hasWooCommerce() {
		return class_exists( 'WooCommerce' );
	}

	public function logo() {
		$this->logo = the_custom_logo();
		return $this->logo;
	}

	public function site_title() {
		if ( is_front_page() || is_home() ) :
			?>
			<h1 class="site-title noline-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
		else :
			?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
		endif;
		?>

		<?php
	}

	public function site_description() {
		if ( self::$siteDescription || is_customize_preview() ) {
			?>
			<p class="site-description"><small>
					<?php
					echo self::$siteDescription; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
				</small></p>
			<?php
		}
	}

	public function isSearchEnable() {
		return get_theme_mod( 'paddle_header_search_button', 1 );
	}
} // End Class
