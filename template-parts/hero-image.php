<?php
/**
 * Logus template to display hero option
 *
 * @package Logus
 */

if ( has_post_thumbnail( $post->ID ) ) : ?>
	<div class="hero-banner" data-interchange="[<?php the_post_thumbnail_url( 'featured-small' ); ?>, small], [<?php the_post_thumbnail_url( 'featured-medium' ); ?>, medium], [<?php the_post_thumbnail_url( 'featured-large' ); ?>, large], [<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, xlarge]">
	</div>
<?php endif; ?>
