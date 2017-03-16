<?php
/**
 * The template part for displaying home widget area
 *
 * @package risewp
 */
?>


	<?php if ( is_active_sidebar('home-widget-area-two') ) : ?>
        
    	<div id="home-section" class="home-section-2">
        	<div class="grid grid-pad">
            	<div class="col-1-1">
                	
					<?php dynamic_sidebar('home-widget-area-two'); ?>
                		
                </div>
            </div> 
        </div><!-- .home-widget --> 
                
   	<?php endif; ?>