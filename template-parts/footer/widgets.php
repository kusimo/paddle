<?php
/**
 * Displays footer widgets if assigned
 *
 * @package paddle
 */

?>
<?php
	$paddle_column_count = 0;
for ( $i = 1; $i <= 4; $i++ ) {
	if ( is_active_sidebar( 'footer-' . $i ) ) {
		$paddle_column_count++;
	}
}
?>

<div class="widget-container footer-widgets">
	<div class="container">
		<div class="row">
			<?php
			/**
			 * Footer Logo
			 */
				$paddle_footer_logo_active = get_theme_mod( 'paddle_footer_logo', PADDLE_DEFAULT_OPTION['paddle_footer_logo'] );
				$paddle_social_column = get_theme_mod( 'footer_social_column', PADDLE_DEFAULT_OPTION['footer_social_column'] );
				$paddle_footer_has_social = get_theme_mod( 'paddle_footer_social', PADDLE_DEFAULT_OPTION['paddle_footer_social'] );
				$paddle_show_social = 'none' !== $paddle_social_column || 'with-logo' !== $paddle_social_column;
		
			for ( $i = 1; $i <= 4; $i++ ) {
				if ( is_active_sidebar( 'footer-' . $i ) ) {

					if ( 1 === $paddle_column_count ) {
						 $paddle_size = '12';
					} elseif ( 2 === $paddle_column_count ) {
						$paddle_size = '6';
					} elseif ( 3 === $paddle_column_count ) {
						$paddle_size = '4';
					} else {
						$paddle_size = '3';
					}
					?>
				<div class="col-content col-lg-<?php echo esc_attr( $paddle_size ); ?> col-md-<?php
					if ( '3' === $paddle_size ) :
						echo esc_attr( '6' ); elseif ( '4' === $paddle_size ) :
							echo esc_attr( '4' );
					else :
						echo esc_attr( $paddle_size );
						endif;
					?>
				 ">
				
					<div class="footer-column footer-active-<?php echo esc_attr( $paddle_column_count ); ?>" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'paddle' ); ?>">
						<?php if ($paddle_show_social && 1 === $paddle_footer_has_social)  {
								$paddle_social_icons_position = intval($paddle_social_column);
							}

							dynamic_sidebar( 'footer-' . $i ); 
							
							if ($paddle_show_social  && 1 === $paddle_footer_has_social )  {
								$paddle_social_icons_position = intval($paddle_social_column);
								if($i === $paddle_social_icons_position ) {
									get_template_part( 'template-parts/footer/social', 'items' ); 
								}
							}
						?>
					</div>
				 </div>
					<?php
				}
			}
			?>

		</div>
	</div>
</div>


