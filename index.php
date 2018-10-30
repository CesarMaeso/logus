<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Logus
 */

get_header(); 
?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content">		
			<section class="page-content primary" role="main">	
				<?php 
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/loop', get_post_format() );
						wp_link_pages(
							array(
								'before'           => '<div class="linked-page-nav"><p><em>' . sprintf( esc_html__( '%s esta formado por varias partes:', 'logus' ), esc_html ( get_the_title() ) ) . '</em><br/>',
								'after'            => '</p></div>',
								'next_or_number'   => 'number',
								'separator'        => ' ',
								'pagelink'         => esc_html__( '&raquo; Part %', 'logus' ),
							)
						);
					endwhile;
				else :
		 			get_template_part( 'template-parts/loop', 'empty' ); 
				endif; ?>
			
				<div class="pagination">			
					<?php get_template_part( 'template-parts/pagination' ); ?>
				</div>
			</section>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
