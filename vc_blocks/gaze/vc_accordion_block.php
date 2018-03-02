<?php

/**
 * The Shortcode
 */
function ebor_accordion_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'panel-group-bg',
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
	
	
	$output .= '
		<div class="panel-group accordion mb-50" id="accordion">'. do_shortcode($content) .'</div>
	';

	return $output;
}
add_shortcode( 'gaze_accordion', 'ebor_accordion_shortcode' );

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
		$in = 'in';	
	}
	
	$class = ( 'active' == $active ) ? 'minus' : 'plus';
	
	$output = '
		<div class="panel">
		
			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse-'. $rand .'-'. esc_attr($ebor_accordion_count) .'" class="'. $class .'">
					'. htmlspecialchars_decode($title) .'<span>&nbsp;</span>
				</a>
			</div>
			
			<div id="collapse-'. $rand .'-'. esc_attr($ebor_accordion_count) .'" class="panel-collapse collapse '. esc_attr($in) .'">
				<div class="panel-body">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>
			</div>
			
		</div>
	';

	return $output;
}
add_shortcode( 'gaze_accordion_content', 'ebor_accordion_content_shortcode' );

// Parent Element
function ebor_accordion_shortcode_vc() {
	vc_map( 
		array(
			"icon"                    => 'gaze-vc-block',
		    'name'                    => esc_html__( 'Accordion' , 'gaze' ),
		    'base'                    => 'gaze_accordion',
		    'description'             => esc_html__( 'Create Accordion Content', 'gaze' ),
		    'as_parent'               => array('only' => 'gaze_accordion_content'),
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view"                 => 'VcColumnView',
		    "category"                => esc_html__('Gaze WP Theme', 'gaze'),
		    'params'                  => array(
		    	array(
		    		"type"       => "dropdown",
		    		"heading"    => esc_html__("First item open by default?", 'gaze'),
		    		"param_name" => "open",
		    		"value"      => array(
		    			'Yes' => 'yes',
		    			'No'  => 'no'
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
			"icon"            => 'gaze-vc-block',
		    'name'            => esc_html__('Accordion Content', 'gaze'),
		    'base'            => 'gaze_accordion_content',
		    'description'     => esc_html__( 'Accordion Content Element', 'gaze' ),
		    "category"        => esc_html__('Gaze WP Theme', 'gaze'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'gaze_accordion'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type"       => "textfield",
		    		"heading"    => esc_html__("Title", 'gaze'),
		    		"param_name" => "title",
		    		'holder'     => 'div'
		    	),
	            array(
	            	"type"       => "textarea_html",
	            	"heading"    => esc_html__("Block Content", 'gaze'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_accordion_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_gaze_accordion extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_gaze_accordion_content extends WPBakeryShortCode {}
}