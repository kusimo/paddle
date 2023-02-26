<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paddle
 */

 $paddle_page_header_type = get_theme_mod( 'paddle_page_header_type', PADDLE_DEFAULT_OPTION['paddle_page_header_type'] );
 $paddle_alignment_page		= get_theme_mod( 'paddle_banner_alignment_page', PADDLE_DEFAULT_OPTION['paddle_banner_alignment_page'] );
 $paddle_author_page		= absint(get_theme_mod( 'banner_author_page', PADDLE_DEFAULT_OPTION['banner_author_page'] ));
 $paddle_published_date_page = absint(get_theme_mod( 'banner_published_date_page', PADDLE_DEFAULT_OPTION['banner_published_date_page'] ));
 $paddle_excerpt_page =absint(get_theme_mod( 'banner_excerpt_page', PADDLE_DEFAULT_OPTION['banner_excerpt_page'] ));
 $paddle_show_post_parent = get_theme_mod( 'banner_parent_title_page', PADDLE_DEFAULT_OPTION['banner_parent_title_page'] );
 $paddle_page_has_meta = false;
 if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && 1 === absint($paddle_author_page) || 1 === absint($paddle_published_date_page) ) {
	$paddle_page_has_meta = true;
 }

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

	<?php if ( $paddle_page_has_meta) : ?>
		<div class="page__entry-meta">
	<?php endif; ?>

		<?php if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && 1 === absint($paddle_author_page) ) { 
			 paddle_posted_by();
		 } ?>

		<?php if ( 1 === absint($paddle_published_date_page)) {
			 paddle_posted_on();
		 } ?>

	<?php if ( $paddle_page_has_meta) : ?>
		</div>
	<?php endif; ?>


	<?php if (1 === $paddle_excerpt_page ) : ?>
		<div class="page__description">
			<?php the_excerpt(); ?>
		</div>
	<?php endif; ?>

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
