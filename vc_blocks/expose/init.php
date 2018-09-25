<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_expose_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_service_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_clients_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_call_to_action_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_services_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_services_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_section_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_contact_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_fullscreen_parallax_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_page_header_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_canvas_page_header_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_video_background_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_agency_tiles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/vc_testimonials_block.php');
}

function ebor_framework_expose_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_expose_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_expose_init', 9999);