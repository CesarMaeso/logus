<?php
/**
 * Custom template tags for Logus theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Logus
 */

if ( ! function_exists( 'logus_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function logus_posted_on() {
		
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		
		$posted_on = sprintf(
			esc_html_x( '%1$s / %2$s', 'post date', 'logus' ),			
			'<span class="entry-author"><a href="'. esc_url( get_the_author_link() ) . '">'. esc_html( get_the_author() ) .'</a></span>',
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo $posted_on;
	}
}


if ( ! function_exists( 'logus_post_meta' ) ) {
	/**
	 * Custom meta information for a post
	 * @return void
	 */
	function logus_post_meta() {
		
		// Hide category and tag text for pages.		
		if ( get_post_type() == 'post' ) {		

			$tags_list = get_the_tag_list( '', '&nbsp;&#183;&nbsp;' );
			if ( $tags_list ) {
				echo '<span class="entry-meta">' . $tags_list . '</span>'; 
			}
		}
		edit_post_link( esc_html__( ' (editar)', 'logus' ), '<span class="edit-link">', '</span>' );
	}
}


/**
 * Get all post categories
 */
function logus_cats() {
	
	$categories_list = get_the_category_list( '&nbsp;&#183;&nbsp;' );
	
	if ( $categories_list ) {
		echo '<span class="post-cat">' . $categories_list . '</span>'; 		
	}
}
