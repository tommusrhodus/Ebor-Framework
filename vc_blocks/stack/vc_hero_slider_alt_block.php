<?php 

/**
 * The Shortcode
 */
function ebor_hero_slider_alt_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => 'light-image-left',
				'opacity' => '',
				'custom_css_class' => '',
				'height' => '',
				'timing' => '7000',
				'arrows' => 'true'
			), $atts 
		) 
	);
	
	$image = explode(',', $image);
	$height = ( '' == $height ) ? '70' : $height;
	
	$output = '<section data-arrows="'. $arrows .'" data-timing="'. esc_attr($timing) .'" class="'. esc_attr($custom_css_class) .' cover height-'. $height .' imagebg text-center slider slider--ken-burns" data-arrows="true" data-paging="true"><ul class="slides">'. do_shortcode(htmlspecialchars_decode($content)) .'</ul></section>';

	return $output;
}
add_shortcode( 'stack_hero_slider_alt', 'ebor_hero_slider_alt_shortcode' );

/**
 * The Shortcode
 */
function ebor_slider_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'opacity' => '4'
			), $atts 
		) 
	);
	
	$output = '
	    <li class="imagebg" data-overlay="'. $opacity .'">
	        <div class="background-image-holder background--top">
	            '. wp_get_attachment_image( $image, 'full' ) .'
	        </div>
	        <div class="container pos-vertical-center">
	            <div class="row">
	                <div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
	            </div>
	        </div>
	    </li>
	';
	
	return $output;
}
add_shortcode( 'stack_slider_content', 'ebor_slider_content_shortcode' );

/**
 * The VC Functions
 */
function ebor_hero_slider_alt_shortcode_vc() {

	vc_map( 
		array(
			"icon" => 'stack-vc-block',
			"name" => esc_html__("Hero Header Alt (Slider)", 'stackwordpresstheme'),
			"base" => "stack_hero_slider_alt",
			"category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
			'as_parent'               => array('only' => 'stack_slider_content'),
			'content_element'         => true,
			'show_settings_on_create' => true,
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Hero Height", 'stackwordpresstheme'),
					"param_name" => "height",
					"description" => 'Leave blank for default height, enter 10, 20, 30, 40, 50, 60, 70, 80, 90 or 100 for custom height (percentage of window height)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Timing", 'stackwordpresstheme'),
					"param_name" => "timing",
					'value' => '7000',
					"description" => 'Timing speed for switching slides, in milliseconds. Default 7000 (7 seconds)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show Arrows?", 'stackwordpresstheme'),
					"param_name" => "arrows",
					'value' => 'true',
					"description" => 'Show navigation arrows? <code>true</code> to show arrows, <code>false</code> to hide them',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=yoWmatY3jNU">Video Tutorial</a></div>',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_hero_slider_alt_shortcode_vc' );

// Nested Element
function ebor_slider_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'            => esc_html__('Hero Slider Slide', 'stack'),
		    'base'            => 'stack_slider_content',
		    'description'     => esc_html__( 'A slide for the image slider.', 'stack' ),
		    "category" => esc_html__('stack WP Theme', 'stack'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'stack_hero_slider_alt'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
	            array(
	            	"type" => "attach_image",
	            	"heading" => esc_html__("Slide Background Image", 'stack'),
	            	"param_name" => "image"
	            ),
	            array(
		    		"type" => "dropdown",
		    		"heading" => __("Slide Background Image Overlay Opacity (Default 40%)", 'stack'),
		    		"param_name" => "opacity",
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
	            	"heading" => esc_html__("Slide Content", 'stack'),
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
    class WPBakeryShortCode_stack_hero_slider_alt extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_stack_slider_content extends WPBakeryShortCode {

    }
}