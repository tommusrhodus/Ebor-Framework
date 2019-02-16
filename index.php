<?php

/*
Plugin Name: Ebor Framework
Plugin URI: http://www.tommusrhodus.com/ebor-framework/
Description: Ebor Framework - The Driving Force Behind TommusRhodus Themes
Version: 1.5.1
Author: Tom Rhodes
Author URI: http://www.tommusrhodus.com/
*/	

/**
 * Plugin definitions
 */
define( 'EBOR_FRAMEWORK_PATH', trailingslashit(plugin_dir_path(__FILE__)) );
define( 'EBOR_FRAMEWORK_VERSION', '1.5.1');

/**
 * Styles & Scripts
 */
if(!( function_exists('ebor_framework_admin_load_scripts') )){
	function ebor_framework_admin_load_scripts(){
		wp_enqueue_style('ebor_framework_font_awesome', plugins_url( '/css/font-awesome.min.css' , __FILE__ ) );
		wp_enqueue_style('ebor_framework_admin_css', plugins_url( '/css/ebor-framework-admin.css' , __FILE__ ) );
		wp_enqueue_script('ebor_framework_admin_js', plugins_url( '/js/ebor-framework-admin.js' , __FILE__ ) );
	}
	add_action('admin_enqueue_scripts', 'ebor_framework_admin_load_scripts', 200);
}

/**
 * Some items are definitely always loaded, these are those.
 */
/**
 * Grab all custom post type functions
 */
require_once( EBOR_FRAMEWORK_PATH . 'ebor_cpt.php' );

/**
 * Grab all generic functions
 */
require_once( EBOR_FRAMEWORK_PATH . 'ebor_functions.php' );

/**
 * Everything else in the framework is conditionally loaded depending on theme options.
 * Let's include all of that now.
 */
require_once( EBOR_FRAMEWORK_PATH . 'init.php' );

/**
 * ebor_ajax_import_data
 * 
 * Use this to auto import a demo-data.xml for the theme.
 * demo-data.xml must be in your active theme root folder, you should also copy this into a child theme if you supply one.
 * 
 * @author TommusRhodus
 * @since v1.0.0
 */
if(!( function_exists('ebor_ajax_import_data') )){
	function ebor_ajax_import_data() {				
		require_once( EBOR_FRAMEWORK_PATH . 'wordpress-importer/demo_import.php' );
		die('ebor_import');
	}
	add_action('wp_ajax_ebor_ajax_import_data', 'ebor_ajax_import_data');
}

/**
 * Plugin Updates
 * This plugin updates from wp-updates.com
 * I've tried various github updaters, but they all seem to break very simply, this should be quite reliable.
 * 
 * @author TommusRhodus
 * @since v1.0.0
 */
require_once(EBOR_FRAMEWORK_PATH . 'wp-updates-plugin.php');
new WPUpdatesPluginUpdater_745( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));