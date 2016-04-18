<?php

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_peekskill_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/peekskill/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/peekskill/vc_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/peekskill/vc_side_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/peekskill/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/peekskill/vc_portfolio_block.php');
}

function ebor_framework_peekskill_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_peekskill_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_peekskill_init', 9999);