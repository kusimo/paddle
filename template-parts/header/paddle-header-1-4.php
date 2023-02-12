<?php
// Header 1-4
$paddle_menu    = new PaddleMenu();
$has_woocommerce = $paddle_menu->hasWooCommerce();
?>


<div class="site-branding">
    <div class="container">
        <div class="brand-wrap d-flex justify-content-between<?php echo $paddle_menu->hasWooCommerce() ? ' has-woocommerce' : ''; ?>">

            <div class="toggler">
                <button aria-label="<?php echo esc_attr__('Open Menu', 'paddle'); ?>" class="open-dialog btn navbar-toggler navbar-toggler-right collapsed offcanvas-toggle pl-0">
                    <span></span><span></span><span></span>
                </button>
            </div>

            <div class="site-logo header-content-left">
                <?php
                $paddle_menu->logo();
                $paddle_menu->site_title();
                $paddle_menu->site_description();
                ?>
            </div><!-- .logo-branging -->

            <div class="header-content-2nd d-flex flex-row">

                <?php // Check the desktop search and mobile search are the same layout
                paddle_search_layout();
                ?>
            </div><!-- .header-content-right -->


            <?php if ($paddle_menu->hasWooCommerce()) : ?>
                <div class="woo-header-utilities d-flex align-items-center">
                    <?php paddle_woocommerce_user_account(); ?>
                    <?php paddle_get_total_cart_item(); ?>
                </div>

            <?php endif; ?>

        </div><!-- .brand-wrap -->
    </div><!-- .container.py-3 -->
</div><!-- .site-branding -->

<nav id="main-header-navigation" class="nav-primary" data-header-style="1-4" data-nav="1-4" role="navigation">
    <?php

    $paddle_menu::getMenu($paddle_menu->has_separated_cta() ? 'sep-header-cta' : '');

    ?>
</nav><!-- #site-navigation -->