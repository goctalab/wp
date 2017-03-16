<?php
/**
 * risewp functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package risewp 
 */

if ( ! function_exists( 'risewp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function risewp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on risewp, use a find and replace
	 * to change 'risewp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'risewp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'risewp-home-project', 400, 400, array( 'center', 'center' ) ); 
	add_image_size( 'risewp-home-blog', 400, 250, true );

	// This theme uses wp_nav_menu() in one location. 
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'risewp' ),
		'social'  => esc_html__( 'Social', 'risewp' ), 
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'quote', 
	) );
	
	/* Editor styles. */
	add_editor_style( risewp_get_editor_styles() ); 
	
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Set logo support
    add_theme_support( 'custom-logo' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'risewp_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'custom-header', apply_filters( 'risewp_custom_header_args', array(
		'default-text-color'     => 'ffffff',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'risewp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function risewp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'risewp_content_width', 640 );
}
add_action( 'after_setup_theme', 'risewp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function risewp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'risewp' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) ); 
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area #1', 'risewp' ),
		'id'            => 'home-widget-area-one',
		'description'   => esc_html__( 'Use this widget area to display home page content', 'risewp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area #2', 'risewp' ), 
		'id'            => 'home-widget-area-two',
		'description'   => esc_html__( 'Use this widget area to display home page content', 'risewp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area #3', 'risewp' ), 
		'id'            => 'home-widget-area-three', 
		'description'   => esc_html__( 'Use this widget area to display home page content', 'risewp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) ); 
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area #4', 'risewp' ), 
		'id'            => 'home-widget-area-four', 
		'description'   => esc_html__( 'Use this widget area to display home page content', 'risewp' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>', 
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'risewp_widgets_init' );


if ( ! function_exists( 'risewp_body_fonts_url' ) ) :

function risewp_body_fonts_url() {

	$body_font = esc_html( get_theme_mod('body_fonts' ));
	
	$body_font_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
		
	if( $body_font ) :
		
		$fonts[] = $body_font;
		
	else :
		
		$fonts[] = 'Lato:400,400italic,700,700italic';
		
	endif;

	
	if ( $fonts ) {
		
		$body_font_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
			
	}

	return $body_font_url;
	
}

endif;


if ( ! function_exists( 'risewp_headings_fonts_url' ) ) :

function risewp_headings_fonts_url() {
	
	$headings_font = esc_html( get_theme_mod('headings_fonts' ));
	
	$headings_font_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
		
	if( $headings_font ) :
		
		$fonts[] = $headings_font;
		
	else :
		
		$fonts[] = 'Montserrat:400,700';
		
	endif;

	
	if ( $fonts ) {
		
		$headings_font_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
			
	}

	return $headings_font_url;
	
}

endif;


/**
 * Enqueue scripts and styles.
 */
function risewp_scripts() {
	wp_enqueue_style( 'risewp-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'risewp-headings-google-fonts', risewp_headings_fonts_url(), array(), null ); 
	
	wp_enqueue_style( 'risewp-body-google-fonts', risewp_body_fonts_url(), array(), null );
	
	wp_enqueue_style( 'risewp-column-clear', get_template_directory_uri() . '/css/mt-column-clear.css' );
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.css' ); 

	wp_enqueue_style( 'jpushmenu', get_template_directory_uri() . '/css/jPushMenu.css' );
	
	if ( get_theme_mod( 'active_project_hovers' ) == '' ) :
	
		wp_enqueue_style( 'risewp-projects-css', get_template_directory_uri() . '/css/risewp-projects.css' );
        
   	else:
	
		wp_enqueue_style( 'risewp-projects-no-hover-css', get_template_directory_uri() . '/css/risewp-projects-no-hover.css' );
        
	endif; 
	
	wp_enqueue_style( 'risewp-testimonials-css', get_template_directory_uri() . '/css/risewp-testimonials.css' ); 
	
	
	if ( get_theme_mod( 'active_header_gradient' ) ) :   
        
    	wp_enqueue_style( 'risewp-no-gradient-css', get_template_directory_uri() . '/css/risewp-no-gradient.css' );
        
	endif; 

	wp_enqueue_script( 'risewp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'risewp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), false, true );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'jpushmenu', get_template_directory_uri() . '/js/jPushMenu.js', array('jquery'), false, true );

	wp_enqueue_script( 'risewp-jpushmenu-script', get_template_directory_uri() . '/js/menu.script.js', array(), false, true );
	
	wp_enqueue_script( 'parallax', get_template_directory_uri() . '/js/parallax.js', array('jquery'), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} 
add_action( 'wp_enqueue_scripts', 'risewp_scripts' );


/**
 * Change the excerpt length
 */
function risewp_excerpt_length( $length ) {
	
	$excerpt = esc_attr( get_theme_mod('exc_length', '15')); 
	return $excerpt; 

}

add_filter( 'excerpt_length', 'risewp_excerpt_length', 999 );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php'; 

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/risewp-styles.php';
require get_template_directory() . '/inc/risewp-sanitize.php';
require get_template_directory() . '/inc/risewp-active-options.php'; 

/**
 * Sidebar widget columns
 */
require get_template_directory() . '/inc/risewp-sidebar-columns.php'; 

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';
require get_template_directory() . '/panel/risewp-theme-admin-page.php';


// allow skype names in social menu
function risewp_allow_skype_protocol( $protocols ){
    $protocols[] = 'skype';
    return $protocols;
}
add_filter( 'kses_allowed_protocols' , 'risewp_allow_skype_protocol' );


/**
 * get out of that loop
 */
function risewp_exclude_post_formats_from_blog( $risewp_blog_query ) {

	if( $risewp_blog_query->is_main_query() && $risewp_blog_query->is_home() ) {
		$risewp_tax_query = array( array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => array( 'post-format-gallery', 'post-format-quote' ),
			'operator' => 'NOT IN',
		) );
		$risewp_blog_query->set( 'tax_query', $risewp_tax_query ); 
	}

}
add_action( 'pre_get_posts', 'risewp_exclude_post_formats_from_blog' );

