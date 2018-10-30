<?php
/**
 * Logus Brands Widget
 *
 * Support for Logus Toolbox lt-brands CPT. This requires the Logus Toolbox plugin to be installed.
 *
 * @link https://wordpress.org/plugins/logus-toolbox/
 * @package Logus
 *	
 */
				
       
/**
 *  Logus Brands Widget
 *
 */
class Logus_Brands extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'logus_brands_widget',
			'description' => esc_html__( 'Muestra una lista de marcas colaboradoras.', 'logus' )
		);
	    parent::__construct(false, $name = esc_html__( 'Logus - Marcas', 'logus' ), $widget_ops);
		$this->alt_option_name = 'logus_brands_widget';
	}

	/**
 	 *  widget 
 	 *
 	 * @link https://developer.wordpress.org/reference/classes/wp_widget/
 	 */
	function widget($args, $instance) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ?  esc_html__( 'Marcas colaboradoras', 'logus' ) : $instance['title'], $instance, $this->id_base );
		$desc = apply_filters( 'widget_title', empty( $instance['desc'] ) ? '' : $instance['desc'], $instance, $this->id_base );
		
		echo $args['before_widget'];

    	$query = new WP_Query( array (
    		'posts_per_page' 	=> 5, 
        	'post_type' 		=> array( "lt-brands" ),
        	'post_status'       => 'publish',
    	) );

		if ( $query->have_posts() ) : ?>

			<div class="clear"></div>
			<section id="brands" class="brands">

				<div class="separator"></div>

				<!-- services title and desc -->
 				<div class="row align-center">			
					<div class="brands-header text-center">
						<?php echo $args['before_title'] ?><h3 class="title"><?php echo esc_html( $title ); ?></h3><?php echo $args['after_title']; ?>
					</div>
				
					<?php if (! empty( $desc) ) : ?>
						<div class="brands-header text-center">	
							<p class="txt"><?php echo esc_html( $desc ); ?></p>
						</div>		
					<?php endif; ?>
				</div>
				<div class="separator"></div>

				<!-- brands loop -->
				<div class="row align-spaced icons-brands">						
					<?php while ( $query->have_posts() ) : $query->the_post();
						global $post;									
						$post_id = get_the_ID();								
						if ( has_post_thumbnail() ): ?>
							<div class="brands-wrap text-center">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" target="_blank">
									<img alt="<?php the_title_attribute() ; ?>" src="<?php echo esc_url( get_the_post_thumbnail_url( $post_id ) ); ?>">
								</a>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			</section> <!-- .#brands -->
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
			<?php esc_html_e('Muestra un listado de marcas colaboradoras', 'logus'); ?>
		</p>

<?php
	}
}
