<?php
/**
Template Name: Page - Fullwidth
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
        <div class="col-1-1">
            <div id="primary" class="content-area shortcodes">
                <main id="main" class="site-main" role="main">
        
                    <?php
                    while ( have_posts() ) : the_post();
        
                        get_template_part( 'template-parts/content', 'page' );
        
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
        
                    endwhile; // End of the loop.
                    ?>
        
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>
</section>

<?php get_footer(); ?>
