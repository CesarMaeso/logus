<?php
/**
 * Logus template for displaying Single-Posts
 *
 * @package Logus
 */

get_header(); 

$featured= logus_get_option( 'logus_blog_featured' );

if (  $featured == 'banner' ) {
	get_template_part( 'template-parts/hero-image' ); 
} ?>


<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
			<section class="page-content primary" role="main">	
				<?php if ( have_posts() ) : the_post();
					
					get_template_part( 'template-parts/loop', get_post_format() ); ?>
					
					<!-- display post links and comments -->
					<aside class="post-aside" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						<div class="row">
							<div class="small-12 large-8 columns icons">
								<div class="post-links">
									<ul class="pagination-pointed pagination text-center">
										<li><?php previous_post_link( '%link', esc_html__( 'Anterior', 'logus' ) ); ?></li>
										<li><?php next_post_link( '%link', esc_html__( 'Siguiente', 'logus' ) ); ?></li>
									</ul>
								</div>
							</div>
						</div>
		
						<?php
							if ( comments_open() || get_comments_number() > 0 ) :
								comments_template( '', true );
							endif;
						?>				
					</aside>

				<?php else :							
					get_template_part( 'template-parts/loop', 'empty' );
				endif; ?>
			</section>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
