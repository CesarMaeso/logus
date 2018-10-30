<?php
/**
 * Custom Nav Menu
 *
 * @package Logus
 */


/*
  * Register logus menu
  */
register_nav_menus( array(
	'menu-header' => esc_html__( 'Menu en el Header', 'logus' ),
	)
);


/**
 * Walker to add data-toggle attribute
 * 
 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/
 */
class Logus_Nav_Header_Walker extends Walker_Nav_Menu {

	/* 
	 *  Starts the list before the elements are added.	 
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown menu vertical\" data-toggle>\n";
	}
}

