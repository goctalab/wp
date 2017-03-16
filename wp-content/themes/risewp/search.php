<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package risewp
 */

get_header(); ?>

    <header class="entry-header">
    	<div class="grid grid-pad">
            <div class="col-1-1">
            	<h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'risewp' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
           	</div><!-- col -->  
      	</div><!-- grid -->
	</header><!-- .entry-header -->
 
 <section id="page-container" class="page-wrap"> 
    <div class="grid grid-pad">
        <div class="col-1-1">
            <section id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
        
                <?php
                if ( have_posts() ) : ?>
                
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();
        
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', 'search' );
        
                    endwhile;
        
                    the_posts_navigation();
        
                else :
        
                    get_template_part( 'template-parts/content', 'none' );
        
                endif; ?>
        
                </main><!-- #main -->
            </section><!-- #primary -->
		</div>
   	</div>
</section>

<?php
get_footer();
