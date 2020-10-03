<?php
/**
 * Displays footer widgets if assigned
 *
 * @package paddle
 */

?>
<?php 
	$paddle_column_count = 0;
	for ( $i = 1; $i <= 4; $i++ ) {
	if ( is_active_sidebar( 'footer-' . $i ) ) {
		$paddle_column_count++;
		}
	}
?>

<div class="footer-widgets">
    <div class="container">
        <div class="row">
            <?php
                for ( $i = 1; $i <= 4 ; $i++ ) {
                    if ( is_active_sidebar( 'footer-' . $i ) ) {
                
                    if( 1 === $paddle_column_count ) {
                         $paddle_size = '12';
                        }
                        elseif( 2 === $paddle_column_count) {
                            $paddle_size = '6';
                        }
                        elseif( 3 === $paddle_column_count ) {
                            $paddle_size = '4';
                        }
                        else{
                            $paddle_size = '3';
                        }
                ?>
                <div class="col-lg-<?php echo esc_attr( $paddle_size ); ?> col-md-<?php if( '3' === $paddle_size ): echo esc_attr( '6' ); elseif( '4' === $paddle_size ): 
				echo esc_attr('4'); else : echo esc_attr( $paddle_size ) ; endif ;?> ">
                    <div class="footer-column footer-active-<?php echo esc_attr( $paddle_column_count );?>" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'paddle' ); ?>">
                            
                        <?php dynamic_sidebar( 'footer-' . $i ); ?>
                               
                    </div>
                 </div>
                 <?php
                    }
                }
            ?>
        </div>
    </div>
</div>

<hr />	 