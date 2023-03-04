<?php
 $paddle_menu = new PaddleMenu();
 $paddle_header_content_max_width   = absint( get_theme_mod( 'header_custom_container_width', PADDLE_DEFAULT_OPTION['header_custom_container_width'] ) );
?>
<div class="container<?php echo esc_attr(paddle_content_witdth_is_full_width($paddle_header_content_max_width)) ? ' paddle-full-width-page': ''; ?>">
	
	<div id="header-style-6" class="header-content<?php echo esc_attr( $paddle_menu->has_separated_cta() ? ' sep-header-cta' : '' ); ?>">

		<div class="site-branding header-content-left site-logo d-block d-lg-none">
			<div class="site-branding-wrap">
				<?php
				$paddle_menu->logo();
				$paddle_menu->site_title();
				$paddle_menu->site_description();
				?>
			</div>
		
		</div>

		<div class="toggler">
			<button aria-label="<?php echo esc_attr__( 'Open Menu', 'paddle' ); ?>" class="open-dialog btn navbar-toggler navbar-toggler-right collapsed offcanvas-toggle pl-0">
				<span></span><span></span><span></span>
			</button>
		</div><!--.toggler-->

		<?php $paddle_menu->splitMenu(); // Menu ?> 

		<?php if ( $paddle_menu->hasWooCommerce() ) : ?>
			<div class="woo-header-utilities d-flex align-items-center">
				<?php paddle_woocommerce_user_account(); ?>
				<?php paddle_get_total_cart_item(); ?>
			</div>
		<?php endif; ?>

		<?php paddle_search_layout(); ?>
		
		</div><!-- .header-content-2nd-->
</div>

