<?php

     
    add_action('admin_menu', 'risewp_setup_menu');
     
    function risewp_setup_menu(){
    	add_theme_page( esc_html__('Rise Theme Details', 'risewp' ), esc_html__('Rise Theme Details', 'risewp' ), 'edit_theme_options', 'risewp-setup', 'risewp_init' );
    }  
      
 	function risewp_init(){
		
		wp_enqueue_style( 'risewp-font-awesome-admin', get_template_directory_uri() . '/fonts/font-awesome.css' ); 
		wp_enqueue_style( 'risewp-style-admin', get_template_directory_uri() . '/panel/css/theme-admin-style.css' ); 
		
	 	echo '<div class="grid grid-pad"><div class="col-1-1"><h1 style="text-align: center;">'; 
		printf(esc_html__('Thank you for using Rise!', 'risewp' ));
        echo "</h1></div></div>";
			
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 40px; margin-bottom: 30px;" ><div class="col-1-3"><h2>'; 
		printf(esc_html__('Rise Widgets Plugin', 'risewp' ));
        echo '</h2>';
		
		echo '<p>';
		printf(esc_html__('We created a FREE plugin that installs a Post Format widget, Call-to-Action widget, and Home Posts widget. Just click the link below to download the Rise Widget plugin.', 'risewp' ));
		echo '</p>';
		
		echo '<a href="https://modernthemes.net/premium-plugins/rise_widgets.zip" target="_blank"><button>'; 
		printf(esc_html__('Download Plugin', 'risewp' ));  
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>';
		printf(esc_html__('Documentation', 'risewp' ));
        echo '</h2>';  
		
		echo '<p>';
		printf(esc_html__('Check out our documentation for tutorials on theme functions and how to get the most out of Rise.', 'risewp' ));   
		echo '</p>'; 
		
		echo '<a href="https://modernthemes.net/rise-documentation/" target="_blank"><button>';
		printf(esc_html__('Read Docs', 'risewp' )); 
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf(esc_html__('ModernThemes', 'risewp' )); 
        echo '</h2>';  
		
		echo '<p>';
		printf(esc_html__('Need some more themes? We have a large selection of both free and premium themes to add to your collection.', 'risewp' ));
		echo '</p>';
		
		echo '<a href="https://modernthemes.net/" target="_blank"><button>'; 
		printf(esc_html__('Visit Us', 'risewp' ));
		echo '</button></a></div></div>';
		
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( esc_html__('Go Pro. Get more out of Rise.', 'risewp' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>';
		printf( esc_html__('More Content Options', 'risewp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Rise Pro adds Services, Team Members, Skill Bars, Detail Spinner, Map area and Clients as content options for you to use.', 'risewp' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-home"></i><h4>';
        printf( esc_html__('10 Home Widget Areas', 'risewp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Add more home page content as Rise Pro comes with 6 additional home page widget areas and the ability to set parallax background images for widget areas.', 'risewp' )); 
		echo '</p></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-image"></i><h4>';
        printf( esc_html__('Sliders + Video', 'risewp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Rise Pro has 5 different home page templates with a variety of sliders or fullscreen video. The best looking websites give the best first impressions.', 'risewp' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-th"></i><h4>'; 
        printf( esc_html__('Footer Widget Areas', 'risewp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Want more content for your footer? Rise Pro has footer widget areas to populate with any content you want.', 'risewp' ));
		echo '</p></div>';
		
            
        echo '<div class="grid grid-pad senswp"><div class="col-1-4"><i class="fa fa-shopping-cart"></i><h4>'; 
		printf( esc_html__( 'WooCommerce', 'risewp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Turn your website into a powerful eCommerce machine. Rise Pro is fully compatible with WooCommerce.', 'risewp' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-font"></i><h4>More Google Fonts</h4><p>';
		printf( esc_html__( 'Access an additional 65 Google fonts with Rise Pro right in the WordPress customizer.', 'risewp' ));
		echo '</p></div>'; 
		
       	echo '<div class="col-1-4"><i class="fa fa-file-image-o"></i><h4>';
		printf( esc_html__( 'PSD Files', 'risewp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Premium versions include PSD files. Preview your own content or showcase a customized version for your clients.', 'risewp' ));
		echo '</p></div>';
            
        echo '<div class="col-1-4"><i class="fa fa-support"></i><h4>';
		printf( esc_html__( 'Free Support', 'risewp' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Call on us to help you out. Pro themes come with free support that goes directly to our support staff.', 'risewp' ));
		echo '</p></div></div>';
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/wordpress-themes/rise-pro/" target="_blank"><button class="pro">'; 
		printf( esc_html__( 'View Pro Version', 'risewp' )); 
		echo '</button></a></div></div>';
		
		
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( esc_html__('Premium Membership. Premium Experience.', 'risewp' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>'; 
		printf( esc_html__('Plugin Compatibility', 'risewp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Use our new free plugins with this theme to add functionality for things like projects, clients, team members and more. Compatible with all premium themes!', 'risewp' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-desktop"></i><h4>'; 
        printf( esc_html__('Agency Designed Themes', 'risewp' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Look as good as can be with our new premium themes. Each one is agency designed with modern styles and professional layouts.', 'risewp' ));
		echo '</p></div>'; 
		
        echo '<div class="col-1-4"><i class="fa fa-users"></i><h4>';
        printf( esc_html__('Membership Options', 'risewp' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('We have options to fit every budget. Choose between a single theme, or access to all current and future themes for a year, or forever!', 'risewp' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-calendar"></i><h4>'; 
		printf( esc_html__( 'Access to New Themes', 'risewp' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'New themes added monthly! When you purchase a premium membership you get access to all premium themes, with new themes added monthly.', 'risewp' ));   
		echo '</p></div>';
		
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/premium-wordpress-themes/" target="_blank"><button class="pro">'; 
		printf( esc_html__( 'Get Premium Membership', 'risewp' ));
		echo '</button></a></div></div>';
		
		
		echo '<div class="grid grid-pad"><div class="col-1-1"><h2 style="text-align: center;">';
		printf( esc_html__( 'Changelog' , 'risewp' ) ); 
        echo "</h2>";
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.6 - Fix: background image glitch', 'risewp' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.5 - Fix: fixed issue where Rise Post Format Options were not showing in the theme customizer', 'risewp' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.4 - Fix: minor bug fixes with admin pages', 'risewp' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.3 - Update: updated to current WordPress repository standards based on theme review', 'risewp' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.17 - Update: styled the 404 and Search page templates to match theme styles', 'risewp' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.16 - Fix: removed http from Skype social icons', 'risewp' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.14 - Update: Tested with WordPress 4.5, Updating Font Awesome icons to 4.6, Added Snapchat and Weibo social icon options', 'risewp' ));  
		echo '</p>';
		
		echo '<p style="text-align: center;">';
		printf( esc_html__('1.0.19 - Update: updated to current WordPress repository standards based on theme review', 'risewp' ));
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.13 - Fix: minor mobile bug fixes', 'risewp' ));
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.0 - New Theme!', 'risewp' ));
		echo '</p></div></div>';
		
    }
?>