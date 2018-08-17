<?php 

/**
 * All content shortcodes enqueued below here
 */
function ebor_framework_register_meetup_blocks(){

	/**
	 * Grab all VC Functions
	 */
	require_once('functions.php');
	
	//Grab text Shortcode
	if(!( function_exists('ebor_text_shortcode') ))
		require_once('vc_text_block.php');
		
	//Grab text Shortcode
	if(!( function_exists('ebor_pricing_card_shortcode') ))
		require_once('vc_pricing_card_block.php');
		
	//Grab testimonial carousel Shortcode
	if(!( function_exists('ebor_testimonial_carousel_shortcode') ))
		require_once('vc_testimonial_carousel_block.php');
		
	//Grab testimonial carousel Shortcode
	if(!( function_exists('ebor_clients_shortcode') ))
		require_once('vc_clients_block.php');
		
	if(!( function_exists('ebor_faq_shortcode') ))
		require_once('vc_faq_block.php');
		
	//Grab testimonial carousel Shortcode
	if(!( function_exists('ebor_hero_slider_shortcode') ))
		require_once('vc_hero_slider_block.php');
		
	if(!( function_exists('ebor_hero_video_shortcode') ))
		require_once('vc_hero_video_block.php');
		
	if(!( function_exists('ebor_team_shortcode') ))
		require_once('vc_team_block.php');
		
	if(!( function_exists('ebor_timetable_shortcode') ))
		require_once('vc_timetable_block.php');
		
	if(!( function_exists('ebor_twitter_shortcode') ))
		require_once('vc_twitter_block.php');
		
	if(!( function_exists('ebor_instagram_shortcode') ))
		require_once('vc_instagram_block.php');
		
	if(!( function_exists('ebor_call_to_action_shortcode') ))
		require_once('vc_call_to_action_block.php');
		
	if(!( function_exists('ebor_colour_blocks_shortcode') ))
		require_once('vc_colour_blocks_block.php');
		
	if(!( function_exists('ebor_big_icon_shortcode') ))
		require_once('vc_big_icon_block.php');
		
	if(!( function_exists('ebor_tickera_shortcode') ) && shortcode_exists( 'event' )){
		require_once('vc_tickera_block.php');
	}
}

function ebor_framework_meetup_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_meetup_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_meetup_init', 9999);