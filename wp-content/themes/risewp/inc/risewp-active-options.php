<?php	

/**
 * check to see if Home News is active
 */
function risewp_news_support() {
	
    if( is_active_widget( '', '', 'risewp_home_news') ) {  
		
        add_theme_support('mt_news');
  
	}
	
}
add_action('after_setup_theme', 'risewp_news_support'); 

 
/**
 * check to see if Projects is active 
 */
function risewp_projects_support() {
	
    if( is_active_widget( '', '', 'risewp_pf_posts') ||  has_post_format( 'gallery' ) ) {   
		
        add_theme_support('mt_projects');
  
	}
	
}
add_action('after_setup_theme', 'risewp_projects_support');


/**
 * check to see if Projects is active 
 */
function risewp_testimonials_support() {
	
    if( is_active_widget( '', '', 'risewp_pf_posts') ||  has_post_format( 'quote' ) ) {  
		
        add_theme_support('mt_testimonials');
  
	}
	
}
add_action('after_setup_theme', 'risewp_testimonials_support'); 
