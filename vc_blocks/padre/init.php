<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_padre_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/padre/vc_section_title_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/padre/vc_menu_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/padre/vc_instagram_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/padre/vc_testimonial_block.php');
}

function ebor_framework_padre_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_padre_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_padre_init', 9999);