<?php
/**
 * Social Widget
 * This widget will display the icons of social networks. You have to associate a menu that has links to each social network.
 * For now it is compatible with facebook and twitter.
 */

/**
 * Custom output for social Nav Menu
 *
 */
class Logus_Social_Walker extends Walker_Nav_Menu
{
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array|object $args    Additional strings. Actually always an 
                                     instance of stdClass. But this is WordPress.
     * @return void
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {

        $object= $item->object;
        $url= wp_parse_url($item->url);
        if (!$url || !isset( $url['host'] ) ) {
        	return;
        }
        
		$social_sites = array(
			'twitter', 
			'facebook',
			'github',
			'instagram',
			'skype',
			'vimeo',
			'youtube'
		);
			
		// Determine if social site is allowed		
		// Social icon is based in social hostname. 
		$social_site= '';
        $tok= strtok( $url['host'], '.' );

        while ($tok !== false) {
			if ( in_array( $tok, $social_sites ) ) {
				$social_site= $tok;
			}
			$tok = strtok( '.' );
		}

		if ( !empty( $social_site ) ) : ?> 
			<a href="<?php echo esc_url( $item->url )?>" target="_blank" rel="nofollow">
				<i class="logus-icon fi-social-<?php echo esc_attr( $social_site ); ?>"></i>				
			</a>			
        <?php endif; 
    }
}


/**
 *  Social Widget
 *
 */
class Logus_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => esc_html__('Muestra tus redes sociales', 'logus') );
		parent::__construct( 'fp_social', esc_html__('Logus - Menu de Redes Sociales', 'logus'), $widget_ops );
	}


	/**
 	 *  Social Widget 
 	 *
 	 * @link https://developer.wordpress.org/reference/classes/wp_widget/
 	 */
	function widget($args, $instance) {

		// Get menu		
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;		
		if ( !$nav_menu )
			return;		

		echo $args['before_widget'];
		?>

			<div class="columns shrink top-socialmedia-icons text-right">
				<?php 
					wp_nav_menu(
						array(
							'menu' => $nav_menu,
							'container' => 'div',
							'container_class' => 'columns shrink top-socialmedia-icons hide-for-large-only',
							'depth' => 1,
							'walker' => new Logus_Social_Walker,
							'items_wrap' => '',
						)										
					);
				?>	
			</div>
		<?php
		echo $args['after_widget'];		
	}


	/**
 	 *  Social widget update
 	 *
 	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}

	/**
 	 *  Social widget form
 	 *
 	 */
	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		$menus = wp_get_nav_menus( );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Nombre:', 'logus' ) ?></label>
			<input 	type="text" 
					class="widefat" 
					id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
					name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
					value="<?php echo esc_attr( $title ); ?>"/>
		</p>		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>"><?php esc_html_e( 'Menu', 'logus' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'nav_menu' ) ); ?>" 
					name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
				<option value="0"><?php esc_html_e( '&mdash; Selecciona &mdash;', 'logus' ) ?></option>
		<?php
			foreach ( $menus as $menu ) {
				printf('<option value="%s" %s>%s</option>', 
					esc_attr( $menu->term_id ), 
					($menu->term_id==$nav_menu)?'selected':'',
					esc_html( $menu->name) 
				);
			}
		?>
			</select>
		</p>
		<p>
			<span style="text-decoration: none" class="dashicons dashicons-editor-help"></span>
				<?php esc_html_e( 'Para mostrar los iconos de redes sociales, asocia un menu que tenga enlaces a cada red social.', 'logus' ); ?>
		</p>

		<?php
	}
}
