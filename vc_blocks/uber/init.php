<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_uber_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/expose/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_page_header_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_section_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_video_background_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_image_background_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_button_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_services_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_testimonial_carousel_block.php');	
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_call_to_action_block.php');	
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/uber/vc_clients_block.php');
}

function ebor_framework_uber_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_uber_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_uber_init', 9999);