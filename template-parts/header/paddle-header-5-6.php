<?php 
 $paddle_menu    = new PaddleMenu();
 ?>
 <div class="container">
    <div id="header-style-2" class="d-flex justify-content-between align-items-center">
    <div class="site-branding header-content-left site-logo">
        <div class="site-branding-wrap">
            <?php  
            $paddle_menu->logo(); 
            $paddle_menu->site_title();
            $paddle_menu->site_description();
            ?>
        </div>
       
    </div>
    <?php

       // $paddle_menu::getMenu($paddle_menu->has_separated_cta() ? 'sep-header-cta' : '');
      // $paddle_menu->splitMenu(false);

    ?>
    <nav id="main-header-navigation" class="nav-primary" data-header-style="1-4" data-nav="1-4" role="navigation">
    <?php

    $paddle_menu::getMenu($paddle_menu->has_separated_cta() ? 'sep-header-cta' : '');

    ?>
    </nav><!-- #site-navigation -->

    <div class="toggler">
        <button aria-label="<?php echo esc_attr__('Open Menu', 'paddle'); ?>" class="open-dialog btn navbar-toggler navbar-toggler-right collapsed offcanvas-toggle pl-0">
            <span></span><span></span><span></span>
        </button>
    </div><!--.toggler-->

  
    <div class="<?php echo esc_attr( $paddle_menu->isSearchEnable() ? 'header-content-2nd': 'header-content-2nd no-search-button') ;?>">
        <?php
        paddle_search_layout();
        ?>
    </div><!-- .header-content-2nd-->

    <?php if ( $paddle_menu->hasWooCommerce() ) : ?>
        <div class="woo-header-utilities d-flex align-items-center">
            <?php paddle_woocommerce_user_account(); ?>
            <?php paddle_get_total_cart_item(); ?>
        </div>

    <?php endif; ?>
   
    </div><!--.header-style-2-container-->
 </div><!--.container-->