<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Logus
 */
?>

<?php if ( is_active_sidebar( 'sidebar-widgets' ) ) : ?>
	<aside class="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<ul>			
			<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
		</ul>
	</aside>
<?php endif; ?>
