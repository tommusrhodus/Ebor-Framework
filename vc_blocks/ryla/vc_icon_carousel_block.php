<?php

/**
 * The Shortcode
 */
function ebor_icon_carousel_shortcode( $atts, $content = null ) {
	$output = '
		<div class="carousel-wrapper wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
			<div class="owl-posts number-carousel boxed text-center">
				'. do_shortcode($content) .'
			</div>
		</div>
	';
	return $output;
}
add_shortcode( 'ryla_icon_carousel', 'ebor_icon_carousel_shortcode' );

/**
 * The Shortcode
 */
function ebor_icon_carousel_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'image' => ''
			), $atts 
		) 
	);

	$output = '
		<div class="item">
			<div class="box">
				<span class="number"></span>
				<div class="icon icon-s bm10"> 
					'. wp_get_attachment_image($image, 'admin-list-thumb') .'
				</div>
				'. do_shortcode(htmlspecialchars_decode($content)) .'
			</div>
		</div>
	';
		
	return $output;
}
add_shortcode( 'ryla_icon_carousel_content', 'ebor_icon_carousel_content_shortcode' );

// Parent Element
function ebor_icon_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
		    'name'                    => __( 'Process Carousel' , 'ryla' ),
		    'base'                    => 'ryla_icon_carousel',
		    'description'             => __( 'Create a carousel of your process/services', 'ryla' ),
		    'as_parent'               => array('only' => 'ryla_icon_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('ryla WP Theme', 'ryla'),
		    'params'          => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_carousel_shortcode_vc' );

// Nested Element
function ebor_icon_carousel_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'ryla-vc-block',
		    'name'            => __('Process Carousel Content', 'ryla'),
		    'base'            => 'ryla_icon_carousel_content',
		    'description'     => __( 'Proces Carousel Content Element', 'ryla' ),
		    "category" => __('ryla WP Theme', 'ryla'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'ryla_icon_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "attach_image",
		    		"heading" => __("Icon Image", 'ryla'),
		    		"param_name" => "image"
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'ryla'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_icon_carousel_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_ryla_icon_carousel extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_ryla_icon_carousel_content extends WPBakeryShortCode {}
}