<?php

/**
 * The Shortcode
 */
function ebor_masonry_services_shortcode( $atts, $content = null ) {
	$output = '<div class="row masonry masonryFlyIn">'. do_shortcode($content) .'</div>';
	return $output;
}
add_shortcode( 'foundry_masonry_services', 'ebor_masonry_services_shortcode' );

/**
 * The Shortcode
 */
function ebor_masonry_services_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => ''
			), $atts 
		) 
	);
	
	$output = '
		<div class="col-md-4 col-sm-12 masonry-item mb30">
		    <div class="feature boxed cast-shadow-light mb0">
		        <h2 class=" color-primary mb0">'. htmlspecialchars_decode($title) .'</h2>
		        <h6 class="uppercase color-primary">'. htmlspecialchars_decode($subtitle) .'</h6>
		        '. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		    </div>
		</div>
	';

	return $output;
}
add_shortcode( 'foundry_masonry_services_content', 'ebor_masonry_services_content_shortcode' );

// Parent Element
function ebor_masonry_services_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Masonry Services' , 'foundry' ),
		    'base'                    => 'foundry_masonry_services',
		    'description'             => __( 'Create Tabbed Content', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_masonry_services_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params' => array()
		) 
	);
}
add_action( 'vc_before_init', 'ebor_masonry_services_shortcode_vc' );

// Nested Element
function ebor_masonry_services_content_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'            => __('Masonry Services Content', 'foundry'),
		    'base'            => 'foundry_masonry_services_content',
		    'description'     => __( 'Tab Content Element', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_masonry_services'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'foundry'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Subtitle", 'foundry'),
		    		"param_name" => "subtitle",
		    		'holder' => 'div'
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
add_action( 'vc_before_init', 'ebor_masonry_services_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_masonry_services extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_masonry_services_content extends WPBakeryShortCode {

    }
}