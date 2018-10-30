<?php
/**
 * Logus template for displaying an empty Loop
 *
 * @package Logus
 */
?>

<section class="page-content primary" role="main">	
	<div class="main-container">
		<div class="main-grid">
			<div class="main-content-full-width text-center">
				<h3 class="post-title"><?php esc_html_e('No encontrado', 'logus'); ?></h3>
				<div>
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
						<p>
							<?php esc_html_e( '&iquest;Preparado para publicar tu primer post? ', 'logus' ) ?>
								<a href="<?php echo esc_url( admin_url( 'post-new.php' ) )?>"><?php esc_html_e('Empieza ahora', 'logus' ); ?></a>
						</p>
					
					<?php elseif ( is_search() ) : ?>	
						<p>
							<?php esc_html_e( 'No he encontrado nada. Prueba con otras palabras.', 'logus' ); ?>
						</p>
						<?php get_search_form(); ?>
					
					<?php elseif ( is_404() ) : ?>
						<p>
							<?php esc_html_e( 'No he encontrado nada. Prueba a realizar una b&uacute;squeda.', 'logus' ); ?>
						</p>
						<?php get_search_form(); ?>				
					
					<?php else : ?>
						<p>
							<?php esc_html_e( 'Est&aacute; p&aacute;gina no se encuentra. Prueba a realizar una b&uacute;squeda.', 'logus' ); ?>
						</p>
						<?php get_search_form(); ?>
					<?php endif; ?>					
				</div>
			</div>
		</div>
	</div>
</section>
