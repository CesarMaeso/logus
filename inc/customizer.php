<?php
/**
 * Logus Theme Customizer
 *
 * @package Logus
 */

/**
 * Customizer default values
 *
 * @link https://make.wordpress.org/themes/2014/07/09/using-sane-defaults-in-themes/
 */
function logus_get_option_defaults() {
	return apply_filters( 'logus_option_defaults', array(
			'logus_blog_featured' 		=> 'classic',
			'logus_banner_footer'		=> '', 
			'logus_credits'	 			=> '',	
			'logus_primary_color' 		=> '#4bad87',
			'logus_menu_color' 			=> '#ffffff',
			'logus_header_height' 		=> 650, 					 // 0 to apply default value
			'logus_excerpt_length' 		=> 55,
			'logus_title_length' 		=> 0,                        // 0 to not apply length limits
			'logus_cta_color' 			=> '#ffffff',
			'logus_cta_button_url' 		=> '#blog',                  // default call to action url
			'logus_cta_button_text' 	=> ''
	) );
}


/**
 * Get all options
 */
function logus_get_options() {   
    return wp_parse_args( 
        	get_theme_mods(), 
        	logus_get_option_defaults() 
    );
}


/**
 * Get option by name
 */
function logus_get_option( $option='' ){
	$options= logus_get_options();
	if ( !isset( $options[$option] ) )
		return false;

	return $options[$option];
}
 

/**
 * Customizer settings
 */
