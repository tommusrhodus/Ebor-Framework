<?php 

/**
 * All content shortcodes enqueued below here
 */
function ebor_framework_register_somnus_blocks(){

	/**
	 * Grab all VC Functions
	 */
	require_once('functions.php');

	/**
	 * Page builder blocks below here
	 * Whoop-dee-doo
	 */
	require_once('vc_featured_text_block.php');
	require_once('vc_instagram_block.php');
	require_once('vc_testimonial_block.php');
	require_once('vc_team_block.php');
	require_once('vc_timetable_block.php');
	require_once('vc_workshop_block.php');

}

function ebor_framework_somnus_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_somnus_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_somnus_init', 9999);