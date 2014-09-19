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
 * ebor_framework_theme_support
 * 
 * The framework supports a number of custom posts types and features, all of these are initialised from within a theme by using add_theme_support()
 * If a theme does not declare ebor-framework support then all features are loaded to avoid data loss.
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if(!( function_exists('ebor_framework_theme_support') )){
	function ebor_framework_theme_support(){
		
		$supported = ( current_theme_supports('ebor-framework') ) ? true : false;
		
		/**
		 * Hook CPT registers to init
		 * Check that we're using an ebor-framework theme and register functions accordingly.
		 * If this isn't an ebor-framework theme (register is false) then we'll just enable everything.
		 */
		if( current_theme_supports('ebor-framework-portfolio') || $supported == false ){
			add_action( 'init', 'ebor_framework_register_portfolio', 10 );
			add_action( 'init', 'ebor_framework_create_portfolio_taxonomies', 10  );
		}
		
		if( current_theme_supports('ebor-framework-team') || $supported == false ){
			add_action( 'init', 'ebor_framework_register_team', 10  );
			add_action( 'init', 'ebor_framework_create_team_taxonomies', 10  );
		}
		
		if( current_theme_supports('ebor-framework-client') || $supported == false ){
			add_action( 'init', 'ebor_framework_register_client', 10  );
			add_action( 'init', 'ebor_framework_create_client_taxonomies', 10  );
		}
		
		if( current_theme_supports('ebor-framework-testimonial') || $supported == false ){
			add_action( 'init', 'ebor_framework_register_testimonial', 10  );
			add_action( 'init', 'ebor_framework_create_testimonial_taxonomies', 10  );
		}
		
		if( current_theme_supports('ebor-framework-mega-menu') || $supported == false )
			add_action( 'init', 'ebor_framework_register_mega_menu', 10  );

	}
	add_action('after_setup_theme', 'ebor_framework_theme_support', 15);
}