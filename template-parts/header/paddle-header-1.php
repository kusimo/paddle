<?php 
 $paddle_menu    = new PaddleMenu();
 $has_woocommerce = $paddle_menu->hasWooCommerce();
 ?> 


     <div class="site-branding py-1">
         <div class="container">
             <div class="brand-wrap d-flex <?php echo is_bool( $paddle_menu->hasWooCommerce() ) ? 'justify-content-between has-woocommerce' : 'justify-content-between'; ?> ">

                 <div class="site-logo header-content-left">
                     <?php
                     $paddle_menu->logo();
                     $paddle_menu->site_title();
                     $paddle_menu->site_description();
                     ?>
                 </div><!-- .logo-branging -->

                 <div class="header-content-right d-flex flex-row">

                     <?php
                     if ( $paddle_menu->isSearchEnable() ) : // Header search button.
                         ?>
                         <div id="search-glass">
                            <button class="btn button-search" data-bs-toggle="modal" data-bs-target="#searchModal"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'paddle' ); ?></span>
                             </button>
                         </div>
                     <?php endif; ?>
                     <div class="toggler">
                         <button aria-label="<?php echo esc_attr__('Open Menu', 'paddle'); ?>" class="open-dialog btn navbar-toggler navbar-toggler-right collapsed offcanvas-toggle pl-0">
                             <span></span><span></span><span></span>
                         </button>
                     </div>
                 </div><!-- .header-content-right -->


                 <?php if ( $paddle_menu->hasWooCommerce() ) : ?>
                     <div class="woo-header-utilities d-flex align-items-center">
                         <?php paddle_woocommerce_user_account(); ?>
                         <?php paddle_get_total_cart_item(); ?>
                     </div>

                 <?php endif; ?>

             </div><!-- .brand-wrap -->
         </div><!-- .container.py-3 -->
     </div><!-- .site-branding -->

     <nav id="main-header-navigation" class="nav-primary" data-header-style="1" role="navigation">
         <?php

         $paddle_menu::getMenu();

         ?>
     </nav><!-- #site-navigation -->

 