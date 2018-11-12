<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_launchkit_blocks(){
	require_once('functions.php');
	require_once('vc_gallery_block.php');
	require_once('vc_slider_block.php');
	require_once('vc_hero_video_block.php');
	require_once('vc_hero_cta_block.php');
	require_once('vc_portfolio_block.php');
	require_once('vc_blog_block.php');	
	require_once('vc_testimonial_carousel_block.php');
	require_once('vc_pricing_table_block.php');
	require_once('vc_clients_block.php');
	require_once('vc_video_popup_block.php');
	require_once('vc_icon_block.php');
	require_once('vc_team_block.php');
	require_once('vc_colour_feature_block.php');
	require_once('vc_side_icon_block.php');
	require_once('vc_instagram_block.php');
	require_once('vc_twitter_block.php');
	require_once('vc_image_title_block.php');
	require_once('vc_tabs_block.php');

	if( class_exists('Woocommerce') ){
		require_once('vc_products_block.php');
	}

}

function ebor_framework_launchkit_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_launchkit_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_launchkit_init', 9999);