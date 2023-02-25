<?php

    $paddle_page_header_type = get_theme_mod( 'paddle_page_header_type', PADDLE_DEFAULT_OPTION['paddle_page_header_type'] );
    $paddle_banner_height_page = get_theme_mod( 'banner_height_page', PADDLE_DEFAULT_OPTION['banner_height_page'] );
    $paddle_banner_background_image_enable_page = get_theme_mod( 'banner_background_image_enable_page', PADDLE_DEFAULT_OPTION['banner_background_image_enable_page'] );
    $paddle_banner_background_color_enable_page = get_theme_mod( 'banner_background_color_enable_page', PADDLE_DEFAULT_OPTION['banner_background_color_enable_page'] );
    $paddle_banner_background_color_page = paddle_theme_get_color( 'banner_background_color_page' );
    $paddle_banner_background_color_gradient_page  = paddle_theme_get_color( 'banner_background_color_gradient_page' );
    $paddle_banner_overlay_color_page	= paddle_theme_get_color( 'banner_overlay_color_page' );
    $paddle_banner_overlay_opacity_page = get_theme_mod( 'banner_overlay_opacity_page', PADDLE_DEFAULT_OPTION['banner_overlay_opacity_page'] );
    $paddle_banner_title_color_page		= paddle_theme_get_color( 'banner_title_color_page' );
    $paddle_banner_text_color_page		= paddle_theme_get_color( 'banner_text_color_page' );
    $paddle_banner_link_color_page		= paddle_theme_get_color( 'banner_link_color_page' );
    $paddle_banner_link_hover_color_page		= paddle_theme_get_color( 'banner_link_hover_color_page' );
    $paddle_banner_padding_top_page		= get_theme_mod( 'banner_padding_top_page', PADDLE_DEFAULT_OPTION['banner_padding_top_page'] );
    $paddle_banner_padding_bottom_page	= get_theme_mod( 'banner_padding_bottom_page', PADDLE_DEFAULT_OPTION['banner_padding_bottom_page'] );
    $paddle_banner_alignment_page		= get_theme_mod( 'paddle_banner_alignment_page', PADDLE_DEFAULT_OPTION['paddle_banner_alignment_page'] );
    $paddle_banner_author_page		= absint(get_theme_mod( 'banner_author_page', PADDLE_DEFAULT_OPTION['banner_author_page'] ));
    $paddle_banner_published_date_page = absint(get_theme_mod( 'banner_published_date_page', PADDLE_DEFAULT_OPTION['banner_published_date_page'] ));
    $paddle_banner_excerpt_page =absint(get_theme_mod( 'banner_excerpt_page', PADDLE_DEFAULT_OPTION['banner_excerpt_page'] ));
	$paddle_page_thumbnail_size = get_theme_mod( 'paddle_thumbnail_size_page', PADDLE_DEFAULT_OPTION['paddle_thumbnail_size_page'] );

	if ('0' === esc_attr($paddle_page_header_type)) {
		return;
	}
?>
<section class="PageBanner">

		<div class="PageBanner__content PageBanner__content-align-<?php echo esc_attr($paddle_banner_alignment_page);?>">
			<div class="PageBanner__wrap">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="PageBanner__heading">', '</h1>' );
				else :
					the_title( '<h2 class="PageBanner__heading"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
				?>
				<?php if (0 === $paddle_banner_excerpt_page ) : ?>
				<div class="PageBanner__description">
				</div>
				<?php endif; ?>
			</div>
			<?php if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() && 1 === absint($paddle_banner_author_page) ) : ?>
				<div class="PageBanner__author">
					<a class="PageBanner__author__link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
					<div class="PageBanner__author__avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?></div>
					<div class="PageBanner__author__name">
						<small>
							<?php
							printf(
								/* translators: %s: Author name. */
								__( 'By %s', 'paddle' ),
								esc_html( get_the_author() )
							);
							?>
						</small>
					</div>
					</a>
				</div>
			<?php endif; ?>
		</div><!-- .header__text -->

		<div class="PageBanner__image">
			<?php 
			
			paddle_post_thumbnail($paddle_page_thumbnail_size); 
			?>
		</div><!-- .header__image -->

</section><!-- .entry-header -->