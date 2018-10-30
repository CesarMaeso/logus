<?php
/**
 * Logus Portfolio Widget
 *
 * Support for Logus Toolbox lt-portfolio CPT. This requires the Logus Toolbox plugin to be installed.
 *
 * @link https://wordpress.org/plugins/logus-toolbox/
 * @package Logus
 *	
 */
				
       
/**
 *  Logus Portfolio Widget
 *
 */
class Logus_Portfolio extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'logus_portfolio_widget',
			'description' => esc_html__( 'Muestra un portafolio con tus &uacute;ltimos trabajos.', 'logus' )
		);
	    parent::__construct(false, $name = esc_html__( 'Logus - Portafolio', 'logus' ), $widget_ops);
		$this->alt_option_name = 'logus_portfolio_widget';
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
    	 'post_type' => array( "lt-portfolio" ),
    	 'posts_per_page' => 7,
    	 'post_status'    => 'publish',
    	) );

		if ( $query->have_posts() ) : ?>

			<section id="portfolio" class="our-work">
						
				<!-- portfolio title and desc -->
		 		<div class="row align-center">
		 			<?php if (! empty( $title) ) : ?>
						<div class="portfolio-header text-center">
							<h3 class="title"><?php echo esc_html( $title ); ?></h3>
						</div>
					<?php endif; ?>
					<?php if (! empty( $desc) ) : ?>
						<div class="portfolio-header text-center">	
							<p class="txt"><?php echo esc_html( $desc ); ?>
						</div>			
					<?php endif; ?>		
				</div>
				<div class="separator"></div>

				<!-- loop portfolio -->
				<div class="portfolio grid"> 				
 					<div class="grid-sizer"></div>
				
					<?php while ( $query->have_posts() ) : $query->the_post();
						global $post;
						$post_id = get_the_ID();
						if ( has_post_thumbnail() ) : 
							$img= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' ); 
							$img_class= ( $img[1]/$img[2] > 2 )?" grid-item--width2":"";
							?>
					
							<div class="grid-item <?php echo esc_attr( $img_class ) ?>">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>">										
									<img class="grid-img" alt="<?php the_title_attribute() ; ?>" src="<?php echo esc_url( get_the_post_thumbnail_url( $post_id ) ); ?>">
									<div class="box">
										<div class="layer"></div>
										<div class="content-wrapper">
		  									<?php													
												if ( has_custom_logo() ) {
    												echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' );
												}
											?>
										</div>
									</div>
								</a>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>				
				</div>						
			</section> <!-- .#portfolio -->
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
			<?php esc_html_e('Muestra la secci&oacute;n de portafolio', 'logus'); ?>
		</p>

<?php
	}
}
