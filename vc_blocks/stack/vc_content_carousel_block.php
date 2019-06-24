<?php

/**
 * The Shortcode
 */
function ebor_content_carousel_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type'             => 'content_carousel-horizontal',
				'item_width'       => 'col-sm-4 col-xs-12',
				'arrows'           => 'false',
				'timing'           => '7000',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$pattern = get_shortcode_regex();
	$content = preg_match_all('/'. $pattern .'/s', $content, $matches);
	
	$content = '<li class="'. esc_attr($item_width) .'">' . implode('</li><li class="'. esc_attr($item_width) .'">', $matches[0]) . '</li>';
	
	$output = '<div class="'. $custom_css_class .' row slider" data-arrows="'. $arrows .'" data-paging="true" data-timing="'. esc_attr($timing) .'"><ul class="slides">'. do_shortcode($content) .'</ul></div>';

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
		    		"heading" => esc_html__("Item Width Class Name", 'stackwordpresstheme'),
		    		"param_name" => "item_width",
		    		'value' => 'col-sm-4 col-xs-12',
		    		"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Show navigation arrows?", 'stackwordpresstheme'),
		    		"param_name" => "arrows",
		    		"value" => array(
		    			'No' => 'false',
		    			'Yes' => 'true'
		    		)
		    	),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Transition Time", 'stackwordpresstheme'),
		    		"param_name" => "timing",
		    		'value' => '7000',
		    		"description" => 'Time between slides in miliseconds - default 7000',
		    	),
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