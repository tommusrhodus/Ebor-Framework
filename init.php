<?php 

/**
 * Grab our framework options as registered by the theme.
 * If ebor_framework_options isn't set then we'll pull a list of defaults.
 * By default everything is turned off.
 */
$defaults = array(
	'pivot_shortcodes'      => '0',
	'pivot_widgets'         => '0',
	'portfolio_post_type'   => '0',
	'team_post_type'        => '0',
	'client_post_type'      => '0',
	'testimonial_post_type' => '0',
	'mega_menu'             => '0',
	'aq_resizer'            => '0',
	'page_builder'          => '0',
	'likes'                 => '0',
	'options'               => '0',
	'metaboxes'             => '0'
);
$framework_options = wp_parse_args( get_option('ebor_framework_options'), $defaults);

/**
 * Turn on the image resizer.
 * The resizer file has a class exists check to avoid conflicts
 */
if( '1' == $framework_options['aq_resizer'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'aq_resizer.php' );		
}

/**
 * Grab page builder, ensure that aqua page builder isn't installed seperately
 */
if(!( class_exists( 'AQ_Page_Builder' ) ) && '1' == $framework_options['page_builder'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'page-builder/aqua-page-builder.php' );	
}

/**
 * Grab our custom metaboxes class
 */
if( '1' == $framework_options['metaboxes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'metaboxes/init.php' );
}

/**
 * Grab ebor likes, make sure Zilla likes isn't installed though
 */
if(!( class_exists( 'eborLikes' ) || class_exists( 'ZillaLikes' ) ) && '1' == $framework_options['likes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'ebor-likes/likes.php' );
}

/**
 * Grab simple options class
 */
if( '1' == $framework_options['options'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'ebor_options.php' );
}

/**
 * Register appropriate shortcodes
 */
if( '1' == $framework_options['pivot_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'shortcodes/pivot-shortcodes.php' );	
}

/**
 * Register appropriate widgets
 */
if( '1' == $framework_options['pivot_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/pivot-widgets.php' );	
}

/**
 * Register Portfolio Post Type
 */
if( '1' == $framework_options['portfolio_post_type'] ){
	add_action( 'init', 'ebor_framework_register_portfolio', 10 );
	add_action( 'init', 'ebor_framework_create_portfolio_taxonomies', 10  );
}

/**
 * Register Team Post Type
 */
if( '1' == $framework_options['team_post_type'] ){
	add_action( 'init', 'ebor_framework_register_team', 10  );
	add_action( 'init', 'ebor_framework_create_team_taxonomies', 10  );
}

/**
 * Register Client Post Type
 */
if( '1' == $framework_options['client_post_type'] ){
	add_action( 'init', 'ebor_framework_register_client', 10  );
	add_action( 'init', 'ebor_framework_create_client_taxonomies', 10  );
}

/**
 * Register Testimonial Post Type
 */
if( '1' == $framework_options['testimonial_post_type'] ){
	add_action( 'init', 'ebor_framework_register_testimonial', 10  );
	add_action( 'init', 'ebor_framework_create_testimonial_taxonomies', 10  );
}

/**
 * Register Mega Menu Post Type
 */
if( '1' == $framework_options['mega_menu'] ){
	add_action( 'init', 'ebor_framework_register_mega_menu', 10  );
}