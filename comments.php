<?php
/**
 *  Logus template for generating comments
 *
 * @package Logus
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments">
	<?php if ( have_comments() || comments_open() ) { ?>
		
		<div class="row align-left">		
			<h2 class="comments-title">
				<?php 
					printf(
						esc_html( _n( '%1$s Comentario', '%1$s Comentarios', get_comments_number(), 'logus' ) ),
						number_format_i18n( get_comments_number() )
					);				
				?>
			</h2>

			<?php 
			if ( get_comment_pages_count() > 1 ) : ?>
				<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php esc_html_e( 'Comentarios', 'logus' ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Anteriores', 'logus' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Siguientes &rarr;', 'logus' ) ); ?></div>
				</nav>
			<?php endif; ?>			
		</div>

		
		<ul class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'    => 'ul',
						'callback' => 'logus_format_comment',
					)
				);
			?>
		</ul><!-- .comment-list -->
	
		<div class="row align-left">
			<?php if ( get_comment_pages_count() > 1 ) : ?>
				<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
					<h1 class="screen-reader-text"><?php esc_html_e( 'Navegaci&oacute;n por comentarios', 'logus' ); ?></h1>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Anteriores', 'logus' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'M&aacute;s &rarr;', 'logus' ) ); ?></div>
				</nav>
			<?php endif; ?>	
		</div>
	<?php } // end if
	
	if ( ! comments_open() ) { ?>
		<p class="no-comments"><?php esc_html_e( 'Los comentarios est&aacute;n cerrados.', 'logus' ); ?></p>
	<?php } ?>

	<div class="row align-left">		
	<?php 
		$args = array( 'comment_notes_after'  => '' );
		comment_form( $args );
	?>
	</div>	
</div> <!-- #comments -->	
