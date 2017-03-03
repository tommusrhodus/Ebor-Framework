<?php 

/**
 * The Shortcode
 */
function ebor_modal_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'button_text' => '',
				'autoshow' => '',
				'cookie' => '',
				'exit' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$autoshow = ( $autoshow ) ? 'data-autoshow="'. (int) $autoshow .'"' : false;
	$cookie = ( $cookie ) ? 'data-cookie="'. $cookie .'"' : false;
	$exit = ( $exit ) ? 'data-show-on-exit="'. $exit .'"' : false;
	
	$output = '
		<div class="modal-instance '. esc_attr($custom_css_class) .'">
			<a class="btn modal-trigger" href="#">'. $button_text .'</a>
			<div class="modal-container" '. $autoshow .' '. $cookie .' '. $exit .'>
				<div class="modal-content">
					<div class="boxed boxed--lg">
						'. do_shortcode(htmlspecialchars_decode($content)) .'
					</div>
				</div>
			</div>
		</div><!--end of modal instance-->
	';

	return $output;
}
add_shortcode( 'stack_modal', 'ebor_modal_shortcode' );

/**
 * The VC Functions
 */
function ebor_modal_shortcode_vc() {
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Modal", 'stackwordpresstheme'),
			"base" => "stack_modal",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('except' => 'stack_tabs_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'stackwordpresstheme'),
					"param_name" => "button_text",
					"description" => 'Modal trigger button text',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Autoshow Counter", 'stackwordpresstheme'),
					"param_name" => "autoshow",
					"description" => 'Autoshow timer, use milliseconds to create a countdown for the modal to show on page load. NUMERIC ONLY. E.g: 5000',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Cookie Name", 'stackwordpresstheme'),
					"param_name" => "cookie",
					"description" => 'Leave blank in most cases, set a unique name if you want a modal to show only once per user.',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Exit element class", 'stackwordpresstheme'),
					"param_name" => "exit",
					"description" => 'Enter the CSS class of an element if you wish to show this modal whenever a users mouse leaves that element. Use sparingly.',
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
add_action( 'vc_before_init', 'ebor_modal_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_modal extends WPBakeryShortCodesContainer {}
}