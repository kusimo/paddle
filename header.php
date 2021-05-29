<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paddle
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'paddle' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="site-branding p-3">
				<div class="container py-3">
					<div
						class="brand-wrap d-flex <?php echo class_exists( 'woocommerce' ) ? 'justify-content-between has-woocommerce' : 'justify-content-between'; ?> ">

						<div class="site-logo header-content-left">
							<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) :
								?>
							<h1 class="site-title noline-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
									rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							else :
								?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
									rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
							endif;
							?>
							<?php
							$paddle_description = get_bloginfo( 'description', 'display' );
							if ( $paddle_description || is_customize_preview() ) :
								?>
							<p class="site-description"><small>
									<?php
										echo $paddle_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									?>
								</small></p>
							<?php endif; ?>
						</div><!-- .logo-branging -->

						<div class="header-content-right d-flex flex-row">

							<?php
							if ( 1 === get_theme_mod( 'paddle_header_search_button', 1 ) ) : // Header search button.
								?>
							<div id="search-glass"><button class="btn button-search" data-bs-toggle="modal"
							data-bs-target="#searchModal"><span
										class="screen-reader-text"><?php esc_html_e( 'Search', 'paddle' ); ?></span>
								</button></div>
							<?php endif; ?>	
							<div class="toggler">
								<button class="btn navbar-toggler navbar-toggler-right collapsed offcanvas-toggle pl-0"
									data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
									<span></span><span></span><span></span>
								</button>
							</div>	
						</div><!-- .header-content-right -->


						<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<div class="woo-header-utilities d-flex align-items-center">
							<?php paddle_woocommerce_user_account(); ?>
							<?php paddle_get_total_cart_item(); ?>
						</div>

						<?php endif; ?>



					</div><!-- .brand-wrap -->
				</div><!-- .container.py-3 -->
			</div><!-- .site-branding -->

			<nav class="nav-primary nav-menu" role="navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'menu_class'      => 'primary-menu menu', // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
						'menu_id'         => 'primary-menu', // (string) The ID that is applied to the ul element which forms the menu. Default is the menu slug, incremented.
						'container'       => 'div', // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
						'container_class' => 'container', // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
						'fallback_cb'     => '',
					)
				);
				?>
			</nav><!-- #site-navigation -->


		</header><!-- #masthead -->

		<div class="clearfix"></div>

		<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
		<div class="offcanvas-header">
			<button type="button" class="btn btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="<?php esc_attr_e( 'Close', 'paddle' ); ?>">
				<span class="toggle-text"><?php esc_html_e( 'Close menu', 'paddle' ); ?></span>
			</button>
		</div>
		<div class="offcanvas-body">
		<nav id="site-navigation" class="main-navigation toggled">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary', // menu-1
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		</div>
		</div>

		<?php if ( is_front_page() || is_home() ) : ?>

			<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

			<?php get_template_part( 'template-parts/header/site', 'slider' ); ?>

		<?php endif; ?>




		<div id="content" class="site-content">
			<div class="
			<?php
						$paddle_container = ( 'full-width-content' === paddle_layout_width() ? 'container-fluid full-width-container' : 'container' );
						echo esc_attr( $paddle_container );
			?>
						">
				<div class="row<?php echo esc_attr( paddle_content_over_banner() ); ?>">

					<!-- content area-->
					<!-- Search Modal -->
					<?php
					if ( 1 === get_theme_mod( 'paddle_header_search_button', 1 ) ) {
						do_action( 'paddle_action_search_modal' );}
					?>
