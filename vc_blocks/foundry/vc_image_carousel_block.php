<?php

/**
 * The Shortcode
 */
function ebor_image_carousel_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'desktop' => '3',
				'desktop1199' => '3',
				'desktop980' => '3'
			), $atts 
		) 
	);
	
	$output = '
		<div class="image-carousel">'. do_shortcode($content) .'</div>
		<script type="text/javascript">
			jQuery(document).ready(function() { 
	
				jQuery(\'.image-carousel\').owlCarousel({
					nav: true,
					navText: ["<i class=\'ti-angle-left\'>","<i class=\'ti-angle-right\'>"],
					center: true,
					loop:true,
					responsive:{
				        0:{
				            items:1
				        },
				        980:{
				            items: '. (int) $desktop980 .'
				        },
				        1199:{
				            items: '. (int) $desktop1199 .'
				        },
				        1400:{
				            items: '. (int) $desktop .'
				        }
				    }
				});
				
			});
		</script>
	';
	return $output;
}
add_shortcode( 'foundry_image_carousel', 'ebor_image_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_image_carousel_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="image-carousel-item overflow-hidden mb-xs-48">
		
			<div class="col-sm-8 col-sm-offset-2 col-xs-6 col-xs-offset-3">
				'. wp_get_attachment_image( $image, 'full' ) .'
			</div>
			
			<hr class="mb48">
			
			<div class="text-holder">
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
			
		</div>
	';

	return $output;
}
add_shortcode( 'foundry_image_carousel_content', 'ebor_image_carousel_content_shortcode' );

// Parent Element
function ebor_image_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Image Carousel' , 'foundry' ),
		    'base'                    => 'foundry_image_carousel',
		    'description'             => __( 'Create An Image Carousel with Text Input', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_image_carousel_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params' => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Desktop # of Items", 'foundry'),
		    		'description' => '3, 5 or 7 only!',
		    		"param_name" => "desktop",
		    		'value' => '3'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Small Desktop # of Items", 'foundry'),
		    		'description' => '3, 5 or 7 only!',
		    		"param_name" => "desktop1199",
		    		'value' => '3'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Large Tablet # of Items", 'foundry'),
		    		'description' => '3, 5 or 7 only!',
		    		"param_name" => "desktop980",
		    		'value' => '3'
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_carousel_shortcode_vc' );

// Nested Element
function ebor_image_carousel_content_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'            => __('Image Carousel Content', 'foundry'),
		    'base'            => 'foundry_image_carousel_content',
		    'description'     => __( 'Tab Content Element', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_image_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "attach_image",
		    		"heading" => __("Image", 'foundry'),
		    		"param_name" => "image"
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'foundry'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_image_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_image_carousel extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_image_carousel_content extends WPBakeryShortCode {}
}