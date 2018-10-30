<?php
/**
 * Logus template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Logus
 */
?>		
		<div id="footer-wrapper">
			<!-- footer widgets -->
			<footer class="footer-nav">
				<div class="row align-spaced info">
					<div class="footer-sidebar">
						<?php if ( is_active_sidebar( 'left-footer-sidebar' ) ) : ?>
							<ul>
								<?php if ( function_exists( 'dynamic_sidebar' ) ) :
									dynamic_sidebar( 'left-footer-sidebar' );
								endif; ?>
							</ul>
						<?php endif; ?>
					</div>
					<div class="footer-sidebar">						
						<?php if ( is_active_sidebar( 'center-footer-sidebar' ) ) : ?>
							<ul>
								<?php if ( function_exists( 'dynamic_sidebar' ) ) :
									dynamic_sidebar( 'center-footer-sidebar' );
								endif; ?>
							</ul>
						<?php elseif ( has_custom_logo() ) :
    						the_custom_logo();
						endif; ?>
					</div>
					<div class="footer-sidebar">
						<?php if ( is_active_sidebar( 'right-footer-sidebar' ) ) : ?>
							<ul>
								<?php if ( function_exists( 'dynamic_sidebar' ) ) :
									dynamic_sidebar( 'right-footer-sidebar' );
								endif; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			</footer>
			
			<!-- credits -->
			<div class="row expanded links">
		  		<div class="columns logo shrink">
		  			<?php if ( has_custom_logo() ) :
    					the_custom_logo();
					else : ?>
		  				<h4><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h4>
		  			<?php endif; ?>
		  		</div>
		  		
		  		<div class="columns text-center hide-for-small-only">
		  			<?php do_action( 'logus_footer' ); ?>		  			
		  		</div>		  		
			</div>
		</div> <!-- #footer-wrapper -->				
    </div> <!-- .off-canvas-wrapper -->
</div> <!-- .site -->

<?php wp_footer(); ?>			
</body>
</html>
