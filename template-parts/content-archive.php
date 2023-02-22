<?php
/**
 * Template part archive posts layout
 *
 * @package paddle
 */

?>

<div class="archive-grid row">

<?php
$paddle_grid_option = get_theme_mod( 'paddle_grid_columns', PADDLE_DEFAULT_OPTION['paddle_grid_columns'] );

$paddle_post_achieve_counter = 0;
/* Start the Loop */
while ( have_posts() ) :
	$paddle_grid = ( 0 === get_theme_mod( 'paddle_page_layout_sidebar' ) ) ? 'col-12 col-sm-12 col-md-6 col-lg-4 pb-4 d-flex' : 'col-12 col-sm-12 col-md-6 col-lg-6 pb-4 d-flex';
	?>
	<div class="
	<?php
	echo esc_attr( 'post-index-'.$paddle_post_achieve_counter.' ');
	echo esc_attr( $paddle_grid );
	echo esc_attr( '3-columns' === $paddle_grid_option ? ' col-xl-4 grid-xtra' : '' );
	?>
	">

	<?php
		the_post();

	/*
	 * Include the Post-Type-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
	 */
		get_template_part( 'template-parts/content', get_post_type() );

		$paddle_post_achieve_counter++;

	?>
	</div><!-- .col-->

<?php endwhile; ?>

</div><!-- .row --> 
