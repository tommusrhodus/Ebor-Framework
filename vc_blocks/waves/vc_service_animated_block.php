<?php

/**
 * The Shortcode
 */
function ebor_service_animated_shortcode( $atts, $content = null ) {
		
	$output = do_shortcode($content);
	
	return $output;
}
add_shortcode( 'waves_service_animated', 'ebor_service_animated_shortcode' );

/**
 * The Shortcode
 */
function ebor_service_animated_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => '',
				'button_text' => 'Learn More',
				'button_url' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="col-md-3 service">
			<i class="'. esc_attr($icon) .'"></i>
			'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			<a href="'. esc_url($button_url) .'" class="btn btn-white tm15">'. $button_text .'</a>
		</div>
	';
	
	return $output;
}
add_shortcode( 'waves_service_animated_content', 'ebor_service_animated_content_shortcode' );

// Parent Element
function ebor_service_animated_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'waves-vc-block',
		    'name'                    => esc_html__( 'Animated Services' , 'waves' ),
		    'base'                    => 'waves_service_animated',
		    'description'             => esc_html__( 'Create Animated Servicebed Content', 'waves' ),
		    'as_parent'               => array('only' => 'waves_service_animated_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('waves WP Theme', 'waves'),
		    'params' => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_animated_shortcode_vc' );

// Nested Element
function ebor_service_animated_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'waves-vc-block',
		    'name'            => esc_html__('Animated Services Content', 'waves'),
		    'base'            => 'waves_service_animated_content',
		    'description'     => esc_html__( 'Animated Service Content Element', 'waves' ),
		    "category" => esc_html__('waves WP Theme', 'waves'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'waves_service_animated'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "ebor_icons",
		    		"heading" => esc_html__("Icon", 'waves'),
		    		"param_name" => "icon",
		    		"value" => array_keys(ebor_get_icons())
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Button Text", 'waves'),
		    		"param_name" => "button_text"
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Button URL", 'waves'),
		    		"param_name" => "button_url"
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'waves'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_animated_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_waves_service_animated extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_waves_service_animated_content extends WPBakeryShortCode {}
}