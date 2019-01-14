<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_stack_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_hero_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_hero_video_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_hero_gradient_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_hero_slider_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_hero_slider_alt_block.php');	
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_hero_slider_alt_two_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_typed_text_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_twitter_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_instagram_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_accordion_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_tabs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_tabs_sections_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_boxed_content_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_countdown_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_dropdown_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_lightbox_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_styled_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_modal_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_notification_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_pricing_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_slider_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_inline_video_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_modal_video_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_call_to_action_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_card_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_text_and_image_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_text_and_map_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_text_and_video_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_blog_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_team_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_testimonial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_portfolio_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_product_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_career_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_icon_feature_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_breadcrumbs_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_image_gallery_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_image_gallery_links_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_video_gallery_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_process_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_radial_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_progress_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_header_plate_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_content_carousel_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_section_navigator_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_login_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_add_to_cart_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_comments_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/stack/vc_wizard_block.php');
}

function ebor_framework_stack_init(){
	add_action('after_setup_theme', 'ebor_framework_register_stack_blocks', 10);
}

add_action('plugins_loaded', 'ebor_framework_stack_init', 9999);