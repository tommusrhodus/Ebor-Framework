<?php

/**
 * The Shortcode
 */
function ebor_services_shortcode( $atts, $content = null ) {
	global $ebor_service_count;
	$ebor_service_count = 0;
	$output = '<article class="col-md-10 col-md-offset-1 service-icon-wrap"><div class="row">'. do_shortcode($content) .'</div></article>';
	return $output;
}
add_shortcode( 'uber_services', 'ebor_services_shortcode' );

/**
 * The Shortcode
 */
function ebor_services_content_shortcode( $atts, $content = null ) {
	global $ebor_service_count;
	$ebor_service_count++;
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => 'none'
			), $atts 
		) 
	);
	$output = '<div class="col-md-6 service-icon parallax">';
	
	if(!( 'none' == $icon ))				
		$output .= '<i class="ion-'. esc_attr($icon) .' color"></i>';
		
	$output .= '<h4 class="font4 black">'. htmlspecialchars_decode($title) .'</h4>'. wpautop(htmlspecialchars_decode($content)) .'</div>';
			   
	if( $ebor_service_count % 2 == 0 )
		$output .= '</div><div class="row">';
	
	return $output;
}
add_shortcode( 'uber_services_content', 'ebor_services_content_shortcode' );

// Parent Element
function ebor_services_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
		    'name'                    => __( 'Services Columns' , 'uber' ),
		    'base'                    => 'uber_services',
		    'description'             => __( 'Add columns of services to the page', 'uber' ),
		    'as_parent'               => array('only' => 'uber_services_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Uber - WP Theme', 'uber'),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_services_shortcode_vc' );

// Nested Element
function ebor_services_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'uber-vc-block',
		    'name'            => __('Services Columns Content', 'uber'),
		    'base'            => 'uber_services_content',
		    'description'     => __( 'Individual Service', 'uber' ),
		    "category" => __('Uber - WP Theme', 'uber'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'uber_services'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "ebor_icons",
		    		"heading" => __("Service Icon", 'uber'),
		    		"param_name" => "icon",
		    		"value" => ebor_get_icons(),
		    		'description' => 'view all icons here: http://ionicons.com'
		    	),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Title", 'uber'),
	            	"param_name" => "title",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Content", 'uber'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_services_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_uber_services extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_uber_services_content extends WPBakeryShortCode {

    }
}