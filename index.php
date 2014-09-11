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
 * Grab page builder, ensure that aqua page builder isn't installed seperately
 */
if(!( class_exists( 'AQ_Page_Builder' ) )){
	require_once( EBOR_FRAMEWORK_PATH . 'page-builder/aqua-page-builder.php' );	
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
		
		( current_theme_supports('ebor-framework') ) ? $supported = true : $supported = false;
		
		/**
		 * Hook CPT registers to init
		 * Check that we're using an ebor-framework theme and register functions accordingly.
		 * If this isn't an ebor-framework theme (register is false) then we'll just enable everything.
		 */
		if( current_theme_supports('ebor-framework-portfolio') || $supported == false ){
			add_action( 'init', 'ebor_framework_register_portfolio' );
			add_action( 'init', 'ebor_framework_create_portfolio_taxonomies' );
		}
		
		if( current_theme_supports('ebor-framework-team') || $supported == false ){
			add_action( 'init', 'ebor_framework_register_team' );
			add_action( 'init', 'ebor_framework_create_team_taxonomies' );
		}
		
		if( current_theme_supports('ebor-framework-client') || $supported == false ){
			add_action( 'init', 'ebor_framework_register_client' );
			add_action( 'init', 'ebor_framework_create_client_taxonomies' );
		}
		
		if( current_theme_supports('ebor-framework-testimonial') || $supported == false ){
			add_action( 'init', 'ebor_framework_register_testimonial' );
			add_action( 'init', 'ebor_framework_create_testimonial_taxonomies' );
		}

	}
	add_action('after_setup_theme', 'ebor_framework_theme_support', 15);
}