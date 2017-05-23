<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_malefic_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_fact_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_toggles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_skill_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_circle_progress_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_icon_text_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/malefic/vc_instagram_block.php');
}

function ebor_framework_malefic_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_malefic_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_malefic_init', 9999);