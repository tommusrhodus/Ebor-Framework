<?php

/**
 * The Shortcode
 */
function ebor_process_carousel_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="row">
		
		  <div class="col-sm-4 col-md-3">
		    <h3 class="main-title">'. preg_replace('#\*(.*?)\*#', '<strong>$1</strong>', $title) .'</h3>
		    '. wpautop($subtitle) .'
		    <div class="divide10"></div>
		    <div class="nav-outside owl-nav"></div>
		  </div>
		  
		  <div class="col-sm-8 col-md-9">
		    <div class="carousel-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
		      <div class="carousel carousel-boxed2 steps2">
		      	'. do_shortcode($content) .'
		      </div>
		    </div>
		  </div>
		  
		</div>
	';
	return $output;
}
add_shortcode( 'kwoon_process_carousel', 'ebor_process_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_process_carousel_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'image_retina' => '',
				'alt' => '',
				'duration' => '1',
				'delay' => '0'
			), $atts 
		) 
	);
	
	$image = wp_get_attachment_image_src($image, 'full');
	$image_retina = wp_get_attachment_image_src($image_retina, 'full');
	
	if(!( isset($image[0]) ))
		$image[0] = false;
	
	if(!( isset($image_retina[0]) ))
		$image_retina[0] = false;
	
	$output = '
		<div class="item">
		  <div class="steps-item box text-center"><span class="number"></span>
		    <div class="icon"> 
		    	<img 
		    		src="'. esc_url($image[0]) .'" 
		    		data-src="'. esc_url($image[0]) .'" 
		    		data-ret="'. esc_url($image_retina[0]) .'" 
		    		class="retina" 
		    		alt="'. esc_attr($alt) .'" 
		    	/>
		    </div>
		    '. do_shortcode(htmlspecialchars_decode($content)) .'
		  </div>
		</div>
	';
		
	return $output;
}
add_shortcode( 'kwoon_process_carousel_content', 'ebor_process_carousel_content_shortcode' );

// Parent Element
function ebor_process_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
		    'name'                    => __( 'Process Carousel' , 'kwoon' ),
		    'base'                    => 'kwoon_process_carousel',
		    'description'             => __( 'Create a carousel of your process/services', 'kwoon' ),
		    'as_parent'               => array('only' => 'kwoon_process_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
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
add_action( 'vc_before_init', 'ebor_process_carousel_shortcode_vc' );

// Nested Element
function ebor_process_carousel_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'kwoon-vc-block',
		    'name'            => __('Process Carousel Content', 'kwoon'),
		    'base'            => 'kwoon_process_carousel_content',
		    'description'     => __( 'Proces Carousel Content Element', 'kwoon' ),
		    "category" => __('Kwoon WP Theme', 'kwoon'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'kwoon_process_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'kwoon'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Service Icon Image", 'kwoon'),
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Service Icon Retina Image (Double Size)", 'kwoon'),
	            	"param_name" => "image_retina"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Image Alt Text", 'kwoon'),
	            	"param_name" => "alt"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_process_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_kwoon_process_carousel extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_kwoon_process_carousel_content extends WPBakeryShortCode {

    }
}