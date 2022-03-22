<?php    
/**
 *electro-mart Theme Customizer
 *
 * @package Electro Mart
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function electro_mart_customize_register( $wp_customize ) {	
	
	function electro_mart_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function electro_mart_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	} 
	
	function electro_mart_sanitize_phone_number( $phone ) {
		// sanitize phone
		return preg_replace( '/[^\d+]/', '', $phone );
	} 
	
	
	function electro_mart_sanitize_excerptrange( $number, $setting ) {	
		// Ensure input is an absolute integer.
		$number = absint( $number );	
		// Get the input attributes associated with the setting.
		$atts = $setting->manager->get_control( $setting->id )->input_attrs;	
		// Get minimum number in the range.
		$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );	
		// Get maximum number in the range.
		$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );	
		// Get step.
		$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );	
		// If the number is within the valid range, return it; otherwise, return the default
		return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
	}

	function electro_mart_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );		
		// If the input is an absolute integer, return it; otherwise, return the default
		return ( $number ? $number : $setting->default );
	}
	
	// Ensure is an absolute integer
	function electro_mart_sanitize_choices( $input, $setting ) {
		global $wp_customize; 
		$control = $wp_customize->get_control( $setting->id ); 
		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
	
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.logo h1 a',
		'render_callback' => 'electro_mart_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.logo p',
		'render_callback' => 'electro_mart_customize_partial_blogdescription',
	) );
		
	 	
	 //Panel for section & control
	$wp_customize->add_panel( 'electro_mart_panel_for_themesettings', array(
		'priority' => 4,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Electro Mart Settings', 'electro-mart' ),		
	) );

	$wp_customize->add_section('electro_mart_layoutoptions',array(
		'title' => __('Site Layout Options','electro-mart'),			
		'priority' => 1,
		'panel' => 	'electro_mart_panel_for_themesettings',          
	));		
	
	$wp_customize->add_setting('electro_mart_layouttype',array(
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'electro_mart_layouttype', array(
    	'section'   => 'electro_mart_layoutoptions',    	 
		'label' => __('Check to Show Box Layout','electro-mart'),
		'description' => __('check for box layout','electro-mart'),
    	'type'      => 'checkbox'
     )); //Box Layout Options 
	
	$wp_customize->add_setting('electro_mart_colorscheme',array(
		'default' => '#00b7f1',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'electro_mart_colorscheme',array(
			'label' => __('Site Color Options','electro-mart'),			
			'section' => 'colors',
			'settings' => 'electro_mart_colorscheme'
		))
	);
	
	$wp_customize->add_setting('electro_mart_hdrnavcolor',array(
		'default' => '#333333',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'electro_mart_hdrnavcolor',array(
			'label' => __('Navigation font Color','electro-mart'),			
			'section' => 'colors',
			'settings' => 'electro_mart_hdrnavcolor'
		))
	);
	
	
	$wp_customize->add_setting('electro_mart_hdrnavactive',array(
		'default' => '#eea702',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'electro_mart_hdrnavactive',array(
			'label' => __('Navigation Hover/Active Color','electro-mart'),			
			'section' => 'colors',
			'settings' => 'electro_mart_hdrnavactive'
		))
	);
	
	 //Header Contact details
	$wp_customize->add_section('electro_mart_hdrcontactdetails',array(
		'title' => __('Header Contact Details','electro-mart'),				
		'priority' => null,
		'panel' => 	'electro_mart_panel_for_themesettings',
	));	
	
	
	$wp_customize->add_setting('electro_mart_emailid',array(
		'sanitize_callback' => 'sanitize_email'
	));
	
	$wp_customize->add_control('electro_mart_emailid',array(
		'type' => 'email',
		'label' => __('enter email id here.','electro-mart'),
		'section' => 'electro_mart_hdrcontactdetails'
	));		
	
	
	$wp_customize->add_setting('electro_mart_phoneno',array(
		'default' => null,
		'sanitize_callback' => 'electro_mart_sanitize_phone_number'	
	));
	
	$wp_customize->add_control('electro_mart_phoneno',array(	
		'type' => 'text',
		'label' => __('Enter phone number here','electro-mart'),
		'section' => 'electro_mart_hdrcontactdetails',
		'setting' => 'electro_mart_phoneno'
	));	
		
	
	$wp_customize->add_setting('electro_mart_show_hdrcontactdetails',array(
		'default' => false,
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'electro_mart_show_hdrcontactdetails', array(
	   'settings' => 'electro_mart_show_hdrcontactdetails',
	   'section'   => 'electro_mart_hdrcontactdetails',
	   'label'     => __('Check To show This Section','electro-mart'),
	   'type'      => 'checkbox'
	 ));//Show Contact Details Sections
	 
	
	 //Social icons Section
	$wp_customize->add_section('electro_mart_hdrsocial_options',array(
		'title' => __('Header Social icons','electro-mart'),
		'description' => __( 'Add social icons link here to display icons in header ', 'electro-mart' ),			
		'priority' => null,
		'panel' => 	'electro_mart_panel_for_themesettings', 
	));
	
	$wp_customize->add_setting('electro_mart_hdrfb_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'	
	));
	
	$wp_customize->add_control('electro_mart_hdrfb_link',array(
		'label' => __('Add facebook link here','electro-mart'),
		'section' => 'electro_mart_hdrsocial_options',
		'setting' => 'electro_mart_hdrfb_link'
	));	
	
	$wp_customize->add_setting('electro_mart_hdrtw_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('electro_mart_hdrtw_link',array(
		'label' => __('Add twitter link here','electro-mart'),
		'section' => 'electro_mart_hdrsocial_options',
		'setting' => 'electro_mart_hdrtw_link'
	));

	
	$wp_customize->add_setting('electro_mart_hdrin_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('electro_mart_hdrin_link',array(
		'label' => __('Add linkedin link here','electro-mart'),
		'section' => 'electro_mart_hdrsocial_options',
		'setting' => 'electro_mart_hdrin_link'
	));
	
	$wp_customize->add_setting('electro_mart_hdrigram_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('electro_mart_hdrigram_link',array(
		'label' => __('Add instagram link here','electro-mart'),
		'section' => 'electro_mart_hdrsocial_options',
		'setting' => 'electro_mart_hdrigram_link'
	));
	
	
	$wp_customize->add_setting('electro_mart_show_hdrsocial_options',array(
		'default' => false,
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'electro_mart_show_hdrsocial_options', array(
	   'settings' => 'electro_mart_show_hdrsocial_options',
	   'section'   => 'electro_mart_hdrsocial_options',
	   'label'     => __('Check To show This Section','electro-mart'),
	   'type'      => 'checkbox'
	 ));//Show Social settings
	
	 	
	//Slider Section		
	$wp_customize->add_section( 'electro_mart_hdrslide_sections', array(
		'title' => __('Frontapage Slider Settings', 'electro-mart'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 670 pixel.','electro-mart'), 
		'panel' => 	'electro_mart_panel_for_themesettings',           			
    ));
	
	$wp_customize->add_setting('electro_mart_hdrslidepage1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'electro_mart_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('electro_mart_hdrslidepage1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide 1:','electro-mart'),
		'section' => 'electro_mart_hdrslide_sections'
	));	
	
	$wp_customize->add_setting('electro_mart_hdrslidepage2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'electro_mart_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('electro_mart_hdrslidepage2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide 2:','electro-mart'),
		'section' => 'electro_mart_hdrslide_sections'
	));	
	
	$wp_customize->add_setting('electro_mart_hdrslidepage3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'electro_mart_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('electro_mart_hdrslidepage3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide 3:','electro-mart'),
		'section' => 'electro_mart_hdrslide_sections'
	));	//frontpage Slider Section	
	
	//Slider Excerpt Length
	$wp_customize->add_setting( 'electro_mart_excerpt_length_hdrslide', array(
		'default'              => 15,
		'type'                 => 'theme_mod',		
		'sanitize_callback'    => 'electro_mart_sanitize_excerptrange',		
	) );
	$wp_customize->add_control( 'electro_mart_excerpt_length_hdrslide', array(
		'label'       => __( 'Slider Excerpt length','electro-mart' ),
		'section'     => 'electro_mart_hdrslide_sections',
		'type'        => 'range',
		'settings'    => 'electro_mart_excerpt_length_hdrslide','input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );	
	
	$wp_customize->add_setting('electro_mart_hdrslidepage_btntext',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('electro_mart_hdrslidepage_btntext',array(	
		'type' => 'text',
		'label' => __('enter button name here','electro-mart'),
		'section' => 'electro_mart_hdrslide_sections',
		'setting' => 'electro_mart_hdrslidepage_btntext'
	)); // slider read more button text
	
	$wp_customize->add_setting('electro_mart_show_hdrslide_sections',array(
		'default' => false,
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'electro_mart_show_hdrslide_sections', array(
	    'settings' => 'electro_mart_show_hdrslide_sections',
	    'section'   => 'electro_mart_hdrslide_sections',
	    'label'     => __('Check To Show This Section','electro-mart'),
	   'type'      => 'checkbox'
	 ));//Show Header Slider Settings	
	 
	 
	 //Three pages Services Sections
	$wp_customize->add_section('electro_mart_services_threecolumn_sections', array(
		'title' => __('Three Page Boxes Sections','electro-mart'),
		'description' => __('Select pages from the dropdown for three column section','electro-mart'),
		'priority' => null,
		'panel' => 	'electro_mart_panel_for_themesettings',          
	));	
		
	$wp_customize->add_setting('electro_mart_services_threecolumn_page1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'electro_mart_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'electro_mart_services_threecolumn_page1',array(
		'type' => 'dropdown-pages',			
		'section' => 'electro_mart_services_threecolumn_sections',
	));		
	
	$wp_customize->add_setting('electro_mart_services_threecolumn_page2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'electro_mart_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'electro_mart_services_threecolumn_page2',array(
		'type' => 'dropdown-pages',			
		'section' => 'electro_mart_services_threecolumn_sections',
	));
	
	$wp_customize->add_setting('electro_mart_services_threecolumn_page3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'electro_mart_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'electro_mart_services_threecolumn_page3',array(
		'type' => 'dropdown-pages',			
		'section' => 'electro_mart_services_threecolumn_sections',
	));		

	$wp_customize->add_setting( 'electro_mart_threecolumn_excerpt_length', array(
		'default'              => 0,
		'type'                 => 'theme_mod',		
		'sanitize_callback'    => 'electro_mart_sanitize_excerptrange',		
	) );
	$wp_customize->add_control( 'electro_mart_threecolumn_excerpt_length', array(
		'label'       => __( 'four page box excerpt length','electro-mart' ),
		'section'     => 'electro_mart_services_threecolumn_sections',
		'type'        => 'range',
		'settings'    => 'electro_mart_threecolumn_excerpt_length','input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );	
	
	$wp_customize->add_setting('electro_mart_threecolumn_readmorebutton',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('electro_mart_threecolumn_readmorebutton',array(	
		'type' => 'text',
		'label' => __('Read more button name here','electro-mart'),
		'section' => 'electro_mart_services_threecolumn_sections',
		'setting' => 'electro_mart_threecolumn_readmorebutton'
	)); //four box read more button text
	
	
	$wp_customize->add_setting('electro_mart_show_services_threecolumn_sections',array(
		'default' => false,
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));		
	
	$wp_customize->add_control( 'electro_mart_show_services_threecolumn_sections', array(
	   'settings' => 'electro_mart_show_services_threecolumn_sections',
	   'section'   => 'electro_mart_services_threecolumn_sections',
	   'label'     => __('Check To Show This Section','electro-mart'),
	   'type'      => 'checkbox'
	 ));//Show four page boxes sections
	 
	 
	 //Blog Posts Settings
	$wp_customize->add_panel( 'electro_mart_blogsettings_panel', array(
		'priority' => 3,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Blog Posts Settings', 'electro-mart' ),		
	) );
	
	$wp_customize->add_section('electro_mart_blogmeta_options',array(
		'title' => __('Blog Meta Options','electro-mart'),			
		'priority' => null,
		'panel' => 	'electro_mart_blogsettings_panel', 	         
	));		
	
	$wp_customize->add_setting('electro_mart_hide_blogdate',array(
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'electro_mart_hide_blogdate', array(
    	'label' => __('Check to hide post date','electro-mart'),	
		'section'   => 'electro_mart_blogmeta_options', 
		'setting' => 'electro_mart_hide_blogdate',		
    	'type'      => 'checkbox'
     )); //Blog Date
	 
	 
	 $wp_customize->add_setting('electro_mart_hide_postcats',array(
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'electro_mart_hide_postcats', array(
		'label' => __('Check to hide post category','electro-mart'),	
    	'section'   => 'electro_mart_blogmeta_options',		
		'setting' => 'electro_mart_hide_postcats',		
    	'type'      => 'checkbox'
     )); //blogposts category	 
	 
	 
	 $wp_customize->add_section('electro_mart_postfeatured_image',array(
		'title' => __('Posts Featured image','electro-mart'),			
		'priority' => null,
		'panel' => 	'electro_mart_blogsettings_panel', 	         
	));		
	
	$wp_customize->add_setting('electro_mart_hide_postfeatured_image',array(
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'electro_mart_hide_postfeatured_image', array(
		'label' => __('Check to hide post featured image','electro-mart'),
    	'section'   => 'electro_mart_postfeatured_image',		
		'setting' => 'electro_mart_hide_postfeatured_image',	
    	'type'      => 'checkbox'
     )); //Posts featured image
	 
	 
	 $wp_customize->add_setting('electro_mart_blogimg_fullwidth',array(
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'electro_mart_blogimg_fullwidth', array(
		'label' => __('Check to featured image Full Width','electro-mart'),
    	'section'   => 'electro_mart_postfeatured_image',		
		'setting' => 'electro_mart_blogimg_fullwidth',	
    	'type'      => 'checkbox'
     )); //posts featured full
	 
	  
	 $wp_customize->add_section('electro_mart_postmorebtn',array(
		'title' => __('Posts Read More Button','electro-mart'),			
		'priority' => null,
		'panel' => 	'electro_mart_blogsettings_panel', 	         
	 ));	
	 
	 $wp_customize->add_setting('electro_mart_postmorebuttontext',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	)); //blog read more button text
	
	$wp_customize->add_control('electro_mart_postmorebuttontext',array(	
		'type' => 'text',
		'label' => __('Read more button text for blog posts','electro-mart'),
		'section' => 'electro_mart_postmorebtn',
		'setting' => 'electro_mart_postmorebuttontext'
	)); //Post read more button text	
	
	$wp_customize->add_section('electro_mart_postcontent_settings',array(
		'title' => __('Posts Excerpt Options','electro-mart'),			
		'priority' => null,
		'panel' => 	'electro_mart_blogsettings_panel', 	         
	 ));	 
	 
	$wp_customize->add_setting( 'electro_mart_postexcerptrange', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'electro_mart_sanitize_excerptrange',		
	) );
	
	$wp_customize->add_control( 'electro_mart_postexcerptrange', array(
		'label'       => __( 'Excerpt length','electro-mart' ),
		'section'     => 'electro_mart_postcontent_settings',
		'type'        => 'range',
		'settings'    => 'electro_mart_postexcerptrange','input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('electro_mart_postsfullcontent_options',array(
        'default' => 'Excerpt',     
        'sanitize_callback' => 'electro_mart_sanitize_choices'
	));
	
	$wp_customize->add_control('electro_mart_postsfullcontent_options',array(
        'type' => 'select',
        'label' => __('Posts Content','electro-mart'),
        'section' => 'electro_mart_postcontent_settings',
        'choices' => array(
        	'Content' => __('Content','electro-mart'),
            'Excerpt' => __('Excerpt','electro-mart'),
            'No Content' => __('No Excerpt','electro-mart')
        ),
	) ); 
	
	
	$wp_customize->add_section('electro_mart_postsinglemeta',array(
		'title' => __('Posts Single Settings','electro-mart'),			
		'priority' => null,
		'panel' => 	'electro_mart_blogsettings_panel', 	         
	));	
	
	$wp_customize->add_setting('electro_mart_hide_postdate_fromsingle',array(
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'electro_mart_hide_postdate_fromsingle', array(
    	'label' => __('Check to hide post date from single','electro-mart'),	
		'section'   => 'electro_mart_postsinglemeta', 
		'setting' => 'electro_mart_hide_postdate_fromsingle',		
    	'type'      => 'checkbox'
     )); //Hide Posts date from single
	 
	 
	 $wp_customize->add_setting('electro_mart_hide_postcats_fromsingle',array(
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'electro_mart_hide_postcats_fromsingle', array(
		'label' => __('Check to hide post category from single','electro-mart'),	
    	'section'   => 'electro_mart_postsinglemeta',		
		'setting' => 'electro_mart_hide_postcats_fromsingle',		
    	'type'      => 'checkbox'
     )); //Hide blogposts category single
	 
	 
	 //Sidebar Settings
	$wp_customize->add_section('electro_mart_sidebarsettings', array(
		'title' => __('Sidebar Settings','electro-mart'),		
		'priority' => null,
		'panel' => 	'electro_mart_blogsettings_panel',          
	));		
	 
	$wp_customize->add_setting('electro_mart_hidesidebar_blogposts',array(
		'default' => false,
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'electro_mart_hidesidebar_blogposts', array(
	   'settings' => 'electro_mart_hidesidebar_blogposts',
	   'section'   => 'electro_mart_sidebarsettings',
	   'label'     => __('Check to hide sidebar from homepage','electro-mart'),
	   'type'      => 'checkbox'
	 ));//hide sidebar blog posts 
	
		 
	 $wp_customize->add_setting('electro_mart_hidesidebar_singleposts',array(
		'default' => false,
		'sanitize_callback' => 'electro_mart_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'electro_mart_hidesidebar_singleposts', array(
	   'settings' => 'electro_mart_hidesidebar_singleposts',
	   'section'   => 'electro_mart_sidebarsettings',
	   'label'     => __('Check to hide sidebar from single post','electro-mart'),
	   'type'      => 'checkbox'
	 ));// Hide sidebar single post	 
		 
}
add_action( 'customize_register', 'electro_mart_customize_register' );

function electro_mart_custom_css(){ 
?>
	<style type="text/css"> 					
        a,
        #sidebar ul li a:hover,
		#sidebar ol li a:hover,							
        .BLogStyle-01 h3 a:hover,		
        .postmeta a:hover,
		.hdrsocial a:hover,
		h4.sub_title,			 			
        .button:hover,
		.ThreePageColumn h4 a:hover,		
		h2.services_title span,			
		.BlogMeta-Strip a:hover,
		.BlogMeta-Strip a:focus,
		blockquote::before	
            { color:<?php echo esc_html( get_theme_mod('electro_mart_colorscheme','#00b7f1')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,		
        .nivo-controlNav a.active,
		.sd-search input, .sd-top-bar-nav .sd-search input,			
		a.blogreadmore,
		.footer-fix,			
		.copyrigh-wrapper:before,										
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,		
		.morebutton,
		.menu-toggle:hover,
		.menu-toggle:focus,	
		.nivo-directionNav a:hover,	
		.nivo-caption .slidermorebtn:hover		
            { background-color:<?php echo esc_html( get_theme_mod('electro_mart_colorscheme','#00b7f1')); ?>;}
			
		
		.tagcloud a:hover,
		.ThreePageColumn:hover .PageColumnBG,
		blockquote
            { border-color:<?php echo esc_html( get_theme_mod('electro_mart_colorscheme','#00b7f1')); ?>;}			
			
		#SiteWrapper a:focus,
		input[type="date"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="button"]:focus,
		input[type="month"]:focus,
		button:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="range"]:focus,		
		input[type="password"]:focus,
		input[type="datetime"]:focus,
		input[type="week"]:focus,
		input[type="submit"]:focus,
		input[type="datetime-local"]:focus,		
		input[type="url"]:focus,
		input[type="time"]:focus,
		input[type="reset"]:focus,
		input[type="color"]:focus,
		textarea:focus
            { border:1px solid <?php echo esc_html( get_theme_mod('electro_mart_colorscheme','#00b7f1')); ?>;}	
			
		
		.site-navigation a,
		.site-navigation ul li.current_page_parent ul.sub-menu li a,
		.site-navigation ul li.current_page_parent ul.sub-menu li.current_page_item ul.sub-menu li a,
		.site-navigation ul li.current-menu-ancestor ul.sub-menu li.current-menu-item ul.sub-menu li a  			
            { color:<?php echo esc_html( get_theme_mod('electro_mart_hdrnavcolor','#333333')); ?>;}	
			
		
		.site-navigation ul.nav-menu .current_page_item > a,
		.site-navigation ul.nav-menu .current-menu-item > a,
		.site-navigation ul.nav-menu .current_page_ancestor > a,
		.site-navigation ul.nav-menu .current-menu-ancestor > a, 
		.site-navigation .nav-menu a:hover,
		.site-navigation .nav-menu a:focus,
		.site-navigation .nav-menu ul a:hover,
		.site-navigation .nav-menu ul a:focus,
		.site-navigation ul li a:hover, 
		.site-navigation ul li.current-menu-item a,			
		.site-navigation ul li.current_page_parent ul.sub-menu li.current-menu-item a,
		.site-navigation ul li.current_page_parent ul.sub-menu li a:hover,
		.site-navigation ul li.current-menu-item ul.sub-menu li a:hover,
		.site-navigation ul li.current-menu-ancestor ul.sub-menu li.current-menu-item ul.sub-menu li a:hover 		 			
            { color:<?php echo esc_html( get_theme_mod('electro_mart_hdrnavactive','#eea702')); ?>;}
			
		.hdrtopcart .cart-count
            { background-color:<?php echo esc_html( get_theme_mod('electro_mart_hdrnavactive','#eea702')); ?>;}		
			
		#SiteWrapper .site-navigation a:focus		 			
            { border:1px solid <?php echo esc_html( get_theme_mod('electro_mart_hdrnavactive','#eea702')); ?>;}	
	
    </style> 
<?php                                                                                                                                                                              
}
         
add_action('wp_head','electro_mart_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function electro_mart_customize_preview_js() {
	wp_enqueue_script( 'electro_mart_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '19062019', true );
}
add_action( 'customize_preview_init', 'electro_mart_customize_preview_js' );