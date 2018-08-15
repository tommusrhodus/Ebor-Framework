<?php

global $ebor_tabs_content;
global $ebor_tabs_count;
$ebor_tabs_count = 0;

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	$ebor_tabs_content = false;
	
	extract( 
		shortcode_atts( 
			array(
				'type' => ''
			), $atts 
		) 
	);
	$output = false;
	
	$rand = wp_rand(0,10000);
		
	$output .= '
		<div class="tabs tabs-top left tab-container ebor-'. $rand .' '. esc_attr($type) .'"><ul class="etabs">'. do_shortcode($content) .'</ul><div class="panel-container">'. $ebor_tabs_content .'</div></div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(\'.tabs.tabs-top.ebor-'. $rand .'\').easytabs({
				    animationSpeed: 300,
				    updateHash: false
				});
			});
		</script>
	';
	
	return $output;
}
add_shortcode( 'pivot_tabs', 'ebor_tabs_shortcode' );

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
	$ebor_tabs_content .= '<div class="tab-block" id="tab-'. esc_attr($ebor_tabs_count) .'">'. wpautop(do_shortcode(wp_specialchars_decode($content, ENT_QUOTES))) .'</div>';
	$output = ' <li class="tab"><a href="#tab-'. esc_attr($ebor_tabs_count) .'">'. wp_specialchars_decode($title, ENT_QUOTES) .'</a></li> ';
	return $output;
}
add_shortcode( 'pivot_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'pivot-vc-block',
		    'name'                    => __( 'Tabs' , 'pivot' ),
		    'base'                    => 'pivot_tabs',
		    'description'             => __( 'Create Tabbed Content', 'pivot' ),
		    'as_parent'               => array('only' => 'pivot_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('pivot WP Theme', 'pivot'),
		    'params' => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Display type", 'pivot'),
		    		"param_name" => "type",
		    		"value" => array_flip(array(
		    			'' => 'Standard',
		    			'bordered' => 'Bordered'
		    		))
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
			"icon" => 'pivot-vc-block',
		    'name'            => __('Tabs Content', 'pivot'),
		    'base'            => 'pivot_tabs_content',
		    'description'     => __( 'Tab Content Element', 'pivot' ),
		    "category" => __('pivot WP Theme', 'pivot'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'pivot_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'pivot'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'pivot'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_pivot_tabs extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_pivot_tabs_content extends WPBakeryShortCode {}
}