<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_creatink_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_client_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_shop_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_accordion_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_animated_text_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_counter_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_countdown_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_footer_social_icons_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_icon_and_text_block.php');
	//require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_image_hover_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_lightbox_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_login_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_media_player_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_register_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_page_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_progress_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_social_feed_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/creatink/vc_timeline_block.php');
}

function ebor_framework_creatink_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_creatink_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_creatink_init', 9999);