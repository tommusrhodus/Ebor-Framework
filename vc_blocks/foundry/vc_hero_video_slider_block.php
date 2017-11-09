<?php

/**
 * The Shortcode
 */
function ebor_video_slider_shortcode( $atts, $content = null ) {
	
	global $ebor_height;
	$ebor_height = false;
	
	extract( 
		shortcode_atts( 
			array(
				'height' => ''
			), $atts 
		) 
	);
	
	$style = ( $height ) ? 'style="height: '. $height.';"' : '';
	$ebor_height = ( $height ) ? 'style="height: '. $height.';"' : '';
		
	$output = '<div class="slider-all-controls" '. $style .'><ul class="slides">'. do_shortcode($content) .'</ul></div>';
	
	return $output;
}
add_shortcode( 'foundry_video_slider', 'ebor_video_slider_shortcode' );

/**
 * The Shortcode
 */
function ebor_video_slider_content_shortcode( $atts, $content = null ) {
	
	global $ebor_height;

	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'mpfour' => '',
				'ogv' => '',
				'webm' => '',
			), $atts 
		) 
	);
	
	$image = wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') );
	
	$output = '
		<li class="vid-bg image-bg overlay pt240 pb240" '. $ebor_height .'>
		
		    <div class="background-image-holder">
		        '. $image .'
		    </div>
		    
		    <div class="fs-vid-background">
		        <video muted loop>
		            <source src="'. esc_url($webm) .'" type="video/webm">
		            <source src="'. esc_url($mpfour) .'" type="video/mp4">
		            <source src="'. esc_url($ogv) .'" type="video/ogg">	
		        </video>
		    </div>
		    
		    <div class="container">
		        <div class="row">
		            <div class="col-sm-12">
		                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		            </div>
		        </div>
		    </div>
		    
		</li>
	';
		
	return $output;
}
add_shortcode( 'foundry_video_slider_content', 'ebor_video_slider_content_shortcode' );

// Parent Element
function ebor_video_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Hero Video Slider' , 'foundry' ),
		    'base'                    => 'foundry_video_slider',
		    'description'             => __( 'Adds a Video Slider', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_video_slider_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Height, enter height value e.g: 600px", 'foundry'),
		    		"param_name" => "height",
		    		'description' => 'If left blank, the slider will be the default auto height. Please ensure your value is in px, e.g: 700px'
		    	),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_slider_shortcode_vc' );

// Nested Element
function ebor_video_slider_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'            => __('Hero Video Slider Slide', 'foundry'),
		    'base'            => 'foundry_video_slider_content',
		    'description'     => __( 'A slide for the video slider.', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_video_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Background Image (fallback for mobile devices)", 'foundry'),
	            	"param_name" => "image",
	            	'description' => 'Mobile devices deny background video from a device level, add a background image here so that mobile users get a static image fallback.'
	            ),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Slide Content", 'foundry'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Self Hosted Video .webm extension", 'foundry'),
	            	"param_name" => "webm",
	            	"description" => __('Please fill all extensions', 'foundry')
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Self Hosted Video .mp4 extension", 'foundry'),
	            	"param_name" => "mpfour",
	            	"description" => __('Please fill all extensions', 'foundry')
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Self Hosted Video .ogv extension", 'foundry'),
	            	"param_name" => "ogv",
	            	"description" => __('Please fill all extensions', 'foundry')
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_video_slider_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_video_slider extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_video_slider_content extends WPBakeryShortCode {

    }
}