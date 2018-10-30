<?php
/**
 * Logus template for displaying Search-Results-Pages 
 *
 * @package Logus
 */

get_header(); ?>	


<div class="main-container">
	<div class="main-grid">
		<main class="main-content">	
			<section class="page-content primary" role="main">	
			<?php if ( have_posts() ) : ?>
				<div class="row">
					<div class="small-12 columns search-title">				
						<h1 ><?php printf( esc_html__( 'Resultados de b&uacute;squeda para: %s', 'logus' ), get_search_query() ); ?></h1>
						<div class="second-search">
							<p>
								<?php esc_html_e( '&iquest;No encuentas lo que buscas? Prueba con otras palabras.', 'logus' ); ?>
							</p>
							<?php get_search_form(); ?>
						</div>
					</div>
				</div>

				<?php while ( have_posts() ) : the_post();			

					get_template_part( 'template-parts/loop', get_post_format() );

					wp_link_pages(
						array(
							'before'           => '<div class="linked-page-nav"><p><em>' . sprintf( esc_html__( '%s esta formado por varias partes:', 'logus' ), esc_html ( get_the_title() ) ) . '</em><br/>',
							'after'            => '</p></div>',
							'next_or_number'   => 'number',
							'separator'        => ' ',
							'pagelink'         => __( '&raquo; Part %', 'logus' ),
						)
					);				

				endwhile;
			else :
				get_template_part( 'template-parts/loop', 'empty' );
			endif; ?>

				<div class="pagination">			
					<?php get_template_part( 'template-parts/pagination'); ?>
				</div>		
			</section>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>


<?php get_footer(); ?>
