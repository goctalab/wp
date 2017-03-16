<?php
/**
 * risewp Theme Customizer 
 *
 * @package risewp
 */


/**
 * Sanitizes our post content value (either excerpts or full post content).
 *
 * @since 1.7
 */
function risewp_sanitize_index_content( $content ) {
	if ( 'option2' == $content ) {
		return 'option2';
	} else {
		return 'option1'; 
	} 
}

//Checkboxes
function risewp_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

//Integers
function risewp_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

//Text
function risewp_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//sanitize widget content
function risewp_sanitize_widget_content( $input ) {
    $valid = array( 
        'option1' => '1 Column',
		'option2' => '2 Columns',
		'option3' => '3 Columns',  
		'option4' => '4 Columns',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
} 

//Content
function risewp_sanitize_hover_content( $input ) {
    $valid = array(
      'option1' => '',
      'option2' => '',
	  'option3' => '', 
    ); 

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'option1';
    }
} 

//Sanitizes Fonts 
function risewp_sanitize_fonts( $input ) {  
    $valid = array(
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
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//Menu
function risewp_sanitize_menu_toggle_display( $input ) { 
    $valid = array(
      'icon' => '',
      'label' => '', 
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'label';
    }
}