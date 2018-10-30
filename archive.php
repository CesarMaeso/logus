<?php
/**
 *  Logus template for displaying Archives
 *
 * @package Logus
 */

get_header(); ?>
	

	<div class="main-container">
		<div class="main-grid">
			<main class="main-content">		
				<section class="page-content primary" role="main">
				<?php if ( have_posts() ) : ?>
					<h1 class="archive-title">
						<?php
							if ( is_category() ) :
								printf( esc_html__( 'Categor&iacute;a: %s', 'logus' ), single_cat_title( '', false ) );

							elseif ( is_tag() ) :
								printf( esc_html__( 'Tags: %s', 'logus' ), single_tag_title( '', false ) );

							elseif ( is_tax() ):
								$term     = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
								$taxonomy = get_taxonomy( get_query_var( 'taxonomy' ) );
								printf( esc_html__( '%1$s Archivos: %2$s', 'logus' ), $taxonomy->labels->singular_name, $term->name );

							elseif ( is_day() ) :
								printf( esc_html__( 'Diario: %s', 'logus' ), get_the_date() );

							elseif ( is_month() ) :
								printf( esc_html__( 'Mensual: %s', 'logus' ), get_the_date( _x( 'F Y', 'formato de fecha mensual de archivos', 'logus' ) ) );

							elseif ( is_year() ) :
								printf( esc_html__( 'Anual: %s', 'logus' ), get_the_date( _x( 'Y', 'formato de fecha anual de archivos', 'logus' ) ) );

							elseif ( is_author() ) : the_post();
								printf( esc_html__( 'Todos los art&iacute;culos por %s', 'logus' ), esc_html( get_the_author() ) );

							else :
								esc_html_e( 'Archivo', 'logus' );

							endif;
						?>
					</h1><?php

						if ( is_category() || is_tag() || is_tax() ):

							$term_description = term_description();
							
							if ( ! empty( $term_description ) ) : ?>							
								<div class="archive-description"><?php
									echo $term_description; ?>
								</div><?php
							endif;
						endif;

						if ( is_author() && get_the_author_meta( 'description' ) ) : ?>

							<div class="archive-description">
								<?php the_author_meta( 'description' ); ?>
							</div><?php

						endif;

						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/loop' );

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
