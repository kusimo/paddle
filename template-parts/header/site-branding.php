<?php

/**
 * Displays header site branding
 *
 * @package Paddle
 */

?>

<?php
if ( ( is_header_video_active() && has_header_video() ) || has_header_image() ) :

	$paddle_banner_title       = get_theme_mod( 'header_banner_title', 'Build Your Dream Website with Paddle' );
	$paddle_banner_description = get_theme_mod( 'header_banner_description', 'Go Forward and Conquer' );
	$paddle_banner_btn_1       = get_theme_mod( 'header_banner_button_1', 'Get Started' );
	$paddle_banner_btn_1_link  = get_theme_mod( 'header_banner_button_1_link', '#' );
	$paddle_banner_btn_2       = get_theme_mod( 'header_banner_button_2' );
	$paddle_banner_btn_2_link  = get_theme_mod( 'header_banner_button_2_link', '#' );
	?>

<div id="home-header-image" class="home-banner vh">
	<div class="home-banner-overlay vh"></div>
	<div id="hero" class="home-banner-content outer content-<?php echo esc_attr( paddle_banner_align() ); ?>">
		<div class="board">

			<header class="no-bgcolor">
				<h1>
					<?php
					if ( '' !== $paddle_banner_title ) {
						echo esc_html( $paddle_banner_title );}
					?>
				</h1>
			</header>

			<p class="home-banner-summary">
				<?php
				if ( '' !== $paddle_banner_description ) {
					echo esc_attr( get_theme_mod( 'header_banner_description' ) );}
				?>
			</p>

			<?php if ( ! empty( $paddle_banner_btn_1 ) || ! empty( $paddle_banner_btn_2 ) ) : ?>
			<div class="home-banner-cta-button-container group-btn <?php echo esc_attr( paddle_banner_btncss() ); ?>">

				<?php if ( ! empty( $paddle_banner_btn_1 ) ) : ?>
				<a href="<?php echo ( esc_url_raw( $paddle_banner_btn_1_link ) ? esc_attr( $paddle_banner_btn_1_link ) : '' ); ?>"
					class="btn btn-primary no-rounded-right">
					<?php echo esc_attr( $paddle_banner_btn_1 ); ?>
				</a>
					<?php
						// End button 1.
						endif;
				?>

				<?php if ( ! empty( $paddle_banner_btn_2 ) ) : ?>
				<a href="<?php echo ( esc_url_raw( $paddle_banner_btn_2_link ) ? esc_url_raw( $paddle_banner_btn_2_link ) : '' ); ?>"
					class="btn bg-white no-rounded-left">
					<?php echo esc_attr( $paddle_banner_btn_2 ); ?>
				</a>
					<?php
						// End button 2.
						endif;
				?>

			</div><!-- .home-banner-cta-button -->
				<?php
				// End buttons.
				endif;
			?>

		</div><!-- .board -->
	</div><!-- .home-banner-content -->
	<div class="home-banner-image"></div><!-- .home-banner-image-->
</div><!-- .home-banner-->
<?php endif; ?>
