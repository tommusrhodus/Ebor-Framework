<?php 

if( class_exists('Ebor_Options') ){
	
	/**
	 * Variables
	 */
	$framework_options = new Ebor_Options;
	$yesNo = array('yes' => 'Yes', 'no' => 'No');
	
	$framework_options->add_panel('Ebor Framework: Update Settings', 1, '');
	
	$framework_options->add_section('framework_user_settings_section', 'User Settings', 30, 'Ebor Framework: Update Settings', '<code>Note:</code> Please enter your Envato username exactly, it\'s case sensitive.<br /><br />For the API key visit the "settings" page of your Themeforest account, see the left menu for the "API Keys" option, enter a name and create a new key.<br /><br /><a href="https://www.youtube.com/watch?v=oqE3RE5TKJk" target="_blank">See Our Instructional Video Here</a>');
	$framework_options->add_setting('input', 'ebor_framework_username', 'Your Envato Username', 'framework_user_settings_section', '', 10);
	$framework_options->add_setting('input', 'ebor_framework_api_key', 'Your Envato API Key', 'framework_user_settings_section', '', 15);
	
}

if(!( '' == get_option('ebor_framework_username', '') )){
	require_once( 'envato-wp-theme-updater.php' );
	
	$username = get_option('ebor_framework_username', '');
	$apikey = get_option('ebor_framework_api_key', '');
	$author = array('Tom Rhodes', 'tommusrhodus');
	
	Envato_WP_Theme_Updater::init( trim($username), trim($apikey), $author );
}