<?php

/**
 * The Shortcode
 */
function ebor_tabs_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'icon-tabs'
			), $atts 
		) 
	);

	$output = '
		<div class="tabbed-content '. esc_attr($type) .'">
		    <ul class="tabs">
		        '. do_shortcode($content) .'
		    </ul>
		</div>
	';
	
	return $output;
}
add_shortcode( 'launchkit_tabs', 'ebor_tabs_shortcode' );

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
		    <div class="tab-title text-center">
		    	<i class="icon icon-'. str_replace('icon-', '', $icon) .'"></i>
		        <h6>'. htmlspecialchars_decode($title) .'</h6>
		        <div class="indicator"></div>
		    </div>
		    <div class="tab-content">
		    	<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
		        	'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
		        </div>
		    </div>
		</li>
	';

	return $output;
}
add_shortcode( 'launchkit_tabs_content', 'ebor_tabs_content_shortcode' );

// Parent Element
function ebor_tabs_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'launchkit-vc-block',
		    'name'                    => __( 'Tabs' , 'launchkit' ),
		    'base'                    => 'launchkit_tabs',
		    'description'             => __( 'Create Tabbed Content', 'launchkit' ),
		    'as_parent'               => array('only' => 'launchkit_tabs_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => __('LaunchKit WP Theme', 'launchkit'),
		    'params' => array(
		    	array(
		    		"type" => "dropdown",
		    		"heading" => __("Display type", 'launchkit'),
		    		"param_name" => "type",
		    		"value" => array(
		    			'Icon Tabs' => 'icon-tabs',
		    			'Text Tabs' => 'text-tabs'
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
			"icon" => 'launchkit-vc-block',
		    'name'            => __('Tabs Content', 'launchkit'),
		    'base'            => 'launchkit_tabs_content',
		    'description'     => __( 'Tab Content Element', 'launchkit' ),
		    "category" => __('LaunchKit WP Themee', 'launchkit'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'launchkit_tabs'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => __("Title", 'launchkit'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => __("Block Content", 'launchkit'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "ebor_icons",
	            	"heading" => __("Click an Icon to choose (Icon tabs only)", 'launchkit'),
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
    class WPBakeryShortCode_launchkit_tabs extends WPBakeryShortCodesContainer {

    }
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_launchkit_tabs_content extends WPBakeryShortCode {

    }
}