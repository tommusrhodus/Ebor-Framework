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
				'custom_css_class' => '',
				'position' => 'pos-right pos-bottom',
				'layout' => 'basic',
				'animation' => 'from-bottom',
				'image' => '',
				'show_trigger' => 'yes',
				'btn_class' => '',				
				'cookie' => '',
			), $atts 
		) 
	);
	
	$autoshow = ( $autoshow ) ? 'data-autoshow="'. (int) $autoshow .'"' : false;
	$cookie = ( $cookie ) ? 'data-cookie="'. $cookie .'"' : false;
	
	if( 'basic' == $layout ){
		
		$notification_content = '
			<div class="'. esc_attr($custom_css_class) .' notification '. $position .' col-sm-4 col-md-3" data-animation="'. $animation .'" data-notification-link="'. $trigger_name .'" '. $autoshow .' '. $cookie .'>
				<div class="boxed boxed--border border--round box-shadow">
					'. do_shortcode(htmlspecialchars_decode($content)) .'
				</div>
			</div><!--end of notification-->
		';	
		
	} elseif( 'narrow' == $layout ){
		
		$notification_content = '
			<div class="'. esc_attr($custom_css_class) .' notification '. $position .' col-sm-4 col-md-3" data-animation="'. $animation .'" data-notification-link="'. $trigger_name .'" '. $autoshow .' '. $cookie .'>
				<div class="feature feature-1 text-center">
				    '. wp_get_attachment_image( $image, 'full' ) .'
				    <div class="feature__body boxed boxed--lg boxed--border">
				        <div class="modal-close modal-close-cross"></div>
				        '. do_shortcode(htmlspecialchars_decode($content)) .'
				    </div>
				    <div class="notification-close-cross notification-close-cross--circle notification-close"></div>
				</div><!--end feature-->
			</div>
		';	
		
	} elseif( 'basic-dark' == $layout ){
		
		$notification_content = '
			<div class="'. esc_attr($custom_css_class) .' notification '. $position .' col-sm-4 col-md-3 bg--dark" data-animation="'. $animation .'" data-notification-link="'. $trigger_name .'" '. $autoshow .' '. $cookie .'>
				<div class="boxed boxed--border border--round box-shadow">
					'. do_shortcode(htmlspecialchars_decode($content)) .'
				</div>
			</div><!--end of notification-->
		';	
		
	} elseif( 'image-background' == $layout ){
		
		$notification_content = '
			<div class="'. esc_attr($custom_css_class) .' notification '. $position .' col-sm-6 col-md-4 box-shadow-wide" data-animation="'. $animation .'" data-notification-link="'. $trigger_name .'" '. $autoshow .' '. $cookie .'>
				<div class="boxed boxed--lg imagebg text-center" data-overlay="6">
				    <div class="background-image-holder">
				        '. wp_get_attachment_image( $image, 'full' ) .'
				    </div>
				    <div class="container">
				        '. do_shortcode(htmlspecialchars_decode($content)) .'
				    </div>
				    <div class="notification-close-cross notification-close-cross--circle notification-close"></div>
				</div>
			</div>
		';	
		
	}
	
	$trigger = ( 'yes' == $show_trigger ) ? '<a class="btn '. $btn_class .' '. esc_attr($custom_css_class) .'" href="#" data-notification-link="'. $trigger_name .'"><span class="btn__text">'. $button_text .'</span></a>' : false;
	
	$output = $trigger . $notification_content;

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
					"type" => "dropdown",
					"heading" => esc_html__("Notification Layout", 'stackwordpresstheme'),
					"param_name" => "layout",
					"value" => array(
						'Basic Notification' => 'basic',
						'Basic, Dark Background' => 'basic-dark',
						'Image Top' => 'narrow',
						'Image Background' => 'image-background'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Show trigger Button?", 'stackwordpresstheme'),
					"param_name" => "show_trigger",
					"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Button Display Type", 'stackwordpresstheme'),
					"param_name" => "btn_class",
					"value" => array(
						'Outline Button' => '',
						'Standard Button' => 'btn--primary',
						'Outline Button Uppercase' => 'type--uppercase',
						'Standard Button Uppercase' => 'btn--primary type--uppercase'
					),
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Block Image", 'stackwordpresstheme'),
					"param_name" => "image"
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Notification Position", 'stackwordpresstheme'),
					"param_name" => "position",
					"value" => array(
						'Bottom Right' => 'pos-right pos-bottom',
						'Bottom Left' => 'pos-left pos-bottom',
						'Top Left' => 'pos-left pos-top',
						'Top Right' => 'pos-right pos-top',
					),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Animate From (origin)", 'stackwordpresstheme'),
					"param_name" => "animation",
					"value" => array(
						'Bottom' => 'from-bottom',
						'Left' => 'from-left',
						'Top' => 'from-top',
						'Right' => 'from-right'
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Autoshow Counter", 'stackwordpresstheme'),
					"param_name" => "autoshow",
					"description" => 'Autoshow timer, use milliseconds to create a countdown for the notification to show on page load. NUMERIC ONLY. E.g: 5000',
				),				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Cookie Name", 'stackwordpresstheme'),
					"param_name" => "cookie",
					"description" => 'Leave blank in most cases, set a unique name if you want a modal to show only once per user.',
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