<?php
/**
Template Name: Home Page
 *
 * @package risewp
 */

get_header(); ?>


<?php if ( get_theme_mod( 'risewp_home_bg_image' ) ) : ?>
	<section id="home-hero" class="hero-image">
<?php else: ?>
	<section id="home-hero" class="hero-no-image">
<?php endif; ?>
	
    <div class="hero-content">
    	<div>
        	<span>
            	
                <?php if ( get_theme_mod( 'risewp_home_title' ) ) : ?>
    				<h1 class="hero-title">
						<?php echo wp_kses_post( get_theme_mod( 'risewp_home_title' )); ?>
                    </h1>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'risewp_home_excerpt' ) ) : ?>
        			<h3 class="hero-excerpt">
                    	<?php echo wp_kses_post( get_theme_mod( 'risewp_home_excerpt' )); ?>
                    </h3>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'risewp_home_button_url' ) ) : ?>
        			
                    <a href="<?php echo esc_url( get_page_link( get_theme_mod('risewp_home_button_url'))) ?>" class="button">
                
                <?php elseif ( get_theme_mod( 'risewp_page_url_text' ) ) : ?> 
                            
    				<a href="<?php echo esc_url( get_theme_mod ( 'risewp_page_url_text' )) ?>" class="button" target="_blank">
                    
                <?php else: ?> 
                                   
				<?php endif; ?>
                
                    	
						<?php if ( get_theme_mod( 'risewp_home_button_text' ) ) : ?>
                        
                        	<?php echo esc_html( get_theme_mod( 'risewp_home_button_text' )); ?> 
                            
                        <?php endif; ?>
                        
            	
                <?php if ( get_theme_mod( 'risewp_home_button_url' ) ) : ?>
        			
                    </a>
                
                <?php elseif ( get_theme_mod( 'risewp_page_url_text' ) ) : ?> 
                            
    				</a>
                                   
				<?php else: ?>
                                   
				<?php endif; ?>    
                	
                
            </span>
        </div>
    </div>
    
	<?php if ( get_theme_mod( 'risewp_home_bg_image' ) ) : ?>
		<img src="<?php echo esc_url( get_theme_mod( 'risewp_home_bg_image' )); ?>" class="risewp-home-bg-image"> 
    <?php endif; ?>
    
    
<?php if ( get_theme_mod( 'risewp_home_bg_image' ) ) : ?>
	</section>
<?php else: ?>
	</section>
<?php endif; ?>

 
<section id="page-container" class="page-wrap home-page-wrap">
         
	
	<?php if ( get_theme_mod( 'active_hw_1' ) == '' ) : ?>
        
    	<?php get_sidebar( 'home-widget-1' ); // sidebar 1 ?>  	
        
	<?php endif; ?>
    
    
    
    <?php if ( get_theme_mod( 'active_hw_2' ) == '' ) : ?>
        
    	<?php get_sidebar( 'home-widget-2' ); // sidebar 2 ?> 	
        
	<?php endif; ?> 
    
    
    
    <?php if ( get_theme_mod( 'active_hw_3' ) == '' ) : ?>
        
    	<?php get_sidebar( 'home-widget-3' ); // sidebar 3 ?> 	
        
	<?php endif; ?>
    
    
    
    <?php if ( get_theme_mod( 'active_hw_4' ) == '' ) : ?>
        
    	<?php get_sidebar( 'home-widget-4' ); // sidebar 4 ?> 	
        
	<?php endif; ?>
    
            
</section>

<?php
get_footer();
