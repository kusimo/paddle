<?php
/**
 * Displays featured header image
 *
 * @package Paddle
 */

/**
 * Check if user is not using right sidebar option
 */

	the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	<div class="entry-meta<?php echo esc_attr(!has_post_thumbnail() ? ' order-is-2' : '' ); ?> ">
		<?php 

		if ( 1 === get_theme_mod( 'paddle_enable_blog_author', PADDLE_DEFAULT_OPTION['paddle_enable_blog_author'] ) ) {
			printf(
				'<span class="by-author"> %1$s<span class="author vcard"><a class="url" href="%2$s"> %3$s</a></span></span>',
				esc_html_x( 'By', 'post author', 'paddle' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		// Post date.
		if ( 'before' === get_theme_mod( 'paddle_blog_date_position', PADDLE_DEFAULT_OPTION['paddle_blog_date_position'] ) ) {
			paddle_posted_on();
		}

		$paddle_enable_blog_comment = get_theme_mod( 'paddle_enable_blog_comment', PADDLE_DEFAULT_OPTION['paddle_enable_blog_comment'] );

		// Comment.
		paddle_get_post_comment( $paddle_enable_blog_comment );


		?>
	</div><!-- end meta-->
   <?php  if(has_post_thumbnail()) { ?>
	<figure class="thumbnail-post-single position-relative overflow-hidden">

		<?php
		$paddle_post_thumbnail_size = get_theme_mod( 'paddle_thumbnail_size', PADDLE_DEFAULT_OPTION['paddle_thumbnail_size'] );
		paddle_post_thumbnail( $paddle_post_thumbnail_size );

		$paddle_caption = get_the_post_thumbnail_caption();

		if ( $paddle_caption ) {
			?>

			<figcaption><?php echo wp_kses_post( the_post_thumbnail_caption() ); ?></figcaption>

			<?php
		}
		?>
	</figure><!-- figure -->
	<?php } ?>


