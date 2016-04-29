<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_partner_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_accordion_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_hero_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_hero_slider_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_text_slider_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_text_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_video_inline_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_cta_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_hero_video_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_icon_feature_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_icon_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_icon_large_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_icon_small_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_image_tile_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_modal_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_notification_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_stats_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_stats_simple_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_stats_grid_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_service_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_case_study_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/partner/vc_text_carousel_block.php');
}

function ebor_framework_partner_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_partner_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_partner_init', 9999);