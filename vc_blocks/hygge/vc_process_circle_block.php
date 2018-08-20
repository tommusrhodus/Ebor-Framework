<?php

/**
 * The Shortcode
 */
function ebor_process_circle_shortcode( $atts, $content = null ) {

	$output = '
			<div class="row circle-wrapper">
				'. do_shortcode($content) .'
			</div>
			<div class="divide30"></div>
	';

	return $output;
}
add_shortcode( 'hygge_process_circle', 'ebor_process_circle_shortcode' );

/**
 * The Shortcode
 */
function ebor_process_circle_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'color' => '#67b7d4',
			), $atts 
		) 
	);
	
	$rgb = ebor_hex2rgb($color);
	
	$output = '
		<div class="col-sm-6 col-md-3">
			<div class="circle" style="background-color: rgba('. $rgb .', 0.85) !important;">
				<div class="text">'. htmlspecialchars_decode($title) .'</div>
			</div>
		</div>
	';

	return $output;
}
add_shortcode( 'hygge_process_circle_content', 'ebor_process_circle_content_shortcode' );

// Parent Element
function ebor_process_circle_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
		    'name'                    => __( 'Process Circles' , 'hygge' ),
		    'base'                    => 'hygge_process_circle',
		    'description'             => __( 'Create Accordion Content', 'hygge' ),
		    'as_parent'               => array('only' => 'hygge_process_circle_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Hygge WP Theme', 'hygge'),
		    'params' => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_circle_shortcode_vc' );

// Nested Element
function ebor_process_circle_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'hygge-vc-block',
		    'name'            => __('Process Circles Content', 'hygge'),
		    'base'            => 'hygge_process_circle_content',
		    'description'     => __( 'Content Element', 'hygge' ),
		    "category" => __('Hygge WP Theme', 'hygge'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'hygge_process_circle'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'hygge'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "colorpicker",
	            	"heading" => __("Icon Colour", 'hygge'),
	            	"param_name" => "color",
	            	'value' => '#67b7d4'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_circle_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_hygge_process_circle extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_hygge_process_circle_content extends WPBakeryShortCode {}
}