<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_union_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/union/vc_header_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/union/vc_instagram_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/union/vc_slider_block.php');
}

function ebor_framework_union_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_union_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_union_init', 9999);