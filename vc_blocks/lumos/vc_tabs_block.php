<?php

global $ebor_tabs_content;
global $ebor_tabs_count;

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	$ebor_tabs_content = false;
	$ebor_tabs_count = 0;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	$output = false;
	
	if( $title )
		$output = '<h3 class="section-title">'. htmlspecialchars_decode($title) .'</h3>';
		
	$output .= '<div class="tabs tabs-top left tab-container"><ul class="etabs">'. do_shortcode($content) .'</ul><div class="panel-container">'. $ebor_tabs_content .'</div></div>';
	return $output;
}
add_shortcode( 'lumos_tabs', 'ebor_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabs_content_shortcode( $atts, $content = null ) {
	
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	$ebor_tabs_count++;
	$ebor_tabs_content .= '<div class="tab-block" id="tab-'. esc_attr($ebor_tabs_count) .'">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';
	$output = ' <li class="tab"><a href="#tab-'. esc_attr($ebor_tabs_count) .'">'. htmlspecialchars_decode($title) .'</a></li> ';
	return $output;
}
add_shortcode( 'lumos_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
		    'name'                    => __( 'Tabs' , 'lumos' ),
		    'base'                    => 'lumos_tabs',
		    'description'             => __( 'Create Tabbed Content', 'lumos' ),
		    'as_parent'               => array('only' => 'lumos_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => false,
		    "js_view" => 'VcColumnView',
		    "category" => __('lumos WP Theme', 'lumos'),
		    'params' => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'lumos'),
		    		"param_name" => "title",
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_shortcode_vc' );

// Nested Element
function ebor_tabs_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lumos-vc-block',
		    'name'            => __('Tabs Content', 'lumos'),
		    'base'            => 'lumos_tabs_content',
		    'description'     => __( 'Tab Content Element', 'lumos' ),
		    "category" => __('lumos WP Theme', 'lumos'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'lumos_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'lumos'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'lumos'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_lumos_tabs extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_lumos_tabs_content extends WPBakeryShortCode {

    }
}