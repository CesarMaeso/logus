<?php
/**
 * Logus template for displaying Pages
 *
 * @package Logus
 */

get_header(); 

$featured= logus_get_option( 'logus_blog_featured' );

if (  $featured == 'banner' ) :
	get_template_part( 'template-parts/hero-image' ); 
endif; ?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
			<section class="page-content primary" role="main">
			<?php if ( have_posts() ) : the_post();
				
				get_template_part( 'template-parts/loop' ); ?>

				<aside class="post-aside"><?php

					wp_link_pages(
						array(
							'before'           => '<div class="linked-page-nav"><p><em>' . sprintf( esc_html__( '%s esta formado por varias partes:', 'logus' ), esc_html ( get_the_title() ) ) . '</em><br/>',
							'after'            => '</p></div>',
							'next_or_number'   => 'number',
							'separator'        => ' ',
							'pagelink'         => __( '&raquo; Part %', 'logus' ),
						)
					); ?>

					<?php
						if ( comments_open() || get_comments_number() > 0 ) :
							comments_template( '', true );
						endif;
					?>

				</aside><?php

			else :				
				get_template_part( 'template-parts/loop', 'empty' );
			endif;
			?>			
			</section>
		</main>
		<?php get_sidebar(); ?>
	</div>
	<?php get_template_part( 'template-parts/banner_footer'); ?>
</div>

<?php get_footer(); ?>
