<?php
$paddle_social_footer_urls = explode( ',', get_theme_mod( 'footer_social_urls', PADDLE_DEFAULT_OPTION['footer_social_urls'] ) );
$paddle_social_icons       = paddle_generate_social_urls();

if ( ! empty( $paddle_social_footer_urls[0] ) ) { ?>
<ul id="menu-social-items" class="d-flex justify-content-center list-unstyled footer-social">
	<?php
}


foreach ( $paddle_social_footer_urls as $key => $value ) {
	if ( ! empty( $value ) ) {
		$paddle_domain = str_ireplace( 'www.', '', parse_url( $value, PHP_URL_HOST ) );
		$index         = array_search( strtolower( $paddle_domain ), array_column( $paddle_social_icons, 'url' ) );
		if ( false !== $index ) {
			$social_name  = $paddle_social_icons[ $index ]['class'];
			$social_title = $paddle_social_icons[ $index ]['title'];
			?>
	   <li class="social-item">
				<a rel="noopener" class="bottom-social" href="<?php echo esc_url( $value ); ?>" title="<?php echo esc_attr( $social_title ); ?>" target="_blank">
					<?php echo wp_kses( paddle_theme_get_social_icon($social_name), paddle_svg_allowedHtml() ); ?>
					<span class="screen-reader-text"><?php echo esc_html( $social_name ); ?></span>
				</a>
		</li>
			<?php

		} else {
			$social_name = 'globe';
			?>
		<li class="social-item no-social">
			<a class="icon icon-globe" href="<?php echo esc_url( $value ); ?>" title="<?php echo esc_attr( $social_title ); ?>" target="_blank">
				<?php echo wp_kses( paddle_theme_get_social_icon($social_name), paddle_svg_allowedHtml() ); ?>
				<span class="screen-reader-text"><?php echo esc_html( $social_name ); ?></span>
			</a>
		</li>
			<?php
		}
	}
}
if ( ! empty( $paddle_social_footer_urls[0] ) ) {
	?>
</ul><!-- .footer-social -->
	<?php
}
