<?php

/**
 * The Shortcode
 */
function ebor_service_carousel_shortcode( $atts, $content = null ) {
	$output = '<div class="carousel-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s"><div class="carousel carousel-boxed portfolio">'. do_shortcode($content) .'</div></div>';
	return $output;
}
add_shortcode( 'kwoon_service_carousel', 'ebor_service_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_service_carousel_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="item">
			<figure>'. wp_get_attachment_image($image, 'full') .'</figure>
			<div class="box text-center">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
		</div>
	';
		
	return $output;
}
add_shortcode( 'kwoon_service_carousel_content', 'ebor_service_carousel_content_shortcode' );

// Parent Element
function ebor_service_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
		    'name'                    => __( 'Services Carousel' , 'kwoon' ),
		    'base'                    => 'kwoon_service_carousel',
		    'description'             => __( 'Create a carousel of your process/services', 'kwoon' ),
		    'as_parent'               => array('only' => 'kwoon_service_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Kwoon WP Theme', 'kwoon'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'kwoon'),
		    		"param_name" => "title"
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Subtitle", 'kwoon'),
		    		"param_name" => "subtitle"
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_carousel_shortcode_vc' );

// Nested Element
function ebor_service_carousel_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
		    'name'            => __('Services Carousel Content', 'kwoon'),
		    'base'            => 'kwoon_service_carousel_content',
		    'description'     => __( 'Services Carousel Content Element', 'kwoon' ),
		    "category" => __('Kwoon WP Theme', 'kwoon'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'kwoon_service_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'kwoon'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Service Image (440x295px recommended)", 'kwoon'),
	            	"param_name" => "image"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_service_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_kwoon_service_carousel extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_kwoon_service_carousel_content extends WPBakeryShortCode {

    }
}