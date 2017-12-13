<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_candar_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/candar/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/candar/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/candar/vc_team_block.php');
}

function ebor_framework_candar_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_candar_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_candar_init', 9999);