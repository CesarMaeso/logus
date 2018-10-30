<?php
/**
 * Logus Testimonies Widget
 *
 * Support for Logus Toolbox lt-testimonies CPT. This requires the Logus Toolbox plugin to be installed.
 * 
 * @link https://wordpress.org/plugins/logus-toolbox/
 * @package Logus
 *	
 */
				
       
/**
 *  Logus Services Widget
 *
 */
class Logus_Testimonies extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'logus_testimonies_widget',
			'description' => esc_html__( 'Muestra una secci&oacute;n con testimonios.', 'logus' )
		);
	    parent::__construct(false, $name = esc_html__('Logus - Testimonios', 'logus'), $widget_ops);
		$this->alt_option_name = 'logus_testimonies_widget';
	}

	/**
 	 *  widget 
 	 *
 	 * @link https://developer.wordpress.org/reference/classes/wp_widget/
 	 */
	function widget($args, $instance) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Testimonios', 'logus' ) : $instance['title'], $instance, $this->id_base );
		$desc = apply_filters( 'widget_title', empty( $instance['desc'] ) ? '' : $instance['desc'], $instance, $this->id_base );
		
		echo $args['before_widget'];

    	$query = new WP_Query( array (
    		'post_type' => array( "lt-testimonies" ),
    	) );

		if ( $query->have_posts() ) : ?>

			<div class="clear"></div>
			<section id="testimonials" class="testimonials">

				<!-- testimonies title -->
		 		<div class="row align-center">
		 			
					<div class="testimonials-title text-center">
						<h3 class="title"><?php echo esc_html( $title ); ?></h3><?php echo $args['after_title']; ?>
					</div>
					
					<?php if (! empty( $desc) ) : ?>
					<div class="testimonials-title text-center">	
						<p class="txt"><?php echo esc_html( $desc ); ?></p>
					</div>
					<?php endif; ?>		
					
					<div class="clear"></div>
					
					<!-- testimonies loop -->
					<div class="owl-carousel">
						<?php while ( $query->have_posts() ) : $query->the_post();
							global $post;
							$post_id = get_the_ID();
							$workposition = get_post_meta( $post_id, 'logus-testimonial-workposition', true );

							if ( has_post_thumbnail() ) : ?>										
								<div class="row align-center">											
									<div class="testimonials-wrap text-center">
										<!-- profile -->
										<div class="profile">
											<div class="img-testimonial-wrap">
												<!-- alt attribute need to be blank -->
												<img class="img-testimonial" alt="" src="#" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( $post_id ) ); ?> );">
											</div>
										</div>
											
										<div class="name"><span><?php the_title(); ?></span></div>												
										<div class="workposition"><?php echo esc_html( $workposition ); ?></div>				
										<div class="claim-testimonial">	
											<div><?php the_excerpt(); ?></div>
										</div>
										<?php edit_post_link( esc_html__( ' (editar)', 'logus' ), '<span class="edit-link">', '</span>' );  ?>
									</div>				
								</div>
							<?php endif; ?>
						<?php endwhile; ?>		
					</div>
				</div>
			</section> <!-- .#testimonials -->
	<?php endif; ?>

	<?php
		echo $args['after_widget'];		
	}


	/**
 	 *  widget update
 	 *
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
			<?php esc_html_e('Muestra la secci&oacute;n de testimonios', 'logus'); ?>
		</p>

<?php
	}
}
