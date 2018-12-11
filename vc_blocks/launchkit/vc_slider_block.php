<?php

/**
 * The Shortcode
 */
function ebor_slider_shortcode( $atts, $content = null ) {
	
	extract( 
		shortcode_atts( 
			array(
				'parallax' => 'no',
				'short' => 'header header-7'
			), $atts 
		) 
	);
		
	$output = '<div class="'. $short .' '. $parallax .'"><div class="hero-slider"><ul class="slides">'. do_shortcode($content) .'</ul></div></div>';
	return $output;
}
add_shortcode( 'launchkit_slider', 'ebor_slider_shortcode' );

/**
 * The Shortcode
 */
function ebor_slider_content_shortcode( $atts, $content = null ) {

	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$image = wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') );

	$output = '<li>';
	
	if($image)
		$output .= '<div class="background-image-holder">'. $image .'</div>';
	
	if($content)
		$output .= '<div class="container"><div class="row"><div class="col-sm-12 text-center">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div></div></div>';
			
	$output .= '</li>';
	
	return $output;
}
add_shortcode( 'launchkit_slider_content', 'ebor_slider_content_shortcode' );

// Parent Element
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
		    'name'                    => __( 'Hero Slider' , 'launchkit' ),
		    'base'                    => 'launchkit_slider',
		    'description'             => __( 'Adds an Image Slider', 'launchkit' ),
		    'as_parent'               => array('only' => 'launchkit_slider_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('LaunchKit WP Theme', 'launchkit'),
		    'params'          => array(
		        array(
		        	"type" => "dropdown",
		        	"heading" => __("Use parallax scrolling? (headers only)", 'launchkit'),
		        	"param_name" => "parallax",
		        	"value" => array(
		        		'No' => 'no',
		        		'Yes' => 'parallax',
		        	),
		        ),
		        array(
		        	"type" => "dropdown",
		        	"heading" => __("Adjust Slider Height?", 'launchkit'),
		        	"param_name" => "short",
		        	"value" => array(
		        		'Normal Height' => 'header header-7',
		        		'Short Height' => 'header header-11 overlay',
		        		'Full Window Height' => 'features features-9'
		        	),
		        ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_shortcode_vc' );

// Nested Element
function ebor_slider_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
		    'name'            => __('Hero Slider Slide', 'launchkit'),
		    'base'            => 'launchkit_slider_content',
		    'description'     => __( 'A slide for the image slider.', 'launchkit' ),
		    "category" => __('LaunchKit WP Theme', 'launchkit'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'launchkit_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Slide Background Image", 'launchkit'),
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Slide Content", 'launchkit'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_launchkit_slider extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_launchkit_slider_content extends WPBakeryShortCode {

    }
}