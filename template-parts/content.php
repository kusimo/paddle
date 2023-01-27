<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paddle
 */

 $paddle_placeholder_image = 1 ===  absint( get_theme_mod('paddle_placeholder_image', PADDLE_DEFAULT_OPTION['paddle_placeholder_image']) ) ? 'has-placeholder-image' : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($paddle_placeholder_image); ?>>

	<?php
	if ( ( is_single() || ( is_page() && ! is_front_page() ) ) && has_post_thumbnail() ) :
		get_template_part( 'template-parts/header/featured-header', 'image' );

	else :
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title heading-size-1"><a class="post-entry-link" href="' . esc_url( get_permalink() ) . '"  "rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<small>
				<?php
				paddle_posted_by();
				?>
				</small>

			<?php
			// Display date link in the header if not in the footer.
			//if ( is_archive() || is_front_page() && 1 === get_theme_mod( 'hide_archive_meta', PADDLE_DEFAULT_OPTION['hide_archive_meta'] ) ) :
			 if(! is_singular()) {	paddle_posted_on(); }
			//endif;
			?>

			</div><!-- .entry-meta -->
			<?php
		endif;    // End if post type.

		do_action('paddle_after_post_title');

		paddle_post_thumbnail();

		paddle_thumbnail_svg_fallback();

	endif;
	?>

	<?php do_action('paddle_before_entry_content'); ?>

	<div class="entry-content">
		<?php

		if ( is_search() || ! is_singular() ) {
			do_action( 'paddle_before_archive_excerpt' );

			$paddle_enable_blog_excerpt = get_theme_mod('enable_blog_excerpt', PADDLE_DEFAULT_OPTION['enable_blog_excerpt']);
			if ( 1 === $paddle_enable_blog_excerpt ) {
				the_excerpt();
			} 
		} else {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'paddle' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'paddle' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php do_action('paddle_after_entry_content'); ?>

	<div class="clearfix"></div>

	<?php
	if ( is_archive() && 1 === get_theme_mod( 'hide_archive_meta', PADDLE_DEFAULT_OPTION['hide_archive_meta'] ) || is_front_page() && 1 === get_theme_mod( 'hide_archive_meta', PADDLE_DEFAULT_OPTION['hide_archive_meta'] ) ) :
				return '';
		else :
			?>
	<footer class="entry-footer">
			<?php paddle_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

