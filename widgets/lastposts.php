<?php
/**
 * Widget to show Last posts
 *
 * @package Logus
 *	
 */
				
       
/**
 *  Logus Lastposts widget
 *
 * @since  0.0.0
 */
class Logus_Lastposts extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'logus_lastposts_widget',
			'description' => esc_html__( 'Muestra una secci&oacute;n con los art&iacute;culos recientes.', 'logus' )
		);
	    parent::__construct(false, $name = esc_html__( 'Logus - Art&iacute;culos recientes', 'logus' ), $widget_ops);
		$this->alt_option_name = 'logus_lastposts_widget';
	}

	/**
 	 *  widget 
 	 *
 	 * @since  0.0.0
 	 * @link https://developer.wordpress.org/reference/classes/wp_widget/
 	 */
	function widget($args, $instance) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ?  esc_html__( 'Blog', 'logus' ) : $instance['title'], $instance, $this->id_base );
		$desc = apply_filters( 'widget_title', empty( $instance['desc'] ) ? '' : $instance['desc'], $instance, $this->id_base );
		
		echo $args['before_widget'];

    	$query = new WP_Query( array (
    		'posts_per_page' 	=> 8, 
        	'post_type' 		=> array( "post" ),
        	'post_status'       => 'publish',
    	) );

		if ( $query->have_posts() ) : ?>

			<div class="clear"></div>
			<section id="blog" class="blog">

				<div class="separator"></div>

				<!-- blog title and desc -->
 				<div class="row align-center">			
					<div class="blog-header text-center">
						<?php echo $args['before_title'] ?><h3 class="title"><?php echo esc_html( $title ); ?></h3><?php echo $args['after_title']; ?>
					</div>
				
					<?php if (! empty( $desc) ) : ?>
						<div class="blog-header text-center">	
							<p class="txt"><?php echo esc_html( $desc ); ?></p>
						</div>		
					<?php endif; ?>

				</div>
				<div class="separator"></div>

				<!-- brands loop -->
				<div class="row align-spaced icons-services">						
					<?php while ( $query->have_posts() ) : $query->the_post();
						global $post;																
						$post_id = get_the_ID(); ?>
								
						<div class="blog-wrap icons text-center">
									
							<div class="image-hover-wrapper">										
								<?php if ( has_post_thumbnail() ): ?>
  									<a href="<?php echo esc_url( get_permalink() ); ?>">
										<img alt="<?php the_title_attribute() ; ?>" src="<?php echo esc_url( get_the_post_thumbnail_url( $post_id ) ); ?>">
  									  	<span class="image-hover-wrapper-reveal"></span>
  									</a>
  								<?php endif ?>								
							</div>	
									

							<!-- title and excerpt -->
							<div class="txt-events">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>">
									<h4 class="title"><?php the_title(); ?></h4>											
								</a>
								<?php edit_post_link( esc_html__( ' (editar)', 'logus' ), '<span class="edit-link">', '</span>' );  ?>
						 		<div class="txt">
						 			<?php the_excerpt(); ?>
						 		</div>
							</div>
						</div>
					<?php endwhile; ?>
	
						
				</div>		
			</section> <!-- /.blog -->
		<?php endif; ?>	

		<?php
		echo $args['after_widget'];		
	}


	/**
 	 *  widget update
 	 *
 	 * @since  0.0.0
 	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['desc'] = strip_tags( stripslashes( $new_instance['desc'] ) );

		return $instance;
	}

	/**
 	 *  widget form
 	 *
 	 * @since  0.0.0
 	 */
	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$desc = isset( $instance['desc'] ) ? esc_attr( $instance['desc'] ) : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ) ; ?>"><?php esc_html_e('Titulo:', 'logus'); ?></label>
			<input 	type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php $this->get_field_id( 'desc' ); ?>"><?php esc_html_e( 'Subtitulo:', 'logus' ); ?></label>
			<input 	type="text" class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo $desc; ?>" />
		</p>
		<p>
			<span style="text-decoration: none" class="dashicons dashicons-editor-help"></span>
			<?php esc_html_e('Muestra los &uacute;ltimos art&iacute;culos.', 'logus'); ?>
		</p>

<?php
	}
}
