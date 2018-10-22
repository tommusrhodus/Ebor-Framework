<?php

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	global $rand;
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	global $ebor_tab_type;
	$ebor_tabs_count = $rand = 0;
	$ebor_tabs_content = $ebor_tab_type = false;
	
	extract( 
		shortcode_atts( 
			array(
				'type' => 'bordered',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$ebor_tab_type = $type;
	$output = false;
	$rand   = wp_rand(0, 10000);
	  
	if( 'vertical' == $type ){
	
		$output .= '
			<div class="row">
			
				<div class="col-4">
					<div class="list-group" id="list-tab" role="tablist">
					 	'. do_shortcode($content) .'
					</div>
				</div>
				
				<div class="col-8">
					<div class="tab-content" id="nav-tabContent">
						'. $ebor_tabs_content .'
					</div>
				</div>
				
			</div>
		';
	
	} else {
	
		$output .= '
			<div class="tabs-wrapper '. $type .' '. esc_attr( $custom_css_class ).'">
				<ul class="nav nav-tabs">
					'. do_shortcode($content) .'
				</ul>
				<div class="tab-content">
					'. $ebor_tabs_content .'
				</div><!-- /.tab-content --> 
			</div>
		';
	
	}
	
	return $output;
}
add_shortcode( 'brailie_tabs', 'ebor_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabs_content_shortcode( $atts, $content = null ) {
	global $ebor_tabs_content;
	global $ebor_tabs_count;
	global $rand;
	global $ebor_tab_type;
	$ebor_tabs_count++;
	
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$active = ( 1 == $ebor_tabs_count ) ? 'show active' : '';
	
	$ebor_tabs_content .= '<div class="tab-pane fade '. $active .'" id="tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';
	
	if( 'vertical' == $ebor_tab_type ){
		$output = '<a class="list-group-item list-group-item-action '. $active .'" href="#tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="list" role="tab">'. htmlspecialchars_decode($title) .'</a>';
	} else {
		$output = '<li class="nav-item"><a class="nav-link '. $active .'" href="#tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab">'. htmlspecialchars_decode($title) .'</a></li>';
	}
	
	return $output;
}
add_shortcode( 'brailie_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon"            => 'brailie-vc-block',
		    'name'            => esc_html__( 'Tabs' , 'brailie' ),
		    'base'            => 'brailie_tabs',
		    'description'     => esc_html__( 'Create Tabbed Content', 'brailie' ),
		    'as_parent'       => array('only' => 'brailie_tabs_content'),
		    'content_element' => true,
		    "js_view"         => 'VcColumnView',
		    "category"        => esc_html__('brailie WP Theme', 'brailie'),
		    'params'          => array(
		    	array(
		    		"type"       => "dropdown",
		    		"heading"    => esc_html__("Display type", 'brailie'),
		    		"param_name" => "type",
		    		"value"      => array(
		    			'Bordered' => 'bordered',
		    			'Lined'    => 'lined',
		    			'Vertical' => 'vertical'
		    		)
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
add_action( 'vc_before_init', 'ebor_tabs_shortcode_vc' );

// Nested Element
function ebor_tabs_content_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('brailie_get_icons') ){
		$icons = array_values(brailie_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"            => 'brailie-vc-block',
		    'name'            => esc_html__('Tabs Content', 'brailie'),
		    'base'            => 'brailie_tabs_content',
		    'description'     => esc_html__( 'Tab Content Element', 'brailie' ),
		    "category"        => esc_html__('brailie WP Theme', 'brailie'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'brailie_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type"       => "textfield",
		    		"heading"    => esc_html__("Title", 'brailie'),
		    		"param_name" => "title",
		    		'holder'     => 'div'
		    	),
	            array(
	            	"type"       => "textarea_html",
	            	"heading"    => esc_html__("Block Content", 'brailie'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_brailie_tabs extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_brailie_tabs_content extends WPBakeryShortCode {}
}