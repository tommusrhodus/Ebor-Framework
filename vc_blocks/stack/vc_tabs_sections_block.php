<?php

/**
 * The Shortcode
 */
function ebor_tabs_sections_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="tabs-container text-center '. esc_attr($custom_css_class) .'" data-content-align="left"><ul class="tabs section-tabs">'. do_shortcode($content) .'</ul></div>';

	return $output;
}
add_shortcode( 'stack_tabs_sections', 'ebor_tabs_sections_shortcode' );

// Parent Element
function ebor_tabs_sections_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Tabs Sections' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_tabs_sections',
		    'description'             => esc_html__( 'Create tabs_sections Content', 'stackwordpresstheme' ),
		    'as_parent'               => array('except' => 'stack_tabs_sections_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
		    		"param_name" => "custom_css_class",
		    		"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=CLiNWmfDkow">Video Tutorial</a></div>',
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_sections_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_tabs_sections extends WPBakeryShortCodesContainer {}
}