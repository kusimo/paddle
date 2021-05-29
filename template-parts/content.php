<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paddle
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
			if ( is_archive() || is_front_page() && 1 === get_theme_mod( 'hide_archive_meta' ) ) :
				paddle_posted_on();
endif;
			?>

			</div><!-- .entry-meta -->
			<?php
		endif;    // End if post type.

		paddle_post_thumbnail();

	endif;
	?>


	<div class="entry-content">
		<?php

		if ( is_search() || ! is_singular() ) {
			the_excerpt();
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
	<div class="clearfix"></div>

	<?php
	if ( is_archive() || is_front_page() && 1 === get_theme_mod( 'hide_archive_meta' ) ) :
				return '';
		else :
			?>
	<footer class="entry-footer">
			<?php paddle_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

