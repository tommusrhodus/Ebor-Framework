<?php

/**
 * The Shortcode
 */
function ebor_slider_shortcode( $atts, $content = null ) {
	
	global $ebor_height;
	$ebor_height = false;
	
	extract( 
		shortcode_atts( 
			array(
				'type' => 'standard',
				'parallax' => 'parallax',
				'height' => ''
			), $atts 
		) 
	);
	
	$fullscreen = ( $height ) ? '' : 'fullscreen';
	$style = ( $height ) ? 'style="height: '. $height.';"' : '';
	$ebor_height = ( $height ) ? 'style="height: '. $height.';"' : '';
	
	if( 'standard' == $type ){
		$output = '<section class="cover '. $fullscreen .' image-slider slider-all-controls controls-inside '. $parallax .'" '. $style .'><ul class="slides">'. do_shortcode($content) .'</ul></section>';
	} else {
		$output = '<section class="kenburns cover '. $fullscreen .' image-slider slider-arrow-controls controls-inside" '. $style .'><ul class="slides">'. do_shortcode($content) .'</ul></section>';
	}
	return $output;
}
add_shortcode( 'foundry_slider', 'ebor_slider_shortcode' );

/**
 * The Shortcode
 */
function ebor_slider_content_shortcode( $atts, $content = null ) {
	
	global $ebor_height;

	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'type' => 'standard',
				'title' => '',
				'subtitle' => '',
				'button_text' => '',
				'button_url' => ''
			), $atts 
		) 
	);
	
	$image = wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') );
	
	if( 'standard' == $type ) {
		
		$output = '<li class="overlay image-bg" '. $ebor_height .'>';
		
		if($image)
			$output .= '<div class="background-image-holder">'. $image .'</div>';
		
		$output .= '	
		    <div class="container v-align-transform">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
		                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		            </div>
		        </div>
		    </div>
		';
		    
		$output .= '</li>';
		
	} else {
		
		$output = '<li class="image-bg pt-xs-240 pb-xs-240" '. $ebor_height .'>';
		
		    if($image)
		    	$output .= '<div class="background-image-holder">'. $image .'</div>';
		    
		$output .= '
		    <div class="align-bottom">
		        <div class="row">
		            <div class="col-sm-12">
		                <hr class="mb24">
		            </div>
		        </div>
		        <div class="row">
		            <div class="col-md-3 col-sm-6 col-xs-12 text-center-xs mb-xs-24">
		                <h4 class="uppercase mb0 bold">'. htmlspecialchars_decode($title) .'</h4>
		                <span>'. htmlspecialchars_decode($subtitle) .'</span>
		            </div>
		            <div class="col-md-4 hidden-sm hidden-xs">
		                '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		            </div>
		            <div class="col-md-5 col-sm-6 col-xs-12 text-right text-center-xs">
		                <a class="btn btn btn-white mt16" href="'. esc_url($button_url) .'">'. $button_text .'</a>
		            </div>
		        </div>
		    </div>
		';
		
		$output .= '</li>';
		                    	
	}
	
	return $output;
}
add_shortcode( 'foundry_slider_content', 'ebor_slider_content_shortcode' );

// Parent Element
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Hero Slider' , 'foundry' ),
		    'base'                    => 'foundry_slider',
		    'description'             => __( 'Adds an Image Slider', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_slider_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Display type", 'foundry'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Standard Slider' => 'standard',
		    			'Zooming Slider' => 'ken'
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Use Parallax Scrolling on this element?", 'foundry'),
		    		"param_name" => "parallax",
		    		"value" => array(
		    			'Parallax On' => 'parallax',
		    			'Parallax Off' => 'parallax-off'
		    		),
		    		'description' => 'Parallax scrolling works best when this element is at the top of a page, if it isn\'t, turn this off so the element displays at its best.'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Height, enter height value e.g: 600px", 'foundry'),
		    		"param_name" => "height",
		    		'description' => 'If left blank, the slider will be the fullheight of the screen. Please ensure your value is in px, e.g: 700px'
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
			"icon" => 'foundry-vc-block',
		    'name'            => __('Hero Slider Slide', 'foundry'),
		    'base'            => 'foundry_slider_content',
		    'description'     => __( 'A slide for the image slider.', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "attach_image",
	            	"heading" => __("Slide Background Image", 'foundry'),
	            	"param_name" => "image"
	            ),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Slide Content", 'foundry'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "dropdown",
	            	"heading" => __("Display type", 'foundry'),
	            	"param_name" => "type",
	            	"value" => array(
	            		'Standard Slider' => 'standard',
	            		'Zooming Slider' => 'ken'
	            	)
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Title (Zooming Only)", 'foundry'),
	            	"param_name" => "title",
	            	'holder' => 'div'
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Subtitle (Zooming Only)", 'foundry'),
	            	"param_name" => "subtitle",
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Button Text (Zooming Only)", 'foundry'),
	            	"param_name" => "button_text",
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => __("Button URL (Zooming Only)", 'foundry'),
	            	"param_name" => "button_url",
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_slider_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_slider extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_slider_content extends WPBakeryShortCode {

    }
}