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
					<div class="brand-wrap row flex-nowrap justify-content-between">
						<div class="site-logo header-content-left">
							<?php
							the_custom_logo();
							if ( is_front_page() && is_home() ) :
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

							<?php if ( 1 === get_theme_mod( 'paddle_header_search_button', 1 )  )  : // Header search button. ?>
							<div id="search-glass"><button class="btn button-search" data-toggle="modal" data-target="#searchModal"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'paddle' ); ?></span>
								</button></div>
							<?php endif; ?>

							<div class="toggler">
								<button class="navbar-toggler navbar-toggler-right collapsed offcanvas-toggle" aria-label="Toggle navigation" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas">
									<span></span><span></span><span></span>
								</button>
							</div>
						</div><!-- .header-content-right -->

					</div><!-- .brand-wrap -->
				</div><!-- .container.py-3 -->
			</div><!-- .site-branding -->

			<nav class="nav-primary nav-menu" role="navigation">
				<?php 
				wp_nav_menu(
					array(
						'theme_location'        => 'menu-1',
						'menu_id'               => 'primary-menu',
						'container_class'       => 'container',
						'menu_class'            => 'primary-menu menu d-flex justify-content-between',
					) 
				);
				?>
			</nav><!-- #site-navigation -->

		</header><!-- #masthead -->

		<div class="clearfix"></div>

		<div class="navbar-offcanvas navbar-offcanvas-touch" id="js-bootstrap-offcanvas">

			<?php get_search_form(); ?>

			<?php
			if ( has_nav_menu( 'menu-1' ) ) {
				echo '<nav class="offcanvas-nav-menu" role="navigation">';
				wp_nav_menu(
					array(
						'theme_location'        => 'menu-1',
						'menu_id'               => 'off-canvas-primary-menu',
					) 
				);
				echo '</nav>';
			}
			?>
		</div><!-- .navbar-offcanvas -->

		<?php if ( is_front_page() || is_home() ) : ?>

			<?php get_template_part( 'template-parts/header/site', 'branding' ); ?> 

		<?php endif; ?>




		<div id="content" class="site-content">
			<div class="<?php 
							$paddle_container = ( 'full-width-content' === paddle_layout_width() ? 'container-fluid full-width-container' : 'container' );  echo esc_attr( $paddle_container ); 
						?>">
				<div class="row">