function logus_customize_register( $wp_customize ) {

	// get default options
	$options= logus_get_option_defaults();	

	//___Colors___//

    // Primary Color
    $wp_customize->add_setting( 'logus_primary_color', array(
            'default'           => $options['logus_primary_color'],
            'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logus_primary_color', array(
            'label'     => __( 'Color principal', 'logus' ),
            'description' => __( 'Elige un color que se utilizar&aacute; en los encabezados, t&iacute;tulos, botones y enlaces.', 'logus' ),
            'section'   => 'colors',
            'priority'  => 15
        )
    ) );     

    // Menu Color
    $wp_customize->add_setting( 'logus_menu_color', array(
            'default'           => $options['logus_menu_color'],
            'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logus_menu_color', array(
            'label'     => __( 'Color de textos de men&uacute; ', 'logus' ),
            'description' => __( 'Elige un color para el men&uacute; de la cabecera.', 'logus' ),
            'section'   => 'colors',
            'priority'  => 17
        )
    ) ); 

    // Menu Color
    $wp_customize->add_setting( 'logus_cta_color', array(
            'default'           => $options['logus_cta_color'],
            'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logus_cta_color', array(
            'label'     => __( 'Color de llamada a la acci&oacute;n', 'logus' ),
            'description' => __( 'Elige un color para el bot&oacute;n que aparece en el banner de la p&aacute;gina de inicio.', 'logus' ),
            'section'   => 'colors',
            'priority'  => 19
        )
    ) );         

	//___Cover Page___//	
	$wp_customize->add_section( 'logus_coverpage_section', array(
		'title'       => __( 'Portada de Logus', 'logus' ),
		'priority'    => 120,
		'description' => __( 'Ajustes de Portada del Tema Logus. <br>El plugin "Logus Toolbox" te crea men&uacute;s en el escriorio 
						para a&ntilde;adir los servicios, proyectos, testimonios o marcas.<br> Aqu&iacute; puedes configurar los encabezados y 
						los textos descriptivos de las distintas secciones.', 'logus' ),
	));	

    // call to action button text
    $wp_customize->add_setting( 'logus_cta_button_text', array(
            'default' => $options['logus_cta_button_text'],
            'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'logus_cta_button_text', array(
    		'label'       => __( 'Llamada a la acci&oacute;n', 'logus' ),
            'description' => __( 'Texto que muestra el bot&oacute;n', 'logus' ),
            'section'     => 'logus_coverpage_section',
            'settings'    => 'logus_cta_button_text',
            'type'        => 'text',
            'priority'    => 15
    ) );

    // call to action button url
    $wp_customize->add_setting( 'logus_cta_button_url', array(
            'default' => $options['logus_cta_button_url'],
            'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'logus_cta_button_url', array(            
            'description' => __( 'Url d&oacute;nde apunta el bot&oacute;n el bot&oacute;n CTA.', 'logus' ),
            'section'     => 'logus_coverpage_section',
            'settings'    => 'logus_cta_button_url',
            'type'        => 'text',
            'priority'    => 17
        )
    );
 
	//___Header Image___//	        
    // header min height 
    $wp_customize->add_setting( 'logus_header_height', array(
		'default'  			=> $options['logus_header_height'],
		'sanitize_callback' => 'absint',
	) );	
    $wp_customize->add_control( 'logus_header_height', array(
        'type'        => 'number',
        'priority'    => 15,
        'section'     => 'header_image',
        'label'       => __( 'Altura de la imagen del encabezado', 'logus' ),
        'description' => __( 'El valor utilizado por defecto es 650. La unidad es pixels.', 'logus' ),
        'input_attrs' => array(
            'min'   => 200,
            'max'   => 700,
            'step'  => 5,
        ),
    ) );

	//___Blog Options__//
	$wp_customize->add_section( 'logus_blog_options', array(
		'title'       => __( 'Opciones del Blog', 'logus' ),
		'priority'    => 120,
		'description' => __( 'Ajustes de opciones para el blog.', 'logus' ),
	));

	// title length
	$wp_customize->add_setting( 'logus_title_length', array(
		'default'  			=> $options['logus_title_length'],
		'sanitize_callback' => 'absint',
	) );	
    $wp_customize->add_control( 'logus_title_length', array(
        'type'        => 'number',
        'priority'    => 15,
        'section'     => 'logus_blog_options',
        'label'       => __( 'Longitud de T&iacute;tulos', 'logus' ),
        'description' => __( 'Escribe el n&uacute;mero de letras m&aacute;ximo para la longitud de los t&iacute;tulos y encabezados. El valor por defecto es que no recorte los t&iacute;tulos (0).', 'logus' ),
        'input_attrs' => array(
            'min'   => 5,
            'max'   => 65,
            'step'  => 5,
        ),
    ) );

	// featured image banner
    $wp_customize->add_setting( 'logus_blog_featured', array(
            'default'           => $options['logus_blog_featured'],
            'sanitize_callback' => 'logus_sanitize_featured',
    ) );
    $wp_customize->add_control( 'logus_blog_featured', array(
            'type'      	=> 'radio',
            'priority'      => 15,
            'label'			=> __( 'Estilo del blog', 'logus' ),
            'description'   => __( 'El estilo banner muestra la imagen destacada como un banner', 'logus' ),
            'section'   	=> 'logus_blog_options',
            'choices'   		=> array(
                'classic'       => __( 'Cl&aacute;sico', 'logus' ),
                'banner'      	=> __( 'Banner', 'logus' ),
			),			
    ) );    

	// excerpt length
	$wp_customize->add_setting( 'logus_excerpt_length', array(				
		'default'  			=> $options['logus_excerpt_length'],
		'sanitize_callback' => 'absint',
	) );	
    $wp_customize->add_control( 'logus_excerpt_length', array(
        'type'        => 'number',
        'priority'    => 15,
        'section'     => 'logus_blog_options',
        'label'       => __( 'Longitud de Resumen', 'logus' ),
        'description' => __( 'Escribe el n&uacute;mero de palabras para el Resumen de art&iacute;culo. El valor por defecto es 55 palabras.', 'logus' ),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 100,
            'step'  => 5,
        ),
    ) );

	//___Footer___//	
	$wp_customize->add_section( 'logus_footer', array(
		'title'       => __( 'Pie de P&aacute;gina', 'logus' ),
		'priority'    => 120,
		'description' => __( 'Ajustes en el pie de p&aacute;gina', 'logus' ),
	) );

    // footer banner
	$wp_customize->add_setting( 'logus_banner_footer', array(		
		'default'  			=> $options['logus_banner_footer'],
		'dirty'  			=> false,		
		'sanitize_callback' => 'esc_url_raw',
	) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'banner_footer_control', array(
        'label'             => __( 'Banner', 'logus' ),
        'description'       => __( 'Escoge una imagen destacada para el pie de p&aacute;gina que se ver&aacute; en el home y en las p&aacute;ginas.', 'logus' ),
        'section'           => 'logus_footer',
        'priority' 			=> 15,
        'settings'          => 'logus_banner_footer',    
        )
    ) );

    // credits 
	$wp_customize->add_setting( 'logus_credits', array(				
		'default' 			=> $options['logus_credits'],
		'dirty' 			=> false,
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'logus_credits', array(
		'label'       => __( 'Cr&eacute;ditos', 'logus' ),
		'description' => __( 'Escribe un texto con los cr&eacute;ditos.', 'logus' ),
		'section'     => 'logus_footer',
		'priority'    => 15,
		'settings'    => 'logus_credits',
		'type'        => 'text',
	) );
}
add_action( 'customize_register', 'logus_customize_register' );



/**
 * Sanitization callback for logus_blog_featured option. This callback sanitizes `$input`
 * against the choices defined for the control.
 */
function logus_sanitize_featured( $input ) {
    $valid = array(
        'classic'   => __( 'Cl&aacute;sico', 'logus' ),
        'banner'   	=> __( 'Banner', 'logus' ),
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        $options= logus_get_option_defaults();  
        return $options['logus_blog_featured'];
    }
}
