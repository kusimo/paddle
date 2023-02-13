<ul class="social-items topbar-social">
<?php
$paddle_social_urls  = explode( ',', get_theme_mod( 'social_urls', '' ) );
$paddle_social_icons = paddle_generate_social_urls();

foreach ( $paddle_social_urls as $key => $value ) {
	if ( ! empty( $value ) ) {
		$paddle_domain = str_ireplace( 'www.', '', parse_url( $value, PHP_URL_HOST ) );
		$index         = array_search( strtolower( $paddle_domain ), array_column( $paddle_social_icons, 'url' ) );
		if ( false !== $index ) {
			$social_name  = $paddle_social_icons[ $index ]['class'];
			$social_title = $paddle_social_icons[ $index ]['title'];
			?>
	   <li class="social-item">
			<span class="social-icon-wrap social-link solid-dark-bordered <?php echo esc_attr( $social_name ); ?>-social">
				<a rel="noopener" href="<?php echo esc_url( $value ); ?>" title="<?php echo esc_attr( $social_title ); ?>" target="_blank">
					<span class="<?php echo esc_attr( $social_name ); ?>-social icon icon-<?php echo esc_attr( $social_name ); ?>"></span>
					<span class="bg-transform">
						<i class="icon icon-<?php echo esc_attr( $social_name ); ?>"></i>
					</span>
				</a>
			</span>
		</li>
			<?php

		} else {
			$social_name = 'globe';
			?>
		<li class="social-item no-social">
			<span class="social-icon-wrap social-link solid-dark-bordered <?php echo esc_attr( $social_name ); ?>-social">
				<a href="<?php echo esc_url( $value ); ?>" target="_blank">
					<span class="<?php echo esc_attr( $social_name ); ?>-social icon icon-<?php echo esc_attr( $social_name ); ?>"></span>
					<span class="bg-transform">
						<i class="icon icon-<?php echo esc_attr( $social_name ); ?>"></i>
					</span>
				</a>
			</span>
		</li>
			<?php
		}
	}
}

?>
</ul><!-- .social-items -->
