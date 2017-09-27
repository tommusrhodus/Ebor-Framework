<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_sugarland_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/sugarland/vc_maps_button_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/sugarland/vc_video_button_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/sugarland/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/sugarland/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/sugarland/vc_pricing_table_block.php');
}

function ebor_framework_sugarland_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_sugarland_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_sugarland_init', 9999);