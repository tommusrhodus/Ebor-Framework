<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_kwoon_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_sidebar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_section_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_client_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_skill_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_toggles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_instagram_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_dribbble_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_flickr_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_fact_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_side_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_side_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_step_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_service_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_service_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_process_grid_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_process_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_process_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_progress_circle_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_slider_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_code_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_advert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_countdown_block.php');

	if( class_exists('Woocommerce') ){
		require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_products_carousel_block.php');
		require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/kwoon/vc_products_block.php');
	}
}

function ebor_framework_kwoon_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_kwoon_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_kwoon_init', 9999);