<?php

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'button-tabs'
			), $atts 
		) 
	);
	
	$output = '
		<div class="tabbed-content '. esc_attr($type) .' text-center">
		    <ul class="tabs">
		        '. do_shortcode($content) .'
		    </ul>
		</div>
	';
	
	return $output;
}
add_shortcode( 'foundry_tabs', 'ebor_tabs_shortcode' );

/**
 * The Shortcode
 */
function ebor_tabs_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => ''
			), $atts 
		) 
	);
	
	$output = '
		<li>
		    <div class="tab-title">
		    	<i class="'. $icon .' icon"></i>
		        <span>'. htmlspecialchars_decode($title) .'</span>
		    </div>
		    <div class="tab-content">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'</div>
		</li>
	';

	return $output;
}
add_shortcode( 'foundry_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'                    => __( 'Tabs' , 'foundry' ),
		    'base'                    => 'foundry_tabs',
		    'description'             => __( 'Create Tabbed Content', 'foundry' ),
		    'as_parent'               => array('only' => 'foundry_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'params' => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Display type", 'foundry'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Button Tabs' => 'button-tabs',
		    			'Icon Tabs' => 'icon-tabs',
		    			'Text Tabs' => 'text-tabs',
		    			'Text Tabs, No Border' => 'text-tabs no-border',
		    			'Vertical Tabs' => 'button-tabs vertical'
		    		)
		    	)
		    )
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_shortcode_vc' );

// Nested Element
function ebor_tabs_content_shortcode_vc() {
	
	$icons = ebor_get_icons();
	
	vc_map( 
		array(
			"icon" => 'foundry-vc-block',
		    'name'            => __('Tabs Content', 'foundry'),
		    'base'            => 'foundry_tabs_content',
		    'description'     => __( 'Tab Content Element', 'foundry' ),
		    "category" => __('Foundry WP Theme', 'foundry'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'foundry_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'foundry'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'foundry'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "ebor_icons",
	            	"heading" => __("Click an Icon to choose (Icon tabs only)", 'foundry'),
	            	"param_name" => "icon",
	            	"value" => $icons,
	            	'description' => 'Type "none" or leave blank to hide icons.'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'ebor_tabs_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_foundry_tabs extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_foundry_tabs_content extends WPBakeryShortCode {

    }
}