<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paddle
 */

 $paddle_sidebar_style = '';
 if( paddle_is_blog()) {
	if('1' === paddle_get_blog_style()) {
		$paddle_sidebar_style = ' sidebar-offset-'.paddle_get_blog_style();
	}
	
 }

if ( ! is_active_sidebar( 'sidebar-1' ) 
|| 'no-sidebar' === paddle_get_sidebar_option() ) {
	return;
}
?>

<aside id="secondary"
	class="widget-area col-sm-12 <?php echo esc_attr( paddle_layout_container() ); ?> <?php echo esc_attr( paddle_layout_width() ); ?><?php echo esc_attr( $paddle_sidebar_style ); ?>">
	<?php
	do_action( 'paddle_before_sidebar_1' );
	dynamic_sidebar( 'sidebar-1' );
	do_action( 'paddle_after_sidebar_1' );
	?>
</aside><!-- #secondary -->
