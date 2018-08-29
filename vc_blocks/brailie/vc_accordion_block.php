<?php

/**
 * The Shortcode
 */
function ebor_accordion_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'bordered',
				'open' => 'yes'
			), $atts 
		) 
	);
	
	global $ebor_accordion_count;
	global $rand;
	global $ebor_accordion_open;
	$ebor_accordion_count = 0;
	$rand = false;
	$output = false;
	$rand = wp_rand(0,10000);
	$ebor_accordion_open = $open;
	
	$output .= '<div id="accordion'. $rand .'" class="accordion-wrapper '. $type .'">'. do_shortcode($content) .'</div>';

	return $output;
}
add_shortcode( 'brailie_accordion', 'ebor_accordion_shortcode' );

/**
 * The Shortcode
 */
function ebor_accordion_content_shortcode( $atts, $content = null ) {
	global $ebor_accordion_count;
	global $rand;
	global $ebor_accordion_open;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => ''
			), $atts 
		) 
	);
	
	$ebor_accordion_count++;
	$active = $in = false;
	
	if( 1 == $ebor_accordion_count && 'yes' == $ebor_accordion_open ){
		$active = 'active';
		$in = 'show';	
		$aria_expanded = 'true';
	} else {
		$aria_expanded = 'false';
	}
	
	$output = '
		<div class="card">
			<div class="card-header">
				<h3> <a data-toggle="collapse" data-parent="#accordion-'. $rand .'" href="#collapse-'. $rand .'-'. esc_attr($ebor_accordion_count) .'" aria-expanded="'. $aria_expanded .'">'. $title .'</a> </h3>
			</div>
			<div id="collapse-'. $rand .'-'. esc_attr($ebor_accordion_count) .'" class="collapse '. esc_attr($in) .'">
				<div class="card-block">'. do_shortcode($content) .'</div>
			</div>
		</div>
	';

	return $output;
}
add_shortcode( 'brailie_accordion_content', 'ebor_accordion_content_shortcode' );

// Parent Element
function ebor_accordion_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'                    => esc_html__( 'Accordion' , 'brailie' ),
		    'base'                    => 'brailie_accordion',
		    'description'             => esc_html__( 'Create Accordion Content', 'brailie' ),
		    'as_parent'               => array('only' => 'brailie_accordion_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		    'params' => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Display type", 'brailie'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Border'     => 'bordered',
		    			'Line'       => 'lined',
		    		)
		    	),
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("First item open by default?", 'brailie'),
		    		"param_name" => "open",
		    		"value" => array(
		    			'Yes' => 'yes',
		    			'No' => 'no'
		    		)
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_shortcode_vc' );

// Nested Element
function ebor_accordion_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'brailie-vc-block',
		    'name'            => esc_html__('Accordion Content', 'brailie'),
		    'base'            => 'brailie_accordion_content',
		    'description'     => esc_html__( 'Accordion Content Element', 'brailie' ),
		    "category" => esc_html__('brailie WP Theme', 'brailie'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'brailie_accordion'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'brailie'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'brailie'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_brailie_accordion extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_brailie_accordion_content extends WPBakeryShortCode {}
}