<?php
/**
 * Logus functions and definitions
 *
 * @package Logus
 */


if ( ! function_exists( 'logus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function logus_setup(){

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'logus', get_template_directory() . '/languages' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );


	/*
	 * Set the maximum pixels allowed width for any content in the theme, 
	 * like oEmbeds and images added to posts.
     *
	 * @link https://codex.wordpress.org/Content_Width
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170; 
	}


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	/* 
	 * Adds RSS feed links to HTML <head>.
	 *
	 * @link https://codex.wordpress.org/Automatic_Feed_Links
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Custom header is an image that is chosen as the representative image 
	 * in the theme top header section.
	 * 
	 * @link https://codex.wordpress.org/Custom_Headers
 	 */
	$custom_header_args = array(
		'default-image' => get_template_directory_uri() . '/images/logus/header.jpg',
		'width'         => 1350,
		'height'        => 700,		
	);	
 	add_theme_support( 'custom-header', apply_filters( 'logus_custom_header_args', $custom_header_args ) );

	/*
	 * Allows to apply HTML5 markup for search forms, comment forms, comment lists,
	 * gallery and caption.
	 * 
	 * @link https://codex.wordpress.org/Theme_Markup
	 */
	$html5_args= array(
		'search-form', 
		'comment-form', 
		'comment-list', 
		'gallery', 
		'caption',
	);
	add_theme_support( 'html5', $html5_args );

	/*
	 * Enable custom logo
	 *
	 * @link https://developer.wordpress.org/themes/functionality/custom-logo/
	 */
	$custom_logo_args = array(
        'height'      => 65,
        'width'       => 65,
        'flex-height' => false,
        'flex-width'  => false,        
    );
	add_theme_support( 'custom-logo', $custom_logo_args );

	/* 
	 * Set up the WordPress core custom background feature.
	 * 
	 * @link https://codex.wordpress.org/Custom_Backgrounds
	 */
	$custom_background_args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $custom_background_args );	

} 	
endif; // logus_setup
add_action( 'after_setup_theme', 'logus_setup' );


/**
 * Register widget and sidebar areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function logus_widgets_init() {

     // Sidebar sidebar
    register_sidebar(
		array(
			'id' 			=> 'sidebar-widgets',
			'name' 			=> esc_html__( 'Barra Lateral', 'logus' ),
			'description' 	=> esc_html__( 'Aparecen en la barra lateral', 'logus' )
		)
	);

     // Home sidebar
    register_sidebar(
		array(
			'id' 			=> 'home-sidebar',
			'name' 			=> esc_html__( 'Inicio', 'logus' ),
			'description' 	=> esc_html__( 'Aparecen en la p&aacute;gina de inicio', 'logus' )
		)
	);

	// footer sidebar (left position)
	register_sidebar(
		array(
			'id' 			=> 'left-footer-sidebar',
			'name' 			=> esc_html__( 'Pie de P&aacute;gina (Izquierda)', 'logus' ),
			'description' 	=> esc_html__( 'Se muestra en la izquierda del Pie de P&aacute;gina', 'logus' )
		)
	);

	// footer sidebar (center position)
	register_sidebar(
		array(
			'id' 			=> 'center-footer-sidebar',
			'name' 			=> esc_html__( 'Pie de P&aacute;gina (Centro)', 'logus' ),
			'description' 	=> esc_html__( 'Se muestra en la parte central del Pie de P&aacute;gina', 'logus' )
		)
	);

	// footer sidebar (right position)
	register_sidebar(
		array(
			'id' 			=> 'right-footer-sidebar',
			'name' 			=> esc_html__( 'Pie de P&aacute;gina (Derecha)', 'logus' ),
			'description' 	=> esc_html__( 'Se muestra en la derecha del Pie de P&aacute;gina', 'logus' )
		)
	);

    // Register widgets 
	register_widget( 'Logus_Social' );
	register_widget( 'Logus_Lastposts' );

	if ( in_array( 'logus-toolbox/logus-toolbox.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		register_widget( 'Logus_Services' );
		register_widget( 'Logus_Portfolio' );
		register_widget( 'Logus_Testimonies' );
		register_widget( 'Logus_Brands' );		
	}
}
add_action( 'widgets_init', 'logus_widgets_init' );


/**
 * Change the excerpt length if mod_theme is configured. 
 * 
 * Return mod_theme value. The default excerpt value is configured with 
 * the default wordpress value for excerpt (55).
 */
function logus_excerpt_length( $length ) {		
	if ( is_admin() ) {
		return $length;
	}
	return logus_get_option( 'logus_excerpt_length' );
}
add_filter( 'excerpt_length', 'logus_excerpt_length', 999 );


/**
 * Set max title chars length if mod_theme is configured.
 */
function logus_title_length( $title ){

	// get default values to compare 
	$defaults= logus_get_option_defaults();	
		
	// get mod_theme value
	$title_length= logus_get_option( 'logus_title_length' );	

	// substring title or header if title_length mod_theme is configured
	if ( ( $title_length != $defaults['logus_title_length'] ) && ( strlen( $title ) > $title_length ) ){
		return substr( $title, 0, $title_length ). " &hellip;";
	}
	return $title;
}
add_filter( 'option_blogname', 'logus_title_length' );
add_filter( 'the_title', 'logus_title_length' );


/**
 * Return blog layout
 * 
 * Is used for different templates on the home page. 
 */
function logus_blog_layout() {
	
	$blog_layout= logus_get_option( 'logus_blog_layout' );
	
	return $blog_layout;
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Enable Foundation responsive embeds for WP video embeds
 */
require get_template_directory() . '/inc/custom-embed.php';

/**
 * Implement the Custom Navs
 */
require get_template_directory() . '/inc/custom-navs.php';

/**
 * Implement the Custom Comments
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load the front page widgets
 */
require get_template_directory() . "/widgets/social.php";
require get_template_directory() . "/widgets/lastposts.php";

if ( in_array( 'logus-toolbox/logus-toolbox.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . "/widgets/lt-services.php";
	require get_template_directory() . "/widgets/lt-portfolio.php";
	require get_template_directory() . "/widgets/lt-testimonies.php";
	require get_template_directory() . "/widgets/lt-brands.php";
}

/**
 * Enqueue scripts and styles
 */
require_once(get_template_directory() . '/inc/enqueue-scripts.php');

/**
 * Customizer additions
 */
require_once(get_template_directory() . '/inc/customizer.php');

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Custom Footer
 */
require get_template_directory() . '/inc/custom-footer.php';

/**
 * TGM Plugin activation.
 *
 */
require_once dirname( __FILE__ ) . '/vendor/tgm-plugin-activation/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'logus_register_required_plugins' );


/**
 * Logus-toolbox is a plugin that creates cpt used in Logus Theme: lt-services, lt-portfolio, lt-testimonies and lt-brands
 * @link https://wordpress.org/plugins/logus-toolbox/
 */
function logus_register_required_plugins() {

	$plugins = array(
		array(
			'name'      => 'Logus Toolbox',
			'slug'      => 'logus-toolbox',
			'required'  => false,
		),	
		array(
            'name'      => 'Page Builder by SiteOrigin',
            'slug'      => 'siteorigin-panels',
            'required'  => false,
        )	
	);
	tgmpa( $plugins );
}
