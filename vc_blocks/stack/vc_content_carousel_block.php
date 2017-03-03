<?php

/**
 * The Shortcode
 */
function ebor_content_carousel_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'content_carousel-horizontal',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$pattern = get_shortcode_regex();
	$content = preg_match_all('/'. $pattern .'/s', $content, $matches);
	
	$content = '<li class="col-sm-4 col-xs-12">' . implode('</li><li class="col-sm-4 col-xs-12">', $matches[0]) . '</li>';
	
	$output = '<div class="'. $custom_css_class .' row slider" data-arrows="false" data-paging="true"><ul class="slides">'. do_shortcode($content) .'</ul></div>';

	return $output;
}
add_shortcode( 'stack_content_carousel', 'ebor_content_carousel_shortcode' );

// Parent Element
function ebor_content_carousel_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Content Carousel' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_content_carousel',
		    'description'             => esc_html__( 'Create a carousel of feature blocks', 'stackwordpresstheme' ),
		    'as_parent'               => array('except' => 'stack_content_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
		    		"param_name" => "custom_css_class",
		    		"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_content_carousel_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_content_carousel extends WPBakeryShortCodesContainer {}
}