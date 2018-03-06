<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_gaze_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_accordion_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_client_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_countdown_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_counter_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_flip_box_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_icon_box_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_image_and_text_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_image_lightbox_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_modal_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_modal_video_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_page_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_promo_box_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_process_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_progress_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_shop_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_social_icons_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_toggle_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_twitter_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/gaze/vc_typed_text_block.php');

}

function ebor_framework_gaze_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_gaze_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_gaze_init', 9999);