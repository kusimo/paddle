<?php

/**
 * Displays header site branding
 *
 * @package Paddle
 */

?>

<?php
	$paddle_banner_image_id = get_theme_mod( 'hero_image', PADDLE_DEFAULT_OPTION['hero_image'] ) > 0 ?  absint( get_theme_mod( 'hero_image' ) ) : 0;
	$paddle_banner_title       = get_theme_mod( 'header_banner_title', PADDLE_DEFAULT_OPTION['header_banner_title'] );
	$paddle_banner_description = get_theme_mod( 'header_banner_description', PADDLE_DEFAULT_OPTION['header_banner_description'] );
	$paddle_banner_btn_1       = get_theme_mod( 'header_banner_button_1', PADDLE_DEFAULT_OPTION['header_banner_button_1'] );
	$paddle_banner_btn_1_link  = get_theme_mod( 'header_banner_button_1_link', '#' );
	$paddle_banner_btn_2       = get_theme_mod( 'header_banner_button_2', PADDLE_DEFAULT_OPTION['header_banner_button_2'] );
	$paddle_banner_btn_2_link  = get_theme_mod( 'header_banner_button_2_link', '#' );
	$paddle_header_html_tag       = get_theme_mod( 'banner_header_htmltag', PADDLE_DEFAULT_OPTION['banner_header_htmltag'] );
	$paddle_banner_border_radius = get_theme_mod( 'paddle_banner_border_radius', PADDLE_DEFAULT_OPTION['paddle_banner_border_radius'] );
	$paddle_banner_box_shadow = get_theme_mod( 'paddle_banner_box_shadow', PADDLE_DEFAULT_OPTION['paddle_banner_box_shadow'] );
	$paddle_banner_arrow_button = get_theme_mod( 'banner_arrow_button', PADDLE_DEFAULT_OPTION['banner_arrow_button'] );
	

	$paddle_banner_has_content = false;
	$paddle_banner_button_is_multiple = false;

	if (! empty( $paddle_banner_btn_1 ) && ! empty( $paddle_banner_btn_2) ) {
		$paddle_banner_button_is_multiple = true;
	}

	if (!empty($paddle_banner_title && '' !== $paddle_banner_title) 
	|| !empty($paddle_banner_description && '' !== $paddle_banner_description) 
	||  ! empty( $paddle_banner_btn_1 ) || ! empty( $paddle_banner_btn_2 )
	) {
		$paddle_banner_has_content = true;
	}
?>


<section class="Banner">
	<div class="Banner__hero">
		<div class="Banner__content">
		<?php  if ($paddle_banner_has_content) : ?>
				<div class="Banner__details">
					<div class="Banner__details-container<?php echo esc_attr( 0 === $paddle_banner_image_id ? ' banner-no-image': '');?><?php echo esc_attr( 1=== absint($paddle_banner_border_radius) ? ' has-border-radius': ''); ?><?php echo esc_attr( 1=== absint($paddle_banner_box_shadow) ? ' has-box-shadow': ''); ?>">
						<div class="Banner__detail-heading">
							<?php
							echo wp_kses_post('h2' === $paddle_header_html_tag ? '<h2>' : '<h1>');
							if(!empty($paddle_banner_title && '' !== $paddle_banner_title))
							echo esc_attr($paddle_banner_title);
							echo wp_kses_post('h2' === $paddle_header_html_tag ? '</h2>' : '</h1>');
							?>
						</div>

						<?php if ('' !== $paddle_banner_description ) : ?>
							<div class="Banner__description">
								<?php echo wp_kses_post($paddle_banner_description); ?>
							</div>
						<?php endif; ?>

						<div class="Banner__buttons banner__<?php echo esc_attr($paddle_banner_button_is_multiple ? 'buttons--is-multiple' : 'button');?>">
							<?php if ( ! empty( $paddle_banner_btn_1 ) ) : ?>
							<a href="<?php echo ( esc_url_raw( $paddle_banner_btn_1_link ) ? esc_url_raw( $paddle_banner_btn_1_link ) : esc_attr($paddle_banner_btn_1_link) ); ?>"
								role="link" class="button button--primary">
								<span><?php echo esc_attr( $paddle_banner_btn_1 ); ?></span>
								<?php if (1 === absint($paddle_banner_arrow_button)) {
									 echo wp_kses(paddle_get_svg_icon('arrow-right'), paddle_svg_allowedHtml() );
								} ?>
							</a>
							<?php endif; ?>
							<?php if ( ! empty( $paddle_banner_btn_2 ) ) : ?>
							<a href="<?php echo ( esc_url_raw( $paddle_banner_btn_2_link ) ? esc_url_raw( $paddle_banner_btn_2_link ) : esc_attr($paddle_banner_btn_2_link) ); ?>"
								role="link" class="button button--primary">
								<span><?php echo esc_attr( $paddle_banner_btn_2 ); ?></span>
								<?php if (1 === absint($paddle_banner_arrow_button)) {
									 echo wp_kses(paddle_get_svg_icon('arrow-right'), paddle_svg_allowedHtml() );
								} ?>
							</a>
							<?php endif; ?>
						</div>
					</div>
		
				</div>
			<?php endif; ?>

			<?php if ( 0 !== $paddle_banner_image_id) : ?>
				<div class="Banner__media-layout">
					<div class="Banner__color-underlay">
						<div class="Banner__media">
							<div class="Banner__image">
								<?php 
								paddle_optimize_image_height_width_using_id($paddle_banner_image_id, 'full', 'site-banner-image', 'site banner');
								?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>

</div>
</section><!-- .entry-header -->

