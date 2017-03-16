<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package risewp
 */

get_header(); ?> 

	<?php if ( has_header_image() ) : ?>
    
		<header class="entry-header parallax-window" data-parallax="scroll" data-image-src="<?php echo( get_header_image() ); ?>" data-z-index="-1">
        
    <?php else : ?>
    
    	<header class="entry-header parallax-window">
        
    <?php endif; ?>
    
    		<div class="grid grid-pad">
            	<div class="col-1-1">
				<?php
                	the_archive_title( '<h1 class="entry-title">', '</h1>' );
                 	the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
           		</div>
      		</div>
            
		</header><!-- .entry-header -->

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
                if ( have_posts() ) : ?>
        
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();
        
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );
        
                    endwhile;
        
                    the_posts_navigation();
        
                else :
        
                    get_template_part( 'template-parts/content', 'none' );
        
                endif; ?>
        
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    
    	<?php if ( 'option1' == risewp_sanitize_index_content( get_theme_mod( 'risewp_sidebar_blog_setting' ) ) ) : ?> 
  
        	<?php get_sidebar(); ?> 
        
    	<?php else : ?>
    
			
            
		<?php endif; ?>
    
    </div>
</section>

<?php get_footer(); ?>