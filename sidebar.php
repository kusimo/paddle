<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paddle
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || 'no-sidebar' === get_theme_mod( 'paddle_sidebar_position', PADDLE_DEFAULT_OPTION['paddle_sidebar_position'] ) ) {
	return;
}
?>

<aside id="secondary"
	class="widget-area col-sm-12 <?php echo esc_attr( paddle_layout_container() ); ?> <?php echo esc_attr( paddle_layout_width() ); ?>">
	<?php
	do_action( 'paddle_before_sidebar_1' );
	dynamic_sidebar( 'sidebar-1' );
	do_action( 'paddle_after_sidebar_1' );
	?>
</aside><!-- #secondary -->
