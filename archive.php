<?php
/**
 * The template for displaying archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paddle
 */

defined( 'ABSPATH' ) || exit;  // Exit if accessed directly.

get_header();

?>

<div id="primary" class="content-area col-sm-12 <?php echo esc_attr( paddle_layout_container( 'content' ) ); ?>">
	<main id="primary" class="site-main <?php echo esc_attr( paddle_layout_width() ); ?>">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header --> 

			<?php
			if ( 1 === get_theme_mod( 'archive_layout', 1 ) ) {
				get_template_part( 'template-parts/content', 'archive' );
			} else {
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
			}
			
			?>

			<?php 
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
