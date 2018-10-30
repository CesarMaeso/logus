<?php
/*
Template Name: P&aacute;gina de Inicio
*/

get_header(); ?>

<div id="main-wrapper">
	<?php if ( have_posts() ) :    
		while ( have_posts() ) : the_post(); 
			the_content(); 
		endwhile; 
	endif; ?>
		
	<?php get_template_part( 'template-parts/banner_footer'); ?>
</div>

<?php get_footer(); ?>
