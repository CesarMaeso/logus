<?php
/**
 * Logus template for dynamic styles
 *
 * @package Logus
 */

/**
 * Logus dynamic styles
 *
 */
function logus_custom_styles($custom) {
	
	// custom background image hero 
	$custom= '';
	$header_image= get_header_image();

	if ( $header_image ) {
		$custom .= "#header { background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.25)), -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.05) 25%, rgba(0, 0, 0, 0.45) 75%, rgba(0, 0, 0, 0.25) 100%), url(" . esc_url( $header_image ) . "); } \n";
		$custom .= "#header { background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.25)), linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.05) 25%, rgba(0, 0, 0, 0.45) 75%, rgba(0, 0, 0, 0.25) 100%), (" . esc_url( $header_image ) . "); } \n";
	}
	
	// custom header textcolor
	$header_text_color = get_header_textcolor();

	// Has the text been hidden?
	if ( $header_text_color && 'blank' !== $header_text_color ) {
		$custom .= "#header .intro h2, #header .intro p, #header .intro .button { color: #" . esc_attr( $header_text_color ) . "; } \n";
		$custom .= "#header .intro .button { border-color: #" . esc_attr( $header_text_color ) . "; } \n";
		$custom .= ".logus-icon { color: #" . esc_attr( $header_text_color ) . "; }\n";
		$custom .= "#header .site-title a { color: #" . esc_attr( $header_text_color ) . "; }\n";
		$custom .= "#header .intro .header-text a, #header .intro .header-text a:hover { color: #" . esc_attr( $header_text_color ) . "; }\n";
	}

	// get default values to compare with theme_mod value
	$defaults= logus_get_option_defaults();	
	
	// primary color
	$primary_color= logus_get_option( 'logus_primary_color' );
	if ($primary_color != $defaults[ 'logus_primary_color' ]){
		$custom .= "h3.title::before, #blog h4.title::before, .post-meta::before { border-top: 3px solid " . esc_attr( $primary_color ) . "; }\n";
		$custom .= ".pagination-pointed .current { background: " . esc_attr( $primary_color ) . "; }\n";
		$custom .= "a, a:hover {color: " . esc_attr( $primary_color ) . "; }\n";
	}

	// menu color
	$menu_color= logus_get_option( 'logus_menu_color' );
	if ($menu_color != $defaults[ 'logus_menu_color' ]){
		$custom .= ".title-bar-right nav ul li a {color: " . esc_attr( $menu_color ) . "; }\n";
		$custom .= ".dropdown.menu .is-active > a {color: " . esc_attr( $menu_color ) . "; }\n";
		$custom .= ".dropdown.menu > li.is-dropdown-submenu-parent > a::after {border-color: " . esc_attr( $menu_color ) . " transparent transparent; }\n";
	}

	// cta color
	$cta_color= logus_get_option( 'logus_cta_color' );
	if ( $cta_color != $defaults[ 'logus_cta_color' ] ) {
		$custom .= "#header .cta h2, #header .cta p, #header .cta .button { color: " . esc_attr( $cta_color ) . "; } \n";
		$custom .= "#header .cta .button { border-color: " . esc_attr( $cta_color ) . "; } \n";
		$custom .= "#header .cta .header-text a, #header .cta .header-text a:hover { color: " . esc_attr( $cta_color ) . "; }\n";
	}

	// header height
	$header_height= logus_get_option( 'logus_header_height' );
	if ($header_height > 0 && $header_height != $defaults[ 'logus_header_height' ]){
		$custom .= ".front-page {min-height: " . esc_attr( $header_height ) . "px; }\n";
	}
	wp_add_inline_style( 'logus-styles', $custom );	
}
add_action( 'wp_enqueue_scripts', 'logus_custom_styles' );
