<?php
/*
Plugin Name: Rise Widgets
Plugin URI: http://modernthemes.net/plugins/rise-widgets
Description: This is a plugin by ModernThemes that adds content widget capabilities to the Rise WordPress theme.
Version: 1.0.0
Author: ModernThemes
Author URI: http://modernthemes.net
License: GPL2
Text Domain: rise_widgets
Domain Path: /languages/
*/


require 'plugin-updates/plugin-update-checker.php';  
$MyUpdateChecker = PucFactory::buildUpdateChecker(
'http://modernthemes.net/updates/?action=get_metadata&slug=rise_widgets', //Metadata URL.
__FILE__, //Full path to the main plugin file. 
'rise_widgets' //Plugin slug
);


add_action('admin_init', 'rise_widgetssettings_flush' );

function rise_widgetssettings_flush(){ 

		if ( isset( $_POST['rise_widgetssettings_options'] ) ) {


			flush_rewrite_rules();
		
		}

}

/* Paths for Files */
$rise_widgets_main_file = dirname(__FILE__).'/rise-widgets.php';
$rise_widgets_directory = plugin_dir_url($rise_widgets_main_file);
$rise_widgets_path = dirname(__FILE__);

/* Add css and scripts file */
function rise_widgets_add_scripts() {
	global $rise_widgets_directory, $rise_widgets_path; 
	
		
}
		
add_action('wp_enqueue_scripts', 'rise_widgets_add_scripts');  


class Rise_Widgets {
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'load' ), 9 );
		add_action( 'widgets_init', array( $this, 'init' ), 10 );
		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall' ) );
	}

	public function load() {
		$dir = plugin_dir_path( __FILE__ );

		include_once( trailingslashit($dir) . 'inc/widget-mt-cta.php' );
		include_once( trailingslashit($dir) . 'inc/widget-mt-home-news.php' );
		include_once( trailingslashit($dir) . 'inc/widget-rise-pf-posts.php' );
		
	}

	public function init() {
		if ( ! is_blog_installed() ) {
			return;
		}

		load_plugin_textdomain( 'rise_widgets', false, 'rise_widgets/languages' );
		
		register_widget( 'rise_pf_posts' );
		register_widget( 'rise_action' );
		register_widget( 'rise_home_news' ); 
		
	}

	public function uninstall() {}
}

$rise_widgets = new Rise_Widgets(); 