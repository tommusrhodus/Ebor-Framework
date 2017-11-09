<?php

/**
 * The Shortcode
 */
function ebor_half_carousel_shortcode( $atts, $content = null ) {
	$output = '<div class="half-carousel">'. do_shortcode($content) .'</div>';
	
	if( substr_count( $content, '[foundry_half_carousel_content' ) > 1 ){
		$output .= '
			<script type="text/javascript">
				jQuery(document).ready(function() { 
		
					jQuery(\'.half-carousel\').owlCarousel({
						nav: true,
						navText: ["<i class=\'ti-angle-left\'>","<i class=\'ti-angle-right\'>"],
						dots: false,
						center: true,
						loop:true,
						responsive:{
					        0:{
					            items:1
					        }
					    }
					});
					
				});
			</script>
		';
	}
	
	return $output;
}
add_shortcode( 'foundry_half_carousel', 'ebor_half_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_half_carousel_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => '',
				'layout' => 'left'
			), $atts 
		) 
	);
	
	if( 'left' == $layout ){
		
		$output = '
			<section class="image-square right">
			    <div class="col-md-6 image">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			        </div>
			    </div>
			    <div class="col-md-6 content">
			        '. do_shortcode($content) .'
			    </div>
			</section>
		';
	
	} else {
		
		$output = '
			<section class="image-square left">
				<div class="col-md-6 content">
				    '. do_shortcode($content) .'
				</div>
			    <div class="col-md-6 image">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			        </div>
			    </div>
			</section>
		';
		
	}

	return $output;
}
add_shortcode( 'foundry_half_carousel_content', 'ebor_half_carousel_content_shortcode' );

// Parent Element
function ebor_half_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Half Text, Half Image Carousel' , 'foundry' ),
		    'base'                    => 'foundry_half_carousel',
		    'description'             => __( 'Create a fullwidth carousel of content', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_half_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params' => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_half_carousel_shortcode_vc' );

// Nested Element
function ebor_half_carousel_content_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'            => __('Half Text, Half Image Carousels Content', 'foundry'),
		    'base'            => 'foundry_half_carousel_content',
		    'description'     => __( 'Half Text, Half Image Carousel Content Element', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_half_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "attach_image",
		    		"heading" => __("Block Image", 'foundry'),
		    		"param_name" => "image"
		    	),
		    	array(
		    		"type" => "textarea_html",
		    		"heading" => __("Block Content", 'foundry'),
		    		"param_name" => "content",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Image & Text Display Type", 'foundry'),
		    		"param_name" => "layout",
		    		"value" => array(
		    			'Image Right, Content Left' => 'left',
		    			'Image Left, Content Right' => 'right'
		    		)
		    	),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_half_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_half_carousel extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_half_carousel_content extends WPBakeryShortCode {}
}