<?php 

if( class_exists('Ebor_Options') ){
	
	/**
	 * Variables
	 */
	$framework_options = new Ebor_Options;
	$yesNo = array('yes' => 'Yes', 'no' => 'No');
	
	$framework_options->add_panel('Ebor Framework: Update Settings', 1, '');
	
	$framework_options->add_section('framework_user_settings_section', 'User Settings', 30, 'Ebor Framework: Update Settings', 'Please enter your Envato username exactly, case sensitive. For the API key visit the "settings" page of your Themeforest account, see the left menu for the "API Keys" option, enter a name and create a new key.');
	$framework_options->add_setting('input', 'ebor_framework_username', 'Your Envato Username', 'framework_user_settings_section', '', 10);
	$framework_options->add_setting('input', 'ebor_framework_api_key', 'Your Envato API Key', 'framework_user_settings_section', '', 15);
	
	$framework_options->add_section('framework_dismiss_section', 'Dismissed Notifications Settings', 35, 'Ebor Framework: Update Settings', '');
	$framework_options->add_setting('select', 'framework_show_welcome_modal', 'Show welcome modal on framework start?', 'framework_dismiss_section', 'yes', 35, $yesNo);
	
}

function ebor_framework_updates_notification(){
	
	if( '' == get_option('ebor_framework_username', '') && 'yes' == get_option('framework_show_welcome_modal', 'yes') ){
		
		$query['autofocus[control]'] = 'ebor_framework_username';
		$control_link = add_query_arg( $query, admin_url( 'customize.php' ) );
		
		echo '
			<div class="notice notice-success is-dismissible ebor-framework-updates-dismiss">
				<img src="http://www.tommusrhodus.com/wp-content/uploads/2014/06/profile4.png" alt="tommsusrhodus" />
				<div class="content">
					<h3>Thank you for installing Ebor Framework <small>by TommusRhodus</small></h3>
			        <p class="lead">Ebor Framework provides verified customers with auto-updates and important features for your TommusRhodus Themes and Plugins. Keep your Theme, Plugins and Site secure by enabling updates from the framework settings.</p>
			        <p>To get started with enabling auto-updates and important framework features, visit the Ebor Framework settings in your <a href="'. esc_url( $control_link ) .'">customizer panel</a> to fill out your Envato Username & API key.</p>
			        <p><a class="button button-primary" href="'. esc_url( $control_link ) .'">Enable Updates & Extras</a></p>
		        </div>
		    </div>
	    ';
    
	}
    
}
add_action( 'admin_notices', 'ebor_framework_updates_notification' );

//MasonThemes
//htw0lppk5z4fhu99fjyrbuo6vmb7qxss

if(!( '' == get_option('ebor_framework_username', '') )){
	require_once( 'envato-wp-theme-updater.php' );
	
	$username = get_option('ebor_framework_username', '');
	$apikey = get_option('ebor_framework_api_key', '');
	$author = array('Tom Rhodes', 'tommusrhodus');
	
	Envato_WP_Theme_Updater::init( $username, $apikey, $author );
}