<?php
/**
 * Template part for displaying Projects page content
 * 
 *
 * @package risewp
 */

?>


	<?php 
	// the query
	$risewp_project_page_query = new WP_Query( array(  
	
		'posts_per_page' => -1,
		
		'tax_query' => 	
						
				array(
				
					array(
      				'taxonomy' => 'post_format',
      				'field' => 'slug',
      				'terms' => 'post-format-gallery',
 				
		)))); 
		
	?>
		
	<?php if ( $risewp_project_page_query->have_posts() ) : ?> 
	<!-- pagination here -->
		
    	<div class="grid grid-pad">   
    		<div class="risewp-iso-grid"> 
                
					
		<!-- the loop -->
		<?php while ( $risewp_project_page_query->have_posts() ) : $risewp_project_page_query->the_post(); ?>
                    
        		
			<?php if ( has_post_format( 'gallery' )) : ?>
                        
                <?php $risewp_projects_columns_number = esc_html( get_theme_mod( 'risewp_projects_columns_number', '3' )); ?>
                        
				<div class="col-1-<?php echo esc_html( $risewp_projects_columns_number ); ?> mt-column-clear risewp-project-container"> 
                	<div class="risewp-view risewp-effect">   
  						<a href="<?php the_permalink(); ?>">
                                            
                        	<?php if ( has_post_thumbnail() ): 
                                                
                            	$risewp_project_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'risewp-home-project' ); ?>    
                                                
                                 <img src="<?php echo esc_url( $risewp_project_src[0] ); ?>" class="risewp_item_image">    
                                                    
                            <?php endif;
                            
                            
                            if ( get_theme_mod('active_hover_effect') == '' ) :  
											
							$risewp_hover_content = get_theme_mod( 'risewp_hover_content', 'option1' ); 
    													
        					switch ( $risewp_hover_content ) { 
													 
            				case 'option1': 
                									
                            	the_title( '<h2 class="risewp_item_title">', '</h2>' );
                								
							break;
												
            				case 'option2': 
                                                    
                                the_excerpt( '<p class="risewp_item_title">', '</p>' ); 
                           	
                	
                			break; 
												
            				case 'option3': 
												
													
                                                
							}
    											
							endif; ?>
                            
                            
                                                 
                        </a>
  						<div class="risewp-mask"></div> 
                    </div>
				</div> 
                                   
                            
         	<?php endif; ?> 
                        
		<?php endwhile; ?>
		<!-- end of the loop --> 
                    
                    
        	</div>
        </div>  
                    
					
   	<?php else : ?> 
                
                
		<p><?php esc_html__( 'Sorry, no Projects have been added yet!', 'risewp' ); ?></p>
                    
                    
	<?php endif; 
	
	// Reset the global $the_post as this query will have stomped on it  

		wp_reset_postdata();   ?>
                                    
                                    
                                    