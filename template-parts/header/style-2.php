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
    <nav id="main-header-navigation" class="nav-primary" data-header-style="1" role="navigation">
    <?php

    $paddle_menu::getMenu();

    ?>
    </nav><!-- #site-navigation -->

    <?php if ( $paddle_menu->hasWooCommerce() ) : ?>
        <div class="woo-header-utilities d-flex align-items-center">
            <?php paddle_woocommerce_user_account(); ?>
            <?php paddle_get_total_cart_item(); ?>
        </div>

    <?php endif; ?>
    <div class="<?php echo esc_attr( $paddle_menu->isSearchEnable() ? 'header-content-right': 'header-content-right no-search-button') ;?>">
    <?php
    if ( $paddle_menu->isSearchEnable() ) : // Header search button.
        ?>
        <div id="search-glass"><button class="btn button-search" data-bs-toggle="modal" data-bs-target="#searchModal"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'paddle' ); ?></span>
        </div>
            </button>
    <?php endif; ?>

    <div class="toggler">
        <button aria-label="<?php echo esc_attr__('Open Menu', 'paddle'); ?>" class="open-dialog btn navbar-toggler navbar-toggler-right collapsed offcanvas-toggle pl-0">
            <span></span><span></span><span></span>
        </button>
    </div><!--.toggler-->
    </div><!-- .header-content-right-->
    </div><!--.header-style-2-->
 </div><!--.container-->


