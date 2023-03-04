<?php
/**
 * Template part archive posts list layout
 *
 * @package paddle
 */

 $paddle_title_order = has_post_thumbnail() ? ' order-is-0' : ' order-is-1';

?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="col-12 col-lg-12 col-xl-12">
  <div class="list-card d-flex">
    <?php 
    if ( 1 === absint( get_theme_mod( 'enable_archive_featured_image', PADDLE_DEFAULT_OPTION['enable_archive_featured_image'] ) ) ) {
        $paddle_archive_thumbnail_size = get_theme_mod( 'paddle_archive_thumbnail_size', PADDLE_DEFAULT_OPTION['paddle_archive_thumbnail_size'] );
        paddle_grid_post_thumbnail($paddle_archive_thumbnail_size);
    }
    ?>
    <div class="entry-content-wrap">
	<?php

		the_title( '<h2 class="entry-title heading-size-1"><a class="post-entry-link" href="' . esc_url( get_permalink() ) . '"  "rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta<?php echo esc_attr($paddle_title_order);?>">
				<?php if ( 1 === absint( get_theme_mod( 'paddle_enable_archive_author', PADDLE_DEFAULT_OPTION['paddle_enable_archive_author'] ) ) ) : ?>
					<?php paddle_posted_by(); ?>
					<?php
				endif;

                if ( 1 === absint( get_theme_mod( 'paddle_enable_archive_published_date', PADDLE_DEFAULT_OPTION['paddle_enable_archive_published_date'] ) ) ) {
                    paddle_posted_on();
                }

				paddle_grid_category_list();?>

			</div><!-- .entry-meta -->
			<?php
		endif;    // End if post type.

		do_action( 'paddle_after_post_title' );
	?>

	<?php do_action( 'paddle_before_entry_content' ); ?>

    <div class="entry-content">
		<?php

		if ( is_search() || ! is_singular() ) {
			do_action( 'paddle_before_archive_excerpt' );

			$paddle_enable_blog_excerpt = get_theme_mod( 'enable_blog_excerpt', PADDLE_DEFAULT_OPTION['enable_blog_excerpt'] );
			if ( 1 === $paddle_enable_blog_excerpt ) {
				the_excerpt();
			}
		} 

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'paddle' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
    <?php do_action( 'paddle_after_entry_content' ); ?>

    </div><!-- .details -->

  </div>
</div>	
</article><!-- #post-<?php the_ID(); ?> -->



