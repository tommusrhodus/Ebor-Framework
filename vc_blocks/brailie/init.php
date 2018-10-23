<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_brailie_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/functions.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_accordion_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_alert_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_animated_text_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_blog_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_clients_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_countdown_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_counter_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_flickr_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_html5_video_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_instagram_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_lightbox_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_portfolio_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_pricing_table_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_process_steps_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_progress_bar_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_services_icon_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_services_image_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_tabs_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_team_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_testimonial_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_comparison_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_swiper_gallery_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_swiper_modal_gallery_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_image_text_tile_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_modal_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_image_gallery_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_tabbed_carousel_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_tabbed_media_player_block.php' );
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/brailie/vc_bullet_nav.php' );
}

function ebor_framework_brailie_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_brailie_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_brailie_init', 9999);