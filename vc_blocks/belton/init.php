<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_belton_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_intro_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_post_feed_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_accordion_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_card_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_image_slider_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_icon_and_text_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_team_feed_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_pricing_table_block.php');	
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_image_gallery_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/belton/vc_testimonial_slider_block.php');
}

function ebor_framework_belton_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_belton_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_belton_init', 9999);