<?php
/**
 * The template part for displaying home widget area
 *
 * @package risewp 
 */
?>



	<?php if ( is_active_sidebar('home-widget-area-four') ) : ?>
            
    	<div id="home-section" class="home-section-4">
        	<div class="grid grid-pad">
            	<div class="col-1-1">
                	
					<?php dynamic_sidebar('home-widget-area-four'); ?>
                	
                </div>
            </div>
       	</div><!-- .home-widget --> 
                
	<?php endif; ?>
        