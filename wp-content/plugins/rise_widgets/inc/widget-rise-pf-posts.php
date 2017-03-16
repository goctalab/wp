<?php



class rise_pf_posts extends WP_Widget {



// constructor

    function rise_pf_posts() {

		$widget_ops = array('classname' => 'rise_pf_posts_widget', 'description' => esc_html__( 'Use this widget to display your post formats.', 'rise_widgets') );

        parent::__construct( false, $name = esc_html__('MT - Rise Post Formats', 'rise_widgets'), $widget_ops ); 

		$this->alt_option_name = 'rise_pf_posts_widget';

		

		add_action( 'save_post', array($this, 'flush_widget_cache') );

		add_action( 'deleted_post', array($this, 'flush_widget_cache') );

		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		

    }

	

	// widget form creation
	
	function form($instance) { 



	// Check values
	
		$post_format_sel 	= isset( $instance['post_format_sel'] ) ? sanitize_text_field( $instance['post_format_sel'] ) : '';

		$title     		= isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
		
		$post_excerpt  = isset( $instance['post_excerpt'] ) ? sanitize_text_field( $instance['post_excerpt'] ) : '';

		$category  		= isset( $instance['category'] ) ? sanitize_text_field( $instance['category'] ) : '';
		
		$number    		= isset( $instance['number'] ) ? sanitize_text_field( $instance['number'] ) : 3;
		
		$columnset    	= isset( $instance['columnset'] ) ? sanitize_text_field( $instance['columnset'] ) : 3;
		
		$see_all   		= isset( $instance['see_all'] ) ? sanitize_text_field( $instance['see_all'] ) : ''; 

		$see_all_text  	= isset( $instance['see_all_text'] ) ? sanitize_text_field( $instance['see_all_text'] ) : esc_html__( 'See All', 'rise_widgets' );		
		
		$random 		= isset( $instance['random'] ) ? (bool) $instance['random'] : false;	
	

	?>
    

	<!-- Post Format Selector -->
    
     <p>
      <label for="<?php echo sanitize_text_field( $this->get_field_id('text')); ?>"> <?php echo esc_html__( 'Post Format:', 'rise_widgets' ); ?>
      
        <select class='widefat' id="<?php echo sanitize_text_field( $this->get_field_id('post_format_sel')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('post_format_sel')); ?>" type="text">
                
     	<option value='Projects'<?php echo ($post_format_sel=='Projects') ? 'selected' : ''; ?> ><?php echo esc_html__( 'Projects', 'rise_widgets' ); ?></option>
        <option value='Testimonials'<?php echo ( $post_format_sel=='Testimonials' ) ? 'selected' : ''; ?> ><?php echo esc_html__( 'Testimonials', 'rise_widgets' ); ?></option>
            
        </select>
                     
      </label>
     </p>
     
	<!-- Post Format Selector END -->


	<p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'rise_widgets'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

	</p>
    
    
    <p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('post_excerpt')); ?>"><?php esc_html_e('Excerpt', 'rise_widgets'); ?></label>
    
