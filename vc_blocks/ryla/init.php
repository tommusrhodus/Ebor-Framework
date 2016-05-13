<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_ryla_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_toggles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_skill_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_fact_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_section_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_client_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_icon_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_product_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/ryla/vc_testimonial_block.php');
}

function ebor_framework_ryla_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_ryla_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_ryla_init', 9999);