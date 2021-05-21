<?php

/**
 * Displays homepage slider
 *
 * @package Paddle
 */

?>

<?php
if ( 1 === get_theme_mod( 'paddle_enable_slider' ) && false === has_header_image() ) :
	?>

	<div id="paddle-slider" class="home-banner vh paddle-front-page-slider">

		<?php
		for ( $i = 1; $i < 4; $i++ ) :
			// Getting data from Customizer to display the Slider section
			$slider_page[ $i ]        = get_theme_mod( 'paddle_slider_page' . $i );
			$slider_button_text[ $i ] = get_theme_mod( 'paddle_slider_button_text' . $i );
			$slider_button_url[ $i ]  = get_theme_mod( 'paddle_slider_button_url' . $i );
		endfor;

		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => 3,
			'post__in'       => $slider_page,
			'orderby'        => 'post__in',
		);

		$slider_loop = new WP_Query( $args );
		$j           = 1;
		if ( $slider_loop->have_posts() ) :
			?>
		
			<?php

			while ( $slider_loop->have_posts() ) :
				$slider_loop->the_post();

				$paddle_banner_title       = get_the_title( get_the_ID() );
				$paddle_banner_description = get_the_content( get_the_ID() );
				$paddle_banner_btn_1       = get_theme_mod( 'paddle_slider_button_text1', '' );
				$paddle_banner_btn_1_link  = get_theme_mod( 'paddle_slider_button_url1', '#' );
				$paddle_image_url          = get_the_post_thumbnail_url( $slider_loop->ID, 'paddle-slider' );
				?>
				<div class="home-banner-overlay vh d-none"></div>

				<div class="slideshow-content" data-src="<?php echo esc_url_raw( $paddle_image_url ); ?>">
					<div class="home-banner-content outer content-<?php echo esc_attr( paddle_banner_align() ); ?>">
						<div class="board light-box-shadow">

							<header class="no-bgcolor">
								<h1 class="banner-h1 animate-up">
									<?php
									if ( '' !== $paddle_banner_title ) {
										echo esc_html( $paddle_banner_title );}
									?>
								</h1>
							</header>

							<p class="home-banner-summary animate-up">
								<?php
								if ( '' !== $paddle_banner_description ) {
									$paddle_banner_description = wp_strip_all_tags( $paddle_banner_description );
									echo esc_html( $paddle_banner_description );}
								?>
							</p>

							<?php if ( ! empty( $slider_button_text[ $j ] ) || ! empty( $paddle_banner_btn_1 ) ) : ?>
								<div class="home-banner-cta-button-container group-btn animate-up <?php echo esc_attr( paddle_banner_btncss() ); ?>">

									<?php if ( ! empty( $slider_button_text[ $j ] ) ) : ?>
										<a href="<?php echo ( esc_url_raw( $slider_button_url[ $j ] ) ? esc_attr( $slider_button_url[ $j ] ) : '' ); ?>" class="btn btn-primary border-0">
											<?php echo esc_attr( $slider_button_text[ $j ] ); ?>
										</a>
										<?php
										// End button 1.
									endif;
									?>

								</div><!-- .home-banner-cta-button -->
								<?php
								// End buttons.
							endif;
							?>

						</div><!-- .board -->
					</div><!-- .home-banner-content -->
				</div><!-- .slide container -->

				<div class="home-banner-image"></div><!-- .home-banner-image-->
				<?php
				$j++;
			endwhile;
			wp_reset_postdata();
		endif;
		?>
		<!-- Next and previous buttons -->
		<div class="slider-control-navigation">
		<button class="prev-slide" aria-label="<?php esc_attr_e( 'Previous slide', 'paddle' ); ?>">&#10094;</button>
		<!-- The dots/circles -->
		<div class="dots-container">
			<span class="dot" data-index="1"><span class="dot-inner"></span></span>
			<span class="dot" data-index="2"><span class="dot-inner"></span></span>
			<span class="dot" data-index="3"><span class="dot-inner"></span></span>
		</div>
		<button class="next-slide" aria-label="<?php esc_attr_e( 'Next slide', 'paddle' ); ?>">&#10095;</button>
		<div class="slide-number-holder">
				<div class="numbertext"><span class="slide-index">1</span> <span> 3 </span></div>
			</div>
	</div>
	</div><!-- .home-banner-->
<?php endif; ?>
