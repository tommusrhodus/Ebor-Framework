<?php

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	global $rand;
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	global $ebor_tab_type;
	$ebor_tabs_count   = $rand = 0;
	$ebor_tabs_content = $ebor_tab_type = false;
	
	extract( 
		shortcode_atts( 
			array(
				'type' => 'horizontal'
			), $atts 
		) 
	);
	
	$output        = false;
	$ebor_tab_type = $type;
	$rand          = wp_rand(0, 10000);
	
	if( 'horizontal' == $type ){
		
		$output .= '
			<div class="tabs mb-50">
				<ul class="nav nav-tabs">'. do_shortcode($content) .'</ul>
				<div class="tab-content">'. $ebor_tabs_content .'</div>
			</div>
		';
		
	} elseif( 'vertical' == $type ){
		
		$output .= '
			<div class="tabs vertical mt-40 mb-60">
				<ul class="nav nav-tabs">'. do_shortcode($content) .'</ul>
				<div class="tab-content">'. $ebor_tabs_content .'</div>
			</div>
		';
		
	} elseif( 'icons' == $type ){
		
		$output .= '
			<div class="service-tabs">
				<div class="tabs">
					<ul class="nav nav-tabs">'. do_shortcode($content) .'</ul>
					<div class="tab-content">'. $ebor_tabs_content .'</div>
				</div>
			</div>
		';
		
	} else {
		
		$output .= '
			<div class="tabs tabs-bb mb-20">
				<ul class="nav nav-tabs">'. do_shortcode($content) .'</ul>
				<div class="tab-content">'. $ebor_tabs_content .'</div>
			</div>
		';
		
	}
	
	return $output;
}
add_shortcode( 'gaze_tabs', 'ebor_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabs_content_shortcode( $atts, $content = null ) {
	global $ebor_tab_type;
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	global $rand;
	$ebor_tabs_count++;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$active = ( 1 == $ebor_tabs_count ) ? 'active' : '';

	$ebor_tabs_content .= '<div class="tab-pane fade in '. $active .'" id="tab-'. $rand .'-'. esc_attr($ebor_tabs_count) .'">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';
	
	if( $icon ){
		
		$output = '
			<li class="'. $active .' col-md-3 col-xs-6 text-center">
				<a href="#tab-'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab">
					<i class="'. $icon .'"></i>
					<h4>'. $title .'</h4>
				</a>
			</li>
		';
		
	} else {
	
		$output = '
			<li class="'. $active .'">
				<a href="#tab-'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab">'. $title .'</a>
			</li>   
		';
	
	}
	
	return $output;
}
add_shortcode( 'gaze_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon"            => 'gaze-vc-block',
		    'name'            => esc_html__( 'Tabs' , 'gaze' ),
		    'base'            => 'gaze_tabs',
		    'description'     => esc_html__( 'Create Tabbed Content', 'gaze' ),
		    'as_parent'       => array('only' => 'gaze_tabs_content'),
		    'content_element' => true,
		    "js_view"         => 'VcColumnView',
		    "category"        => esc_html__('Gaze WP Theme', 'gaze'),
		    'params'          => array(
		    	array(
		    		"type"       => "dropdown",
		    		"heading"    => esc_html__("Display type", 'gaze'),
		    		"param_name" => "type",
		    		"value"      => array(
		    			'Horizontal Tabs' => 'horizontal',
		    			'Vertical Tabs'   => 'vertical',
		    			'Border Bottom'   => 'border',
		    			'Icon Tabs'       => 'icons'
		    		)
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_shortcode_vc' );

// Nested Element
function ebor_tabs_content_shortcode_vc() {
	
	$icons = array_keys(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_keys(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"            => 'gaze-vc-block',
		    'name'            => esc_html__('Tabs Content', 'gaze'),
		    'base'            => 'gaze_tabs_content',
		    'description'     => esc_html__( 'Tab Content Element', 'gaze' ),
		    "category"        => esc_html__('Gaze WP Theme', 'gaze'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'gaze_tabs'),
		    'params'          => array(
		    	array(
		    		"type"       => "ebor_icons",
		    		"heading"    => esc_html__("Icon", 'gaze'),
		    		"param_name" => "icon",
		    		"value"      => $icons
		    	),
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
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_gaze_tabs extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_gaze_tabs_content extends WPBakeryShortCode {}
}