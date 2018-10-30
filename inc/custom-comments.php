<?php
/**
 * Logus comments functions and definitions 
 *
 * @package Logus
 */


/**
 * Callback to style comments in the same way as the post pagination.
 * @return void
 */
function logus_format_comment($comment, $args, $depth){  ?>    
    
    <li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
    <div class="row comment">
    	<div class="comment-img text-center">				            
            <?php                
                $avatar = get_avatar( $comment->comment_author_email, $size = '64');
                if ( $avatar !== false ) { 
                    echo $avatar; 
                } 
            ?>            
    	</div>

    	<div class="comment-text">	
            <div class="comment-intro">
                <?php echo esc_html( comment_author_link() ); ?>
                <span class="comment-date">&sol;                    
                    <?php echo esc_html( get_comment_date() ); ?>&nbsp;<small><?php echo esc_html( get_comment_time() ); ?></small>
                </span>                    
            </div>
                        
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <div>
                    <em><?php esc_html_e( 'El comentario espera moderaci&oacute;n.', 'logus' ); ?></em>
                </div>
            <?php endif; ?>

            <?php
            comment_text();

            if ( comments_open() ) : ?>
                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 
                        'depth' => $depth, 
                        'max_depth' => $args['max_depth'] 
                        ) 
                    ) ) ?>
                </div>            
            <?php endif; ?>
    	</div> <!-- .comment-text -->
    </div>
<?php
} 


