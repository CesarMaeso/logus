<?php
/**
 * Logus Services Widget
 *
 * Support for Logus Toolbox lt-services CPT. This requires the Logus Toolbox plugin to be installed.
 *
 * @link https://wordpress.org/plugins/logus-toolbox/
 * @package Logus
 *	
 */
				
       
/**
 *  Logus Services Widget
 *
 */
class Logus_Services extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'logus_services_widget',
			'description' => esc_html__( 'Muestra una secci&oacute;n con tus servicios.', 'logus' )
		);
	    parent::__construct(false, $name = esc_html__( 'Logus - Servicios', 'logus' ), $widget_ops);
		$this->alt_option_name = 'logus_services_widget';
	}

	/**
 	 *  widget 
 	 *
 	 * @link https://developer.wordpress.org/reference/classes/wp_widget/
 	 */
	function widget($args, $instance) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$desc = apply_filters( 'widget_title', empty( $instance['desc'] ) ? '' : $instance['desc'], $instance, $this->id_base );
		
		echo $args['before_widget'];

    	$query = new WP_Query( array (
    	 'post_type' => array( "lt-services" ),
    	 'posts_per_page' => 4,
    	 'post_status'    => 'publish',
    	) );

		if ( $query->have_posts() ) : ?>

			<div class="clear"></div>
			<section id="services" class="services">

				<div class="separator"></div>

				<!-- services title and desc -->
 				<div class="row align-center">			
 					<?php if (! empty( $title) ) : ?>
						<div class="services-text text-center">
							<?php echo $args['before_title'] ?><h3 class="title"><?php echo esc_html( $title ); ?></h3><?php echo $args['after_title']; ?>
						</div>
					<?php endif; ?>
					<?php if (! empty( $desc) ) : ?>
						<div class="services-text text-center">	
							<p class="txt"><?php echo esc_html( $desc ); ?></p>
						</div>		
					<?php endif; ?>
				</div>
				<div class="separator"></div>

				<!-- loop services -->
				<div class="row align-spaced icons-services">
					
					<?php while ( $query->have_posts() ) : $query->the_post();									
						global $post;			
						$post_id = get_the_ID(); ?>						
						<div class="services-wrap icons text-center">
							<?php if ( has_post_thumbnail() ): ?>
								<div class="image-hover-wrapper">									
  									<a href="<?php echo esc_url( get_permalink() ); ?>">  										
  										<img alt="<?php the_title_attribute() ; ?>" src="<?php echo esc_url( get_the_post_thumbnail_url( $post_id ) ); ?>">
  									  <span class="image-hover-wrapper-reveal"></span>
  									</a>
								</div>								
							<?php endif; ?>
										
							<!-- title -->
							<div class="txt-events columns">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>">
									<h4 class="title"><?php the_title(); ?></h4>
								</a>
								<?php edit_post_link( esc_html__( ' (editar)', 'logus' ), '<span class="edit-link">', '</span>' );  ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>		
			</section> <!-- .#services -->
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
			<?php esc_html_e('Muestra un listado de servicios', 'logus'); ?>
		</p>

<?php
	}
}
