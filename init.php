<?php 

function ebor_framework_clean_theme_options(){
	$existing_options = get_option('ebor_framework_options');
	if( is_array($existing_options) ){
		foreach ($existing_options as $key => $value) {
			$existing_options[$key] = '0';
		}
		update_option('ebor_framework_options', $existing_options);
	}
}

if ( 
	is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ||
	is_admin() && isset( $_GET['theme'] ) && $pagenow == 'customize.php'
){
	add_action( 'after_setup_theme', 'ebor_framework_clean_theme_options', 0 );
}

/**
 * Grab our framework options as registered by the theme.
 * If ebor_framework_options isn't set then we'll pull a list of defaults.
 * By default everything is turned off.
 */
$defaults = array(
	'pivot_shortcodes'         => '0',
	'pivot_widgets'            => '0',
	'portfolio_post_type'      => '0',
	'team_post_type'           => '0',
	'client_post_type'         => '0',
	'testimonial_post_type'    => '0',
	'faq_post_type'            => '0',
	'menu_post_type'           => '0',
	'class_post_type'          => '0',
	'service_post_type'        => '0',
	'case_study_post_type'     => '0',
	'career_post_type'         => '0',
	'mega_menu'                => '0',
	'aq_resizer'               => '0',
	'page_builder'             => '0',
	'likes'                    => '0',
	'options'                  => '0',
	'metaboxes'                => '0',
	'elemis_widgets'           => '0',
	'elemis_shortcodes'        => '0',
	'keepsake_widgets'         => '0',
	'morello_widgets'          => '0',
	'meetup_widgets'           => '0',
	'machine_widgets'          => '0',
	'lumos_widgets'            => '0',
	'foundry_widgets'          => '0',
	'malefic_widgets'          => '0',
	'creatink_widgets'         => '0',
	'brailie_widgets'          => '0',
	'gaze_widgets'			   => '0',
	'foundry_shortcodes'       => '0',
	'malory_vc_shortcodes'     => '0',
	'peekskill_vc_shortcodes'  => '0',
	'partner_vc_shortcodes'    => '0',
	'ryla_vc_shortcodes'       => '0',
	'morello_vc_shortcodes'    => '0',
	'hive_vc_shortcodes'       => '0',
	'pillar_vc_shortcodes'     => '0',
	'stack_vc_shortcodes'      => '0',
	'malefic_vc_shortcodes'    => '0',
	'waves_vc_shortcodes'      => '0',
	'sugarland_vc_shortcodes'  => '0',
	'foundry_vc_shortcodes'    => '0',
	'griddr_vc_shortcodes'     => '0',
	'candar_vc_shortcodes'     => '0',
	'creatink_vc_shortcodes'   => '0',
	'gaze_vc_shortcodes'       => '0',
	'belton_vc_shortcodes'     => '0',
	'brailie_vc_shortcodes'    => '0',
	'pivot_vc_shortcodes'      => '0',
	'meetup_vc_shortcodes'     => '0',
	'hygge_vc_shortcodes'      => '0',
	'somnus_vc_shortcodes'     => '0',
	'lumos_vc_shortcodes'      => '0',
	'huntington_vc_shortcodes' => '0',
	'kwoon_vc_shortcodes'  	   => '0',
	'padre_vc_shortcodes'  	   => '0',
	'lydia_vc_shortcodes'  	   => '0',
	'expose_vc_shortcodes'	   => '0',
	'uber_vc_shortcodes'	   => '0',
	'launchkit_vc_shortcodes'  => '0',
	'fulford_widgets'	   	   => '0',
	'acomb_widgets'	   	   	   => '0',
	'gallery_widgets'	   	   => '0',
	'union_vc_shortcodes'      => '0',
);
$framework_options = wp_parse_args( get_option('ebor_framework_options'), $defaults);

/**
 * Getting started instructions
 */
