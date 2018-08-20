<?php 

/**
 * All content shortcodes enqueued below here
 */
function ebor_framework_register_hygge_blocks(){

	/**
	 * Grab all VC Functions
	 */
	require_once('functions.php');

	/**
	 * Page builder blocks below here
	 * Whoop-dee-doo
	 */
	require_once('vc_pricing_table_block.php');
	require_once('vc_animated_heading_block.php');
	require_once('vc_service_block.php');
	require_once('vc_section_title_block.php');
	require_once('vc_skill_bar_block.php');
	require_once('vc_testimonial_block.php');
	require_once('vc_team_block.php');
	require_once('vc_feature_block.php');
	require_once('vc_tabs_block.php');
	require_once('vc_toggles_block.php');
	require_once('vc_instagram_block.php');
	require_once('vc_client_block.php');
	require_once('vc_map_block.php');
	require_once('vc_process_circle_block.php');
	require_once('vc_fact_block.php');
	require_once('vc_alert_block.php');
	require_once('vc_code_block.php');
	require_once('vc_blog_block.php');
	require_once('vc_portfolio_block.php');

}

function ebor_framework_hygge_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_hygge_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_hygge_init', 9999);