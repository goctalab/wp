<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package risewp
 */
 
if ( ! function_exists( 'risewp_the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function risewp_the_post_navigation() { 
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
		

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'risewp' ); ?></h1>
		<div class="nav-links">
        
        	<?php $risewp_post_nav = esc_html( get_theme_mod( 'risewp_post_nav_terms' )); ?>
            
			<?php
			
			if ( get_theme_mod( 'risewp_post_nav_terms' ) ) :
			
				previous_post_link( 
					'<div class="nav-previous">%link</div>', 
					_x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'risewp' ), 
					$in_same_term = false, 
					$excluded_terms = array( $risewp_post_nav )
				);
				next_post_link(     
					'<div class="nav-next">%link</div>',     
					_x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'risewp' ),
					$in_same_term = false,
					$excluded_terms = array( $risewp_post_nav )
				); 
			
			else:
			
				previous_post_link( 
					'<div class="nav-previous">%link</div>', 
					_x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'risewp' )
				);
				next_post_link(     
					'<div class="nav-next">%link</div>',     
					_x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'risewp' )
				); 
				
			endif; 
			
			?>
            
             
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;  


if ( ! function_exists( 'risewp_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function risewp_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'risewp' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'risewp' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'risewp_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function risewp_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'risewp' ) );
		if ( $categories_list && risewp_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'risewp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'risewp' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'risewp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'risewp' ), esc_html__( '1 Comment', 'risewp' ), esc_html__( '% Comments', 'risewp' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'risewp' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function risewp_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'risewp_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'risewp_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so risewp_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so risewp_categorized_blog should return false.
		return false;
	}
}


/**
 * Callback function for adding editor styles.  Use along with the add_editor_style() function.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function risewp_get_editor_styles() {

	/* Set up an array for the styles. */
	$editor_styles = array();

	/* Add the theme's editor styles. */
	$editor_styles[] = trailingslashit( get_template_directory_uri() ) . 'css/editor-style.css';

	/* If a child theme, add its editor styles. Note: WP checks whether the file exists before using it. */
	if ( is_child_theme() && file_exists( trailingslashit( get_stylesheet_directory() ) . 'css/editor-style.css' ) )
		$editor_styles[] = trailingslashit( get_stylesheet_directory_uri() ) . 'css/editor-style.css';

	/* Add the locale stylesheet. */
	$editor_styles[] = get_locale_stylesheet_uri();

	/* Uses Ajax to display custom theme styles added via the Theme Mods API. */
	$editor_styles[] = add_query_arg( 'action', 'risewp_editor_styles', admin_url( 'admin-ajax.php' ) );

	/* Return the styles. */
	return $editor_styles; 
	
} 


/**
 * Flush out the transients used in risewp_categorized_blog.
 */
function risewp_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'risewp_categories' );
}
add_action( 'edit_category', 'risewp_category_transient_flusher' );
add_action( 'save_post',     'risewp_category_transient_flusher' );
