<?php
/**
 * Logus template for generating pagination
 *
 * @package Logus
 */

	the_posts_pagination( array(
		'mid_size'  => 4,
		'prev_text' => __('Anterior', 'logus'),
		'next_text' => __('Siguiente', 'logus'),
	) );
	
?>
						