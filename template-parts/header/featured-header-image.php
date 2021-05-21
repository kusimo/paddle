<?php
/**
 * Displays featured header image
 *
 * @package Paddle
 */

/**
 * Check if user is not using right sidebar option
 */
$paddle_sidebar_check = paddle_layout_container( 'content' );
if ( 'col-lg-8' !== $paddle_sidebar_check && 'classic' !== get_theme_mod( 'paddle_featured_image_style', 'classic' ) ) :  // Theme is not using the right sidebar option or classic, get wide header image.
	?>

	<header class="entry-header has-post-thumbnail <?php echo esc_attr( get_theme_mod( 'paddle_featured_image_style', 'slim-full-width' ) ); ?>">

		<div class="header__text">
			<div class="row">
				<div class="page__title-wrap col-md-8 col-lg-6 column end">
					<div class="page__title">
						<?php
						if ( is_singular() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;
						?>
					</div>
					<div class="page__description">
					</div>
				</div>
				<?php if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() && 1 === get_theme_mod( 'paddle_enable_author_bio', 1 ) ) : ?>
					<div class="author-bio-info col-md-8 col-lg-6">
						<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<div class="author-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?></div>
						<div class="author-name">
							<small>
								<?php
								printf(
									/* translators: %s: Author name. */
									__( 'By %s', 'paddle' ),
									esc_html( get_the_author() )
								);
								?>
							</small>
						</div>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div><!-- .header__text -->

		<div class="header__image">
			<img src="<?php the_post_thumbnail_url( 'full' ); ?>" alt="<?php the_title_attribute(); ?>">
		</div><!-- .header__image -->

	</header><!-- .entry-header -->

	<?php
else :  // Right sidebar option is in use.

	the_title( '<h1 class="entry-title">', '</h1>' );

	if ( 1 === get_theme_mod( 'paddle_enable_author_bio', 1 ) ) {
		printf(
			'<div class="by-author"> %1$s<span class="author vcard"><a class="url" href="%2$s"> %3$s</a></span></div>',
			esc_html_x( 'By', 'post author', 'paddle' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}

	?>

	<figure class="thumbnail-post-single position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">

		<?php
		paddle_post_thumbnail();

		$paddle_caption = get_the_post_thumbnail_caption();

		if ( $paddle_caption ) {
			?>

			<figcaption><?php echo wp_kses_post( $paddle_caption ); ?></figcaption>

			<?php
		}
		?>
	</figure><!-- figure -->

<?php endif; ?>
