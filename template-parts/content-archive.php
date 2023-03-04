<?php
/**
 * Template part archive posts layout
 *
 * @package paddle
 */

 $paddle_archieve_layout =  get_theme_mod( 'post_archive_layout', PADDLE_DEFAULT_OPTION['post_archive_layout'] ) ;
?>

<div class="<?php echo 'grid' === esc_attr($paddle_archieve_layout) ?  'archive-grid' : '';?> row">

<?php
$paddle_grid_col = 'col-12 col-sm-12 col-md-6 col-lg-6';
$paddle_grid_option = get_theme_mod( 'paddle_grid_columns', PADDLE_DEFAULT_OPTION['paddle_grid_columns'] );

switch($paddle_grid_option) {
	case '1-column':
		$paddle_grid_col = 'col-12 col-sm-12 col-md-12 col-lg-12';
		break;
	case '2-columns':
		$paddle_grid_col = 'col-12 col-sm-6 col-md-6 col-lg-6';
		break;
	case '3-columns':
		$paddle_grid_col = 'col-12 col-sm-6 col-md-6 col-lg-4';
		break;
	default:
		$paddle_grid_col = 'col-12 col-sm-6 col-md-6 col-lg-6';
}

$paddle_post_achieve_counter = 0;

/* Start the Loop */
while ( have_posts() ) :
	$paddle_grid = ( 0 === get_theme_mod( 'paddle_page_layout_sidebar' ) ) ? 'col-12 col-sm-12 col-md-6 col-lg-4' : 'col-12 col-sm-12 col-md-6 col-lg-6';
	?>
	<div class="d-flex 
	<?php if ('grid' === $paddle_archieve_layout) {
		echo esc_attr( 'post-index-'.$paddle_post_achieve_counter.' ');
		echo esc_attr( $paddle_grid_col );
		echo esc_attr( '3-columns' === $paddle_grid_option ? ' col-xl-4 grid-xtra' : '' );
	} else {
		// PHPCS - static content.
		echo 'col-12 col-sm-12 col-md-12 col-lg-12';  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	
	?>
	">

	<?php
		the_post();

	/*
	 * Include the Post-Type-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
	 */
	if ( 'grid' === get_theme_mod( 'post_archive_layout', PADDLE_DEFAULT_OPTION['post_archive_layout'] ) ) {
		get_template_part( 'template-parts/content', get_post_type() );
	} else {
		get_template_part( 'template-parts/content', 'list' );
	}
		

		$paddle_post_achieve_counter++;

	?>
	</div><!-- .col-->

<?php endwhile; ?>

</div><!-- .row --> 
