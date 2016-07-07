<?php 

/**
 * Custom blocks for visual composer in this theme.
 */
function ebor_framework_register_hive_blocks(){
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/hive/vc_menu_block.php');
	require_once( EBOR_FRAMEWORK_PATH . 'vc_blocks/hive/vc_testimonial_block.php');
}

function ebor_framework_hive_init(){
	if( function_exists('vc_set_as_theme') ){
		add_action('after_setup_theme', 'ebor_framework_register_hive_blocks', 10);
	}
}

add_action('plugins_loaded', 'ebor_framework_hive_init', 9999);