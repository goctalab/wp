<?php
/**
 * risewp Theme Customizer.
 *
 * @package risewp
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function risewp_customize_register( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
//-------------------------------------------------------------------------------------------------------------------//
// Move and Replace
//-------------------------------------------------------------------------------------------------------------------// 
	
	//Colors
	$wp_customize->add_panel( 'risewp_colors_panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'General Colors', 'risewp' ),
    'description'    => esc_html__( 'Edit your general color settings.', 'risewp' ),
	));
	
	//Nav
	$wp_customize->add_panel( 'risewp_nav_panel', array(
    'priority'       => 11,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Navigation', 'risewp' ),
    'description'    => esc_html__( 'Edit your theme navigation settings.', 'risewp' ),
	));
	
	// nav
	$wp_customize->add_section( 'nav', array( 
	'title' => esc_html__( 'Navigation Settings', 'risewp' ),
	'priority' => '10', 
	'panel' => 'risewp_nav_panel'
	) );
	
	// colors
	$wp_customize->add_section( 'colors', array(
	'title' => esc_html__( 'Theme Colors', 'risewp' ),   
	'priority' => '10', 
	'panel' => 'risewp_colors_panel' 
	) );
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 8; 
	$wp_customize->get_section('title_tagline')->priority = 10;
	
	//premiums are better
    class risewp_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() {
        ?>

        <?php
        }
    }	
	

//-------------------------------------------------------------------------------------------------------------------//
// Upgrade
//-------------------------------------------------------------------------------------------------------------------//

    $wp_customize->add_section(
        'risewp_theme_info',
        array(
            'title' => esc_html__('Rise Pro', 'risewp'),  
            'priority' => 5, 
            'description' => __('Need more Rise? If you want to see what additional features are included in Rise Pro, visit <a href="https://modernthemes.net/wordpress-themes/rise-pro/" target="_blank">https://modernthemes.net/wordpress-themes/rise-pro/</a> to take a closer look.', 'risewp'),
    )); 
	 
    //show them what we have to offer 
    $wp_customize->add_setting( 'risewp_help', array(
		'sanitize_callback' => 'risewp_sanitize_text',
   		'type' => 'info_control',
    	'capability' => 'edit_theme_options',
    ));
	
    $wp_customize->add_control( new risewp_Info( $wp_customize, 'risewp_help', array( 
        'section' => 'risewp_theme_info', 
        'settings' => 'risewp_help',  
        'priority' => 10
     )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Navigation
//-------------------------------------------------------------------------------------------------------------------//

	
	//nav font size
    $wp_customize->add_setting( 
        'risewp_nav_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '12',
    ));
	
    $wp_customize->add_control( 'risewp_nav_text_size', array( 
        'type'        => 'number', 
        'priority'    => 30,
        'section'     => 'nav',  
        'label'       => esc_html__('Navigation Font Size', 'risewp'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32,
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
	
	
	//Navigation/Menu Options
	$wp_customize->add_setting( 'risewp_menu_method', array( 
		'default'	        => 'option1', 
		'sanitize_callback' => 'risewp_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_menu_method', array(
		'description'    => esc_html__( 'Choose between a the Icon Toggle Menu or a classic listed menu.', 'risewp' ),
		'section'  => 'nav', 
		'settings' => 'risewp_menu_method', 
		'type'     => 'radio',
		'choices'  => array(
			'option1' => esc_html__( 'Classic Menu', 'risewp' ), 
			'option2' => esc_html__( 'Toggle Menu', 'risewp' ),  
			), 
		'input_attrs' => array(
            'style' => 'margin-top: 15px;', 
        ),
	)));
	
	$wp_customize->add_setting( 'risewp_menu_toggle', array(
		'default' => 'icon', 
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'risewp_sanitize_menu_toggle_display', 
  	));

  	$wp_customize->add_control( 'risewp_menu_toggle_radio', array(
    	'settings' => 'risewp_menu_toggle',
    	'label'    => esc_html__( 'Menu Toggle Display', 'risewp' ), 
    	'section'  => 'nav',
    	'type'     => 'radio',
    	'choices'  => array(
      		'icon' => esc_html__( 'Icon', 'risewp' ),
      		'label' => esc_html__( 'Menu', 'risewp' ), 
    	),
	));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Navigation Colors
//-------------------------------------------------------------------------------------------------------------------//

	// Nav Colors
    $wp_customize->add_section( 'risewp_nav_colors_section' , array(  
	    'title'       => esc_html__( 'Navigation Colors', 'risewp' ),
	    'priority'    => 10, 
	    'description' => esc_html__( 'Set your theme navigation colors.', 'risewp'),
		'panel' => 'risewp_nav_panel', 
	));
	

	$wp_customize->add_setting( 'risewp_nav_link_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_nav_link_color', array(
        'label'	   => esc_html__( 'Nav Link', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_nav_link_color',
		'priority' => 5, 
    )));
	
	$wp_customize->add_setting( 'risewp_nav_link_hover_color', array(
        'default'     => '#C4C5C5',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_nav_link_hover_color', array(
        'label'	   => esc_html__( 'Nav Link Hover', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_nav_link_hover_color', 
		'priority' => 10,
    )));
	
	$wp_customize->add_setting( 'risewp_nav_drop_link_color', array( 
        'default'     => '#656565',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_nav_drop_link_color', array(
        'label'	   => esc_html__( 'Nav Dropdown Link', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_nav_drop_link_color',
		'priority' => 15,
    )));
	
	$wp_customize->add_setting( 'risewp_nav_drop_link_hover_color', array( 
        'default'     => '#A7A8A8', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_nav_drop_link_hover_color', array(
        'label'	   => esc_html__( 'Nav Dropdown Link Hover', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_nav_drop_link_hover_color',
		'priority' => 20,
    )));
	
	$wp_customize->add_setting( 'risewp_nav_drop_bg_color', array( 
        'default'  => '#eaebeb',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_nav_drop_bg_color', array(
        'label'	   => esc_html__( 'Nav Dropdown Background', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_nav_drop_bg_color', 
		'priority' => 25,
    ))); 
	
	
	$wp_customize->add_setting( 'risewp_mobile_button_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_mobile_button_color', array(
        'label'	   => esc_html__( 'Mobile Menu Button', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_mobile_button_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'risewp_mobile_button_text_color', array(
        'default'     => '#2a2a2d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_mobile_button_text_color', array(
        'label'	   => esc_html__( 'Mobile Menu Button Text', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_mobile_button_text_color',
		'priority' => 35, 
    )));
	
	$wp_customize->add_setting( 'risewp_mobile_button_hover_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_mobile_button_hover_color', array(
        'label'	   => esc_html__( 'Mobile Menu Button Hover', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_mobile_button_hover_color',
		'priority' => 40, 
    )));
	
	$wp_customize->add_setting( 'risewp_mobile_button_hover_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_mobile_button_hover_text_color', array(
        'label'	   => esc_html__( 'Mobile Menu Button Hover Text', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_mobile_button_hover_text_color',
		'priority' => 45, 
    )));
	
	
	$wp_customize->add_setting( 'risewp_mobile_menu_bg', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_mobile_menu_bg', array(
        'label'	   => esc_html__( 'Mobile Menu Background', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_mobile_menu_bg',
		'priority' => 50,
    )));
	
	$wp_customize->add_setting( 'risewp_mobile_menu_link', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_mobile_menu_link', array(
        'label'	   => esc_html__( 'Mobile Menu Link', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_mobile_menu_link',
		'priority' => 55,
    )));
	
	$wp_customize->add_setting( 'risewp_mobile_menu_hover', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_mobile_menu_hover', array(
        'label'	   => esc_html__( 'Mobile Menu Link Hover', 'risewp' ),
        'section'  => 'risewp_nav_colors_section',
        'settings' => 'risewp_mobile_menu_hover',
		'priority' => 60, 
    )));
	
	$wp_customize->add_setting( 'risewp_mobile_menu_hover_bg', array(
        'default'     => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_mobile_menu_hover_bg', array(
        'label'	   => esc_html__( 'Mobile Menu Background Hover', 'risewp' ),
        'section'  => 'risewp_nav_colors_section', 
        'settings' => 'risewp_mobile_menu_hover_bg',
		'priority' => 65,
    ))); 
	

//-------------------------------------------------------------------------------------------------------------------//
// Hero Section
//-------------------------------------------------------------------------------------------------------------------//
	
	function risewp_home_tmpl_callback() {
         if( is_page_template( 'template-page-home.php' ))
         { return true; } else { return false; }
 	} 
	
	//Home Hero Section
    $wp_customize->add_section( 'risewp_home_hero_section' , array( 
		'title'       => esc_html__( 'Home Hero Section', 'risewp' ),
		'active_callback' => 'risewp_home_tmpl_callback', 
	    'priority'    => 22, 
	    'description' => esc_html__( 'Edit the options for the Home Page Hero section.', 'risewp'),
	));
	
	$wp_customize->add_setting( 'risewp_home_bg_image', array( 
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'risewp_home_bg_image', array( 
		'label'    => esc_html__( 'Background Image', 'risewp' ),
		'type'     => 'image', 
		'section'  => 'risewp_home_hero_section', 
		'settings' => 'risewp_home_bg_image', 
		'priority' => 10,
	)));
	
	$wp_customize->add_setting( 'risewp_hero_bg_color', array(
        'default'     => '#b6b9bd',  
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hero_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'risewp' ),
		'description' => esc_html__( 'If not using a background image, set your background color here.', 'risewp' ),
        'section'  => 'risewp_home_hero_section',
        'settings' => 'risewp_hero_bg_color',
		'priority' => 15
    ))); 
	
	//Title
	$wp_customize->add_setting( 'risewp_home_title',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_text',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_home_title', array(
		'label'    => esc_html__( 'Home Hero Title', 'risewp' ), 
		'section'  => 'risewp_home_hero_section',  
		'settings' => 'risewp_home_title',  
		'priority'   => 20
	)));
	
	//Excerpt
	$wp_customize->add_setting( 'risewp_home_excerpt',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_text',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_home_excerpt', array(
		'label'    => esc_html__( 'Home Hero Excerpt', 'risewp' ), 
		'type' => 'textarea', 
		'section'  => 'risewp_home_hero_section',  
		'settings' => 'risewp_home_excerpt',
		'priority'   => 25
	)));
	
	$wp_customize->add_setting( 'risewp_hero_heading_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hero_heading_color', array(
        'label'	   => esc_html__( 'Title Color', 'risewp' ),
        'section'  => 'risewp_home_hero_section',
        'settings' => 'risewp_hero_heading_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'risewp_hero_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hero_text_color', array(
        'label'	   => esc_html__( 'Excerpt Color', 'risewp' ), 
        'section'  => 'risewp_home_hero_section',
        'settings' => 'risewp_hero_text_color',
		'priority' => 33
    )));
	
	//Link Text
	$wp_customize->add_setting( 'risewp_home_button_text',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_text',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_home_button_text', array(
		'label'    => esc_html__( 'Button Text', 'risewp' ), 
		'section'  => 'risewp_home_hero_section',  
		'settings' => 'risewp_home_button_text', 
		'priority'   => 35
	)));
	
	
	// Page Drop Downs 
	$wp_customize->add_setting('risewp_home_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'risewp_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_home_button_url', array( 
    	'label' => esc_html__( 'Hero Button URL', 'risewp' ), 
    	'section' => 'risewp_home_hero_section', 
		'type' => 'dropdown-pages',
    	'settings' => 'risewp_home_button_url', 
		'priority'   => 40  
	)));
	
	// Page URL
	$wp_customize->add_setting( 'risewp_page_url_text',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_text',
	));  

	$wp_customize->add_control( 'risewp_page_url_text', array(
		'type'     => 'url',
		'label'    => esc_html__( 'External URL Option', 'risewp' ), 
		'description' => esc_html__( 'If you use an external URL, leave the Hero Button URL above empty. Must include http:// before any URL.', 'risewp' ),
		'section' => 'risewp_home_hero_section', 
		'settings' => 'risewp_page_url_text',
		'priority'   => 41 
	));  
	
	$wp_customize->add_setting( 'risewp_hero_button_bg_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hero_button_bg_color', array(
        'label'	   => esc_html__( 'Button Color', 'risewp' ),
        'section'  => 'risewp_home_hero_section',
        'settings' => 'risewp_hero_button_bg_color',
		'priority' => 45
    )));
	
	$wp_customize->add_setting( 'risewp_hero_button_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hero_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'risewp' ),
        'section'  => 'risewp_home_hero_section',
        'settings' => 'risewp_hero_button_text_color',
		'priority' => 50 
    )));
	
	$wp_customize->add_setting( 'risewp_hero_button_hover_color', array(
        'default'     => '#3d3d41', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hero_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'risewp' ),
        'section'  => 'risewp_home_hero_section',
        'settings' => 'risewp_hero_button_hover_color',
		'priority' => 60
    ))); 
	
	$wp_customize->add_setting( 'risewp_hero_button_text_hover_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hero_button_text_hover_color', array(
        'label'	   => esc_html__( 'Button Text Hover Color', 'risewp' ),
        'section'  => 'risewp_home_hero_section',
        'settings' => 'risewp_hero_button_text_hover_color',
		'priority' => 65 
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Home Page
//-------------------------------------------------------------------------------------------------------------------//
	
	
	$wp_customize->add_panel( 'risewp_home_page_panel', array(
    	'priority'       => 25,
    	'capability'     => 'edit_theme_options',
		'active_callback' => 'risewp_home_tmpl_callback',
    	'title'          => esc_html__( 'Home Page Options', 'risewp' ),
    	'description'    => esc_html__( 'Edit your home page settings', 'risewp' ),
	));
	
	//First Widget Area
    $wp_customize->add_section( 'risewp_home_widget_section_1' , array(  
	    'title'       => esc_html__( 'Home Widget Area #1', 'risewp' ),
	    'priority'    => 10, 
	    'description' => esc_html__( 'Edit the options for the first home page widget area.', 'risewp'),
		'panel' 	  => 'risewp_home_page_panel', 
	));
	
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'risewp_widget_column_one', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_widget_column_one', array(
		'label'    => esc_html__( 'Number of Widget Columns', 'risewp' ),
		'description'    => esc_html__( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'risewp' ),
		'section'  => 'risewp_home_widget_section_1', 
		'settings' => 'risewp_widget_column_one', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => esc_html__( '1 Column', 'risewp' ),
			'option2' => esc_html__( '2 Columns', 'risewp' ), 
			'option3' => esc_html__( '3 Columns', 'risewp' ),
			'option4' => esc_html__( '4 Columns', 'risewp' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px;',
        ),
	)));
	
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_1',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_1', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Widget Area #1', 'risewp' ),
        'section' => 'risewp_home_widget_section_1', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'risewp_hw_area_1_bg_color', array(
        'default'     => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_bg_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_1_text_color', array(
        'default'     => '#656565',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_text_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_1_heading_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_1_link_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_1_link_hover_color', array(
        'default'     => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_link_hover_color', array(
        'label'	   => esc_html__( 'Link Hover Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_link_hover_color', 
		'priority' => 39
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_1_button_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_1_button_text_color', array(
        'default'     => '#2a2a2d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_button_text_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_1_button_hover_color', array(
        'default'     => '#3d3d41', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_button_hover_color',
		'priority' => 50  
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_1_button_hover_text_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_1_button_hover_text_color', array(
        'label'	   => esc_html__( 'Button Hover Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_1',
        'settings' => 'risewp_hw_area_1_button_hover_text_color',
		'priority' => 50  
    ))); 
	
	//Second Widget Area
    $wp_customize->add_section( 'risewp_home_widget_section_2' , array(  
	    'title'       => esc_html__( 'Home Widget Area #2', 'risewp' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Edit the options for the second home page widget area.', 'risewp'),
		'panel' 	  => 'risewp_home_page_panel',
	));
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'risewp_widget_column_two', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_widget_column_two', array(
		'label'    => esc_html__( 'Number of Widget Columns', 'risewp' ),
		'description'    => esc_html__( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'risewp' ),
		'section'  => 'risewp_home_widget_section_2', 
		'settings' => 'risewp_widget_column_two', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => esc_html__( '1 Column', 'risewp' ),
			'option2' => esc_html__( '2 Columns', 'risewp' ), 
			'option3' => esc_html__( '3 Columns', 'risewp' ),
			'option4' => esc_html__( '4 Columns', 'risewp' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px;',
        ),
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_2',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_2', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Widget Area #2', 'risewp' ),
        'section' => 'risewp_home_widget_section_2', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'risewp_hw_area_2_bg_color', array(
        'default'     => '#f1f5f7',
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_bg_color',
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_2_text_color', array(
        'default'     => '#656565',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_text_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_2_heading_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_2_link_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_2_link_hover_color', array(
        'default'     => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_link_hover_color', array(
        'label'	   => esc_html__( 'Link Hover Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_link_hover_color', 
		'priority' => 39
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_2_button_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_2_button_text_color', array(
        'default'     => '#2a2a2d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_button_text_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_2_button_hover_color', array(
        'default'     => '#3d3d41', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_button_hover_color', 
		'priority' => 50  
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_2_button_hover_text_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_2_button_hover_text_color', array(
        'label'	   => esc_html__( 'Button Hover Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_2',
        'settings' => 'risewp_hw_area_2_button_hover_text_color',
		'priority' => 50  
    ))); 
	
	
	//Third Widget Area
    $wp_customize->add_section( 'risewp_home_widget_section_3' , array(  
	    'title'       => esc_html__( 'Home Widget Area #3', 'risewp' ),
	    'priority'    => 30, 
	    'description' => esc_html__( 'Edit the options for the third home page widget area.', 'risewp'),
		'panel' 	  => 'risewp_home_page_panel', 
	)); 
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'risewp_widget_column_three', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_widget_column_three', array(
		'label'    => esc_html__( 'Number of Widget Columns', 'risewp' ),
		'description'    => esc_html__( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'risewp' ),
		'section'  => 'risewp_home_widget_section_3', 
		'settings' => 'risewp_widget_column_three', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => esc_html__( '1 Column', 'risewp' ),
			'option2' => esc_html__( '2 Columns', 'risewp' ), 
			'option3' => esc_html__( '3 Columns', 'risewp' ),
			'option4' => esc_html__( '4 Columns', 'risewp' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px;',
        ),
	)));
	
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_3',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_3', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Widget Area #3', 'risewp' ),
        'section' => 'risewp_home_widget_section_3', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'risewp_hw_area_3_bg_color', array(
        'default'     => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_bg_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_3_text_color', array(
        'default'     => '#656565',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_text_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_3_heading_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_3_link_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_3_link_hover_color', array(
        'default'     => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_link_hover_color', array(
        'label'	   => esc_html__( 'Link Hover Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_link_hover_color', 
		'priority' => 39
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_3_button_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_3_button_text_color', array(
        'default'     => '#2a2a2d',
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_button_text_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_3_button_hover_color', array(
        'default'     => '#3d3d41', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_button_hover_color',
		'priority' => 50  
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_3_button_hover_text_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_3_button_hover_text_color', array(
        'label'	   => esc_html__( 'Button Hover Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_3',
        'settings' => 'risewp_hw_area_3_button_hover_text_color',
		'priority' => 50  
    ))); 
	
	
	
	//Fourth Widget Area
    $wp_customize->add_section( 'risewp_home_widget_section_4' , array(   
	    'title'       => esc_html__( 'Home Widget Area #4', 'risewp' ),
	    'priority'    => 40, 
	    'description' => esc_html__( 'Edit the options for the second home page widget area.', 'risewp'),
		'panel' 	  => 'risewp_home_page_panel',
	));
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'risewp_widget_column_four', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_widget_column_four', array(
		'label'    => esc_html__( 'Number of Widget Columns', 'risewp' ),
		'description'    => esc_html__( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'risewp' ),
		'section'  => 'risewp_home_widget_section_4', 
		'settings' => 'risewp_widget_column_four', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => esc_html__( '1 Column', 'risewp' ),
			'option2' => esc_html__( '2 Columns', 'risewp' ), 
			'option3' => esc_html__( '3 Columns', 'risewp' ),
			'option4' => esc_html__( '4 Columns', 'risewp' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px;',
        ),
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_4',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_4', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Widget Area #4', 'risewp' ),
        'section' => 'risewp_home_widget_section_4', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'risewp_hw_area_4_bg_color', array(
        'default'     => '#f1f5f7',
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_bg_color',
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_4_text_color', array(
        'default'     => '#656565',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_text_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_4_heading_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_4_link_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_link_color', 
		'priority' => 38 
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_4_link_hover_color', array(
        'default'     => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_link_hover_color', array(
        'label'	   => esc_html__( 'Link Hover Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_link_hover_color', 
		'priority' => 39
    )));
	
	$wp_customize->add_setting( 'risewp_hw_area_4_button_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_4_button_text_color', array(
        'default'     => '#2a2a2d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_button_text_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_4_button_hover_color', array(
        'default'     => '#3d3d41', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_button_hover_color', 
		'priority' => 50  
    ))); 
	
	$wp_customize->add_setting( 'risewp_hw_area_4_button_hover_text_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hw_area_4_button_hover_text_color', array(
        'label'	   => esc_html__( 'Button Hover Text Color', 'risewp' ),
        'section'  => 'risewp_home_widget_section_4',
        'settings' => 'risewp_hw_area_4_button_hover_text_color', 
		'priority' => 60  
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Footer
//-------------------------------------------------------------------------------------------------------------------//
	 
	 
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => esc_html__( 'Footer', 'risewp' ),
    	'priority' => 30,
    	'description' => esc_html__( 'Customize your footer area', 'risewp' )
	)); 
	
	// Footer Text
	$wp_customize->add_setting( 'risewp_footer_text',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_footer_text', array(
	'type'     => 'textarea',
    'label' => esc_html__( 'Footer Text', 'risewp' ),
    'section' => 'footer-custom', 
    'settings' => 'risewp_footer_text', 
	'priority'   => 25
	)));

	// Footer Byline Text 
	$wp_customize->add_setting( 'risewp_footerid',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_footerid', array(
    'label' => esc_html__( 'Footer Byline Text', 'risewp' ),
    'section' => 'footer-custom', 
    'settings' => 'risewp_footerid',
	'priority'   => 30
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_byline',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_byline', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer Byline', 'risewp' ),
        'section' => 'footer-custom',  
		'priority'   => 35
    ));
	
	$wp_customize->add_setting( 'risewp_footer_color', array( 
        'default'     => '#f9f9f9',  
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_footer_color', array(
        'label'	   => esc_html__( 'Footer Background Color', 'risewp'),
        'section'  => 'footer-custom',
        'settings' => 'risewp_footer_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'risewp_footer_text_color', array( 
        'default'     => '#656565', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_footer_text_color', array(
        'label'	   => esc_html__( 'Footer Text Color', 'risewp'),
        'section'  => 'footer-custom',
        'settings' => 'risewp_footer_text_color', 
		'priority' => 50
    ))); 
	
	$wp_customize->add_setting( 'risewp_footer_link_color', array(  
        'default'     => '#3d3d41', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_footer_link_color', array(
        'label'	   => esc_html__( 'Footer Link Color', 'risewp'),  
        'section'  => 'footer-custom',
        'settings' => 'risewp_footer_link_color', 
		'priority' => 60 
    )));
	
	$wp_customize->add_setting( 'risewp_footer_link_hover_color', array(  
        'default'     => '#999999',  
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_footer_link_hover_color', array(
        'label'	   => esc_html__( 'Footer Link Hover Color', 'risewp'),  
        'section'  => 'footer-custom', 
        'settings' => 'risewp_footer_link_hover_color', 
		'priority' => 70
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Social Icons
//-------------------------------------------------------------------------------------------------------------------//

	
	//Social Section
	$wp_customize->add_section( 'risewp_settings', array(
            'title'          => esc_html__( 'Social Media Icons', 'risewp' ),
			'description'    => esc_html__( 'Edit your social media icons', 'risewp' ),
            'priority'       => 38,
    ) );
	
	//Hide Social Section 
	$wp_customize->add_setting('active_social',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_social', 
    array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Social Media Icons', 'risewp' ),
        'section' => 'risewp_settings',  
		'priority'   => 10
    ));
	
	//social font size
    $wp_customize->add_setting( 
        'risewp_social_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16', 
        )
    );
	
    $wp_customize->add_control( 'risewp_social_text_size', array(
        'type'        => 'number', 
        'priority'    => 15,
        'section'     => 'risewp_settings', 
        'label'       => esc_html__('Social Icon Size', 'risewp'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32, 
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
		
	//Social Icon Colors
	$wp_customize->add_setting( 'risewp_social_color', array( 
        'default'     => '#656565',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_social_color', array(
        'label'	   => esc_html__( 'Social Icon', 'risewp' ),
        'section'  => 'risewp_settings',
        'settings' => 'risewp_social_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'risewp_social_color_hover', array( 
        'default'     => '#999999',   
		'sanitize_callback' => 'sanitize_hex_color',  
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_social_color_hover', array(
        'label'	   => esc_html__( 'Social Icon Hover', 'risewp' ), 
        'section'  => 'risewp_settings',
        'settings' => 'risewp_social_color_hover', 
		'priority' => 30
    ))); 
	

//-------------------------------------------------------------------------------------------------------------------//
// General Colors
//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_setting( 'risewp_text_color', array(
        'default'     => '#656565',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'risewp' ),
        'section'  => 'colors',
        'settings' => 'risewp_text_color',
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'risewp_heading_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'risewp' ),
        'section'  => 'colors',
        'settings' => 'risewp_heading_color', 
		'priority' => 11
    ))); 
	
    $wp_customize->add_setting( 'risewp_link_color', array( 
        'default'     => '#3d3d41',   
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'risewp'),
        'section'  => 'colors',
        'settings' => 'risewp_link_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'risewp_hover_color', array(
        'default'     => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_hover_color', array(
        'label'	   => esc_html__( 'Hover Color', 'risewp' ), 
        'section'  => 'colors',
        'settings' => 'risewp_hover_color',
		'priority' => 35 
    ))); 
	
	
	//Page Colors
    $wp_customize->add_section( 'risewp_page_colors_section' , array(  
	    'title'       => esc_html__( 'Page Colors', 'risewp' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Set your page colors.', 'risewp'),
		'panel' => 'risewp_colors_panel', 
	));
	
	//Hide Section 
	$wp_customize->add_setting('active_header_gradient',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_header_gradient', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Disable Header Gradient', 'risewp' ),
        'section'  => 'risewp_page_colors_section',
		'priority'   => 5
    )); 
	
	$wp_customize->add_setting( 'risewp_page_header', array(
        'default'     => '#b6b9bd',  
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_page_header', array(
        'label'	   => esc_html__( 'Page Header Background Color', 'risewp' ),
        'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_page_header',
		'priority' => 10
    ))); 
	
	$wp_customize->add_setting( 'risewp_entry', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_entry', array(
        'label'	   => esc_html__( 'Entry Title Color', 'risewp' ), 
        'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_entry',  
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'risewp_content_bg', array( 
        'default'     => '#ffffff',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_content_bg', array(
        'label'	   => esc_html__( 'Content Background', 'risewp' ), 
        'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_content_bg', 
		'priority' => 22
    )));
	
	$wp_customize->add_setting( 'risewp_content_border', array( 
        'default'     => '#f3f3f3', 
		'sanitize_callback' => 'sanitize_hex_color', 
    )); 
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_content_border', array(
        'label'	   => esc_html__( 'Content Border', 'risewp' ),
        'section'  => 'risewp_page_colors_section', 
        'settings' => 'risewp_content_border',
		'priority' => 24 
    ))); 

	$wp_customize->add_setting( 'risewp_custom_color', array(
        'default'     => '#3d3d41',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_custom_color', array(
        'label'	   => esc_html__( 'Button Color', 'risewp' ),
        'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_custom_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'risewp_button_text_color', array(
        'default'     => '#2a2a2d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'risewp' ),
         'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_button_text_color',
		'priority' => 45
    ))); 
	
	$wp_customize->add_setting( 'risewp_custom_color_hover', array(
        'default'     => '#3d3d41', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_custom_color_hover', array(
        'label'	   => esc_html__( 'Button Hover Color', 'risewp' ),
        'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_custom_color_hover', 
		'priority' => 50  
    )));
	
	$wp_customize->add_setting( 'risewp_button_text_hover_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_button_text_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Text Color', 'risewp' ),
        'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_button_text_hover_color',
		'priority' => 55
    )));
	
	$wp_customize->add_setting( 'risewp_sidebar_bg', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_sidebar_bg', array(
        'label'	   => esc_html__( 'Sidebar Background', 'risewp' ),
        'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_sidebar_bg',
		'priority' => 60
    )));
	
	$wp_customize->add_setting( 'risewp_sidebar_border', array(
        'default'     => '#f3f3f3', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_sidebar_border', array(
        'label'	   => esc_html__( 'Sidebar Border', 'risewp' ),
        'section'  => 'risewp_page_colors_section',
        'settings' => 'risewp_sidebar_border',
		'priority' => 65
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Fonts
//-------------------------------------------------------------------------------------------------------------------//	
	
    $wp_customize->add_section(
        'risewp_typography',
        array(
            'title' => esc_html__('Fonts', 'risewp' ),   
            'priority' => 45, 
    ));
	
    $font_choices = 
        array(
			' ', 
			'Lato:400,700,400italic,700italic' => 'Lato',
			'Montserrat:400,700' => 'Montserrat',
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald', 
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
	
	//body font size
    $wp_customize->add_setting(
        'risewp_body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '16', 
        )
    );
	
    $wp_customize->add_control( 'risewp_body_size', array(
        'type'        => 'number', 
        'priority'    => 10,
        'section'     => 'risewp_typography',
        'label'       => esc_html__('Body Font Size', 'risewp'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 28,
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'risewp_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
			'default'           => '20', 
            'description' => esc_html__('Select your desired font for the headings. Montserrat is the default Heading font.', 'risewp'),
            'section' => 'risewp_typography',
            'choices' => $font_choices
    ));
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'risewp_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
			'default'           => '30', 
            'description' => esc_html__( 'Select your desired font for the body. Lato is the default Body font.', 'risewp' ), 
            'section' => 'risewp_typography',   
            'choices' => $font_choices 
    ));
	

//-------------------------------------------------------------------------------------------------------------------//
// Blog Layout
//-------------------------------------------------------------------------------------------------------------------//

	
	//Colors
	$wp_customize->add_panel( 'risewp_blog_panel', array( 
    	'priority'       => 38,
    	'capability'     => 'edit_theme_options',
    	'theme_supports' => '',
    	'title'          => esc_html__( 'Blog', 'risewp' ),
    	'description'    => esc_html__( 'Edit your blog settings.', 'risewp' ),
	));
	
	// header image
	$wp_customize->add_section( 'header_image', array(
		'title' => esc_html__( 'Blog Header Image', 'risewp' ),   
		'priority' => '10',
		'panel'	=> 'risewp_blog_panel'
	) );

    $wp_customize->add_section( 'risewp_layout_section' , array( 
	    'title'       => esc_html__( 'Blog Options', 'risewp' ),
	    'priority'    => 20,
		'panel'	=> 'risewp_blog_panel' 
	));
	
	// Blog Title
	$wp_customize->add_setting( 'risewp_blog_title', array(
		'sanitize_callback' => 'risewp_sanitize_text', 
		'default' => esc_html__( 'Our Latest News', 'risewp' ), 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_blog_title', array(
		'label'    => esc_html__( 'Posts Page Title', 'risewp' ),
		'section'  => 'risewp_layout_section', 
		'settings' => 'risewp_blog_title',
		'priority'   => 10 
	))); 
	
	//Blog Colors
	$wp_customize->add_setting( 'risewp_post_nav_bg', array( 
        'default'     => '#3d3d41', 
		'sanitize_callback' => 'sanitize_hex_color', 
    )); 
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_post_nav_bg', array(
        'label'	   => esc_html__( 'Post Navigation Background', 'risewp' ), 
        'section'  => 'risewp_layout_section',
        'settings' => 'risewp_post_nav_bg',
		'priority' => 40
    ))); 
	
	//Post Content
	$wp_customize->add_setting( 'risewp_post_content', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_post_content', array(
		'label'    => esc_html__( 'Post content', 'risewp' ),
		'section'  => 'risewp_layout_section',
		'settings' => 'risewp_post_content', 
		'type'     => 'radio',
		'priority'   => 30, 
		'choices'  => array(
			'option1' => esc_html__( 'Excerpts', 'risewp' ), 
			'option2' => esc_html__( 'Full content', 'risewp' ), 
			),
	)));
	
	//blog on single posts
	$wp_customize->add_setting( 'risewp_sidebar_blog_setting', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_sidebar_blog_setting', array(
		'label'    => esc_html__( 'Sidebar Option', 'risewp' ), 
		'section'  => 'risewp_layout_section',
		'settings' => 'risewp_sidebar_blog_setting', 
		'type'     => 'radio', 
		'priority'   => 31, 
		'choices'  => array(
			'option1' => esc_html__( 'Sidebar On Blog Pages', 'risewp' ),
			'option2' => esc_html__( 'No Sidebar', 'risewp' ),
			),
	))); 
	
	//Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
    ));
	
    $wp_customize->add_control( 'exc_length', array( 
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'risewp_layout_section',
        'label'       => esc_html__( 'Excerpt length', 'risewp' ),
		'priority'   => 40,
        'description' => esc_html__( 'Default: 30 words', 'risewp' ),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5
        ), 
	));
	
	//Excluded Terms
	$wp_customize->add_setting( 'risewp_post_nav_terms',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_text',
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_post_nav_terms', array(
		'label'    => esc_html__( 'Post Navigation Excluded Categories', 'risewp' ),
		'description'    => esc_html__( 'If you would like to exclude certain categories from the navigation at the bottom of single post pages, enter in the category numbers in the field below. Separate each number with a comma. For example: 15, 17, 18', 'risewp' ),
		'section'  => 'risewp_layout_section',   
		'settings' => 'risewp_post_nav_terms', 
		'priority'   => 50
	))); 
	
//-------------------------------------------------------------------------------------------------------------------//
// Post Format Options
//-------------------------------------------------------------------------------------------------------------------//


	$wp_customize->add_panel( 'risewp_plugin_panel', array(
    	'priority'       => 35, 
    	'capability'     => 'edit_theme_options',
    	'title'          => esc_html__( 'Rise Post Format Options', 'risewp' ), 
    	'description'    => esc_html__( 'If you are using any of the post format widgets or archives with Rise, you can customize the features here.', 'risewp' ),
		
	));
	

	//Projects Posts
	$wp_customize->add_section( 'risewp_plugin_projects_colors' , array(  
	    'title'       => esc_html__( 'Projects', 'risewp' ), 
		'theme_supports' => 'mt_projects',
	    'priority'    => 20, 
	    'description' => esc_html__( 'If you are using Gallery post formats, you can customize the settings here.', 'risewp'), 
		'panel' => 'risewp_plugin_panel', 
	));
	
	//Disable Hovers
	$wp_customize->add_setting('active_project_hovers',
	    array(
	        'sanitize_callback' => 'risewp_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_project_hovers', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Disable Project Hovers', 'risewp' ), 
        'section'  => 'risewp_plugin_projects_colors',
		'priority'   => 5
    )); 
	
	// Hover content settings
	$wp_customize->add_setting( 'risewp_hover_content', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_hover_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_hover_content', array(
		'label' => esc_html__( 'Project Hover Content', 'risewp' ),
		'description'    => esc_html__( 'Choose your Project hover content', 'risewp' ),
		'section'  => 'risewp_plugin_projects_colors',
		'settings' => 'risewp_hover_content', 
		'type'     => 'radio',  
		'priority'   => 10, 
		'choices'  => array(
			'option1' => esc_html__( 'Post Title', 'risewp' ), 
			'option2' => esc_html__( 'Post Excerpt', 'risewp' ), 
			'option3' => esc_html__( 'None', 'risewp' ),
			),
	))); 
	
	$wp_customize->add_setting( 'risewp_plugin_project_hover_color', array( 
        'default'     => '#2a2e39',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_plugin_project_hover_color', array(
        'label'	   => esc_html__( 'Overlay Color', 'risewp' ), 
        'section'  => 'risewp_plugin_projects_colors',
        'settings' => 'risewp_plugin_project_hover_color', 
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'risewp_plugin_project_hover_text_color', array( 
        'default'     => '#ffffff', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_plugin_project_hover_text_color', array(
        'label'	   => esc_html__( 'Title Text', 'risewp' ), 
        'section'  => 'risewp_plugin_projects_colors',
        'settings' => 'risewp_plugin_project_hover_text_color', 
		'priority' => 20 
    )));


	//Testimonials Plugins 
	$wp_customize->add_section( 'risewp_plugin_testimonial_colors' , array(  
	    'title'       => esc_html__( 'Testimonials', 'risewp' ),
		'theme_supports' => 'mt_testimonials',  
	    'priority'    => 40, 
	    'description' => esc_html__( 'If you are using Quote post formats, you can customize the settings here.', 'risewp'), 
		'panel' => 'risewp_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'risewp_plugin_testimonial_bg', array(  
        'default'     => '#ffffff',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_plugin_testimonial_bg', array(
        'label'	   => esc_html__( 'Content Background', 'risewp' ), 
        'section'  => 'risewp_plugin_testimonial_colors',
        'settings' => 'risewp_plugin_testimonial_bg', 
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'risewp_plugin_testimonial_text_color', array( 
        'default'     => '#656565', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_plugin_testimonial_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'risewp' ), 
        'section'  => 'risewp_plugin_testimonial_colors',
        'settings' => 'risewp_plugin_testimonial_text_color', 
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'risewp_plugin_testimonial_title_color', array( 
        'default'     => '#3d3d41', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'risewp_plugin_testimonial_title_color', array(
        'label'	   => esc_html__( 'Title Color', 'risewp' ), 
        'section'  => 'risewp_plugin_testimonial_colors',
        'settings' => 'risewp_plugin_testimonial_title_color', 
		'priority' => 25
    )));
	
	//Font Style
	$wp_customize->add_setting( 'risewp_plugin_testimonial_font_style', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_plugin_testimonial_font_style', array(
		'label'    => esc_html__( 'Font Style', 'risewp' ),
		'section'  => 'risewp_plugin_testimonial_colors',
		'settings' => 'risewp_plugin_testimonial_font_style',
		'type'     => 'radio',
		'priority'   => 30, 
		'choices'  => array(
			'option1' => esc_html__( 'Italic', 'risewp' ),
			'option2' => esc_html__( 'Normal', 'risewp' ), 
			),
	)));
	
	//Archive Options
	$wp_customize->add_section( 'risewp_archive_options' , array(  
	    'title'       => esc_html__( 'Post Format Archive Options', 'risewp' ), 
		'theme_supports' => 'mt_projects',  
	    'priority'    => 40, 
	    'description' => esc_html__( 'Edit your post format archive options here.', 'risewp'), 
		'panel' => 'risewp_plugin_panel',
	));
	
	//Projects Columns
    $wp_customize->add_setting( 
        'risewp_projects_columns_number',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '3', 
        )
    );
	
    $wp_customize->add_control( 'risewp_projects_columns_number', array(
        'type'        => 'number', 
        'priority'    => 10,
        'section'     => 'risewp_archive_options', 
        'label'       => esc_html__('Projects Page Columns Width', 'risewp'),
		'description' => esc_html__('Set the width of the each Projects Column. 1 = 100% of the width, 4 = 25% of the width.', 'risewp'), 
        'input_attrs' => array(
            'min'   => 1,
            'max'   => 5,  
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ), 
  	)); 
	
	//Testimonial Columns
    $wp_customize->add_setting( 
        'risewp_testimonial_columns_number',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '3', 
        )
    );
	
    $wp_customize->add_control( 'risewp_testimonial_columns_number', array(
        'type'        => 'number', 
        'priority'    => 20,
        'section'     => 'risewp_archive_options', 
        'label'       => esc_html__('Testimonial Page Columns Width', 'risewp'),
		'description' => esc_html__('Set the width of the each Testimonial Column. 1 = 100% of the width, 4 = 25% of the width.', 'risewp'), 
        'input_attrs' => array(
            'min'   => 1,
            'max'   => 5,  
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ), 
  	)); 
	
	
	//content placement
	$wp_customize->add_setting( 'risewp_archive_content_setting', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'risewp_sanitize_index_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'risewp_archive_content_setting', array(
		'label'    => esc_html__( 'Post Format Archive Placement', 'risewp' ),  
		'section'     => 'risewp_archive_options',
		'settings' => 'risewp_archive_content_setting', 
		'type'     => 'radio', 
		'priority'   => 30, 
		'choices'  => array(
			'option1' => esc_html__( 'Above Content', 'risewp' ),
			'option2' => esc_html__( 'Below Content', 'risewp' ),
			),
	))); 
	

}
add_action( 'customize_register', 'risewp_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function risewp_customize_preview_js() {
	wp_enqueue_script( 'risewp_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'risewp_customize_preview_js' );
