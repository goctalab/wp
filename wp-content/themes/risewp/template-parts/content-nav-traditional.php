				
                
                
                <div class="navigation-container push-right">
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                        <button class="toggle-menu menu-right push-body" aria-controls="primary-menu" aria-expanded="false">
                        
							 <?php $risewp_menu_toggle_option = risewp_sanitize_menu_toggle_display( get_theme_mod( 'risewp_menu_toggle', 'icon' )); 
    
                        		$risewp_menu_display = '';
    
                        			if ( $risewp_menu_toggle_option == 'icon' ) {
                    
                            	$risewp_menu_display = sprintf( '<i class="fa fa-bars"></i>' );
                
                        			} else if ( $risewp_menu_toggle_option == 'label' ) {
                    
                           	 	$risewp_menu_display = esc_html__( 'Menu', 'risewp' );  
                
                        			} 
    
                        		echo wp_kses_post( $risewp_menu_display ); ?>
                                
                        </button> 
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                    </nav><!-- #site-navigation -->
                </div>
                
          	</div>
     	</div>
	</header><!-- #masthead -->
    
    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    </nav> 