<?php



class rise_home_news extends WP_Widget {



// constructor

    function rise_home_news() {

		$widget_ops = array('classname' => 'rise_home_news_widget', 'description' => esc_html__( 'Show your blog posts on your home page.', 'rise_widgets') );

        parent::__construct(false, $name = esc_html__('MT - Home Posts', 'rise_widgets'), $widget_ops);

		$this->alt_option_name = 'rise_home_news_widget'; 

		

		add_action( 'save_post', array($this, 'flush_widget_cache') );

		add_action( 'deleted_post', array($this, 'flush_widget_cache') );

		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		

    }

	

	// widget form creation

	function form($instance) { 



	// Check values

		$title     		= isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';

		$category  		= isset( $instance['category'] ) ? sanitize_text_field( $instance['category'] ) : ''; 
		
		$number    		= isset( $instance['number'] ) ? sanitize_text_field( $instance['number'] ) : 3;
		
		$columnset    	= isset( $instance['columnset'] ) ? sanitize_text_field( $instance['columnset'] ) : 3;

		$see_all_text  	= isset( $instance['see_all_text'] ) ? sanitize_text_field( $instance['see_all_text'] ) : esc_html__( 'See All', 'rise_widgets' );										
	

	?>



	<p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'rise_widgets'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

	</p>
    


	<p><label for="<?php echo sanitize_text_field( $this->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Enter the slug for your category or leave empty to show posts from all categories.', 'rise_widgets' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'category' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'category' )); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" size="3" /></p>
    
    	
    
    <p><label for="<?php echo sanitize_text_field( $this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Enter the number of posts to display.', 'rise_widgets' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'number' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'number' )); ?>" type="text" value="<?php echo intval( $number ); ?>" size="3" /></p>	
    
    
    <p><label for="<?php echo sanitize_text_field( $this->get_field_id( 'columnset' )); ?>"><?php esc_html_e( 'Enter the number of columns.', 'rise_widgets' ); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'columnset' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'columnset' )); ?>" type="text" value="<?php echo intval( $columnset ); ?>" size="3" /></p> 	



    <p><label for="<?php echo sanitize_text_field( $this->get_field_id('see_all_text')); ?>"><?php esc_html_e('Button Text. Default is set to See All.', 'rise_widgets'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id( 'see_all_text' )); ?>" name="<?php echo sanitize_text_field( $this->get_field_name( 'see_all_text' )); ?>" type="text" value="<?php echo esc_html( $see_all_text ); ?>" size="3" /></p>

	

	<?php

	}



	// update widget

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] 			= sanitize_text_field($new_instance['title']);

		$instance['category'] 		= sanitize_text_field($new_instance['category']);
		
		$instance['number'] 		= sanitize_text_field($new_instance['number']); 
		
		$instance['columnset'] 		= sanitize_text_field($new_instance['columnset']);

		$instance['see_all_text'] 	= sanitize_text_field($new_instance['see_all_text']);									

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset($alloptions['rise_home_news']) )

			delete_option('rise_home_news');	  

		  

		return $instance;

	}

	

	function flush_widget_cache() {

		wp_cache_delete('rise_home_news', 'widget');

	}

	

	// display widget

	function widget($args, $instance) {

		$cache = array();

		if ( ! $this->is_preview() ) {

			$cache = wp_cache_get( 'rise_home_news', 'widget' );

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

		$title = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';

		$category = isset( $instance['category'] ) ? sanitize_text_field($instance['category']) : '';
		
		$number = ( ! empty( $instance['number'] ) ) ? sanitize_text_field( $instance['number'] ) : 3;

		if ( ! $number )

			$number = 3;
			
		$columnset 		= ( ! empty( $instance['columnset'] ) ) ? sanitize_text_field( $instance['columnset'] ) : 3;
		
		if ( ! $columnset ) 

			$columnset = 3;

		$see_all_text = isset( $instance['see_all_text'] ) ? sanitize_text_field($instance['see_all_text']) : esc_html__( 'See All', 'rise_widgets' );


		/**

		 * Filter the arguments for the Recent Posts widget.

		 *

		 * @since 3.4.0

		 *

		 * @see WP_Query::get_posts()

		 *

		 * @param array $args An array of arguments used to retrieve the recent posts.

		 */

		$mt = new WP_Query( apply_filters( 'widget_posts_args', array(

			'no_found_rows'       => true,

			'post_status'         => 'publish',

			'posts_per_page'	  => $number,

			'category_name'		  => $category,
			
			'tax_query' => array(
    							array(
      								'taxonomy' => 'post_format',
      								'field' => 'slug',
      								'terms' => 
								array(
									'post-format-gallery', 
									'post-format-quote',
									),	
      							'operator' => 'NOT IN',
    		)))));


		if ($mt->have_posts()) :

?>

		 <div class="home-news">
                
			<?php if ( $title ) : ?> 
        
        		<div class="grid grid-pad">
            		<div class="col-1-1">
                    		<h2 class="home-title">
								<?php echo wp_kses_post( $title ) ?> 
                        	</h2>
                	</div><!-- col-1-1 -->  
            	</div><!-- grid -->
            
        	<?php endif; ?>
            
           	    	
       		<div class="grid grid-pad"> 
                
                
                <?php while ( $mt->have_posts() ) : $mt->the_post(); ?>
             
                	<div class="col-1-<?php echo $columnset; ?> mt-column-clear">
            			<div class="grid-block fade">
                        	<div class="caption" style="display: none;">
                        	<a href="<?php the_permalink(); ?>">
                            	<i class="fa fa-plus"></i>
                            </a>
                        	</div>
            				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('rise-home-blog'); ?></a> 
                        </div>
							<a href="<?php the_permalink(); ?>"><?php the_title( '<h5>', '</h5>' ); ?></a>
                            
                            <?php if ( has_excerpt() ) : ?>  
                            	<?php the_excerpt('<p>','</p>'); ?>
                            <?php else : ?>
                        		<p><?php $content = get_the_content(); echo wp_trim_words( $content , '20' ); ?></p>
                            <?php endif; ?>
                            
                             
                    </div><!-- col-1-3 -->

				<?php endwhile; ?>
                
                        
				
        		
            </div><!-- grid -->
        
    	</div><!-- home-news -->
        	
		<?php if ( $see_all_text ) : ?> 
        		
    	
                			
                	<a href="<?php if( get_option( 'show_on_front' ) == 'page' ) echo get_permalink( get_option('page_for_posts' ) ); else echo esc_url( home_url() );?>" class="rise-widget-button"> 
						<button>
							<?php echo esc_html( $see_all_text ); ?>
                    	</button>
                	</a>  
        				
         		
            
		<?php endif; ?>
        
		
	<?php

		// Reset the global $the_post as this query will have stomped on it

		wp_reset_postdata();



		endif;



		if ( ! $this->is_preview() ) {

			$cache[ $args['widget_id'] ] = ob_get_flush();

			wp_cache_set( 'rise_home_news', $cache, 'widget' ); 

		} else {

			ob_end_flush(); 

		}

	}


	

}