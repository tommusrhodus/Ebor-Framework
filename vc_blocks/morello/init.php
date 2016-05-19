<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_morello_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_section_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_skill_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_fact_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_icon_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_side_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_top_left_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_box_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_counter_text_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_process_circle_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_toggles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_client_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/morello/vc_portfolio_meta_block.php');
}

function ebor_framework_morello_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_morello_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_morello_init', 9999);