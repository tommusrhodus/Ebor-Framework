<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_malory_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_fact_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_skill_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_toggles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_service_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_client_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_instagram_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malory/vc_disqus_block.php');
}

function ebor_framework_malory_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_malory_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_malory_init', 9999);