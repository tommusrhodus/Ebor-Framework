<?php

/**
 * The Shortcode
 */
function ebor_testimonials_slider_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array( 
				'show_all_text' => 'Show All',
				'enable_filters' => 'show',
				'caption_size' => 'regular-captions',
			), $atts 
		) 
	);
	
	global $ebor_testimonials_slider_count;
	global $rand;
	global $ebor_testimonials_slider_open;
	$ebor_testimonials_slider_count = 0;
	$rand = false;
	$output = false;
	$rand = wp_rand(0,10000);
	
	$output .= '
		<div class="flexslider testimonials">
			<ul class="slides">'. do_shortcode($content) .'</ul>
		</div>
	';

	return $output;
}
add_shortcode( 'belton_testimonials_slider', 'ebor_testimonials_slider_shortcode' );

/**
 * The Shortcode
 */
function ebor_testimonials_slider_content_shortcode( $atts, $content = null ) {
	global $ebor_testimonials_slider_count;
	global $rand;
	global $ebor_testimonials_slider_open;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
			), $atts 
		) 
	);
	
	$ebor_testimonials_slider_count++;

	$output = '
		<li> 
			<blockquote>'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			<footer>'. wp_kses_post($title) .'</footer>
			</blockquote>           
      	</li>
	';

	return $output;
}
add_shortcode( 'belton_testimonials_slider_content', 'ebor_testimonials_slider_content_shortcode' );

// Parent Element
function ebor_testimonials_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'belton-vc-block',
		    'name'                    => esc_html__( 'Testimonial Slider' , 'belton' ),
		    'base'                    => 'belton_testimonials_slider',
		    'description'             => esc_html__( 'A Neat Testimonial Slider', 'belton' ),
		    'as_parent'               => array('only' => 'belton_testimonials_slider_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('belton WP Theme', 'belton'),
		    'params' => array(
 
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_testimonials_slider_shortcode_vc' );

// Nested Element
function ebor_testimonials_slider_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'belton-vc-block',
		    'name'            => esc_html__('Testimonial Item', 'belton'),
		    'base'            => 'belton_testimonials_slider_content',
		    'description'     => esc_html__( 'Testimonial Content Element', 'belton' ),
		    "category" => esc_html__('belton WP Theme', 'belton'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'belton_testimonials_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Testimonial Author", 'belton'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "textarea_html",
		    		"heading" => esc_html__("Testimonial Content", 'belton'),
		    		"param_name" => "content",
		    		'holder' => 'div'
		    	),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_testimonials_slider_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_belton_testimonials_slider extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_belton_testimonials_slider_content extends WPBakeryShortCode {}
}