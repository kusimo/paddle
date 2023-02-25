<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paddle
 */

 $paddle_page_header_type = get_theme_mod( 'paddle_page_header_type', PADDLE_DEFAULT_OPTION['paddle_page_header_type'] );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ('0' === esc_attr($paddle_page_header_type)) : ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php 
	$paddle_post_thumbnail_size_page = get_theme_mod( 'paddle_thumbnail_size_page', PADDLE_DEFAULT_OPTION['paddle_thumbnail_size_page'] );
	paddle_post_thumbnail($paddle_post_thumbnail_size_page); 

	endif;
	?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'paddle' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<div class="clearfix"></div>
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'paddle' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->		
		
<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
