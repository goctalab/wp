<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package risewp
 */

get_header(); ?>


	<?php if (has_post_thumbnail() ): ?>  
	
    <header class="entry-header parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() , 'full' )); ?>" data-z-index="-1">
    	<div class="grid grid-pad">
            <div class="col-1-1">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
           	</div><!-- col -->
      	</div><!-- grid --> 
	</header><!-- .entry-header -->   
    
    <?php else : ?>
    
    <header class="entry-header">
    	<div class="grid grid-pad">
            <div class="col-1-1">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
           	</div><!-- col -->
      	</div><!-- grid -->
	</header><!-- .entry-header -->
    
<?php endif; ?>

<section id="page-container" class="page-wrap"> 
    <div class="grid grid-pad">
        
        
        <?php if ( 'option1' == risewp_sanitize_index_content( get_theme_mod( 'risewp_sidebar_blog_setting' ) ) ) : ?>
    
       		<div class="col-8-12">
        
    	<?php else : ?>
    
			<div class="col-1-1">
            
		<?php endif; ?>
        
        
            <div id="primary" class="content-area shortcodes">
                <main id="main" class="site-main" role="main">
        
                <?php
                while ( have_posts() ) : the_post();
				
					get_template_part( 'template-parts/content', 'single', get_post_format() );
        
                    risewp_the_post_navigation(); 
        
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
        
                endwhile; // End of the loop.
                ?>
        
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- col -->
        
        
    <?php if ( 'option1' == risewp_sanitize_index_content( get_theme_mod( 'risewp_sidebar_blog_setting' ) ) ) : ?> 
  
        <?php get_sidebar(); ?> 
        
    <?php else : ?>
    
			
            
	<?php endif; ?>
    
    
    </div><!-- grid -->
</section><!-- page-container -->

<?php get_footer(); ?>
