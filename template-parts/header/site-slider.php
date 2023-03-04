<?php

/**
 * Displays homepage slider
 *
 * @package Paddle
 */

?>


<?php

	$slide_total = 0;
	$i           = 0;

?>
	<div id="paddle-slider" class="home-banner vh paddle-front-page-slider">
	<?php

	foreach ( paddle_get_slider_ids() as $pid ) {
		if ( ! empty( absint( $pid ) ) && $i < 3 ) :
			$slide_total++;
			$i++;
			$paddle_banner_title       = get_the_title( $pid );
			$paddle_banner_description = get_the_excerpt( $pid );
			$paddle_post_url           = get_the_permalink( $pid );
			$paddle_banner_btn_1       = get_theme_mod( 'paddle_slider_button_text1', '' );
			$paddle_banner_btn_1_link  = get_theme_mod( 'paddle_slider_button_url1', '#' );
			$paddle_image_url          = get_the_post_thumbnail_url( $pid, 'paddle-slider' );
			$slider_button_text[ $i ]  = get_theme_mod( 'paddle_slider_button_text' . $i );
			$paddle_custom_link        = get_theme_mod( 'paddle_slider_custom_url', PADDLE_DEFAULT_OPTION['paddle_slider_custom_url'] );

			// Custom Text and Links.
			$slider_button_url[ $i ] = get_theme_mod( 'paddle_slider_button_url' . $i );

			?>

		<div class="home-banner-overlay vh d-none"></div>

		<div class="slideshow-content" data-src="<?php echo esc_url_raw( $paddle_image_url ); ?>">
			<div class="home-banner-content outer content-left">
				<div class="board light-box-shadow">

					<header class="no-bgcolor">
						<h1 class="banner-h1 animate-up">
						<?php
						if ( '' !== $paddle_banner_title ) {
							echo esc_html( $paddle_banner_title );}
						?>
						</h1>
					</header>
					<?php
					/*
					 @todo add options to show category list.
					<div class="banner-tags">
						<?php paddle_category_list_by_id( $pid ); ?>
					</div>
					 */
					?>

					<p class="home-banner-summary animate-up">
						<?php
						if ( '' !== $paddle_banner_description ) {
							$paddle_banner_description = wp_strip_all_tags( $paddle_banner_description );
							echo esc_html( paddle_theme_trim_text( $paddle_banner_description, 20 ) );}
						?>
					</p>
						<div class="home-banner-cta-button-container group-btn animate-up <?php echo esc_attr( paddle_banner_btncss() ); ?>">

							<?php if ( 1 === $paddle_custom_link && ! empty( $slider_button_text[ $i ] ) && ! empty( $paddle_banner_btn_1 ) ) { ?>
								<a title="<?php echo esc_attr( $slider_button_text[ $i ] ); ?>" href="<?php echo ( esc_url_raw( $slider_button_url[ $i ] ) ? esc_attr( $slider_button_url[ $i ] ) : $paddle_post_url ); ?>" class="btn btn-primary border-0">
									<?php echo esc_attr( $slider_button_text[ $i ] ); ?>
								</a>
								<?php
								// End button 1.
							} else {
								?>
								<a href="<?php echo ( esc_url_raw( $paddle_post_url ) ); ?>" class="btn btn-primary border-0">
									<?php echo esc_html( 'Continue Reading' ); ?>
								</a>
							<?php } ?>

						</div><!-- .home-banner-cta-button -->
						<?php
						// End buttons.
						?>

				</div><!-- .board -->
			</div><!-- .home-banner-content -->
		</div><!-- .slide container -->

		<div class="home-banner-image"></div><!-- .home-banner-image-->

			<?php

		endif;
	}

	?>
	<!-- Next and previous buttons -->
	<div class="slider-control-navigation">
		<button class="prev-slide" aria-label="<?php esc_attr_e( 'Previous slide', 'paddle' ); ?>">&#10094;</button>
		<!-- The dots/circles -->
		<div class="dots-container">
			<?php for ( $x = 1; $x <= $slide_total; $x++ ) : ?>
			<span class="dot" data-index="<?php echo esc_attr( $x ); ?>"><span class="dot-inner"></span></span>
			<?php endfor; ?>
		</div>
		<button class="next-slide" aria-label="<?php esc_attr_e( 'Next slide', 'paddle' ); ?>">&#10095;</button>
		<div class="slide-number-holder">
			<div class="numbertext"><span class="slide-index">1</span> <span> <?php echo esc_html( $slide_total ); ?> </span></div>
		</div>
	</div>
	</div><!-- #paddle-slider -->


