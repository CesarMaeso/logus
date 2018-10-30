<?php
/**
 * Logus template for displaying the standard Loop
 *
 * @package Logus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	
	<div class="post-cats">		
		<?php logus_cats(); ?> 
	</div>
	
	<div>
		<h3 class="post-title">
			<?php if ( is_singular() ) : 
				the_title();
			else : 
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
			endif; ?>
		</h3>
	</div>

	<?php if ( !is_page() ) : 
		logus_posted_on();
	endif; ?>

	
	<div class="post-meta">	
		<?php logus_post_meta(); ?>		
	</div>
	
	<?php 
	if (  is_singular() ) :

		$featured= logus_get_option( 'logus_blog_featured' );
		
		if ( has_post_thumbnail() && $featured && $featured != 'banner' ): ?>
			<div>
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<div class="post-content">

		<?php if ( is_category() || is_archive() || is_search() ) {
			the_excerpt();
			?><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'M&aacute;s', 'logus' ); ?></a>
		<?php 
		} else {
			the_content( esc_html__( 'Continua leyendo', 'logus' ) ); 
		} 
		
		wp_link_pages(
			array(
				'before'           => '<div class="linked-page-nav"><p>'. esc_html__( 'Este articulo tiene m&aacute;s partes: ', 'logus' ),
				'after'            => '</p></div>',
				'next_or_number'   => 'number',
				'separator'        => ' ',
				'pagelink'         => esc_html__( '&lt;%&gt;', 'logus' ),
			)
		); ?>	
	</div>
</article>
