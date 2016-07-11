<?php

/**
 * The Shortcode
 */
function ebor_slider_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'slider_timing' => '5000'
			), $atts 
		) 
	);
	$output = '<div class="slider height-60" data-animation="slide" data-arrows="true" data-timing="' .$slider_timing . '"><ul class="slides">'. do_shortcode($content) .'</ul></div>';
	return $output;
}
add_shortcode( 'partner_slider', 'ebor_slider_shortcode' );

/**
 * The Shortcode
 */
function ebor_slider_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<li class="imagebg" data-overlay="3">
			<div class="background-image-holder">
				'. wp_get_attachment_image( $image, 'full' ) .'
			</div>
			<div class="container pos-vertical-center">
				<div class="row">
					<div class="col-md-6 col-sm-7 wpb_text_column">
						 '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					</div>
				</div>
			</div>
		</li>
	';
	
	return $output;
}
add_shortcode( 'partner_slider_content', 'ebor_slider_content_shortcode' );

// Parent Element
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'                    => esc_html__( 'Hero Slider' , 'partner' ),
		    'base'                    => 'partner_slider',
		    'description'             => esc_html__( 'Adds an Image Slider', 'partner' ),
		    'as_parent'               => array('only' => 'partner_slider_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'params'  => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Slide Delay", 'partner'),
					"param_name" => "slider_timing",
					"value" => '5000'
				)
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_shortcode_vc' );

// Nested Element
function ebor_slider_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'partner-vc-block',
		    'name'            => esc_html__('Hero Slider Slide', 'partner'),
		    'base'            => 'partner_slider_content',
		    'description'     => esc_html__( 'A slide for the image slider.', 'partner' ),
		    "category" => esc_html__('partner WP Theme', 'partner'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'partner_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "attach_image",
	            	"heading" => esc_html__("Slide Background Image", 'partner'),
	            	"param_name" => "image"
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
add_action( 'vc_before_init', 'ebor_slider_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_partner_slider extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_partner_slider_content extends WPBakeryShortCode {}
}