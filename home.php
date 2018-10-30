<?php
/**
 * Logus template for displaying the Front-Page
 *
 * @package Logus
 */

get_header(); 
?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
			<section class="page-content primary" role="main">
				<?php if ( have_posts() ) : 				
					while ( have_posts() ) : the_post();  
						get_template_part( 'template-parts/loop' ); 
					endwhile; ?>										
					<?php
						/* pagination */
						the_posts_pagination( array(
							'mid_size'  => 1,
						) ); ?>

				<?php else : ?>  
					<?php
						/* no content */
						get_template_part( 'content', 'none' ); ?>  
				<?php endif; ?>

			</section>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_template_part( 'template-parts/banner_footer' ); ?> 
<?php get_footer(); ?>
