<?php
/**
 * Banner in the footer
 *
 * @package Logus
 */
	
$banner_footer= logus_get_option( 'logus_banner_footer' );

if ( $banner_footer && !empty( $banner_footer ) ) : ?>	
	<div class="row expanded-menu align-center background-image-brand">
		<div>			
			<img class="image-brand" alt="brand" src="<?php echo esc_url( $banner_footer ); ?>">
				 
			<!-- watermark -->				
			<?php if ( has_custom_logo() ) :
				
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$url = wp_get_attachment_image_src( $custom_logo_id , 'full' );							
				
				if ( !empty( $url ) ) : ?>
					<img alt="watermark" class="logo-image-brand" src="<?php echo esc_url( $url[0] ); ?>">
				<?php endif; ?>				
			<?php endif; ?>			
		</div>
	</div>
<?php endif; ?>
