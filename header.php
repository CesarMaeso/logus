<?php
/**
 * Logus template for displaying the head and hero section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Logus
 */
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie ie-no-support" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> 
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />	
	<meta name="viewport" content="width=device-width" />
	<?php wp_head(); ?>	
</head>


<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">	
	<div class="site">

		<!-- Wrapper around off-canvas and the content -->
		<div id="page-wrapper" class="inner-wrap">			

			<div id="header" class="<?php echo esc_attr( ( is_home() ) ? 'front-page' : 'post-page' ); ?>">
				<!-- Off canvas wrapper -->
				<div class="off-canvas-wrapper">
				
    				<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
						
						<!-- Off-canvas menu panel goes here -->
	   					<div class="off-canvas position-left vertical-menu-header is-transition-push" id="offCanvasLeft" data-off-canvas>
							<?php 
								// if is admin_bar showing
								if ( is_admin_bar_showing() ) : ?>
    								<div class="adminbar-showing"></div>
								<?php endif; 
								
								if ( has_custom_logo() ) : ?>
    								<div class="text-center"><?php the_custom_logo(); ?></div>
								<?php endif;  
											
								// the mobile menu
								wp_nav_menu(
									array(
										'container'      => 'div',                         
										'menu_class'     => 'vertical menu',
										'theme_location' => 'menu-header',
										'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu data-submenu-toggle="true">%3$s</ul>',
										'fallback_cb'    => false,
										'walker'         => new Logus_Nav_Header_Walker(),
									)
								);
							?>
      					</div> 
					
						<!-- Page Content -->
      					<div class="off-canvas-content <?php echo esc_attr( ( is_home() ) ? 'front-page' : 'post-page' ); ?>" data-off-canvas-content>			
      						<!-- top title bar -->
      						<div class="row">
        						<!-- title bar left / logo -->
          						<div class="title-bar-left">            
            						<div class="logo">
            							<button class="menu-icon hide-for-large" type="button" data-open="offCanvasLeft"></button>
            							<?php 
            								if ( has_custom_logo() ) {
    											the_custom_logo();
										} ?>
										
										<?php if ( !is_front_page() ) : ?>
											<span class="site-title">
												<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
											</span>
										<?php endif; ?>

									</div>
          						</div>
          				
          						<!-- title-bar-right / menu -->
          						<div class="title-bar-right hide-for-small-only hide-for-medium-only">          							
									<div class="title-bar" data-animate="hinge-in-from-top spin-out">
										<?php 

											// this is the main menu
											wp_nav_menu(
												array(
													'container'      => false,
													'menu_class'     => 'dropdown menu',
													'items_wrap'     => '<nav><ul id="%1$s" class="%2$s desktop-menu" data-dropdown-menu>%3$s</ul></nav>',
													'theme_location' => 'menu-header',
													'fallback_cb'    => false,
													'walker'         => new Logus_Nav_Header_Walker(),
												)
											);
										?>
									</div>
          						</div> <!-- title-bar-right -->
        					</div>

							<a class="exit-off-canvas"></a>
					
							<?php if ( is_front_page() ) : ?>
								<div class="row">
									<div class="home-wrap">
										<?php if ( display_header_text() ) : ?>
											<div class="intro">
												<div class="row align-left">
													<div class="header-text">	
														<h2 class="title">
															<?php
																// link to home in title if there is no logo
																if ( has_custom_logo() ) {															
																	bloginfo( 'name' );
																} else { ?>
																	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
																<?php } ?>														
														</h2>
														<?php 	
															// blog description													
															if ( get_bloginfo( 'description' ) ) : ?>
																<p><?php bloginfo( 'description' ); ?></p>
														<?php endif; ?>													
													</div>
												</div>
											</div>	
										<?php endif; ?>
									
										<!-- cta -->
										<?php 
											$cta_button_text = logus_get_option( 'logus_cta_button_text' );
											if ( $cta_button_text && ! empty( $cta_button_text ) ) : ?>										
											<div class="cta">									
												<div class="row align-left">
													<div class="header-text">
														<p>
															<a class="button" rel="nofollow" href="<?php echo esc_url( logus_get_option( 'logus_cta_button_url' ) ); ?>"><?php echo esc_html( logus_get_option( 'logus_cta_button_text' ) ); ?></a>
														</p>
													</div>
												</div>
											</div>
										<?php endif; ?>
									</div> <!-- .home-wrap -->
								
									<!-- widget area -->
									<div class="home-sidebar">										
										<?php								
										if ( is_active_sidebar( 'home-sidebar' ) ) : ?>
											<aside itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
												<div id="home-widgets">
													<ul>
														<?php if ( function_exists( 'dynamic_sidebar' ) ) :
															dynamic_sidebar( 'home-sidebar' );
														endif; ?>
													</ul>
												</div>
											</aside>
										<?php endif; ?>
									</div> <!-- .home-sidebar -->								
								</div> <!-- .row -->
								
								<!-- custom logo -->
								<?php if ( has_custom_logo() ) : ?>
									<div class="cta">
										<div class="row align-center">
											<div class="cell hide-for-small-only intro-logo">
												<?php the_custom_logo(); ?>											
											</div>
										</div>
									</div>
								<?php endif; ?>		
							<?php endif; ?>
					</div>	 <!-- .off-canvas-content -->
				</div> <!-- .off-canvas-wrapper-inner -->
			</div> <!-- .off-canvas-wrapper -->
		</div> <!-- #header -->
