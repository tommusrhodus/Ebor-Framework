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
			<div class="tab-content">
				'. $ebor_tabs_content .'
			</div><!-- /.tab-content --> 
		';
		
	} elseif( 'icon' == $type ){
		
		$content = do_shortcode($content);
		
		$output .= '
			<ul class="nav nav-tabs nav-tabs-lined nav-tabs-lined-top flex-center">
				'. $content .'
			</ul>
			<div class="tab-content">
				'. $ebor_tabs_content .'
			</div><!-- /.tab-content -->
		';

	} 
	
	return $output;
}
add_shortcode( 'belton_tabs', 'ebor_tabs_shortcode' );

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
				'icon' => '',
				'image' => ''
			), $atts 
		) 
	);
	
	$active = ( 1 == $ebor_tabs_count ) ? 'active' : '';
	
	$ebor_tabs_content .= '<div class="tab-pane fade in '. $active .'" id="tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>';
	
	if( 'icon' == $ebor_tab_type ){
		if($image) {
			$bg_image = wp_get_attachment_image_src($image, 'full');
			$output = '<li class="'. $active .'"><a href="#tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab" style="background: url('.esc_url($bg_image[0]).') no-repeat top center;">'. htmlspecialchars_decode($title) .'</a></li>';
		} else {
			$output = '<li class="'. $active .'"><a href="#tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab"><span class="icon icon-m icon-color mb-10"><i class="fa '. $icon .'"></i></span>'. htmlspecialchars_decode($title) .'</a></li>';	
		}
		
		
	} else {
		
		$output = ' <li class="'. $active .'"><a href="#tab'. $rand .'-'. esc_attr($ebor_tabs_count) .'" data-toggle="tab">'. htmlspecialchars_decode($title) .'</a></li> ';
	
	}
	
	return $output;
}
add_shortcode( 'belton_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon"            => 'belton-vc-block',
		    'name'            => esc_html__( 'Tabs' , 'belton' ),
		    'base'            => 'belton_tabs',
		    'description'     => esc_html__( 'Create Tabbed Content', 'belton' ),
		    'as_parent'       => array('only' => 'belton_tabs_content'),
		    'content_element' => true,
		    "js_view"         => 'VcColumnView',
		    "category"        => esc_html__('belton WP Theme', 'belton'),
		    'params'          => array(
		    	array(
		    		"type"       => "dropdown",
		    		"heading"    => esc_html__("Display type", 'belton'),
		    		"param_name" => "type",
		    		"value"      => array(
		    			'Horizontal Tabs' => 'horizontal',
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
		$icons = array_keys(ebor_get_icons());	
	}
	
	vc_map( 
		array(
			"icon"            => 'belton-vc-block',
		    'name'            => esc_html__('Tabs Content', 'belton'),
		    'base'            => 'belton_tabs_content',
		    'description'     => esc_html__( 'Tab Content Element', 'belton' ),
		    "category"        => esc_html__('belton WP Theme', 'belton'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'belton_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "ebor_icons",
		    		"heading" => esc_html__("Icon", 'belton'),
		    		"param_name" => "icon",
		    		"value" => $icons
		    	),
		    	array(
					"type" => "attach_image",
					"heading" => esc_html__("Icon Image", 'belton'),
					"param_name" => "image"
				),
		    	array(
		    		"type"       => "textfield",
		    		"heading"    => esc_html__("Title", 'belton'),
		    		"param_name" => "title",
		    		'holder'     => 'div'
		    	),
	            array(
	            	"type"       => "textarea_html",
	            	"heading"    => esc_html__("Block Content", 'belton'),
	            	"param_name" => "content"
	            ),
		    ),
		) 
	);
	
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_belton_tabs extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_belton_tabs_content extends WPBakeryShortCode {}
}