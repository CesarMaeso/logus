<?php
/**
 * Logus enqueu scripts
 *
 * @package Logus
 */

/*
 * Enqueue scripts
 * 
 */
function logus_enqueue_scripts() {
	
	// logus styles
	wp_enqueue_style( 'logus-styles', get_stylesheet_uri(), array(), '1.0' );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

		
	// foundation
	wp_enqueue_script( 'what-input', get_template_directory_uri() . '/js/what-input.js', array(), null, true );	
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation.js', array('jquery'), null, true );	

	// owl.
	wp_enqueue_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.js', array( 'jquery' ), null, true );

	// logus styles
	wp_enqueue_script( 'default-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'logus_enqueue_scripts' );
