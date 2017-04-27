<?php

/**
 * The Shortcode
 */
function ebor_slider_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'standard',
				'parallax' => 'parallax',
				'slider_height' => 'height-100',
				'arrows' => 'true',
				'paging' => 'true',
				'timing' => 5000
			), $atts 
		) 
	);
	
	$output = '
		<section class="slider slider--animate '. $slider_height .' cover cover-5 '. $parallax .'" data-animation="fade" data-arrows="'. $arrows .'" data-paging="'. $paging .'" data-timing="'. $timing .'">
			<ul class="slides">
				'. do_shortcode($content) .'
			</ul>
		</section>
	';
	
	return $output;
}
add_shortcode( 'pillar_slider', 'ebor_slider_shortcode' );

/**
 * The Shortcode
 */
function ebor_slider_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'overlay_opacity' => '4'
			), $atts 
		) 
	);
	
	$output = '
		<li class="imagebg" data-overlay="'. $overlay_opacity .'">
			<div class="background-image-holder">
				'. wp_get_attachment_image( $image, 'full' ) .'
			</div>
			<div class="container pos-vertical-center">
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
add_shortcode( 'pillar_slider_content', 'ebor_slider_content_shortcode' );

// Parent Element
function ebor_slider_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pillar-vc-block',
		    'name'                    => esc_html__( 'Hero Slider' , 'pillar' ),
		    'base'                    => 'pillar_slider',
		    'description'             => esc_html__( 'Adds an Image Slider', 'pillar' ),
		    'as_parent'               => array('only' => 'pillar_slider_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'params'          => array(
				array(
		    		"type" => "dropdown",
		    		"heading" => __("Sider Height", 'pillar'),
		    		"param_name" => "slider_height",
		    		"value" => array(
		    			'100vh' => 'height-100',
		    			'90vh' => 'height-90',
		    			'80vh' => 'height-80',
		    			'70vh' => 'height-70',
		    			'60vh' => 'height-60',
		    			'50vh' => 'height-50',
		    		)
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Autoplay Timer (ms)", 'pillar'),
		    		"param_name" => "timing",
		    		'value' => '5000'
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Show Arrows", 'pillar'),
		    		"param_name" => "arrows",
		    		"value" => array(
		    			'Yes' => 'true',
		    			'No' => 'false' 
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Show Paging", 'pillar'),
		    		"param_name" => "paging",
		    		"value" => array(
		    			'Yes' => 'true',
		    			'No' => 'false' 
		    		)
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
			"icon" => 'pillar-vc-block',
		    'name'            => esc_html__('Hero Slider Slide', 'pillar'),
		    'base'            => 'pillar_slider_content',
		    'description'     => esc_html__( 'A slide for the image slider.', 'pillar' ),
		    "category" => esc_html__('pillar WP Theme', 'pillar'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'pillar_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "attach_image",
	            	"heading" => esc_html__("Slide Background Image", 'pillar'),
	            	"param_name" => "image"
	            ),
	            array(
		    		"type" => "dropdown",
		    		"heading" => __("Slide Background Image Overlay Opacity (Default 40%)", 'pillar'),
		    		"param_name" => "overlay_opacity",
		    		"value" => array(
		    			'40%' => '4',
		    			'90%' => '9',
		    			'80%' => '8',
		    			'70%' => '7',
		    			'60%' => '6',
		    			'50%' => '5',
		    			'30%' => '3',
		    			'20%' => '2',
		    			'10%' => '1',
		    			'0%' => '0',
		    		)
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Slide Content", 'pillar'),
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
    class WPBakeryShortCode_pillar_slider extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_pillar_slider_content extends WPBakeryShortCode {

    }
}