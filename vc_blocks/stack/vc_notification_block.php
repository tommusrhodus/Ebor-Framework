<?php 

/**
 * The Shortcode
 */
function ebor_notification_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'trigger_name' => '',
				'button_text' => '',
				'autoshow' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$autoshow = ( $autoshow ) ? 'data-autoshow="'. (int) $autoshow .'"' : false;
	
	$output = '
		<a class="btn '. esc_attr($custom_css_class) .'" href="#" data-notification-link="'. $trigger_name .'">'. $button_text .'</a>
		<div class="'. esc_attr($custom_css_class) .' notification pos-right pos-bottom col-sm-4 col-md-3" data-animation="from-bottom" data-notification-link="'. $trigger_name .'" '. $autoshow .'>
			<div class="boxed boxed--border border--round box-shadow">
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		</div><!--end of notification-->
	';

	return $output;
}
add_shortcode( 'stack_notification', 'ebor_notification_shortcode' );

/**
 * The VC Functions
 */
function ebor_notification_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Notifications", 'stackwordpresstheme'),
			"base" => "stack_notification",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('except' => 'stack_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Trigger Name", 'stackwordpresstheme'),
					"param_name" => "trigger_name",
					"description" => 'Enter a unique identifying name for this element e.g: mainModal',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'stackwordpresstheme'),
					"param_name" => "button_text",
					"description" => 'notification trigger button text',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Autoshow Counter", 'stackwordpresstheme'),
					"param_name" => "autoshow",
					"description" => 'Autoshow timer, use milliseconds to create a countdown for the notification to show on page load. NUMERIC ONLY. E.g: 5000',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_notification_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_notification extends WPBakeryShortCodesContainer {}
}