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

	public static function getMenu($classes='') {
        self::$menu            = wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_class'      => 'primary-menu menu',
				'menu_id'         => 'primary-menu',
				'container'       => 'div', 
				'container_class' => 'container '.$classes, 
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
		return get_theme_mod( 'paddle_header_search_button', PADDLE_DEFAULT_OPTION['paddle_header_search_button'] );
	}

	public function searchType($platform='desktop') {
        $desktop_search = get_theme_mod( 'paddle_header_search_button_type', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type'] );
        $mobile_search = get_theme_mod( 'paddle_header_search_button_type_mobile', PADDLE_DEFAULT_OPTION['paddle_header_search_button_type_mobile'] );
        if('mobile' === $platform) {
            return $mobile_search;
        }
		return $desktop_search;
	}

    public function searchLayout($type) {
        $input_search = $this->isSearchEnable() 
        && 'input' === $this->searchType()
        && 'input' === $this->searchType('mobile');

        $icon_search = $this->isSearchEnable() 
        && 'icon' === $this->searchType()
        && 'icon' === $this->searchType('mobile');

        $multiple_search = false;
        if ( $input_search === false || $icon_search === false ){
            if($this->isSearchEnable()) {
                $multiple_search = true;
            }
                
        }

        if('input' === $type) {
            return $input_search;
        } elseif ('icon' === $type) {
            return $icon_search;
        } elseif ('both' === $type) {
            return $multiple_search;
        }

    }

	public function current_header() {
		return get_theme_mod( 'paddle_header_layout_style', PADDLE_DEFAULT_OPTION['paddle_header_layout_style'] );
	}

    // Has separated header CTA
    public function has_separated_cta() {
        $has_header_cta = absint( get_theme_mod( 'paddle_header_cta', PADDLE_DEFAULT_OPTION['paddle_header_cta'] ) );
	    $header_cta_separated = absint( get_theme_mod( 'cta_separated', PADDLE_DEFAULT_OPTION['cta_separated'] ) );
        if (1 === $has_header_cta && 1 === $header_cta_separated ) {
            return true;
        }
        return false;
    }

	/**
	 * Split menu
	 */

	 public function splitMenu($with_logo = true) {
        $message = '';
        $menu_list = '';
        $max_menu_item = 6;
        $total_menu = get_theme_mod('parent_menu_count');
		$menu_options = get_theme_mod('paddle_split_menu_options',  PADDLE_DEFAULT_OPTION['paddle_split_menu_options']);
        $header_number = 'paddle-header-6' === $this->current_header() ? '6' : '5-6';

        if ( 0  !== $total_menu  % 2 ) {
            $message .= 'Menu is not even';
        } 

            $theme_location  = 'primary';
            $theme_locations = get_nav_menu_locations();
            $counter         = 0;
        
        
            if ( is_array( $theme_locations ) ) {
                if ( isset( $theme_locations[ $theme_location ] ) ) {
                    $menu_obj    = get_term( $theme_locations[ $theme_location ], 'nav_menu' );
                    $menu_items = wp_get_nav_menu_items( $menu_obj );

                    // NAV
                    $menu_list  .= '<nav id="main-header-navigation" class="nav-primary" data-header-style="'.$header_number.'" data-nav="'.$header_number.'" role="navigation">' ."\n";
                    $menu_list .= '<ul id="primary-menu" class="main-nav nav-inner">' ."\n";
                    $count = 0;
					$count_parent_menu = 0;
					$parent_menu_items = [];
                    $submenu = false;

					if ( is_array($menu_items) )
					foreach( $menu_items as $menu_item ) {
                        if ( !$menu_item->menu_item_parent ) {
                            if(count($parent_menu_items) < $max_menu_item)
							array_push( $parent_menu_items, $menu_item->ID );
						}
					}

					if ( count($parent_menu_items)> 0 )
                    foreach( $menu_items as $menu_item ) {
 
                        $link = $menu_item->url;
                        $title = $menu_item->title;

                        $has_child = '';

            
                        
                        if ( !$menu_item->menu_item_parent ) {
                            $parent_id = $menu_item->ID;
							$count_parent_menu++;
							
                            
                            if($count_parent_menu <= $max_menu_item) :

                              
                            $menu_list .= '<li class="item upper-menu-item header-link">' ."\n";
                            $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
                            endif;
                            $counter++;
							

                            // Insert Logo
                            if ( $with_logo && $counter == round((count($parent_menu_items)) / 2) )  {
                                $menu_list .= '<li class="nav-logo"><div class="site-branding header-content-left site-logo"><div class="site-branding-wrap">';
                                if (has_custom_logo()) {
                                    $menu_list .= $this->htmlLogo();
                                } else {
                                    $menu_list .= '<a class="site-title" href="'.esc_url( home_url( "/" ) ).'" rel="home">'.get_bloginfo("name").'</a>';
                                }
                                
                                $menu_list .='</div></div></li>';
                            }

                            // CTA Button
                            if (count($parent_menu_items)  === $counter) {
                                $menu_list .= $this->calltoActionButton();
                            }
							
                        }
                        /* @todo add SUB MENU support - wp_get_nav_menu_items
            
                        if ( $parent_id == $menu_item->menu_item_parent ) {
							// Check if the max menu is reached
                            if($count_parent_menu <= $max_menu_item) :
            
                                if ( !$submenu ) {
                                    $submenu = true;
                                    ob_start(); ?>
                                    <button class="toggle submenu-expand" data-toggle-target="sub-menu" aria-expanded="false">
                                        <span class="screen-reader-text">Show sub menu</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M11.9932649,19.500812 C11.3580307,19.501631 10.7532316,19.2174209 10.3334249,18.720812 L0.91486487,7.56881201 C0.295732764,6.80022105 0.378869031,5.6573388 1.10211237,4.99470263 C1.82535571,4.33206645 2.92415989,4.39205385 3.57694487,5.12981201 L11.8127849,14.881812 C11.8583553,14.9359668 11.9241311,14.9670212 11.9932649,14.9670212 C12.0623986,14.9670212 12.1281745,14.9359668 12.1737449,14.881812 L20.4095849,5.12981201 C20.8230992,4.61647509 21.4710943,4.37671194 22.1028228,4.50330101 C22.7345513,4.62989008 23.2509019,5.10297096 23.4520682,5.73948081 C23.6532345,6.37599067 23.5076557,7.07606812 23.0716649,7.56881201 L13.6559849,18.716812 C13.2354593,19.214623 12.6298404,19.5001823 11.9932649,19.500812 Z" />
                                        </svg>
                                    </button>
                                    <?php
                                    
                                    $menu_list .=  ob_get_clean();
                                    
                                    $menu_list .= '<ul class="sub-menu">' ."\n";
                                }
                
                                $menu_list .= '<li class="item">' ."\n";
                                $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
                                $menu_list .= '</li>' ."\n";
                                    
                
                                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                                    $menu_list .= '</ul>' ."\n";
                                    $submenu = false;
                                }
                            endif;
							
                        }
                        */
                        
                        if($count_parent_menu <= $max_menu_item) :
                        if( count( $menu_items ) !== count( $menu_items) ) {
                            
                            if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                                $menu_list .= '</li>' ."\n";      
                                $submenu = false;
                            }
                        }
                    endif;
                    
            
                        $count++;
                    }
                    
                    $menu_list .= '</ul>' ."\n";
                    $menu_list .= '</nav>' ."\n";

                
                } else {
                    $menu_list = '<!-- no menu defined in location"'.$theme_location.'"-->';
                }
            }
            
            echo wp_kses( $menu_list, $this->allowedHtml() );
       
    }

    private function allowedHtml() {
        $allowed_html = array(
            'nav' => array(
                'id' => array(),
                'class' => array(),
                'role' => array(),
                'data-header-style' => array(),
				'data-nav' => array(),
            ),
            'ul' => array(
                'class' => array(),
                'id' => array(),
            ),
            'li' => array(
                'id' => array(),
                'class' => array(),
            ),
            'div' => array(
                'id' => array(),
                'class' => array(),
            ),
			'button' => array(
				'id' => array(),
                'class' => array(),
			),
			'span' => array(
				'id' => array(),
                'class' => array(),
			),
            'img' => array(
                'src' => array(),
                'srcset' => array(),
                'id' => array(),
                'class' => array(),
                'alt' => array(),
                'height'      => array(),
			    'width'       => array(),
            ),
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
            'svg'   => array(
                'class'           => true,
                'aria-hidden'     => true,
                'aria-labelledby' => true,
                'role'            => true,
                'xmlns'           => true,
                'width'           => true,
                'height'          => true,
                'viewbox'         => true // <= Must be lower case!
            ),
            'g'     => array( 'fill' => true ),
            'title' => array( 'title' => true ),
            'path'  => array( 
                'd'               => true, 
                'fill'            => true  
            )
        );
        return $allowed_html;
    }

    private function htmlLogo() {
        $html = '';
        ob_start(); 
        $this->logo();
        $html = ob_get_contents();
        ob_end_clean();
        return $html;  
    }

    public function calltoActionButton() {
		$menu_options = get_theme_mod('paddle_split_menu_options',  PADDLE_DEFAULT_OPTION['paddle_split_menu_options']);
		
		$padding =  strpos($menu_options, 'padding') === false ? '' : ' no-padding';

		$items = '';

		if (strpos($menu_options, 'cta') !== false) {
			if ( 1 === absint( get_theme_mod( 'paddle_header_cta', 0 ) ) ) {
				$option_url  = get_theme_mod( 'paddle_header_cta_url', home_url() );
				$option_text = get_theme_mod( 'paddle_header_cta_text', ' CTA TEXT ' );
				$url         = esc_url( $option_url );
				if ( ! empty( $option_url ) && ! empty( $option_text ) ) {
					$items .= '<li id="header-btn-cta" class="menu-item d-flex justify-content-center align-items-center'.$padding.'">'
						. '<a href="' . $url . '" class="btn btn-primary btn-lg">' . esc_attr( $option_text ) . '</a>'
						. '</a>'
						. '</li>';
				}
			}
		}
       
        
        return $items;
    }

} // End Class
