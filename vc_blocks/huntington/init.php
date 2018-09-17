<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_huntington_blocks(){	
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/huntington/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/huntington/vc_icon_text_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/huntington/vc_service_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/huntington/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/huntington/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/huntington/vc_quote_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/huntington/vc_gallery_block.php');
}

function ebor_framework_huntington_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_huntington_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_huntington_init', 9999);