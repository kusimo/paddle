<?php 
$paddle_social_footer_urls = explode( ',', get_theme_mod( 'footer_social_urls', '' ) ); 
$paddle_social_icons = paddle_generate_social_urls();

if (! empty ($paddle_social_footer_urls[0]) )  { ?>
<ul id="menu-social-items" class="footer-social">
    <?php } 


foreach( $paddle_social_footer_urls as $key => $value ) {
    if ( !empty( $value ) ) {
        $domain = str_ireplace( 'www.', '', parse_url( $value, PHP_URL_HOST ) );
        $index = array_search( strtolower( $domain ), array_column( $paddle_social_icons, 'url' ) );
        if( false !== $index ) { 
            $social_name = $paddle_social_icons[$index]['class'];
            $social_title = $paddle_social_icons[$index]['title'];
            ?>
       <li class="social-item">
                <a href="<?php echo esc_url( $value ); ?>" title="<?php esc_attr_e($social_title) ; ?>" target="_blank">
                    <span class="screen-reader-text"><?php esc_attr_e($social_name) ; ?></span>
                </a>
        </li>
        <?php 
           
        }
        else {
            $social_name = "globe";
             ?>
        <li class="social-item no-social">
            <a class="icon icon-globe" href="<?php echo esc_url( $value ); ?>" title="<?php esc_attr_e($social_title) ; ?>" target="_blank">
                <span class="screen-reader-text"><?php esc_attr_e($social_name) ; ?></span>
            </a>
        </li>
        <?php 
        }
    }
}
if (! empty ($paddle_social_footer_urls[0]) ) {
?>
</ul><!-- .footer-social -->
<?php }