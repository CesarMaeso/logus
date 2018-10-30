<?php
/**
 *  Logus credits
 *
 * @package Logus
 */

function logus_footer_credits() {
             
	$credits= logus_get_option( 'logus_credits' );
	if ( $credits ) : ?>
		<p>			
			<?php echo esc_html( $credits ); ?>
		</p>
	<?php endif; ?>
	<p class="text-right">
		<small>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'logus' ) ); ?>"><?php printf( esc_html__( 'Creado con WordPress', 'logus' ) ); ?></a>
			<span> | </span>
			<?php printf( esc_html__( 'Tema %1$s por ', 'logus' ), 'Logus' ); ?>
			<a href="<?php echo esc_url( "https://superadmin.es/" ); ?>" rel="nofollow" target="_blank"><?php esc_html_e( "Superadmin", 'logus'); ?></a>
		</small>
	</p>
<?php }
add_action( 'logus_footer', 'logus_footer_credits' );
