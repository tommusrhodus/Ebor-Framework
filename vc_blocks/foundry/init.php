<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_foundry_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_hero_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_hero_slider_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_hero_video_slider_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_page_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_alert_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_skill_bar_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_feature_list_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_toggles_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_pricing_table_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_icon_box_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_video_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_video_background_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_instagram_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_flickr_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_twitter_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_clients_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_text_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_text_images_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_testimonials_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_title_card_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_resume_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_simple_social_icon_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_masonry_services_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_menu_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_embed_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_tour_date_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_big_social_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_call_to_action_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_sharing_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_modal_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_image_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_half_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_process_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_counter_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_image_tile_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_image_caption_block.php');	
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/foundry/vc_portfolio_nav.php');
}

function ebor_framework_foundry_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_foundry_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_foundry_init', 9999);