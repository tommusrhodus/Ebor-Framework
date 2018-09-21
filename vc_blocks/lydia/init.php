<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_lydia_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_service_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_service_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_skill_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_toggles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_instagram_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_disqus_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_flickr_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_fact_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lydia/vc_client_block.php');
}

function ebor_framework_lydia_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_lydia_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_lydia_init', 9999);