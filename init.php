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
	'faq_post_type'         => '0',
	'menu_post_type'        => '0',
	'class_post_type'       => '0',
	'service_post_type'     => '0',
	'case_study_post_type'  => '0',
	'mega_menu'             => '0',
	'aq_resizer'            => '0',
	'page_builder'          => '0',
	'likes'                 => '0',
	'options'               => '0',
	'metaboxes'             => '0',
	'elemis_widgets'        => '0',
	'elemis_shortcodes'     => '0',
	'keepsake_widgets'      => '0',
	'morello_widgets'       => '0',
	'meetup_widgets'        => '0',
	'machine_widgets'       => '0',
	'lumos_widgets'         => '0',
	'foundry_widgets'       => '0',
	'foundry_shortcodes'    => '0',
	'malory_vc_shortcodes'  => '0',
	'peekskill_vc_shortcodes'  => '0',
	'partner_vc_shortcodes'    => '0',
	'ryla_vc_shortcodes'       => '0',
	'morello_vc_shortcodes'    => '0',
	'hive_vc_shortcodes'       => '0',
	'pillar_vc_shortcodes'     => '0'
);
$framework_options = wp_parse_args( get_option('ebor_framework_options'), $defaults);

/**
 * Getting started instructions
 */
if( is_admin() ){
	require_once( EBOR_FRAMEWORK_PATH  . 'getting_started.php' );
}

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
if( '1' == $framework_options['elemis_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'shortcodes/elemis-shortcodes.php' );	
}
if( '1' == $framework_options['foundry_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'shortcodes/foundry-shortcodes.php' );	
}

/**
 * Visual Composer Shortocdes
 */
if( '1' == $framework_options['malory_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/init.php' );	
}
if( '1' == $framework_options['peekskill_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/peekskill/init.php' );	
}
if( '1' == $framework_options['partner_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/init.php' );	
}
if( '1' == $framework_options['ryla_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/init.php' );	
}
if( '1' == $framework_options['morello_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/init.php' );	
}
if( '1' == $framework_options['hive_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/hive/init.php' );	
}
if( '1' == $framework_options['pillar_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/pillar/init.php' );	
}

/**
 * Register appropriate widgets
 */
if( '1' == $framework_options['pivot_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/pivot-widgets.php' );	
}
if( '1' == $framework_options['elemis_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/elemis-widgets.php' );	
}
if( '1' == $framework_options['lumos_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/lumos-widgets.php' );	
}
if( '1' == $framework_options['keepsake_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/keepsake-widgets.php' );	
}
if( '1' == $framework_options['meetup_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/meetup-widgets.php' );	
}
if( '1' == $framework_options['machine_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/machine-widgets.php' );	
}
if( '1' == $framework_options['foundry_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/foundry-widgets.php' );	
}
if( '1' == $framework_options['morello_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/morello-widgets.php' );	
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
 * Register faq Post Type
 */
if( '1' == $framework_options['faq_post_type'] ){
	add_action( 'init', 'ebor_framework_register_faq', 10  );
	add_action( 'init', 'ebor_framework_create_faq_taxonomies', 10  );
}

/**
 * Register Menu Post Type
 */
if( '1' == $framework_options['menu_post_type'] ){
	add_action( 'init', 'ebor_framework_register_menu', 10  );
	add_action( 'init', 'ebor_framework_create_menu_taxonomies', 10  );
}

/**
 * Register Class Post Type
 */
if( '1' == $framework_options['class_post_type'] ){
	add_action( 'init', 'ebor_framework_register_class', 10  );
	add_action( 'init', 'ebor_framework_create_class_taxonomies', 10  );
}

/**
 * Register Case Study Post Type
 */
if( '1' == $framework_options['case_study_post_type'] ){
	add_action( 'init', 'ebor_framework_register_case_study', 10  );
	add_action( 'init', 'ebor_framework_create_case_study_taxonomies', 10  );
}

/**
 * Register Service Post Type
 */
if( '1' == $framework_options['service_post_type'] ){
	add_action( 'init', 'ebor_framework_register_service', 10  );
	add_action( 'init', 'ebor_framework_create_service_taxonomies', 10  );
}

/**
 * Register Mega Menu Post Type
 */
if( '1' == $framework_options['mega_menu'] ){
	add_action( 'init', 'ebor_framework_register_mega_menu', 10  );
}