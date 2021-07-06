<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paddle
 */

?>



</div><!-- .row -->
</div><!-- .container -->
</div><!-- #content -->

<!-- Search Modal -->
<?php
$paddle_search_modal = new PaddleMenu();
if ( $paddle_search_modal->isSearchEnable() ) {
	do_action( 'paddle_action_search_modal' );
}
?>

<div class="clearfix"></div>


<footer id="paddle-footer-colophon" class="site-footer">

	<?php
	/**
	 * Widgets Sidbar
	 */
	if ( is_active_sidebar( 'footer-1' ) ||
		is_active_sidebar( 'footer-2' ) ||
		is_active_sidebar( 'footer-3' ) ||
		is_active_sidebar( 'footer-4' ) ||
		is_active_sidebar( 'footer-5' ) ||
		1 === get_theme_mod( 'paddle_footer_logo', 0 )
		) :

		get_template_part( 'template-parts/footer/widgets' );

	endif;
	?>

	<div class="site-info">
		<div class="container py-3 text-center">
			<?php
			/**
			 * Hook - paddle_action_footer.
			 *
			 * @hooked paddle_footer_copyrights - 10
			 */
			do_action( 'paddle_action_footer' );
			?>
		</div><!-- .container -->
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>

</body>

</html>
