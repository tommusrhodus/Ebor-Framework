<?php

/*
Plugin Name: Ebor Framework
Plugin URI: http://www.madeinebor.com/ebor-framework
Description: Ebor Framework - The Driving Force Behind TommusRhodus Themes
Version: 1.0.0
Author: Tom Rhodes
Author URI: http://www.madeinebor.com
*/	

/**
 * Plugin definitions
 */
define( 'EBOR_FRAMEWORK_PATH', trailingslashit(plugin_dir_path(__FILE__)) );
define( 'EBOR_FRAMEWORK_VERSION', '1.0.0');

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
 * Turn on the image resizer.
 * The resizer file has a class exists check to avoid conflicts
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_framework_load_aq_resize') )){
	function ebor_framework_load_aq_resize(){
		require_once( EBOR_FRAMEWORK_PATH . 'aq_resizer.php' );	
	}
	add_action('after_setup_theme', 'ebor_framework_load_aq_resize', 10);	
}

/**
 * Grab page builder, ensure that aqua page builder isn't installed seperately
 */
if(!( class_exists( 'AQ_Page_Builder' ) )){
	require_once( EBOR_FRAMEWORK_PATH . 'page-builder/aqua-page-builder.php' );	
}

/**
 * Grab ebor likes, make sure Zilla likes isn't installed though
 */
if(!( class_exists( 'eborLikes' ) || class_exists( 'ZillaLikes' ) )){
	require_once( EBOR_FRAMEWORK_PATH . 'ebor-likes/likes.php' );
}

/**
 * Grab simple options class
 */
require_once( EBOR_FRAMEWORK_PATH . 'ebor_options.php' );

/**
 * Grab all custom post type functions
 */
require_once( EBOR_FRAMEWORK_PATH . 'ebor_cpt.php' );

/**
 * Grab all generic functions
 */
require_once( EBOR_FRAMEWORK_PATH . 'ebor_functions.php' );

/**
 * Grab our custom metaboxes class
 */
require_once( EBOR_FRAMEWORK_PATH . 'metaboxes/init.php' );

/**
 * Register appropriate shortcodes
 */
if( '1' == get_option('ebor_framework_pivot_shortcodes') ){
	require_once( EBOR_FRAMEWORK_PATH . 'shortcodes/pivot-shortcodes.php' );	
}

/**
 * Register Portfolio Post Type
 */
if( '1' == get_option('ebor_framework_portfolio_post_type') ){
	add_action( 'init', 'ebor_framework_register_portfolio', 10 );
	add_action( 'init', 'ebor_framework_create_portfolio_taxonomies', 10  );
}

/**
 * Register Team Post Type
 */
if( '1' == get_option('ebor_framework_team_post_type') ){
	add_action( 'init', 'ebor_framework_register_team', 10  );
	add_action( 'init', 'ebor_framework_create_team_taxonomies', 10  );
}

/**
 * Register Client Post Type
 */
if( '1' == get_option('ebor_framework_client_post_type') ){
	add_action( 'init', 'ebor_framework_register_client', 10  );
	add_action( 'init', 'ebor_framework_create_client_taxonomies', 10  );
}

/**
 * Register Testimonial Post Type
 */
if( '1' == get_option('ebor_framework_testimonial_post_type') ){
	add_action( 'init', 'ebor_framework_register_testimonial', 10  );
	add_action( 'init', 'ebor_framework_create_testimonial_taxonomies', 10  );
}

/**
 * Register Mega Menu Post Type
 */
if( '1' == get_option('ebor_framework_mega_menu') ){
	add_action( 'init', 'ebor_framework_register_mega_menu', 10  );
}