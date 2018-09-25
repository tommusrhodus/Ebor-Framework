<?php

global $ebor_service_tabs;
global $ebor_service_tabs_count;

/**
 * The Shortcode
 */
function ebor_services_tabs_shortcode( $atts, $content = null ) {
	global $ebor_service_tabs;
	global $ebor_service_tabs_count;
	$ebor_service_tabs = false;
	$ebor_service_tabs_count = 0;
	
	$output = '<div class="row">
				<article class="col-md-12 text-center">
				
					<div id="bx-pager" class="agency-slider-triggers">
						'. do_shortcode($content) .'
					</div>
					
					'. ebor_expose_seperator(2) .'
					
					<ul class="bxslider agency-slider">
						'. $ebor_service_tabs .'
					</ul>
				
				</article>
			</div>';
	return $output;
}
add_shortcode( 'expose_services_tabs', 'ebor_services_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_services_tabs_content_shortcode( $atts, $content = null ) {
	global $ebor_service_tabs;
	global $ebor_service_tabs_count;
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'small' => '',
				'image' => ''
			), $atts 
		) 
	);
	$output = '<a data-slide-index="'. $ebor_service_tabs_count .'" href="#">'. wp_get_attachment_image($image, 'thumbnail') .'</a>';
	$ebor_service_tabs_count++;
	$ebor_service_tabs .= '<li><div class="row"><article class="col-md-12 text-center">';
	
	if($title)
		$ebor_service_tabs .= '<h3 class="agency-feature-heading dark font3"><span>'. htmlspecialchars_decode($title) .'</span></h3>';
		
	if($subtitle)
		$ebor_service_tabs .= '<h1 class="agency-feature-text black font2">'. htmlspecialchars_decode($subtitle) .'</h1>';
	
	if($small)
		$ebor_service_tabs .= '<p class="color font3">'. htmlspecialchars_decode($small) .'</p>';
		
	$ebor_service_tabs .= '</article></div></li>';
	return $output;
}
add_shortcode( 'expose_services_tabs_content', 'ebor_services_tabs_content_shortcode' );

// Parent Element
function ebor_services_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
		    'name'                    => __( 'Services Tabs' , 'expose' ),
		    'base'                    => 'expose_services_tabs',
		    'description'             => __( 'Container for Item', 'expose' ),
		    'as_parent'               => array('only' => 'expose_services_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Expose WP Theme', 'expose'),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_services_tabs_shortcode_vc' );

// Nested Element
function ebor_services_tabs_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
		    'name'            => __('ServicesTabs Content', 'expose'),
		    'base'            => 'expose_services_tabs_content',
		    'description'     => __( 'Items "Item".', 'expose' ),
		    "category" => __('Expose WP Theme', 'expose'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'expose_services_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Title", 'expose'),
	            	"param_name" => "title",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Subtitle", 'expose'),
	            	"param_name" => "subtitle",
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Small Text", 'expose'),
	            	"param_name" => "small",
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Service Icon Image", 'expose'),
	            	"param_name" => "image"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_services_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_expose_services_tabs extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_expose_services_tabs_content extends WPBakeryShortCode {

    }
}