    <textarea class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('post_excerpt')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('post_excerpt')); ?>"><?php echo wp_kses_post( $post_excerpt ); ?></textarea> 

	</p>
    
    
    <p>
    
    <label for="<?php echo sanitize_text_field( $this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of Posts to Display', 'rise_widgets' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'number' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'number' )); ?>" type="text" value="<?php echo intval( $number ); ?>" size="3" /> 
    
    </p>	
    
    
    <p>
    
    <label for="<?php echo sanitize_text_field( $this->get_field_id( 'columnset' )); ?>"><?php esc_html_e( 'Number of Columns', 'rise_widgets' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'columnset' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'columnset' )); ?>" type="text" value="<?php echo intval( $columnset ); ?>" size="3" />
    
    </p> 	
    
    
    <p>
    
    <label for="<?php echo sanitize_text_field( $this->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Enter the slug for your category or leave empty to show posts from all categories.', 'rise_widgets' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'category' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'category' )); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" size="3" />
    
    </p>
    
    
    <p>
    
    <label for="<?php echo sanitize_text_field( $this->get_field_id('see_all')); ?>"><?php esc_html_e( 'Enter the URL for your Projects or Testimonials archive:', 'rise_widgets' ); ?></label>

	<input class="widefat custom_media_url" id="<?php echo sanitize_text_field( $this->get_field_id( 'see_all' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'see_all' )); ?>" type="text" value="<?php echo esc_url_raw( $see_all ); ?>" size="3" />
    
    </p> 	


    <p>
    
    <label for="<?php echo sanitize_text_field( $this->get_field_id('see_all_text')); ?>"><?php esc_html_e('Button Text. Default is set to See All.', 'rise_widgets'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'see_all_text' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'see_all_text' )); ?>" type="text" value="<?php echo esc_html( $see_all_text ); ?>" size="3" />
    
    </p>
    
    
    <!-- random -->
     
     <p>
     
     <input class="checkbox" type="checkbox" <?php checked( $random ); ?> id="<?php echo sanitize_text_field( $this->get_field_id( 'random' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'random' )); ?>" />

	<label for="<?php echo sanitize_text_field( $this->get_field_id( 'random' )); ?>"><?php esc_html_e( 'Click to show Posts in Random order', 'rise_widgets' ); ?></label> 
    
    </p>
    
    <!-- end random -->

	

	<?php

	}



	// update widget

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		
		$instance['post_format_sel'] 	= sanitize_text_field($new_instance['post_format_sel']);	

		$instance['title'] 				= sanitize_text_field($new_instance['title']); 
		
		$instance['post_excerpt']  		= sanitize_text_field($new_instance['post_excerpt']); 

		$instance['category'] 			= sanitize_text_field($new_instance['category']);
		
		$instance['number'] 			= sanitize_text_field($new_instance['number']); 
		
		$instance['columnset'] 			= sanitize_text_field($new_instance['columnset']);
		
		$instance['see_all'] 			= sanitize_text_field( $new_instance['see_all'] );

		$instance['see_all_text'] 		= sanitize_text_field($new_instance['see_all_text']);	
		
		$instance['random'] 			= isset( $new_instance['random'] ) ? (bool) $new_instance['random'] : false;			

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset($alloptions['rise_pf_posts']) )

			delete_option('rise_pf_posts');	  

		  

		return $instance;

	}

	

	function flush_widget_cache() {

		wp_cache_delete('rise_pf_posts', 'widget');

	}

	

	// display widget

	function widget($args, $instance) {

		$cache = array();

		if ( ! $this->is_preview() ) {

			$cache = wp_cache_get( 'rise_pf_posts', 'widget' );

		}



		if ( ! is_array( $cache ) ) {

			$cache = array();

		}



		if ( ! isset( $args['widget_id'] ) ) { 

			$args['widget_id'] = $this->id;

		}



		if ( isset( $cache[ $args['widget_id'] ] ) ) {

			echo wp_kses_post( $cache[ $args['widget_id'] ] ); 

			return;

		}



		ob_start();

		extract($args);



		/** This filter is documented in wp-includes/default-widgets.php */
		
		$post_format_sel = isset( $instance['post_format_sel'] ) ? sanitize_text_field( $instance['post_format_sel'] ) : ''; 

		$title = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : ''; 
		
		$post_excerpt  = isset( $instance['post_excerpt'] ) ? sanitize_text_field( $instance['post_excerpt'] ) : '';
		
		$see_all_text = isset( $instance['see_all_text'] ) ? sanitize_text_field($instance['see_all_text']) : esc_html__( 'See All', 'rise_widgets' );
		
		$see_all = isset( $instance['see_all'] ) ? sanitize_text_field($instance['see_all']) : '';	

		$category = isset( $instance['category'] ) ? sanitize_text_field($instance['category']) : '';
		
		$number = ( ! empty( $instance['number'] ) ) ? sanitize_text_field( $instance['number'] ) : 3;

		if ( ! $number )

			$number = 3;
			
		$columnset 		= ( ! empty( $instance['columnset'] ) ) ? sanitize_text_field( $instance['columnset'] ) : 3;
		
		if ( ! $columnset ) 

			$columnset = 3; 
			
		$random 		= isset( $instance['random'] ) ? (bool) $instance['random'] : false;

		if ( $random ) {

			$random = 'rand';	

		} else {

			$random = 'date';

		}
		

		
        /**
		 *

		 * @see WP_Query::get_posts()

		 *

		 * @param array $args An array of arguments used to retrieve the recent posts.

		 */

		if ( $post_format_sel=='Projects' ) :

		$mt = new WP_Query( apply_filters( 'widget_posts_args', array(
		
			'post_type' 		  => 'post', 

			'post_status'         => 'publish',

			'posts_per_page'	  => $number,

			'category_name'		  => $category,
			
			'orderby'        	  => $random,
			
			'tax_query' => 	
						
				array(
				
					array(
      				'taxonomy' => 'post_format',
      				'field' => 'slug',
      				'terms' => 'post-format-gallery',
 				
		))))); 
			 
			 
		endif;
		
		
		if ( $post_format_sel=='Testimonials' ) :
		
		
		$mt = new WP_Query( apply_filters( 'widget_posts_args', array(
		
			'post_type' 		  => 'post', 

			'post_status'         => 'publish',

			'posts_per_page'	  => $number,

			'category_name'		  => $category,
			
			'orderby'        	  => $random,
			
			'tax_query' => 	
						
				array(
				
					array(
      				'taxonomy' => 'post_format',
      				'field' => 'slug',
      				'terms' => 'post-format-quote',
 				
		)))));
		
		
		endif;



		if ($mt->have_posts()) :

		
			echo $args['before_widget']; 
		
		
        
        		if ( $post_format_sel=='Projects' ) : ?>
        

					<div class="home-projects">
        
        				<?php if ( $title ) : ?>
        
        					<div class="grid grid-pad">
            					<div class="col-1-1"> 
                    	
								<?php if ( $title ) : ?> 
                        	
                           			<h2 class="home-title">
										<?php echo wp_kses_post( $title ) ?>
                        			</h2>
						   
								<?php endif; ?>
                        
								
								<?php if ( $post_excerpt ) : ?> 
                        
									<p class="home-excerpt">
										<?php echo wp_kses_post( $post_excerpt ) ?> 
                            		</p>
                            
								<?php endif; ?>
                       
                				</div><!-- col-1-1 -->   
            				</div><!-- grid -->
            
        				<?php endif; ?>
            
            			
                        <div class="grid grid-pad"> 
            			
							<?php if ( $mt->have_posts() ) : ?>
                			
                            	<div class="rise-iso-grid"> 
                
								<!-- the loop -->
								<?php while ( $mt->have_posts() ) : $mt->the_post(); ?>
                    			
									<?php if ( has_post_format( 'gallery' )) : ?>
                        				
                                        <div class="col-1-<?php echo esc_html( $columnset ); ?> mt-column-clear rise-project-container"> 
                            				<div class="rise-view rise-effect">   
  												
                                                <a href="<?php the_permalink(); ?>">
                                            
                                        			<?php if ( has_post_thumbnail() ): 
                                                
                                         			$rise_project_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'rise-home-project' ); ?>    
                                                
                                        				<img src="<?php echo esc_url( $rise_project_src[0] ); ?>" class="rise_item_image">    
                                                    
                                        			<?php endif;
                            
                            
                            						if ( get_theme_mod('active_hover_effect') == '' ) : 
											
													$rise_hover_content = get_theme_mod( 'rise_hover_content', 'option1' ); 
    													
        											switch ( $rise_hover_content ) { 
													 
            											case 'option1': 
                									
                            								the_title( '<h2 class="rise_item_title">', '</h2>' );
                								
														break;
												
            											case 'option2': ?> 
                                                    
                                							<div class="rise-project-excerpt"><?php the_excerpt(); ?></div>  
                           	
                										<?php break;
												
            											case 'option3': 
													
													}
    											
													endif; ?> 
                                                 
                                   				</a>
  											
                                            <div class="rise-mask"></div> 
                                		</div>
									</div> 
                                   
                        		<?php endif; ?> 
                    	
							<?php endwhile; ?>
							<!-- end of the loop -->
                    
                    	</div> 
                    
					
            	<?php else : ?> 
                
                
					<p><?php esc_html__( 'Sorry, no Projects have been added yet!', 'rise_widgets' ); ?></p> 
                    
                    
				<?php endif; ?>
                
                    
            </div><!-- grid -->
            

			<?php if ($see_all != '') : ?>
                
			
            	<a href="<?php echo esc_url($see_all); ?>" class="rise-widget-button">  

					<?php if ($see_all_text) : ?>

						<button><?php echo esc_html( $see_all_text ); ?></button>

					<?php else : ?>

						<button><?php echo esc_html__('See All', 'rise_widgets'); ?></button> 

					<?php endif; ?>

				</a>
                    

			<?php endif; ?>	
                
                
                
        </div><!-- home-projects -->
		
        
    <?php endif;
    
        
    if ( $post_format_sel=='Testimonials' ) : ?>
    
    	
        <div class="home-testimonial">
        	
			<?php if ( $title ) : ?>
        
        		<div class="grid grid-pad">
            		<div class="col-1-1"> 
                    	
						<?php if ( $title ) : ?> 
                        	
                           	<h2 class="home-title">
								<?php echo wp_kses_post( $title ) ?>
                        	</h2>
						   
						<?php endif; ?>
                        
						<?php if ( $post_excerpt ) : ?> 
                        
							<p class="home-excerpt">
								<?php echo wp_kses_post( $post_excerpt ) ?> 
                            </p>
                            
						<?php endif; ?>
                       
                	</div><!-- col-1-1 -->   
            	</div><!-- grid -->
            
        	<?php endif; ?>
            	
                
        		<div class="grid grid-pad"> 
                	
                    
					<?php if ( $mt->have_posts() ) : ?>
		
					
						<!-- the loop -->
						<?php while ( $mt->have_posts() ) : $mt->the_post(); ?>
                    
        		
							<?php if ( has_post_format( 'quote' )) : ?>
								
                                <div class="col-1-<?php echo esc_html( $columnset ); ?> mt-column-clear">
                                	<div class="testimonial">
            								
										<?php the_content( '<p>', '</p>' ); ?>
                                            
										<?php if ( has_post_thumbnail( get_the_id() ) ): ?>
                							<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'rise-testimonial-img' ) ); ?> 
                                       	<?php endif; ?>
                							
										<?php the_title( '<h3>', '</h3>' ); ?>
                							
                					</div>
								</div>  
							
							<?php endif; ?> 
                        
                            
						<?php endwhile; ?>
						<!-- end of the loop -->
                 	
					<?php else : ?> 
                		
                        <p><?php esc_html__( 'Sorry, no Testimonials have been added yet!', 'rise_widgets' ); ?></p>
                    
					<?php endif; ?>
                
                
                </div><!-- grid -->
  						
                
                <?php if ($see_all != '') : ?>
                

					<a href="<?php echo esc_url($see_all); ?>" class="rise-widget-button">  

						<?php if ($see_all_text) : ?>

							<button><?php echo esc_html( $see_all_text ); ?></button>

						<?php else : ?>

							<button><?php echo esc_html__('See All', 'rise_widgets'); ?></button> 

						<?php endif; ?>

					</a>
                    

				<?php endif; ?>	
                
                
        </div><!-- home-testimonial -->
        
    
    <?php endif;
	

	
	echo $args['after_widget']; 


	// Reset the global $the_post as this query will have stomped on it

	wp_reset_postdata();


	endif;



		if ( ! $this->is_preview() ) {

			$cache[ $args['widget_id'] ] = ob_get_flush();

			wp_cache_set( 'rise_pf_posts', $cache, 'widget' );

		} else {

			ob_end_flush(); 

		}

	}


	

}