<?php

/**
 * The Shortcode
 */
function ebor_services_carousel_shortcode( $atts, $content = null ) {
	$output = '<article class="text-center"><div class="owl-carousel services-carousel">'. do_shortcode($content) .'</div></article>';
	return $output;
}
add_shortcode( 'expose_services_carousel', 'ebor_services_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_services_carousel_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'image' => ''
			), $atts 
		) 
	);
	$output = '<div class="item">
				  <div class="feature-item">
					'. wp_get_attachment_image($image, 'thumbnail') .'
					<h3 class="white font2">'. htmlspecialchars_decode($title) .'</h3>
				  </div>
			   </div>';
	return $output;
}
add_shortcode( 'expose_services_carousel_content', 'ebor_services_carousel_content_shortcode' );

// Parent Element
function ebor_services_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
		    'name'                    => __( 'Services Carousel' , 'expose' ),
		    'base'                    => 'expose_services_carousel',
		    'description'             => __( 'Container for Item', 'expose' ),
		    'as_parent'               => array('only' => 'expose_services_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Expose WP Theme', 'expose'),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_services_carousel_shortcode_vc' );

// Nested Element
function ebor_services_carousel_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'expose-vc-block',
		    'name'            => __('Services Carousel Content', 'expose'),
		    'base'            => 'expose_services_carousel_content',
		    'description'     => __( 'Items "Item".', 'expose' ),
		    "category" => __('Expose WP Theme', 'expose'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'expose_services_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Title", 'expose'),
	            	"param_name" => "title",
	            	'holder' => 'div'
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
add_action( 'vc_before_init', 'ebor_services_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_expose_services_carousel extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_expose_services_carousel_content extends WPBakeryShortCode {

    }
}