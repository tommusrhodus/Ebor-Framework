<?php 

/**
 * The Shortcode
 */
function ebor_notification_shortcode( $atts, $content = null ) {
	
	global $partner_notification_content;
	
	extract( 
		shortcode_atts( 
			array(
				'button_text' => '',
				'layout' => 'bottom',
				'title' => ''
			), $atts 
		) 
	);
	
	if( 'bottom' == $layout ) {
		
		$output = '
			<a class="btn" href="#" data-notification-link="'. $title .'">
				<span class="btn__text">
					'. $button_text .'
				</span>
			</a>
			<div class="notification pos-right pos-bottom col-md-4 col-sm-6" data-animation="from-bottom" data-notification-link="'. $title .'">
				'. do_shortcode($content) .'
			</div>
		';
		
	} else {
		
		$output = '
			<a class="btn" href="#" data-notification-link="'. $title .'">
				<span class="btn__text">
					'. $button_text .'
				</span>
			</a>
			<div class="notification pos-bottom pos-right col-md-4 col-sm-6" data-animation="from-right" data-notification-link="'. $title .'">
				'. do_shortcode($content) .'
			</div>
		';	
		
	}
	
	return $output;
}
add_shortcode( 'partner_notification', 'ebor_notification_shortcode' );

/**
 * The VC Functions
 */
function ebor_notification_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'                    => esc_html__( 'Notification' , 'partner' ),
		    'base'                    => 'partner_notification',
		    'description'             => esc_html__( 'Create a notification popup', 'partner' ),
		    'as_parent'               => array('except' => 'partner_tabs_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'params' => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Unique Title", 'partner'),
		    		"param_name" => "title",
		    		'description' => 'Use a unique lowercase title for each notification on a page.'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Button Text", 'partner'),
		    		"param_name" => "button_text"
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Modal Layout", 'partner'),
		    		"param_name" => "layout",
		    		"value" => array(
		    			'Notification From Bottom' => 'bottom',
		    			'Notification From Right' => 'right'
		    		)
		    	),
		    )
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_notification_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_partner_notification extends WPBakeryShortCodesContainer {}
}