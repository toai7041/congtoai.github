<?php
/**
 * Electro Mart About Theme
 *
 * @package Electro Mart
 */

//about theme info
add_action( 'admin_menu', 'electro_mart_abouttheme' );
function electro_mart_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'electro-mart'), __('About Theme Info', 'electro-mart'), 'edit_theme_options', 'electro_mart_guide', 'electro_mart_mostrar_guide');   
} 

//Info of the theme
function electro_mart_mostrar_guide() { 	
?>

<h1><?php esc_html_e('About Theme Info', 'electro-mart'); ?></h1>
<hr />  

<p><?php esc_html_e('Electro Mart is an electronics store WordPress theme that flaunts a highly impressive appeal for electronic stores, electronic manufacturers, gadget suppliers, online gadget stores, headphone manufacturers, smart device producers, online electronic gadget supplier services, eCommerce stores for electronics, and many more.', 'electro-mart'); ?></p>

<h2><?php esc_html_e('Theme Features', 'electro-mart'); ?></h2>
<hr />  
 
<h3><?php esc_html_e('Theme Customizer', 'electro-mart'); ?></h3>
<p><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'electro-mart'); ?></p>


<h3><?php esc_html_e('Responsive Ready', 'electro-mart'); ?></h3>
<p><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'electro-mart'); ?></p>


<h3><?php esc_html_e('Cross Browser Compatible', 'electro-mart'); ?></h3>
<p><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'electro-mart'); ?></p>


<h3><?php esc_html_e('E-commerce', 'electro-mart'); ?></h3>
<p><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'electro-mart'); ?></p>

<hr />  	
<p><a href="http://www.gracethemesdemo.com/documentation/electro-mart/#homepage-lite" target="_blank"><?php esc_html_e('Documentation', 'electro-mart'); ?></a></p>

<?php } ?>