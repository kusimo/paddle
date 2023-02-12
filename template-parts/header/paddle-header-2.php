<?php 
// Header 2
 $paddle_menu    = new PaddleMenu();
 $has_woocommerce = $paddle_menu->hasWooCommerce();
 ?> 


     <div class="site-branding">
         <div class="container">
             <div class="brand-wrap d-flex justify-content-between<?php echo $paddle_menu->hasWooCommerce() ? ' has-woocommerce' : ''; ?>">

                 <div class="site-logo header-content-left">
                     <?php
                     $paddle_menu->logo();
                     $paddle_menu->site_title();
                     $paddle_menu->site_description();
                     ?>
                 </div><!-- .logo-branging -->

                 <div class="header-content-2nd d-flex flex-row">

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

     <nav id="main-header-navigation" class="nav-primary" data-header-style="2" data-nav="<?php echo esc_attr(paddle_get_default_header_number($paddle_menu->current_header()));?>" role="navigation">
         <?php

         $paddle_menu::getMenu();

         ?>
     </nav><!-- #site-navigation -->