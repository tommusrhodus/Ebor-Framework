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
				'type' => 'horizontal'
			), $atts 
		) 
	);
	$output = false;
	$ebor_tab_type = $type;
	$rand = wp_rand(0, 10000);
	
	if( 'horizontal' == $type ){
		
		$output .= '
			<ul class="nav nav-tabs nav-tabs-lined nav-tabs-lined-bottom">
				'. do_shortcode($content) .'
			</ul>
			<div class="space20"></div>
			<div class="tab-content">
				'. $ebor_tabs_content .'
			</div><!-- /.tab-content --> 
		';
		
	} elseif( 'icon' == $type ){
		
		$content = do_shortcode($content);
		
		$output .= '
			<div class="tab-content text-center">
				'. $ebor_tabs_content .'
			</div><!-- /.tab-content -->
			<div class="space10"></div>
			<ul class="nav nav-tabs nav-tabs-lined nav-tabs-lined-top flex-center">
				'. $content .'
			</ul>
		';

	} else {
		
		$output .= '
			<div class="tabs-stacked flex-vertical">
				<ul class="nav nav-tabs nav-stacked">
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
add_shortcode( 'creatink_tabs', 'ebor_tabs_shortcode' );

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
	
	$ebor_tabs_content .= '<div class="tab-pane fade in '. $active .'" id="tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';
	
	if( 'icon' == $ebor_tab_type ){
		
		$output = '<li class="'. $active .'"><a href="#tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab"><span class="icon icon-m icon-color mb-10"><i class="'. $icon .'"></i></span><h5 class="mb-0">'. htmlspecialchars_decode($title) .'</h5></a></li>';
		
	} else {
		
		$output = ' <li class="'. $active .'"><a href="#tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab">'. htmlspecialchars_decode($title) .'</a></li> ';
	
	}
	
	return $output;
}
add_shortcode( 'creatink_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon"            => 'creatink-vc-block',
		    'name'            => esc_html__( 'Tabs' , 'creatink' ),
		    'base'            => 'creatink_tabs',
		    'description'     => esc_html__( 'Create Tabbed Content', 'creatink' ),
		    'as_parent'       => array('only' => 'creatink_tabs_content'),
		    'content_element' => true,
		    "js_view"         => 'VcColumnView',
		    "category"        => esc_html__('creatink WP Theme', 'creatink'),
		    'params'          => array(
		    	array(
		    		"type"       => "dropdown",
		    		"heading"    => esc_html__("Display type", 'creatink'),
		    		"param_name" => "type",
		    		"value"      => array(
		    			'Horizontal Tabs' => 'horizontal',
		    			'Vertical Tabs'   => 'vertical',
		    			'Icon Tabs'       => 'icon'
		    		)
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_shortcode_vc' );

// Nested Element
function ebor_tabs_content_shortcode_vc() {
	
	$icons = array_values(array('Install Ebor Framework' => 'Install Ebor Framework'));
	
	if( function_exists('ebor_get_icons') ){
		$icons = array_values(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"            => 'creatink-vc-block',
		    'name'            => esc_html__('Tabs Content', 'creatink'),
		    'base'            => 'creatink_tabs_content',
		    'description'     => esc_html__( 'Tab Content Element', 'creatink' ),
		    "category"        => esc_html__('creatink WP Theme', 'creatink'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'creatink_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "ebor_icons",
		    		"heading" => esc_html__("Icon", 'creatink'),
		    		"param_name" => "icon",
		    		"value" => $icons
		    	),
		    	array(
		    		"type"       => "textfield",
		    		"heading"    => esc_html__("Title", 'creatink'),
		    		"param_name" => "title",
		    		'holder'     => 'div'
		    	),
	            array(
	            	"type"       => "textarea_html",
	            	"heading"    => esc_html__("Block Content", 'creatink'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_creatink_tabs extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_creatink_tabs_content extends WPBakeryShortCode {}
}