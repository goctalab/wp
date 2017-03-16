<?php 

			
/*-----------------------------------------------------------------------------------------------------//
	Home Widget One
-------------------------------------------------------------------------------------------------------*/
	
function risewp_home_widget_one_style() {

	$widget_column_one = esc_html( get_theme_mod( 'risewp_widget_column_one', 'option1' )); 
    			
	if( $widget_column_one != '' ) { 
    
		switch ( $widget_column_one ) { 
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-section-1 .widget { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-1 .widget { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-section-1 .widget { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-1 .widget { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-section-1 .widget { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-1 .widget { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break; 
				
        }
    }
	
}
	
add_action( 'wp_enqueue_scripts', 'risewp_home_widget_one_style' );
	
	
	
/*-----------------------------------------------------------------------------------------------------//
	Home Widget Two
-------------------------------------------------------------------------------------------------------*/

function risewp_home_widget_two_style() {
	
	$widget_column_two = esc_html( get_theme_mod( 'risewp_widget_column_two', 'option1' ));
    			
	if( $widget_column_two != '' ) {
    
		switch ( $widget_column_two ) { 
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-section-2 .widget, .home-section-2 section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-2 .widget, .home-section-2 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-section-2 .widget, .home-section-2 section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-2 .widget, .home-section-2 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-section-2 .widget, .home-section-2 section { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-2 .widget, .home-section-2 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break;
				
        }
    }
	
}

add_action( 'wp_enqueue_scripts', 'risewp_home_widget_two_style' );


/*-----------------------------------------------------------------------------------------------------//
	Home Widget Three
-------------------------------------------------------------------------------------------------------*/

function risewp_home_widget_three_style() {
	
	$widget_column_three = esc_html( get_theme_mod( 'risewp_widget_column_three', 'option1' ));
    			
	if( $widget_column_three != '' ) {
    
		switch ( $widget_column_three ) {  
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-section-3 .widget, .home-section-3 section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-3 .widget, .home-section-3 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-section-3 .widget, .home-section-3 section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-3 .widget, .home-section-3 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-section-3 .widget, .home-section-3 section { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-3 .widget, .home-section-3 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break;
				
        }
    }
	
}

add_action( 'wp_enqueue_scripts', 'risewp_home_widget_three_style' );



/*-----------------------------------------------------------------------------------------------------//
	Home Widget Four
-------------------------------------------------------------------------------------------------------*/

function risewp_home_widget_four_style() {
	
	$widget_column_four = esc_html( get_theme_mod( 'risewp_widget_column_four', 'option1' ));
    			
	if( $widget_column_four != '' ) {
    
		switch ( $widget_column_four ) { 
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-section-4 .widget, .home-section-4 section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-4 .widget, .home-section-4 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-section-4 .widget, .home-section-4 section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-4 .widget, .home-section-4 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-section-4 .widget, .home-section-4 section { width: 25%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-section-4 .widget, .home-section-4 section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>'; 
                break;  
				
        }
    }
	
}

add_action( 'wp_enqueue_scripts', 'risewp_home_widget_four_style' ); 
