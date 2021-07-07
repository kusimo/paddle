<?php

/**
 * Template Name: Full Width No Title
 * The template for displaying full width page with no padding
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package paddle
 */

defined('ABSPATH') || exit;  // Exit if accessed directly.

get_header();

?>

<div id="primary" class="content-area col-sm-12 col-lg-12">
    <main class="site-main full-width-content">

        <?php
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content', get_post_type());

            if (!is_page()) :
                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'paddle') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'paddle') . '</span> <span class="nav-title">%title</span>',
                    )
                );
            endif;


            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary-->

<?php
//get_sidebar();
get_footer();