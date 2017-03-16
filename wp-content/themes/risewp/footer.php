<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package risewp 
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo"> 
    
    	<?php if ( get_theme_mod( 'risewp_footer_text' ) ) : ?> 
            <div class="grid grid-pad">
                <div class="col-1-1">
        			<p class="footer-text"><?php echo wp_kses_post( get_theme_mod( 'risewp_footer_text' )); ?></p><!-- footer text -->
                </div>
           	</div>
        <?php endif; ?>
    
    	<div class="grid grid-pad">
            <div class="col-1-1">
                <div class="site-info">
                	
					<?php if( get_theme_mod( 'active_byline' ) == '') : ?>
                    
                    	<div class="col-1-2">
                        
							<?php if ( get_theme_mod( 'risewp_footerid' ) ) : ?> 
                
        						<?php echo wp_kses_post( get_theme_mod( 'risewp_footerid' )); // footer id ?>
                    
							<?php else : ?>
                            
                            	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'risewp' ) ); ?>">
									<?php printf( esc_html__( 'Proudly powered by %s', 'risewp' ), 'WordPress' ); ?>
                        		</a>
            
            					<span class="sep"> | </span>
                
    							<?php printf( esc_html__( 'Theme: %1$s by %2$s', 'risewp' ), 'risewp', '<a href="//modernthemes.net">modernthemes.net</a>' ); ?>
                    
							<?php endif; ?>
                            
                        </div>
                
        			<?php endif; ?>
                    
                    
                    <?php if( get_theme_mod( 'active_social' ) == '') : ?>
                    
                    <?php if ( has_nav_menu( 'social' ) ) : // social icon location. ?>
                    
                    	<div class="push-right col-1-2 social-footer">
							<div class="social-container"> 
        
        						<?php get_template_part( 'menu', 'social' ); ?>
            
        					</div>
                        </div>
            
					<?php endif; // End check for menu. ?>
                    
                    <?php endif; ?>
                    
                    
                </div><!-- .site-info -->
          	</div><!-- col -->
       	</div><!-- grid -->
        
	</footer><!-- #colophon -->
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
