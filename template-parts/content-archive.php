<?php
/**
 * Template part archive posts layout
 *
 * @package paddle
 */

?>

<div class="archive-grid row">

<?php
/* Start the Loop */
while ( have_posts() ) : 
    $paddle_grid = ( 0 === get_theme_mod( 'paddle_page_layout_sidebar' ) ) ? 'col-12 col-sm-12 col-md-6 col-lg-4 pb-4 d-flex' : 'col-12 col-sm-12 col-md-6 col-lg-6 pb-4 d-flex';
    ?>
    <div class="<?php echo esc_attr( $paddle_grid ); ?>">

    <?php 
        the_post();

    /*
     * Include the Post-Type-specific template for the content.
     * If you want to override this in a child theme, then include a file
     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
     */
        get_template_part( 'template-parts/content', get_post_type() );

    ?>
    </div><!-- .col-->

<?php endwhile; ?>

</div><!-- .row --> 