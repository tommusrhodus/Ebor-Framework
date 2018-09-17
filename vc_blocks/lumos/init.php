<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_lumos_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_toggles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_skill_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_code_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/lumos/vc_instagram_block.php');
}

function ebor_framework_lumos_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_lumos_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_lumos_init', 9999);