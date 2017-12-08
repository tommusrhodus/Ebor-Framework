<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_griddr_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/griddr/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/griddr/vc_blog_post_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/griddr/vc_team_post_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/griddr/vc_portfolio_post_block.php');
}

function ebor_framework_griddr_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_griddr_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_griddr_init', 9999);