if( is_admin() ){
	//require_once( EBOR_FRAMEWORK_PATH  . 'getting_started.php' );
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
if( '1' == $framework_options['stack_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/init.php' );	
}
if( '1' == $framework_options['malefic_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/init.php' );	
}
if( '1' == $framework_options['waves_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/init.php' );	
}
if( '1' == $framework_options['sugarland_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/sugarland/init.php' );	
}
if( '1' == $framework_options['foundry_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/init.php' );	
}
if( '1' == $framework_options['griddr_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/griddr/init.php' );	
}
if( '1' == $framework_options['candar_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/candar/init.php' );	
}
if( '1' == $framework_options['creatink_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/init.php' );	
}
if( '1' == $framework_options['gaze_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/init.php' );	
}
if( '1' == $framework_options['belton_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/init.php' );	
}
if( '1' == $framework_options['brailie_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/init.php' );	
}
if( '1' == $framework_options['pivot_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/pivot/init.php' );	
}
if( '1' == $framework_options['meetup_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/meetup/init.php' );	
}
if( '1' == $framework_options['hygge_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/hygge/init.php' );	
}
if( '1' == $framework_options['somnus_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/somnus/init.php' );	
}
if( '1' == $framework_options['lumos_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/init.php' );	
}
if( '1' == $framework_options['huntington_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/huntington/init.php' );	
}
if( '1' == $framework_options['kwoon_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/init.php' );	
}
if( '1' == $framework_options['padre_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/padre/init.php' );	
}
if( '1' == $framework_options['lydia_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/init.php' );	
}
if( '1' == $framework_options['expose_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/init.php' );	
}
if( '1' == $framework_options['uber_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/init.php' );	
}
if( '1' == $framework_options['launchkit_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/launchkit/init.php' );	
}
if( '1' == $framework_options['union_vc_shortcodes'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/union/init.php' );	
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
if( '1' == $framework_options['malefic_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/malefic-widgets.php' );	
}
if( '1' == $framework_options['creatink_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/creatink-widgets.php' );	
}
if( '1' == $framework_options['brailie_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/brailie-widgets.php' );	
}
if( '1' == $framework_options['gaze_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/gaze-widgets.php' );	
}
if( '1' == $framework_options['fulford_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/fulford-widgets.php' );	
}
if( '1' == $framework_options['acomb_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/acomb-widgets.php' );	
}
if( '1' == $framework_options['gallery_widgets'] ){
	require_once( EBOR_FRAMEWORK_PATH . 'widgets/gallery-widgets.php' );	
}

/**
 * Register Portfolio Post Type
 */
if( !( post_type_exists('portfolio') ) && '1' == $framework_options['portfolio_post_type'] ){
	add_action( 'init', 'ebor_framework_register_portfolio', 10 );
	add_action( 'init', 'ebor_framework_create_portfolio_taxonomies', 10  );
}

/**
 * Register Team Post Type
 */
if( !( post_type_exists('team') ) && '1' == $framework_options['team_post_type'] ){
	add_action( 'init', 'ebor_framework_register_team', 10  );
	add_action( 'init', 'ebor_framework_create_team_taxonomies', 10  );
}

/**
 * Register Client Post Type
 */
if( !( post_type_exists('client') ) && '1' == $framework_options['client_post_type'] ){
	add_action( 'init', 'ebor_framework_register_client', 10  );
	add_action( 'init', 'ebor_framework_create_client_taxonomies', 10  );
}

/**
 * Register Testimonial Post Type
 */
if( !( post_type_exists('testimonial') ) && '1' == $framework_options['testimonial_post_type'] ){
	add_action( 'init', 'ebor_framework_register_testimonial', 10  );
	add_action( 'init', 'ebor_framework_create_testimonial_taxonomies', 10  );
}

/**
 * Register faq Post Type
 */
if( !( post_type_exists('faq') ) && '1' == $framework_options['faq_post_type'] ){
	add_action( 'init', 'ebor_framework_register_faq', 10  );
	add_action( 'init', 'ebor_framework_create_faq_taxonomies', 10  );
}

/**
 * Register Menu Post Type
 */
if( !( post_type_exists('menu') ) && '1' == $framework_options['menu_post_type'] ){
	add_action( 'init', 'ebor_framework_register_menu', 10  );
	add_action( 'init', 'ebor_framework_create_menu_taxonomies', 10  );
}

/**
 * Register Class Post Type
 */
if( !( post_type_exists('class') ) && '1' == $framework_options['class_post_type'] ){
	add_action( 'init', 'ebor_framework_register_class', 10  );
	add_action( 'init', 'ebor_framework_create_class_taxonomies', 10  );
}

/**
 * Register Case Study Post Type
 */
if( !( post_type_exists('case_study') ) && '1' == $framework_options['case_study_post_type'] ){
	add_action( 'init', 'ebor_framework_register_case_study', 10  );
	add_action( 'init', 'ebor_framework_create_case_study_taxonomies', 10  );
}

/**
 * Register Service Post Type
 */
if( !( post_type_exists('service') ) && '1' == $framework_options['service_post_type'] ){
	add_action( 'init', 'ebor_framework_register_service', 10  );
	add_action( 'init', 'ebor_framework_create_service_taxonomies', 10  );
}

/**
 * Register career Post Type
 */
if( !( post_type_exists('career') ) && '1' == $framework_options['career_post_type'] ){
	add_action( 'init', 'ebor_framework_register_career', 10  );
	add_action( 'init', 'ebor_framework_create_career_taxonomies', 10  );
}

/**
 * Register Mega Menu Post Type
 */
if( !( post_type_exists('mega_menu') ) && '1' == $framework_options['mega_menu'] ){
	add_action( 'init', 'ebor_framework_register_mega_menu', 10  );
}