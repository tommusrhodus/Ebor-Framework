<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_waves_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/vc_page_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/vc_service_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/vc_service_column_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/vc_service_animated_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/waves/vc_team_block.php');
}

function ebor_framework_waves_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_waves_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_waves_init', 9999);