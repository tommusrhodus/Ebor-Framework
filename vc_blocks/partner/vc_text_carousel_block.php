<?php

/**
 * The Shortcode
 */
function ebor_text_carousel_shortcode( $atts, $content = null ) {
	$output = '<div class="section-snippet-services-2"><div class="slider" data-paging="true" data-animation="slide"><ul class="slides">'. do_shortcode($content) .'</ul></div></div>';
	return $output;
}
add_shortcode( 'partner_text_carousel', 'ebor_text_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_text_carousel_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '
		<li>
			<i class="icon--partner '. esc_attr($icon) .'"></i>
			'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		</li>
	';
	
	return $output;
}
add_shortcode( 'partner_text_carousel_content', 'ebor_text_carousel_content_shortcode' );

// Parent Element
function ebor_text_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'                    => esc_html__( 'Text Carousel' , 'partner' ),
		    'base'                    => 'partner_text_carousel',
		    'description'             => esc_html__( 'Adds an Image Slider', 'partner' ),
		    'as_parent'               => array('only' => 'partner_text_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'params'  => array(),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_text_carousel_shortcode_vc' );

// Nested Element
function ebor_text_carousel_content_shortcode_vc() {
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'            => esc_html__('Text Carousel Slide', 'partner'),
		    'base'            => 'partner_text_carousel_content',
		    'description'     => esc_html__( 'A slide for the image slider.', 'partner' ),
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'partner_text_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "ebor_icons",
	            	"heading" => esc_html__("Click an Icon to choose", 'partner'),
	            	"param_name" => "icon",
	            	"value" => $icons,
	            	'description' => 'Type "none" or leave blank to hide icons.'
	            ),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Slide Content", 'partner'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            )
		    ),
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_text_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_partner_text_carousel extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_partner_text_carousel_content extends WPBakeryShortCode {}
}