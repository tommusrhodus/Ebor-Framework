<?php

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'tabs-horizontal',
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '<div class="tabs-container '. $type.' '. esc_attr($custom_css_class) .'" data-content-align="left"><ul class="tabs">'. do_shortcode($content) .'</ul></div>';

	return $output;
}
add_shortcode( 'stack_tabs', 'ebor_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabs_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'custom_css_class' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '<li class="'. esc_attr($custom_css_class) .'">';
	
	if( $icon ){
		
		$output .= '
			<div class="tab__title text-center">
				<span class="icon icon--sm block '. $icon .'"></span>
				<span class="h5">'. htmlspecialchars_decode($title) .'</span>
			</div>
		';
		
	} elseif( $icon && !$title ) {
		
		$output .= '
			<div class="tab__title text-center">
				<span class="icon icon--sm block '. $icon .'"></span>
			</div>
		';
		
	} else {
		
		$output .= '
			<div class="tab__title">
				<span class="h5">'. htmlspecialchars_decode($title) .'</span>
			</div>
		';
		
	}
	
	$output .= '
			<div class="tab__content">
				'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
			</div>
		</li>
	';

	return $output;
}
add_shortcode( 'stack_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'                    => esc_html__( 'Tabs' , 'stackwordpresstheme' ),
		    'base'                    => 'stack_tabs',
		    'description'             => esc_html__( 'Create tabs Content', 'stackwordpresstheme' ),
		    'as_parent'               => array('only' => 'stack_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'params'          => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => esc_html__("Display type", 'stackwordpresstheme'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Horizontal Tabs' => 'tabs-horizontal',
		    			'Vertical Tabs' => 'tabs--vertical',
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
	
	$icons = array('Install Ebor Framework' => 'Install Ebor Framework');
	
	if( function_exists('ebor_get_icons') ){
		$icons = ebor_get_icons();	
	}
	
	vc_map( 
		array(
			"icon" => 'stack-vc-block',
		    'name'            => esc_html__('Tabs Content', 'stackwordpresstheme'),
		    'base'            => 'stack_tabs_content',
		    'description'     => esc_html__( 'Toggle Content Element', 'stackwordpresstheme' ),
		    "category" => esc_html__('Stack WP Theme', 'stackwordpresstheme'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'stack_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'stackwordpresstheme'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
		    	array(
		    		"type" => "ebor_icons",
		    		"heading" => esc_html__("Click an Icon to choose (Icon tabs only)", 'stackwordpresstheme'),
		    		"param_name" => "icon",
		    		"value" => $icons,
		    		'description' => 'Type "none" or leave blank to hide icons.'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'stackwordpresstheme'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Extra CSS Class Name", 'stackwordpresstheme'),
	            	"param_name" => "custom_css_class",
	            	"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_stack_tabs extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_stack_tabs_content extends WPBakeryShortCode {}
}